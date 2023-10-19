<?php
require '../connection/connection.php';

if (isset($_GET['usersid'])) {
    $id = $_GET['usersid'];


$newStatus = 'Banned'; // New status you want to set

// Update status in the `account` table
$query = "UPDATE `account` SET `status` = '$newStatus' WHERE `id` = '$id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    // header('location: admin_2.php?update_msg=The status has been set to "Banned".');
}
}
?>
