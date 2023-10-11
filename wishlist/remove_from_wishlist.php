<?php
    if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    $conn = new mysqli('localhost', 'root', '', 'market');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    $sql = "DELETE FROM wishlist WHERE item_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $item_id);

    if ($stmt->execute()) {
        echo "Item removed successfully";
    } else {
        echo "Error removing item: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>