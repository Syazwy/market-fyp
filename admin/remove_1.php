<?php
require '../connection/connection.php';

if(isset($_POST['rowId'])){ // Use POST instead of GET
    $id = $_POST['rowId']; // Corrected the assignment here
    $query = "DELETE FROM `reportbyusers` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }

    // Redirect to admin_2.php after deletion
    header('location: admin_2.php?delete_msg=You have deleted the record.');
}
?>
