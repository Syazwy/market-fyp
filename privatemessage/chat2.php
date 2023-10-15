<?php
require_once("../session/session.php");
require '../connection/connection.php';
?>
<?php
date_default_timezone_set('Asia/Brunei');


$username = $_POST['username'];
$usersid = $_POST['id'];
$description = $_POST['description'];
$price = $_POST['price'];
$item = $_POST['name'];
$input = $_POST['input'];
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];

// Format the time in 12-hour format with AM/PM using PHP
$formattedTime = date("h:i A"); 

// Insert the formatted time into the database
$sql = "INSERT INTO chat (Message, time, sender, receiver) VALUES ('$input', '$formattedTime', '$sender', '$receiver')";

if ($conn->query($sql) === TRUE) {
    // Redirect to the next page with query parameters
    header("Location: chat.php?username=$username&id=$usersid&description=$description&price=$price&name=$item");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

