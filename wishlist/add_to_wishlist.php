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

// Check if the same item_id is already in the wishlist for the same email
$checkQuery = "SELECT COUNT(*) FROM wishlist WHERE item_id = '$item_id' AND email = '$yourEmail'";
$result = mysqli_query($conn, $checkQuery);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}

$row = mysqli_fetch_array($result);
if ($row[0] > 0) {
    // The same item_id is already in the wishlist for the same email
    echo "<script>alert('This item has already been added to your wishlist');</script>";
    
    // Close the database connection
    mysqli_close($conn);
    
    // Redirect back to the previous page
    echo "<script>window.history.back();</script>";
    exit();
}

// If the item is not in the wishlist, insert it
$insertQuery = "INSERT INTO wishlist (id, name, item_id, description, price, category, item_condition, email)
        VALUES (NULL, '$name', '$item_id', '$description', '$price', '$category', '$item_condition', '$yourEmail')";

if (mysqli_query($conn, $insertQuery)) {
    // Data was successfully inserted into the "wishlist" table
    echo "<script>alert('Product has been added to your wishlist');</script>";
} else {
    // There was an error inserting the data
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection and redirect to wishlist.php
mysqli_close($conn);
header("Location: wishlist.php");
exit();
?>


