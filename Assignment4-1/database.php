<?php
// Database connection details
$dsn = 'mysql:host=localhost;dbname=my_guitar_shop';
$username = 'root'; // Use 'root' for default, or your MySQL username
$password = ''; // Leave empty for default, or add your MySQL password

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "Database connection failed: $error_message";
    exit();
}
?>
