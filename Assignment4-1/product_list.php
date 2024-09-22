<?php
// Include the database connection
include('database.php');

// Fetch all products
$query = 'SELECT * FROM products';
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
</head>
<body>
    <h1>Product List</h1>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Category ID</th>
            <th>Product Name</th>
            <th>List Price</th>
            <th>Edit</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productID']; ?></td>
                <td><?php echo $product['categoryID']; ?></td>
                <td><?php echo $product['productName']; ?></td>
                <td><?php echo $product['listPrice']; ?></td>
                <td>
                    <form action="edit_product.php" method="get">
                        <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
                        <input type="submit" value="Edit">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
