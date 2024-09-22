<?php
// Include the database connection
include('database.php');

// Get form data
$product_id = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
$product_name = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
$list_price = filter_input(INPUT_POST, 'listPrice', FILTER_VALIDATE_FLOAT);

// Update product details in the database
if ($product_id && $category_id && $product_name && $list_price) {
    $query = 'UPDATE products
              SET categoryID = :category_id,
                  productName = :product_name,
                  listPrice = :list_price
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':product_name', $product_name);
    $statement->bindValue(':list_price', $list_price);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();

    // Redirect back to the product list
    header('Location: product_list.php');
}
?>
