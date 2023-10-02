<?php
   $conn = mysqli_connect("localhost", "root", "", "market");

// Check if a POST request has been made and if the "complete-button" has been set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['complete-button'])) {
    // Get the item ID from the button's data-status attribute
    $itemId = $_POST['complete-button'];
    
    // Update the item status in your PHP script
    // You can use an SQL UPDATE query to change the status from 'sold' to 'completed'
    $updateQuery = "UPDATE itemslisting SET status = 'completed' WHERE id = $itemId";
    
    // Execute the query
    if (mysqli_query($conn, $updateQuery)) {
        // Item status has been updated successfully
        // You can add any additional logic or messages here if needed
    } else {
        // Error occurred while updating the item status
        // You can handle errors as needed
        echo "Error updating item status: " . mysqli_error($conn);
    }
    
    // Redirect back to the same page
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Purchases</title>
    <link rel="stylesheet" href="../profile/profilecss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Style for the divs */

       
        .content {
            display: none;
            padding: 20px;
            background-color: #white;
            height: 750px;
        }

        /* Style for the active div */
        .active {
            display: block;
        }

        .transparent-button {
            background: transparent;
            border: none;
            color: #000; /* You can change the text color to your preference */
            cursor: pointer;
            /* You can further style the button as needed */
        }
        .card-container {
            display: flex; /* Use flexbox to arrange cards horizontally */
            flex-wrap: wrap; /* Allow cards to wrap to the next row if needed */
        }
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            height: 645px;
            width: calc(20% - 20px); /* Four cards side by side with some spacing */
            display: flex;
            flex-direction: column; /* Stack the elements vertically inside the card */
            justify-content: space-between; /* Space elements evenly vertically */
            align-items: center; /* Center elements horizontally */
            text-align: center; /* Center text horizontally */
        }

        .card img {
            max-width: 75%;
            max-height: 150px;
            margin-bottom: 10px;
        }

        .card p {
            margin: 10px 0; /* Add vertical margin to paragraphs */
        }

        .complete-button, .cancel-button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            width: 40%;
            border-radius: 20px;
        }

        .complete-button {
            background-color: #00A37C;
            margin-bottom: 20px;
        }

        .cancel-button {
            background-color: #FF5353;
            margin-bottom: 20px;
        }

        /* Add a CSS class for the active button */
        .active-button {
            border-bottom: 1px solid black;
        }

        .card-container-horizontal {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .card-container-horizontal .card {
            width: 30%; /* Adjust the width of cards for horizontal layout */
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-transparent">
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
<h3 style="text-align: center;">My Purchases</h3>
<div style="padding-left:50px;border-bottom: 1px solid #C7C7C7">
    <button class="transparent-button active-button" onclick="showDiv('div1')" id="btn1">In Progress</button>
    <button class="transparent-button" onclick="showDiv('div2')" id="btn2">Completed</button>

</div>

<div id="div1" class="content active">

    <!-- to display the cards that are sold -->


<?php

$conn = mysqli_connect("localhost", "root", "", "market");

 // Check the connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

   // Query to select rows with status 'sold' from the itemslisting table
   $query = "SELECT id, name, description, price, item_condition FROM itemslisting WHERE status = 'sold'";
   
   // Execute the query
   $result = mysqli_query($conn, $query);
   
   // Check if there are rows with 'sold' status
   if (mysqli_num_rows($result) > 0) {
     // Inside the loop where you're generating the "Complete" button
while ($row = mysqli_fetch_assoc($result)) {
    // Get the item ID
    $itemId = $row['id'];

    echo '<div class="card-container">';
    echo '<div class="card">';
    echo '<p>' . $row['name'] . '</p>';
    echo '<center><img src="../image/supra.png" alt="Card Image"></center>';
    echo '<p>' . $row['description'] . '</p>';
    echo '<p>' . $row['price'] . '</p>';
    echo '<p>' . $row['item_condition'] . '</p>';
    
    // Add the "Chat" button/link
    echo '<a href="../privatemessage/pm.php?itemId=' . $itemId . '" class="btn btn-primary">Chat</a>';
    
    // Display the "Complete" button with an onclick event to trigger the JavaScript function
    echo '<form method="POST" id="complete-form-' . $itemId . '">';
    echo '<button class="complete-button" style="width:300px" onclick="confirmMarkCompleted(' . $itemId . ')" name="complete-button" value="' . $itemId . '">Complete</button>';
    echo '</form>';
    
    echo '</div></div>';
    
}

   } else {
       echo '<p>You have not made any purchases that are currently in progress.</p>';
   }
   
   // Close the database connection
   mysqli_close($conn);
    ?>


    <!-- closing -->

</div>
<div id="div2" class="content">

    <!-- to display the cards that are completed -->


    <?php
    // Assuming you have a database connection established
    $conn = mysqli_connect("localhost", "root", "", "market");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to select rows with status 'completed' from the itemslisting table
    $query = "SELECT name, description, price, item_condition FROM itemslisting WHERE status = 'completed'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if there are rows with 'completed' status
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card-container">';
            echo '<div class="card">';
            echo '<p>' . $row['name'] . '</p>';
            echo '<center><img src="../image/supra.png" alt="Card Image"></center>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p>' . $row['price'] . '</p>';
            echo '<p>' . $row['item_condition'] . '</p>';
            echo '</div></div>';
        }
    } else {
        echo '<p>You have not made any completed purchases.</p>';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <!-- closing -->

</div>





<script>


    function showDiv(divId) {
        const buttons = document.querySelectorAll('.transparent-button');
        buttons.forEach((button) => {
            button.classList.remove('active-button');
        });

        const divs = document.querySelectorAll('.content');
        divs.forEach((div) => {
            div.style.display = 'none';
        });

        document.getElementById('btn' + divId.substr(3)).classList.add('active-button');
        document.getElementById(divId).style.display = 'block';
    }

    function confirmMarkCompleted(itemId) {
    var confirmed = confirm("Are you sure you want to mark this item as completed?");
    if (confirmed) {
        // User clicked "OK," so we'll submit the form
        document.getElementById('complete-form-' + itemId).submit();
    } else {
        // User clicked "Cancel," so we prevent the default form submission
        event.preventDefault();
    }
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
