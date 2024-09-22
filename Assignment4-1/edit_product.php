<?php
// Include the database connection
include('database.php');

// Get the productID from the form
$product_id = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT);

// Fetch the product data
$query = 'SELECT * FROM products WHERE productID = :product_id';
$statement = $db->prepare($query);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$product = $statement->fetch();
$statement->closeCursor();

// Fetch all categories
$query = 'SELECT * FROM categories';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="update_product.php" method="post">
        <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">

        <label>Category:</label>
        <select name="categoryID">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>" 
                    <?php if ($category['categoryID'] == $product['categoryID']) echo 'selected'; ?>>
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Product Name:</label>
        <input type="text" name="productName" value="<?php echo $product['productName']; ?>"><br>

        <label>List Price:</label>
        <input type="text" name="listPrice" value="<?php echo $product['listPrice']; ?>"><br>

        <input type="submit" value="Update Product">
    </form>
</body>
</html>
