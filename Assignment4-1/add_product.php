<?php
// Include the database connection
include('database.php');

// Fetch all categories for the dropdown
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
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_product_process.php" method="post">
        <label>Category:</label>
        <select name="categoryID">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Product Name:</label>
        <input type="text" name="productName"><br>

        <label>List Price:</label>
        <input type="text" name="listPrice"><br>

        <input type="submit" value="Add Product">
    </form>
</body>
</html>
