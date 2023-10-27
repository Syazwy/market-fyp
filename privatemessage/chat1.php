<?php
require_once("../session/session.php");
require '../connection/connection.php';
$yourEmail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
      <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; 
            padding: 0; 
        }

        #centered-text-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .message-wrapper {
            max-width: 95%;
            margin: 5px auto;
            overflow: hidden;
        }

        .message {
            clear: both;
            margin: 5px;
            padding: 5px 10px;
            border-radius: 10px;
        }

        .sender-message {
            background-color: #3498db; 
            color: #fff; 
            float: left;
        }

        .receiver-message {
            background-color: #e0e0e0;
            color: #000; 
            float: right;
        }

        .message-wrapper::after {
            content: "";
            display: table;
            clear: both;
        }

        .message-wrapper {
            max-height: 400px;
            overflow-y: auto; 
        }

        .message-time-sender {
            float: left;
        }

        .message-time-receiver {
            float: right;
        }
    </style>
</head>
<body>
    <?php
$yourName = $_SESSION['username'];
$username = $_GET['username'];
$itemid = $_GET['itemid'];

$sql = "SELECT `Message`, `time`, `sender`, `receiver` FROM chat WHERE ((sender = '$yourName' AND receiver = '$username') OR (sender = '$username' AND receiver = '$yourName')) AND `itemid` = '$itemid'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<br>";
    echo "<br>";

    echo "<div class=\"message-wrapper\" style=\"max-height: 400px; overflow-y: auto;\">";
    while ($row = $result->fetch_assoc()) {
        $message = $row["Message"];
        $time = $row["time"];
        $sender = $row["sender"];
    
        $messageClass = ($sender == $yourName) ? 'sender-message' : 'receiver-message';
        $timeClass = ($sender == $yourName) ? 'message-time-sender' : 'message-time-receiver';
    
        echo "<div class=\"message $messageClass\">";
        echo "<span class=\"$timeClass\">$time</span>";
        echo "<span class=\"message\">$message</span>";
        echo "</div>";
    }
    
    echo "</div>";
} else {
    echo "<div id=\"centered-text-container\">";
    echo "<h3>Start Chatting</h3>";
    echo "</div>";
}

$conn->close();

    ?>
</body>
</html>
