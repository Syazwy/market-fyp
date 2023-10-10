<!DOCTYPE html>
<?php
require_once("../session/session.php");
$yourEmail = $_SESSION['email'];
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEMBERSHIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="pm.css">

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

<?php
$username = $_GET['username'];
$usersid = $_GET['id'];
$description = $_GET['description'];
$price = $_GET['price'];
$item = $_GET['name'];
?>

<div class="chat">

<center>    
    <div class="user-info">      
        <h3><?php echo $username ?></h3>
        <h4 style="display: inline;"><?php echo $item ?></h4>
        <h4 style="display: inline;">$<?php echo $price ?></h4>
        <p><?php echo $description ?></p>  
    </div>

    <div class="message-container" style="padding: 10px">
<h4 id="start-discussion">Start a new discussion.</h4>
    <div class="user-message">
       
    </div>
    <div class="received-message">
        Hi, Shahmi!
    </div>
</div>

<center>
    <br>
    <br>
    <div class="message-input"> 
    <input type="text" name="message" id="message" placeholder="Type your message">
        <button id="send">Send</button>
        </div>

    </center>
</div>
</div>

<script>
 document.addEventListener("DOMContentLoaded", function () {
  
    const messageContainer = document.querySelector(".message-container");
    const messageInput = document.getElementById("message");
    const sendButton = document.getElementById("send");
    const startDiscussion = document.getElementById("start-discussion");

    // Function to send a message
    function sendMessage() {
    const messageText = messageInput.value.trim();
    console.log("Message Text:", messageText); 

    if (messageText !== "") {
        const messageElement = document.createElement("div"); // Define messageElement
        messageElement.classList.add("user-message"); // Assuming it's a user message

        const messageTextElement = document.createElement("span");
        messageTextElement.classList.add("message-text");
        messageTextElement.textContent = messageText;

        const messageTimeElement = document.createElement("span");
        messageTimeElement.classList.add("message-time");
        const now = new Date();
        const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }).toLowerCase();
        messageTimeElement.textContent = timeString;

        messageElement.appendChild(messageTimeElement);
        messageElement.appendChild(messageTextElement);

        messageContainer.appendChild(messageElement);

        // Scroll to the bottom of the message container to show the latest message
        messageContainer.scrollTop = messageContainer.scrollHeight;

        // Clear the input field
        messageInput.value = "";

        // Hide the "Start a new discussion" section
        startDiscussion.style.display = "none";

        console.log("Sending message to PHP script");
    }
}


    // Listen for Enter key press in the message input field
    messageInput.addEventListener("keydown", function (event) {
      if (event.key === "Enter") {
        event.preventDefault(); // Prevent the default Enter key behavior (new line)
        sendMessage(); // Call the sendMessage function when Enter is pressed
      }
    });

    // Attach the sendMessage function to the Send button click event
    sendButton.addEventListener("click", sendMessage);
  });
</script>

<!-- Include Bootstrap JS (Optional, for certain Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
