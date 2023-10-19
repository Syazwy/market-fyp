<?php
require '../connection/connection.php';


    $id = $_GET['id'];
    $email = $_GET['email'];
    echo $email;
    
    // Update the status to 'hidden' instead of deleting the record
    $query = "UPDATE `itemslisting` SET `status` = 'active' WHERE `id` = '$id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        header("location: view_1.php?id=" . $id . "&email=" . $email);

    }

?>
