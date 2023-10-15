<?php
require_once("../session/session.php");
require '../connection/connection.php';
?>
<?php
date_default_timezone_set('Asia/Brunei');


$username = $_POST['username'];
$itemid = $_POST['id'];
$description = $_POST['description'];
$price = $_POST['price'];
$item_name = $_POST['item_name'];
$input = $_POST['input'];
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];

// Format the time in 12-hour format with AM/PM using PHP
$formattedTime = date("h:i A"); 
echo $itemid;
$sender = $sender . ' (' . $itemid . ')';
$receiver = $receiver . ' (' . $itemid . ')';
// Insert the message into the database

require '../connection/connection.php';
$sql = "INSERT INTO chat (Message, time, sender, receiver, itemid) VALUES ('$input', '$formattedTime', '$sender', '$receiver', '$itemid')";

if ($conn->query($sql) === TRUE) {
    // Redirect to the next page with query parameters
    header("Location: chat.php?username=$username&id=$itemid&description=$description&price=$price&name=$item_name");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

