<?php
require_once("../session/session.php");
require '../connection/connection.php';

date_default_timezone_set('Asia/Brunei');

$itemid = $_POST['id'];
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$input = $_POST['input']; 

$formattedTime = date("h:i A");

$sql = "INSERT INTO chat (Message, time, sender, receiver, itemid) VALUES ('$input', '$formattedTime', '$sender', '$receiver', '$itemid')";

if ($conn->query($sql) === TRUE) {
    header("Location: chat.php?username=$receiver&id=$itemid");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

