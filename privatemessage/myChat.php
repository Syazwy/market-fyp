<?php
require_once("../session/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Chat</title>
    <link rel="stylesheet" href="chat.css">
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
    border: none;
    padding: 10px;
    margin: 20px auto;
    width: 100%;
    max-width: 600px;
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    max-height: 400px; /* Set a fixed maximum height for the table container */
    overflow-y: auto; /* Add vertical scrolling */
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
        #no-chat-message {
    text-align: center;
    padding: 20px;
    font-size: 18px;
    color: #888; /* You can adjust the color to your preference */
}

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-transparent" style=" box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
    <div class="container">
        <a class="navbar-brand" href="../home/index.php">
            <img src="../image/logo.png" width="80" height="80">
        </a>

        <div class="collapse navbar-collapse justify-content-center">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Wishlist</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php">Sell</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                <img src="../image/profile.png" width="50" height="50" class="profile">
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../profile/myprofile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="../myPurchases/myPurchases.php">My Purchases</a></li>
                <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
                <li><a class="dropdown-item" href="../privatemessage/myChat.php">Messages</a></li>
                <li><a class="dropdown-item" href="../home/index-guest.php" id="logout-link">Log out</a></li>

            </ul>
        </div>
    </div>

</nav>
<script>
    document.getElementById('logout-link').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the link from immediately navigating

        // Display a confirmation dialog
        const confirmLogout = confirm("Are you sure you want to log out?");

        // If the user confirms, navigate to the logout page
        if (confirmLogout) {
            window.location.href = event.target.href;
        }
    });
</script>
<br>
<center>
<h1>Chat with other Users</h1>
</center>
<br>
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
        echo '<tr><td colspan="3" id="no-chat-message">You have no chat with other users</td></tr>';
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
