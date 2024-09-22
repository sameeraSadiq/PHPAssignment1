<?php
// Initialize variables
$product_description = "";
$list_price = 0.0;
$discount_percent = 0.0;
$discount_amount = 0.0;
$discount_price = 0.0;
$sales_tax_rate = 0.08;
$sales_tax = 0.0;
$total_price = 0.0;
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product_description = trim($_POST['product_description']);
    $list_price = floatval($_POST['list_price']);
    $discount_percent = floatval($_POST['discount_percent']);
    
    // Data validation
    if (empty($product_description)) {
        $error_message = "Product description is required.";
    } elseif ($list_price <= 0) {
        $error_message = "List price must be a positive number.";
    } elseif ($discount_percent < 0 || $discount_percent > 100) {
        $error_message = "Discount percent must be between 0 and 100.";
    } else {
        // Calculate the discount amount and discounted price
        $discount_amount = $list_price * ($discount_percent / 100);
        $discount_price = $list_price - $discount_amount;
        
        // Calculate sales tax based on discounted price
        $sales_tax = $discount_price * $sales_tax_rate;
        
        // Calculate total price after applying tax
        $total_price = $discount_price + $sales_tax;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Discount Calculator with Sales Tax</title>
    <style>
        body { font-family: Arial, sans-serif; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; }
        .error { color: red; }
        .results { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Product Discount Calculator</h1>

    <form method="post" action="">
        <label for="product_description">Product Description:</label>
        <input type="text" name="product_description" id="product_description" value="<?php echo htmlspecialchars($product_description); ?>" required>

        <label for="list_price">List Price:</label>
        <input type="number" step="0.01" name="list_price" id="list_price" value="<?php echo htmlspecialchars($list_price); ?>" required>

        <label for="discount_percent">Discount Percent:</label>
        <input type="number" step="0.01" name="discount_percent" id="discount_percent" value="<?php echo htmlspecialchars($discount_percent); ?>" required>

        <input type="submit" value="Calculate">

        <?php if (!empty($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error_message)) : ?>
        <div class="results">
            <h2>Results</h2>
            <p>Product Description: <?php echo htmlspecialchars($product_description); ?></p>
            <p>List Price: $<?php echo number_format($list_price, 2); ?></p>
            <p>Discount Percent: <?php echo number_format($discount_percent, 2); ?>%</p>
            <p>Discount Amount: $<?php echo number_format($discount_amount, 2); ?></p>
            <p>Discounted Price: $<?php echo number_format($discount_price, 2); ?></p>
            <p>Sales Tax Rate: <?php echo number_format($sales_tax_rate * 100, 2); ?>%</p>
            <p>Sales Tax Amount: $<?php echo number_format($sales_tax, 2); ?></p>
            <p>Total Price After Tax: $<?php echo number_format($total_price, 2); ?></p>
        </div>
    <?php endif; ?>
</body>
</html>