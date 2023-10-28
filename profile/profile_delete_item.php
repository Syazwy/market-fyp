<?php
require '../connection/connection.php';

$id = $_GET["id"];

$query = "DELETE FROM itemslisting WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    
    echo '<script>alert("Item deleted successfully.");</script>';

    $queryDecrementWishlistCount = "UPDATE account AS a
                                    SET a.wishlist_count = a.wishlist_count - 1
                                    WHERE a.email IN (SELECT email FROM wishlist WHERE item_id = ?)";

    $stmtDecrementWishlistCount = mysqli_prepare($conn, $queryDecrementWishlistCount);
    mysqli_stmt_bind_param($stmtDecrementWishlistCount, "i", $id);

    if (mysqli_stmt_execute($stmtDecrementWishlistCount)) {

        $queryDeleteWishlistEntries = "DELETE FROM wishlist WHERE item_id = ?";
        $stmtDeleteWishlistEntries = mysqli_prepare($conn, $queryDeleteWishlistEntries);
        mysqli_stmt_bind_param($stmtDeleteWishlistEntries, "i", $id);

        if (mysqli_stmt_execute($stmtDeleteWishlistEntries)) {
        } 
        else {
            echo "Error deleting wishlist entries: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmtDeleteWishlistEntries);
    } else {
        echo "Error decrementing wishlist_count: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmtDecrementWishlistCount);

    echo '<script>window.location = "myprofile.php";</script>';
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
