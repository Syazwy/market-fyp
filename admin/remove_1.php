<?php
require '../connection/connection.php';

if(isset($_POST['rowId'])){ 
    $id = $_POST['rowId']; 
    $query = "DELETE FROM `reportbyusers` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }

    header('location: admin_2.php?delete_msg=You have deleted the record.');
}
?>
