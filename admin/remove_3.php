<?php
require '../connection/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Update the status to 'hidden' instead of deleting the record
    $query = "UPDATE `itemslisting` SET `status` = 'hidden' WHERE `id` = '$id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        header('location: view_1.php?update_msg=Record status has been set to hidden.');
    }
}
?>
