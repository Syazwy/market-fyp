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
                <th>Sender Username</th>
                <th>Receiver Username</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Description</th>              
            </tr>
        </thead>
        <tbody>
        <?php
require_once("../session/session.php");
require '../connection/connection.php';
$yourEmail = $_SESSION['email'];
$yourUsername = $_SESSION['username'];

// Create an array to store unique item IDs
$processedItemIds = [];

// Step 1: Find the itemids based on yourUsername in the 'chat' table for the receiver
$sql = "SELECT itemid, receiver, sender FROM chat WHERE receiver LIKE '%$yourUsername%' OR sender LIKE '%$yourUsername%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $receiver = $row['receiver'];
        $sender = $row['sender'];

        // Extract the item ID from the "receiver" column using a regular expression
        preg_match('/\((\d+)\)/', $receiver, $receiverMatches);
        preg_match('/\((\d+)\)/', $sender, $senderMatches);
        if (isset($receiverMatches[1]) && isset($senderMatches[1])) {
            $receiverItemId = $receiverMatches[1];
            $senderItemId = $senderMatches[1];
            
            if (!in_array($receiverItemId, $processedItemIds)) {
                $processedItemIds[] = $receiverItemId;
                
                // Fetch and display the corresponding row from 'itemslisting' for receiverItemId
                $sql = "SELECT * FROM itemslisting WHERE id = $receiverItemId";
                $result2 = $conn->query($sql);
                
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        // Add a data attribute to store the item ID
                        echo "<tr class='clickable-row' data-item-id='" . $row2['id'] . "'>";
                        echo "<td>" . preg_replace('/\(\d+\)/', '', $sender) . "</td>"; // Display sender's username without [itemid]
                        echo "<td>" . preg_replace('/\(\d+\)/', '', $receiver) . "</td>"; // Display receiver's username without [itemid]                        
                        echo "<td>" . $row2['username'] . "</td>"; // Display item owner's username
                        echo "<td>" . $row2['name'] . "</td>";
                        echo "<td>$" . $row2['price'] . "</td>";
                        echo "<td>" . $row2['description'] . "</td>";
                        echo "</tr>";
                    }
                }
            }
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
</center>
<script>
// Add a click event listener to the table rows
document.addEventListener('DOMContentLoaded', function() {
    var rows = document.querySelectorAll('.clickable-row');
    rows.forEach(function(row) {
        row.addEventListener('click', function() {
            var itemId = row.getAttribute('data-item-id');
            var username = row.querySelector('td:nth-child(1)').textContent;
            var itemName = row.querySelector('td:nth-child(2)').textContent; // Assuming name is in the second column
            var itemPrice = row.querySelector('td:nth-child(3)').textContent; // Assuming price is in the third column
            var itemDescription = row.querySelector('td:nth-child(4)').textContent; // Assuming description is in the fourth column

      

            // Redirect to 'chat.php' with all the information as query parameters
            window.location.href = 'chat.php?id=' + itemId + '&name=' + itemName + '&price=' + itemPrice + '&description=' + itemDescription + '&username=' + username;
        });
    });
});
</script>
</body>
</html>
