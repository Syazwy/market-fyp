<!DOCTYPE html>
<?php
require_once("../session/session.php");
require '../connection/connection.php';
        $username = $_SESSION['username'];

        $query = "SELECT * FROM account WHERE username = '$username'";
 $result = mysqli_query($conn, $query);

 
if ($result) {
  while($row = $result->fetch_assoc()){
    $accountStatus = $row['status'];
    $name =  $row['username'];
    $profileimage = $row['profile_image'];
   }
}

?>

    <?php

    // username to look up
    $username = $_SESSION['username']; // Assuming this is the username you want to retrieve the membership for
    $membership = "";
 
    // Prepare and execute SQL query to fetch membership for the given username
    $sql = "SELECT membership FROM account WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($membership);

    // Fetch the result
    if ($stmt->fetch()) {
        $membership = $membership; // Assign the membership value to the variable
    } else {
        $membership = "Membership not found for this username.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
    ?>
<head>


<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEMBERSHIP</title>
    <link rel="stylesheet" href="membership.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .membership-box h4 {
  text-align: center; /* Center the text horizontally */
  /* Add any additional styles for vertical centering if needed */
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
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../wishlist/wishlist.php">Wishlist</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
    </ul>
  </div>

  <?php echo "Hello,&nbsp<b style=\"text-transform: capitalize;\"> " . $username . "</b>"; ?>
        

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
  
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Do you want to subscribe to <span id="modalPlanName">this plan</span>? This subscription will<span id="modalSubscriptionDuration"></span>.
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSubscription" onclick="order()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>

    <script>
function order(plan) {
    // Redirect to orderMembership.php with the selected plan as a URL parameter
    window.location.href = '../order/orderMembership.php?plan=' + plan;
}
</script>

    <div class="current-plan-container">
    <h3 id="current-plan1">Current Plan:</h3>
    <div class="current-plan" id="currentPlan">
    <?php echo $membership; ?>
    </div>
    </div>

<br>
<br>
<br>
    <div class="membership-container">
        
    <div class="membership-box-container">
        <h3 class="text-center"><b>Basic</b></h3>
      <br>
      
      <button class="membership-box basic-membership membership-button"  data-plan="Basic" data-bs-toggle="modal" data-bs-target="#confirmationModal">
        <div class="not">   
        <h4>Free</h4>
            <br>
            <ul>
                <li style="padding-bottom:40px">Can only sell a maximum of 2 items only</li>
                <li style="padding-bottom:40px">Can add up to 5 wish lists</li>
                </div>
            </ul>
</button>
    </div>

    <div class="membership-box-container">
        <h3 class="text-center"><b>Premium Monthly</b></h3>
        <br>
        <button class="membership-box premium-monthly-membership membership-button"  data-plan="Premium Monthly" data-bs-toggle="modal" data-bs-target="#confirmationModal">
            <h4 >$4.99/monthly</h4>
            <br>
            <ul >
                <li style="padding-bottom:40px">Can sell an unlimited amount of items</li>
                <li style="padding-bottom:40px">Can add an unlimited amount of Wish List</li>
            </ul>
        </button>
    </div>

    <div class="membership-box-container">
        <h3 class="text-center"><b>Premium Annually</b></h3>
        <br>
        <button class="membership-box premium-annually-membership membership-button"  data-plan="Premium Annually" data-bs-toggle="modal" data-bs-target="#confirmationModal">
            <h4>$49.99/annually</h4>
            <br>
            <ul>
                <li style="padding-bottom:40px">Can sell an unlimited amount of items</li>
                <li style="padding-bottom:40px">Can add an unlimited amount of Wish List</li>
                <li style="padding-bottom:40px">$10 off each year</li>
            </ul>
        </button>
    </div>
</div>
<script>
function checkMembership() {
    var membership = "<?php echo $membership; ?>"; // Get the membership value from PHP

    // Get all the buttons with the class "membership-button"
    var buttons = document.querySelectorAll('.membership-button');

    // Get the modal's plan name span element
    var modalPlanName = document.getElementById('modalPlanName');

    // Loop through each button and add a click event listener
    buttons.forEach(function (button) {
        var dataPlan = button.getAttribute('data-plan');

        button.addEventListener('click', function () {
            // Update the modal's plan name with the clicked data-plan
            modalPlanName.textContent = dataPlan;
        });

        if (dataPlan === membership) {
            // Disable the button if the data-plan matches the membership value
            button.disabled = true;
        } else {
            // Enable the button if it doesn't match
            button.disabled = false;
        }
    });
}

function updateSubscriptionDuration() {
    var modalPlanName = document.getElementById('modalPlanName').innerText;
    var modalSubscriptionDuration = document.getElementById('modalSubscriptionDuration');
    
    if (modalPlanName === 'Premium Monthly') {
        modalSubscriptionDuration.innerText = ' automatically expire after a month';
    } else if (modalPlanName === 'Basic') {
        modalSubscriptionDuration.innerText = ' never expire';
    } else if (modalPlanName === 'Premium Annually') {
        modalSubscriptionDuration.innerText = ' automatically expire after a year';
    } else {
        modalSubscriptionDuration.innerText = ''; // Handle other cases if needed
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get all the buttons with the class "membership-button"
    var buttons = document.querySelectorAll('.membership-button');

    // Get the modal's plan name span element
    var modalPlanName = document.getElementById('modalPlanName');

    // Add a click event listener to each membership button
    buttons.forEach(function (button) {
    button.addEventListener('click', function () {
        var dataPlan = button.getAttribute('data-plan');
        modalPlanName.textContent = dataPlan;
        updateSubscriptionDuration(); // Call the function here
    });
});


    // Add a click event listener to the "Confirm" button in the modal
    var confirmButton = document.getElementById('confirmSubscription');
    confirmButton.addEventListener('click', function () {
        // Redirect to orderMembership.php with the selected plan as a URL parameter
        var selectedPlan = modalPlanName.textContent;
        window.location.href = '../order/orderMembership.php?plan=' + selectedPlan;
    });
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>

