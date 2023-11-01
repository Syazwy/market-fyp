<!DOCTYPE html>
<?php
require_once("../session/session.php");
require '../connection/connection.php';

$selectedPlan = $_GET['plan'];
$price = 0; 
if ($selectedPlan === "Basic") {
    $price = 0;
} elseif ($selectedPlan === "Premium Monthly") {
    $price = 4.99;
} elseif ($selectedPlan === "Premium Annually") {
    $price = 49.99;
}

$username = $_SESSION['username'];
$yourEmail = $_SESSION['email'];

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

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membership</title>
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="order.css">
    
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
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php">Sell</a></li>
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
    event.preventDefault(); 

    const confirmLogout = confirm("Are you sure you want to log out?");

    if (confirmLogout) {
      window.location.href = event.target.href;
    }
  });
</script>

    <br>
    <div class="container">
        <div class="row">
    <div style="width: 400px">
        <a href="javascript:history.back()" class="left d-flex align-items-start mb-10 ms-5 back-button">
            <img src="../image/Left.png" alt="Left Icon" style="height: 30px">
            <h3 class="ms-4">Order Request</h3>
        </a>
    </div>
    </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
    <div class="payment-container">
        <h3 class="text-center"><b>Payment</b></h3>
    <div>
        <h4>Payment Method</h4>
    <br>
        <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
        <label class="btn btn-outline-primary" for="btn-check-outlined">Paypal</label>
    </div>

   <p style="color:#8F8F8F">Pay using PayPal directly to user</p>

    <div>
        <input type="checkbox" class="btn-check" id="btn-check-3-outlined" autocomplete="off" disabled>
        <label class="btn btn-outline-secondary" for="btn-check-3-outlined">Cash</label>
    </div>
    <p style="color:#8F8F8F">Pay using cash in person</p>

</div>


<div class="payment-container" >
    <h3 class="text-center"><b>Order Summary</b></h3>
    <br>

    <table class="table table-borderless">
    <thead>
        <tr>
            <th class="col-6">Market Membership:</th>
            <td class="col-4 text-end"><?php echo $selectedPlan . " Plan" ?></td>
        </tr>
 
    </thead>
    <tbody>
        <tr>
            <th class="col-6">Price:</th>
            <td class="col-4 text-end">BND$<?php echo $price; ?></td>
        </tr>
    
        <tr>
            <th class="col-6">Total:</th>
            <td class="col-4 text-end"><b>BND$<?php echo $price; ?></b></td>
        </tr>
    </tbody>
</table>


<br>
<div class="text-center">
        <button id="placeOrderButton" onclick="placeOrder()">Place Order</button>
    </div>
    <br>
    <p>By tapping on Place order, you accept the terms of service from <span style="color: #00A307;">Market</span> and the payments provider.</p>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function placeOrder() {
        var paypalCheckbox = document.getElementById('btn-check-outlined');
        var cashCheckbox = document.getElementById('btn-check-3-outlined');

        if (paypalCheckbox.checked || cashCheckbox.checked) {
            if ("<?php echo $selectedPlan; ?>" === "Basic") {
                window.location.href = 'orderCompleted.php?plan=Basic';
            } else {
                window.location.href = '../payment/membershipPaypal.php?plan=<?php echo $selectedPlan; ?>';
            }
        } else {
            alert('Please select a payment method before placing your order.');
        }
    }
</script>

</body>

</html
