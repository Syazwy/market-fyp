<?php
require_once("../session/session.php");
require '../connection/connection.php';


if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$total = $_GET['total'];
$deliveryMethod = $_GET['deliveryMethod'];
$paymentMethod = $_GET['paymentMethod'];
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

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute SQL query to fetch the price for the given ID
$sql = "SELECT price FROM itemslisting WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->bind_result($price);

// Fetch the result
if ($stmt->fetch()) {
    // The $price variable now holds the item's price
} else {
    echo "No data found for the given ID.";
}

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PayPal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="../order/order.css">
  <style>
    #centering-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 50vh;
      border: none;
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
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
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
<div id="centering-container">
  
  <h3 style="padding-right:20px;">Proceed with your PayPal payment by entering your details.</h3>
 
  <div id="paypal-button-container">
    <script
      data-sdk-integration-source="integrationbuilder_sc"
      src="https://www.paypal.com/sdk/js?client-id=AW6IItKqFlY_wY4a0L_9wJ97PFoDY734dhsRZ45Iz572a4sOtDPyWjZ28ATRpy5fWjTPtg-xx8yqoCQc&components=buttons&disable-funding=credit,card"></script>
    <script>
      const total = <?php echo $total; ?>; // Get the total from the database

      paypal.Buttons({
        style: {
          layout: 'vertical',
          shape: 'rect',
          color: 'gold'
        },
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: total.toFixed(2), // Use the 'total' variable here
                currency_code: 'USD'
              }
            }],
            application_context: {
              shipping_preference: 'NO_SHIPPING' // Indicate no shipping address is required
            }
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            // Check for any errors in the capture process
            if (details.status === "COMPLETED") {
                // Successful capture! Redirect to orderCompleted1.php

                var id = <?php echo json_encode($_GET['id']); ?>;
                var deliveryMethod = <?php echo json_encode($_GET['deliveryMethod']); ?>;
                var paymentMethod = <?php echo json_encode($_GET['paymentMethod']); ?>;
                window.location.href = "../order/orderCompleted1.php?price=" + total + "&id=" + id + "&deliveryMethod=" + deliveryMethod + "&paymentMethod=" + paymentMethod;
          } else {
                // Handle capture errors here
                console.error("Order capture error:", details.status);
            }
          });
        }
      }).render('#paypal-button-container');
    </script>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
