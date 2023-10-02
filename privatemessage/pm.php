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

<?php
$username = $_GET['username'];
$usersid = $_GET['id'];
$description = $_GET['description'];
$price = $_GET['price'];
$item = $_GET['name'];
?>

<div class="container-fluid">
    <div class="row">
        <div class="container-flex">
           
            <div class="col-md-3">
            <ul class="list-group mt-5">
               
               <br>
               <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user1">
                       <div class="user-icon">
                           <img src="../image/lakaka.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5><?php echo $username ?></h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p><?php echo $item ?></p>
                           <p>$<?php echo $price ?></p>
                       </div>
                       <span class="badge bg-primary rounded-pill">3</span>
                   </li>
               </ul>
           </div>
            
            <div class="chat">
                <div class="user-info-right">
                <h4></h4>
        <p></p>
                </div>
                <div class="chat-content">
                <h3>Select a chat or start a new conversation</h3>
                </div>
                
                <div class="message-container">
                    <div class="messages">
                     
                    </div>
                    <div class="message-input">
                        <input type="text" placeholder="Type your message">
                        <button>Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Include Bootstrap JS (Optional, for certain Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
       document.addEventListener("DOMContentLoaded", function() {
    const chatDiv = document.querySelector(".chat h3");
    const userItems = document.querySelectorAll(".contact");
    const userInfoDiv = document.querySelector(".user-info-right");
    const messagesContainer = document.querySelector(".messages");
    const chatContent = document.querySelector(".chat-content h3");

    const userMessages = {
                user1: "Hello, how are you?",
                user2: "Interested in the Lego set?",
                user3: "Is the Dragon Lore still available?",
                user4: "can nego?",
                user5: "swap with iphone add cash?",
                user6: "location?",
                user7: "Is it waterproof",
                user8: "can swap with my lego brz nissan mchyundai?",
                user9: "my camera better",
               
            };

    userItems.forEach(function(item) {
        item.addEventListener("click", function() {
            const userName = this.querySelector(".user-info h5").textContent;
            const userTitle = this.querySelector(".user-info p").textContent;
            const dataUser = this.getAttribute("data-user");

            messagesContainer.innerHTML = `
                <div class="message left">
                    <div class="text">${userMessages[dataUser]}</div>
                </div>
            `;

            userInfoDiv.innerHTML = `
                <h4>${userName}</h4>
                <p>${userTitle}</p>
            `;

            chatContent.textContent = "Chatting with " + userName;
        });
    });
});

    </script>

</body>
</html>
