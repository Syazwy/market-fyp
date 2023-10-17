<?php
require_once("../session/session.php");
require '../connection/connection.php';

date_default_timezone_set('Asia/Brunei');

// Get the data from the form
$itemid = $_POST['id'];
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$input = $_POST['input']; // Retrieve the message from the form

// Format the time in 12-hour format with AM/PM using PHP
$formattedTime = date("h:i A");

// Insert the message into the database
$sql = "INSERT INTO chat (Message, time, sender, receiver, itemid) VALUES ('$input', '$formattedTime', '$sender', '$receiver', '$itemid')";

if ($conn->query($sql) === TRUE) {
    // Redirect to the next page with query parameters
    header("Location: chat.php?username=$receiver&id=$itemid");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

