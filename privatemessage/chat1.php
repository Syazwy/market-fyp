<?php
require_once("../session/session.php");
$yourEmail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; /* Reset margin to remove extra space */
            padding: 0; /* Reset padding to remove extra space */
        }

        #centered-text-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /* Example in your chat.css file */
        .message-wrapper {
            max-width: 90%; /* Adjust the maximum width as needed */
            margin: 5px auto;
            overflow: hidden;
        }

        .message {
            clear: both;
            margin: 5px;
            padding: 5px 10px; /* Adjust padding as needed */
            border-radius: 10px;
        }

        .sender-message {
            background-color: #3498db; /* Blue color for sender messages */
            color: #fff; /* Text color for sender messages */
            float: left;
        }

        .receiver-message {
            background-color: #e0e0e0; /* Grey color for receiver messages */
            color: #000; /* Text color for receiver messages */
            float: right;
        }

        .message-wrapper::after {
            content: "";
            display: table;
            clear: both;
        }

        .message-wrapper {
            max-height: 400px; /* Set a maximum height for the message container */
            overflow-y: auto; /* Add vertical scrolling when the content overflows */
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
    // Assuming $yourName is the username of user1
    $yourName = $_SESSION['username'];

    $conn = mysqli_connect("localhost", "root", "", "market");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `Message`, `time`, `sender` FROM chat";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<br>";
        echo "<br>";

        // Create a wrapper div for the messages with a maximum height
        echo "<div class=\"message-wrapper\" style=\"max-height: 400px; overflow-y: auto;\">";

        while ($row = $result->fetch_assoc()) {
            $message = $row["Message"];
            $time = $row["time"];
            $sender = $row["sender"];

            // Determine the message class and time positioning based on the sender
            $messageClass = ($sender == $yourName) ? 'sender-message' : 'receiver-message';
            $timeClass = ($sender == $yourName) ? 'message-time-sender' : 'message-time-receiver';

            // Apply the message class to the container
            echo "<div class=\"message $messageClass\">";
            echo "<span class=\"$timeClass\">$time</span>";
            echo "<span class=\"message\">$message</span>";
            echo "</div>";
        }

        // Close the message wrapper
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
