<!DOCTYPE html>
<?php
require_once("../session/session.php");
$selectedPlan = $_GET['plan'];
$price = 0; // Default price

if ($selectedPlan === "Basic") {
    $price = 0;
} elseif ($selectedPlan === "Premium Monthly") {
    $price = 4.99;
} elseif ($selectedPlan === "Premium Annually") {
    $price = 49.99;
}
?>

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
        <img src="../image/profile.png" width="50" height="50" class="profile">
      </a>

      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../profile/myprofile.php">My Profile</a></li>
        <li><a class="dropdown-item" href="#">My Purchases</a></li>
        <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
        <li><a class="dropdown-item" href="../home/index-guest.php">Log out</a></li>
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
      const selectedPlan = "<?php echo $selectedPlan; ?>";
      const price = <?php echo $price; ?>; // Correctly set the price based on the selected plan

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
                value: price.toFixed(2), // Ensure the price is formatted with 2 decimal places
                currency_code: 'USD' // Adjust currency if necessary
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
                // Successful capture! Redirect to orderCompleted.php
                window.location.href = "../order/orderCompleted.php?plan=" + selectedPlan + "&price=" + price;
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
