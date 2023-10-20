<?php
require_once("../session/session.php");
require '../connection/connection.php';

// Ensure that the user is logged in and has an active session
if (!isset($_SESSION['email'])) {
    exit; // Exit if the user is not logged in
}

// Get the chat parameters from the POST request
$username = $_POST['username'];
$itemid = $_POST['itemid'];

// Query the database for chat messages
$query = "SELECT * FROM chat_messages WHERE (sender = '$username' OR receiver = '$username') AND itemid = $itemid";
$result = mysqli_query($conn, $query);

$messages = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $sender = $row['sender'];
        $text = $row['message'];

        // Add the message to the messages array
        $messages[] = array('sender' => $sender, 'text' => $text);
    }
}

// Return the messages as JSON
echo json_encode($messages);
