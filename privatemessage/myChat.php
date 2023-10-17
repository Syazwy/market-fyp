<?php
require_once("../session/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .table-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 20px auto;
            width: 100%;
            max-width: 600px;
            background-color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #333;
            color: #fff;
        }
        table td {
            border-top: 1px solid #ccc;
        }
        .clickable-row:hover {
            background-color: #e0e0e0;
        }
        .clickable-row {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require '../connection/connection.php';
$yourUsername = $_SESSION['username'];

// Step 1: Find the itemids based on yourUsername in the 'chat' table for the receiver
$sql = "SELECT sender, receiver, itemid FROM chat WHERE receiver = '$yourUsername' OR sender = '$yourUsername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $displayedChatIds = []; // An array to keep track of displayed chat records

    while ($row = $result->fetch_assoc()) {
        $chatId = $row['itemid'];
        $otherUser = ($row['sender'] === $yourUsername) ? $row['receiver'] : $row['sender'];

        // Check if this chat record has already been displayed
        if (!in_array($chatId, $displayedChatIds)) {
            echo "<tr class='clickable-row' data-item-id='" . $chatId . "'>";
            echo "<td>" . $otherUser . "</td>";

            // Fetch and display "itemname" and "price" columns from the 'itemslisting' table
            $itemDetailsSql = "SELECT name, price FROM itemslisting WHERE id = $chatId";
            $itemDetailsResult = $conn->query($itemDetailsSql);

            if ($itemDetailsResult->num_rows > 0) {
                $itemDetailsRow = $itemDetailsResult->fetch_assoc();
                echo "<td>" . $itemDetailsRow['name'] . "</td>";
                echo "<td>$" . $itemDetailsRow['price'] . "</td>";
            } else {
                echo "<td>No item details found.</td>";
            }

            echo "</tr>";

            // Add the chat record ID to the displayed list
            $displayedChatIds[] = $chatId;
        }
    }
} else {
    echo "No matching records found.";
}


$conn->close();

?>
            </tbody>
        </table>
    </div>
</div>
<script>
    // Add a click event listener to the table rows
    document.addEventListener('DOMContentLoaded', function() {
        var rows = document.querySelectorAll('.clickable-row');
        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                var itemId = row.getAttribute('data-item-id');
                var username = row.querySelector('td:nth-child(1)').textContent;

                // Redirect to 'chat.php' with 'username' and 'id' as query parameters
                window.location.href = 'chat.php?id=' + itemId + '&username=' + encodeURIComponent(username);
            });
        });
    });
</script>
</body>
</html>
