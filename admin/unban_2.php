<?php require '../connection/connection.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    
    $newStatus = 'Active';

    $query = "UPDATE `account` SET `status` = '$newStatus' WHERE `username` = '$username'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        $deleteQuery = "DELETE FROM `appeals` WHERE `username` = '$username'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if (!$deleteResult) {
            die("Failed to delete the row: " . mysqli_error($conn));
        } else {
            header('location: appealview.php');
        }
    }
} else {
    echo "Invalid request.";
}
?>
