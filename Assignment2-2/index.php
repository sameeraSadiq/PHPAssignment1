<?php
// Initialize variables for form inputs and results
$product_description = "";
$list_price = "";
$discount_percent = "";
$discount_amount = 0.0;
$discount_price = 0.0;
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize input
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
        // Calculate discount amount and discounted price
        $discount_amount = $list_price * ($discount_percent / 100);
        $discount_price = $list_price - $discount_amount;

        // Clear form values
        $product_description = "";
        $list_price = "";
        $discount_percent = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Discount Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 8px; margin-bottom: 10px; }
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
            <p>Product Description: <?php echo htmlspecialchars($_POST['product_description']); ?></p>
            <p>List Price: $<?php echo number_format(floatval($_POST['list_price']), 2); ?></p>
            <p>Discount Percent: <?php echo number_format(floatval($_POST['discount_percent']), 2); ?>%</p>
            <p>Discount Amount: $<?php echo number_format($discount_amount, 2); ?></p>
            <p>Discounted Price: $<?php echo number_format($discount_price, 2); ?></p>
        </div>
    <?php endif; ?>
</body>
</html>