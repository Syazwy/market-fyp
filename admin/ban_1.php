<?php require '../connection/connection.php'; ?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$newStatus = 'Banned'; 
$query = "UPDATE `account` SET `status` = '$newStatus' WHERE `id` = '$id'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    header('location: admin.php?update_msg=The status has been set to "Banned".');
}
?>