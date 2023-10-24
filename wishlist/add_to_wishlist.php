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
$checkQuery = "SELECT * FROM wishlist WHERE email = '$yourEmail' AND item_id = $item_id";
$result = mysqli_query($conn, $checkQuery);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}

if (mysqli_num_rows($result) > 0) {
    // The item is already in the wishlist, show a message and redirect
    echo "<script>alert('You already have this item in your wishlist'); window.location.href = '../productinfo/productInfo.php?id=$item_id';</script>";
    mysqli_close($conn);
    exit();
}

// Check if the user's wishlist count is within the limit (e.g., 5 for basic members)
$countQuery = "SELECT COUNT(*) AS wishlist_count FROM wishlist WHERE email = '$yourEmail'";
$countResult = mysqli_query($conn, $countQuery);

if (!$countResult) {
    echo "Error: " . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}

$row = mysqli_fetch_assoc($countResult);
$wishlistCount = $row['wishlist_count'];

if ($wishlistCount >= 5) {
    // The user has reached the maximum wishlist limit, show a message and redirect
    echo "<script>alert('You have reached the maximum wishlist limit (5 items)'); window.location.href = 'wishlist.php';</script>";
    mysqli_close($conn);
    exit();
}

// If the item is not in the wishlist and the limit is not reached, insert it
$insertQuery = "INSERT INTO wishlist (id, name, item_id, description, price, category, item_condition, email)
        VALUES (NULL, '$name', '$item_id', '$description', '$price', '$category', '$item_condition', '$yourEmail')";

if (mysqli_query($conn, $insertQuery)) {
    // Data was successfully inserted into the "wishlist" table
    echo "<script>alert('Product has been added to your wishlist');</script>";
} else {
    // There was an error inserting the data
    echo "Error: " . mysqli_error($conn);
}

// Update the user's wishlist count in the 'wishlist_count' table
$updateCountQuery = "UPDATE account SET wishlist_count = wishlist_count + 1 
WHERE email = '$yourEmail'";

mysqli_query($conn, $updateCountQuery);

// Close the database connection and redirect to wishlist.php
mysqli_close($conn);
header("Location: wishlist.php");
exit();
