<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    require_once("../session/session.php");
    $yourEmail = $_SESSION['email'];
    require '../connection/connection.php';
    
    $sql = "DELETE FROM wishlist WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Item removed successfully, now update the wishlist count in the 'account' table
        $updateCountQuery = "UPDATE account SET wishlist_count = wishlist_count - 1 WHERE email = ?";
        $updateCountStmt = $conn->prepare($updateCountQuery);
        $updateCountStmt->bind_param('s', $yourEmail);

        if ($updateCountStmt->execute()) {
            echo "Item removed successfully";
        } else {
            echo "there was an error updating on the wishlist" . $conn->error;
        }

        $updateCountStmt->close();
    } else {
        echo "Error removing item: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
