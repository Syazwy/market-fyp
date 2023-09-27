<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEMBERSHIP</title>
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
        <h3 class="text-center"><b>Delivery & Payment</b></h3>
        <div>
            <h4>Delivery Method</h4>
            <br>
            <input type="radio" class="btn-check" name="deliveryMethod" id="delivery" autocomplete="off">
            <label class="btn btn-outline-primary" for="delivery">Delivery</label>
        </div>
        <p style="color:#8F8F8F">Deliver to your address</p>

        <div>
            <input type="radio" class="btn-check" name="deliveryMethod" id="pickUp" autocomplete="off">
            <label class="btn btn-outline-secondary" for="pickUp">Pick-up</label>
        </div>
        <p style="color:#8F8F8F">Chat with the seller to get address</p>

        <div>
            <h4>Payment Method</h4>
            <br>
            <input type="radio" class="btn-check" name="paymentMethod" id="paypal" autocomplete="off">
            <label class="btn btn-outline-primary" for="paypal">Paypal</label>
        </div>
        <p style="color:#8F8F8F">Pay using PayPal directly to user</p>

        <div>
            <input type="radio" class="btn-check" name="paymentMethod" id="cash" autocomplete="off" >
            <label class="btn btn-outline-secondary" for="cash">Cash</label>
        </div>
        <p style="color:#8F8F8F">Pay using cash in person</p>
    </div>

<div class="payment-container" >
    <h3 class="text-center"><b>Order Summary</b></h3>
    <br>

    <table class="table table-borderless">
    <thead>
        <tr>
            <th class="col-6">Item Name:</th>
            <td class="col-4 text-end">Iphone 13</td>
        </tr>
      
    </thead>
    <tbody>
        <tr>
            <th class="col-6">Price:</th>
            <td class="col-4 text-end">BND$0</td>
        </tr>
        <tr>
        <th class="col-6">Delivery fee:</th>
        <td class="col-4 text-end">BND$0</td>
        </tr>
       
        <tr>
            <th class="col-6">Total:</th>
            <td class="col-4 text-end"><b>BND$0</b></td>
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

</body>
</html
