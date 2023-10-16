<?php
require_once("../session/session.php");
$yourEmail = $_SESSION['email'];
require '../connection/connection.php';

$name = $_GET['name'];
$item_id = $_GET['item_id'];
$description = $_GET['description'];
$price = $_GET['price'];
$category = $_GET['category'];
$item_condition = $_GET['item_condition'];

// Insert data into the "wishlist" table
$sql = "INSERT INTO wishlist (name, item_id, description, price, category, item_condition, email)
        VALUES ('$name', '$item_id', '$description', '$price', '$category', '$item_condition', '$yourEmail')";

if (mysqli_query($conn, $sql)) {
    // Data was successfully inserted into the "wishlist" table
    echo "Product has been added to wishlist";

    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // There was an error inserting the data
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
