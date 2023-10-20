<?php
require_once("../session/session.php");
require '../connection/connection.php';
$yourEmail = $_SESSION['email'];
$yourName = $_SESSION['username'];

$query = "SELECT * FROM account WHERE username = '$yourName'";
$result = mysqli_query($conn, $query);


if ($result) {
 while($row = $result->fetch_assoc()){
   $accountStatus = $row['status'];
   $name =  $row['username'];
   $profileimage = $row['profile_image'];
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<meta http-equiv="refresh" content="5" >
<head>
<meta charset="UTF-8">
<title> Message</title>
<link rel="stylesheet" href="chat.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<style>

</style>
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
            <?php 
            if (isset($profileimage)) {
                    echo '<img src="../profile/' .$profileimage . '" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
                } else {
                    echo '<img src="../image/profile.png" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
                }
                ?>
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

<p></p>
<?php

$username = $_GET['username'];
$itemid = $_GET['id'];
?>
<center>
<div class="chat">

        <h2><?php echo $username ?></h2>
        <br>
<?php
require '../connection/connection.php';
// Get the item ID from the URL
$itemid = $_GET['id'];

// Fetch data from the database
$sql = "SELECT * FROM itemslisting WHERE id = $itemid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="item-details">'; // Start the div for item details
    while ($row = $result->fetch_assoc()) {
        $itemName = $row['name'];
        $price = $row['price'];
        $condition = $row['item_condition'];
        $itemDescription = $row['description'];

        // Output the data in a single row within the div
        echo "<h4> " . $itemName . " </h4><p></p> ";
        echo "<h4> $" . $price . " </h4> <p></p>";
        echo "<h4> " . $condition . " <h4><p></p>";
        echo "<h4> " . $itemDescription . " <h4><p></p>";
    }
    echo '</div>'; // End the div for item details
} else {
    echo "<center><h3>Item is no longer available.</h3></center>";
}

// Close the database connection
$conn->close();
?>
 

<iframe id="chatFrame" src="chat1.php?username=<?php echo $username; ?>&itemid=<?php echo $itemid; ?>"></iframe>



<form method="post" action="chat2.php">
    <br>
  <input type="hidden" name="id" value="<?php echo $itemid; ?>">
  <input type="hidden" name="sender" value="<?php echo $yourName; ?>">
    <input type="hidden" name="receiver" value="<?php echo $username; ?>">
    <input id="textInput" type="textarea" name = "input" placeholder="Type your message" />
<button class="btn" id="send" type="submit" value="Send" />Send</button> <br /> <br />
</form>
</div>
</center>

<script>
window.addEventListener("load", function() {
  var iframe = document.getElementById("chatFrame");
  iframe.contentWindow.scrollTo(0, iframe.contentDocument.body.scrollHeight);
  inputElement.focus();
});

// Get the input element
var inputElement = document.getElementById("textInput");

// Check if there is a stored value in local storage
var storedValue = localStorage.getItem("inputValue");

// If there is a stored value, set it as the input's value
if (storedValue !== null) {
  inputElement.value = storedValue;
}

// Add an event listener to the input element to save its value in local storage
inputElement.addEventListener("input", function () {
  localStorage.setItem("inputValue", inputElement.value);
});

// Add an event listener to the form to clear the stored value when it is submitted
document.querySelector("form").addEventListener("submit", function () {
  localStorage.removeItem("inputValue");
});


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>