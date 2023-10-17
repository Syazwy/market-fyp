<?php

require_once("../session/session.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* styles.css */
        .table-like-div {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 350px;
        }
        .clickable-row {
            cursor: pointer;
        }
    </style>
</head>
<body>
<center>
<div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
<div class="table-like-div">
    <table>
        <thead>
            <tr>
                <th>User:</th>
                <th>Item:</th>
                <th>Price:</th>

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
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='clickable-row' data-item-id='" . $row['itemid'] . "'>";
        echo "<td>" . (($row['sender'] === $yourUsername) ? $row['receiver'] : $row['sender']) . "</td>";

        // Fetch and display "itemname" and "price" columns from the 'itemslisting' table
        $itemId = $row['itemid'];
        $itemDetailsSql = "SELECT name, price FROM itemslisting WHERE id = $itemId";
        $itemDetailsResult = $conn->query($itemDetailsSql);

        if ($itemDetailsResult->num_rows > 0) {
            $itemDetailsRow = $itemDetailsResult->fetch_assoc();
            echo "<td>" . $itemDetailsRow['name'] . "</td>";
            echo "<td>$" . $itemDetailsRow['price'] . "</td>";
        } else {
            echo "<td>No item details found.</td>";
        }

        echo "</tr>";
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
</center>
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
