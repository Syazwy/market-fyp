<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    require '../connection/connection.php';
    $sql = "DELETE FROM wishlist WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "Item removed successfully";
    } else {
        echo "Error removing item: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>