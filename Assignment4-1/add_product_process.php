<?php
// Include the database connection
include('database.php');

// Get form data
$category_id = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
$product_name = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
$list_price = filter_input(INPUT_POST, 'listPrice', FILTER_VALIDATE_FLOAT);

// Insert product into the database
if ($category_id && $product_name && $list_price) {
    $query = 'INSERT INTO products (categoryID, productName, listPrice)
              VALUES (:category_id, :product_name, :list_price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':product_name', $product_name);
    $statement->bindValue(':list_price', $list_price);
    $statement->execute();
    $statement->closeCursor();

    // Redirect to product list
    header('Location: product_list.php');
} else {
    echo "Please fill in all fields.";
}
?>
