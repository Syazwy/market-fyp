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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PayPal Button Centering Test</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="../order/order.css">
  <style>
      #centering-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 50vh;
      border:none;
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
    src="https://www.paypal.com/sdk/js?client-id=AW6IItKqFlY_wY4a0L_9wJ97PFoDY734dhsRZ45Iz572a4sOtDPyWjZ28ATRpy5fWjTPtg-xx8yqoCQc&components=buttons&enable-funding=venmo,paylater"></script>
  <script>
    const selectedPlan = "<?php echo $selectedPlan; ?>";

    const FUNDING_SOURCES = [
      // EDIT FUNDING SOURCES
        paypal.FUNDING.PAYPAL
    ];
    FUNDING_SOURCES.forEach(fundingSource => {
      paypal.Buttons({
        fundingSource,

        style: {
          layout: 'vertical',
          shape: 'rect',
          color: (fundingSource == paypal.FUNDING.PAYLATER) ? 'gold' : '',
        },

        createOrder: async (data, actions) => {
          try {
            const response = await fetch("http://localhost:9597/orders", {
              method: "POST"
            });

            const details = await response.json();
            return details.id;
          } catch (error) {
            console.error(error);
            // Handle the error or display an appropriate error message to the user
          }
        },

        

        onApprove: async (data, actions) => {
  try {
    const response = await fetch(`http://localhost:9597/orders/${data.orderID}/capture`, {
      method: "POST"
    });

    const details = await response.json();
    // Three cases to handle:
    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
    //   (2) Other non-recoverable errors -> Show a failure message
    //   (3) Successful transaction -> Redirect to orderCompleted.php

    // This example reads a v2/checkout/orders capture response, propagated from the server
    // You could use a different API or structure for your 'orderData'
    const errorDetail = Array.isArray(details.details) && details.details[0];

    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
      return actions.restart();
      // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
    }

    if (errorDetail) {
      let msg = 'Sorry, your transaction could not be processed.';
      msg += errorDetail.description ? ' ' + errorDetail.description : '';
      msg += details.debug_id ? ' (' + details.debug_id + ')' : '';
      alert(msg);
    } else {
      // Successful capture! Redirect to orderCompleted.php with the selectedPlan query parameter
      window.location.href = `../order/orderCompleted.php?plan=${selectedPlan}`;

    }
  } catch (error) {
    console.error(error);
    // Handle the error or display an appropriate error message to the user
  }
},

      }).render("#paypal-button-container");
    })
  </script>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
