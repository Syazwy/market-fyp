<?php
require '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userEmail = $_POST['userEmail'];

    if (isset($_POST['ban'])) {
        // Logic to update user status to "Banned" in the account table
        $updateQuery = "UPDATE `account` SET status = 'Banned' WHERE email = '$userEmail'";
    } elseif (isset($_POST['unban'])) {
        // Logic to update user status to "Active" in the account table
        $updateQuery = "UPDATE `account` SET status = 'Active' WHERE email = '$userEmail'";
    }

    if (mysqli_query($conn, $updateQuery)) {
        // Get the URL of the previous page (the referrer)
        $previousPage = $_SERVER['HTTP_REFERER'];

        // Redirect back to the previous page (admin_2.php)
        header("Location: $previousPage");
        exit();
    } else {
        echo "Status update failed: " . mysqli_error($conn);
    }
}
?>
