<?php
require '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['userEmail'])) {
        $userEmail = $_POST['userEmail'];
        $userEmail = trim($userEmail);
        echo "Action: " . $_POST['action'] . "<br>";
        echo "User Email: " . $userEmail . "<br>";
        if ($_POST['action'] === 'ban') {
            echo "Banning user: $userEmail<br>";
            $updateQuery = "UPDATE `account` SET status = 'Banned' WHERE email = '$userEmail'";
        } elseif ($_POST['action'] === 'unban') {
            echo "Unbanning user: $userEmail<br>";
            $updateQuery = "UPDATE `account` SET status = 'Active' WHERE email = '$userEmail'";
        }
        
        echo "Update Query: " . $updateQuery . "<br>";

        if (mysqli_query($conn, $updateQuery)) {
            $previousPage = $_SERVER['HTTP_REFERER'];
            echo "Status updated successfully.";
            header("Location: $previousPage");
            exit();
        } else {
            echo "Status update failed: " . mysqli_error($conn);
        }
        
    } else {
        echo "Action or user email not set.";
    }
} else {
    echo "Invalid request method.";
}

echo "SQL Query: " . $updateQuery . "<br>";
echo "User Email: " . $userEmail . "<br>";

?>
