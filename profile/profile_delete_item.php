<?php
require '../connection/connection.php';

$id = $_GET["id"];

// Using prepared statements to prevent SQL injection
$query = "DELETE FROM itemslisting WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    // Item deleted successfully from the seller's listings
    echo '<script>alert("Item deleted successfully.");</script>';

    // Decrement the wishlist_count for users whose items are deleted from wishlists
    $queryDecrementWishlistCount = "UPDATE account AS a
                                    SET a.wishlist_count = a.wishlist_count - 1
                                    WHERE a.email IN (SELECT email FROM wishlist WHERE item_id = ?)";

    $stmtDecrementWishlistCount = mysqli_prepare($conn, $queryDecrementWishlistCount);
    mysqli_stmt_bind_param($stmtDecrementWishlistCount, "i", $id);

    if (mysqli_stmt_execute($stmtDecrementWishlistCount)) {
        // Wishlist_count decremented successfully for users whose items were deleted from wishlists
    } else {
        echo "Error decrementing wishlist_count: " . mysqli_error($conn);
    }

    // Close the statement for decrementing wishlist_count
    mysqli_stmt_close($stmtDecrementWishlistCount);

    echo '<script>window.location = "myprofile.php";</script>';
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the statement and the connection for deleting from 'itemslisting'
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
