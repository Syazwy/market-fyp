<!DOCTYPE html>

<?php
require_once("../session/session.php");


// $itemName = "Iphone 14 pro max";
// $price = 1399;

// $district = "Belait" ;
// $delivery = "" ;

// if ($district = "Brunei Muara") {
//     $delivery = 3 ;
// } elseif ($district = "Tutong") {
//     $delivery = 5;
// } elseif ($district = "Belait") {
//     $delivery = 7;
// } elseif ($district = "Temburong") {
//   $delivery = 6;
// }

// $total = $price + $delivery;

?>

<?php
    // Database connection information
    $conn = mysqli_connect("localhost", "root", "", "market");

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $id = $_GET['id'];

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to fetch name, price, and location for the given ID
    $sql = "SELECT name, price, location FROM itemslisting WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->bind_result($name, $price, $location);

    // Fetch the result
    if ($stmt->fetch()) {
        // Output the fetched values

$delivery = "" ;

if ($location === "Brunei Muara") {
  $delivery = 3 ;
} elseif ($location === "Tutong") {
  $delivery = 5;
} elseif ($location === "Belait") {
  $delivery = 7;
} elseif ($location === "Temburong") {
  $delivery = 6;
}


$total = $price + $delivery;
    } else {
        echo "No data found for the given ID.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEMBERSHIP</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

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
        <br>
        <div>
            <h4>Delivery Method</h4>
            <input type="radio" class="btn-check" name="deliveryMethod" id="delivery" autocomplete="off">
            <label class="btn btn-outline-primary" for="delivery">Delivery</label>
        </div>
        <p style="color:#8F8F8F">Deliver to your address</p>

        <div>
            <input type="radio" class="btn-check" name="deliveryMethod" id="pickUp" autocomplete="off">
            <label class="btn btn-outline-secondary" for="pickUp">Pick-up</label>
        </div>
        <p style="color:#8F8F8F">Chat with the seller to get address</p>
        <br>

        <div>
            <h4>Payment Method</h4>
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
            <td class="col-4 text-end" style="text-transform: capitalize"><b><?php echo $name ?><b></td>
        </tr>
      
    </thead>
    <tbody>
        <tr>
            <th class="col-6">Price:</th>
            <td class="col-4 text-end"><b>$<?php echo $price?><b></td>
        </tr>
        <tr>
        <th class="col-6">Delivery fee:</th>
        <td class="col-4 text-end"><b>$<?php echo $delivery?></b></td>
        </tr>
       
        <tr>
            <th class="col-6">Total:</th>
            <td class="col-4 text-end"><b>$<?php echo $total ?></b></td>
        </tr>
    </tbody>
</table>


<br>
<div class="text-center">
        <button id="placeOrderButton" onclick="placeOrder()">Place Order</button>
    </div>
    <br>
    <p>By tapping on Place order, you accept the terms of service from <span style="color: #00A307;">Market</span> and the payments provider.</p>

    <!-- Bootstrap Modal -->
<div class="modal fade" id="deliveryModal" tabindex="-1" role="dialog" aria-labelledby="deliveryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deliveryModalLabel">Delivery Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add your form fields here -->
        <form id="deliveryForm">
          <div class="form-group">
            <label for="address">Delivery Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
          </div>
          <!-- Add more form fields as needed -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confirmDelivery">Confirm</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    
    <script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('confirmDelivery').addEventListener('click', function () {
        // Handle the form submission here
        const address = document.getElementById('address').value;
        
        // You can send the address to the server via AJAX if needed
        
        // Close the modal using Bootstrap function
        $('#deliveryModal').modal('hide');
        
        // Redirect to the payment page with the selected ID
        const id = <?php echo $id; ?>;
        window.location.href = `../payment/itemPaypal.php?id=${id}`;
    });

    // Function to check if both payment and delivery methods are selected
    function isPaymentAndDeliverySelected() {
        const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
        const deliveryMethod = document.querySelector('input[name="deliveryMethod"]:checked');
        return paymentMethod !== null && deliveryMethod !== null;
    }

    // Function to place the order and show the modal for delivery address
    function placeOrder() {
        if (isPaymentAndDeliverySelected()) {
            const id = <?php echo $id; ?>;
            
            // Check if the delivery method is selected
            const deliveryMethod = document.querySelector('input[name="deliveryMethod"]:checked');
            
            if (deliveryMethod && deliveryMethod.id === 'delivery') {
                // Show the delivery address modal
                $('#deliveryModal').modal('show');
            } else {
                // Redirect to the payment page with the selected ID
                window.location.href = `../payment/itemPaypal.php?id=${id}&total=<?php echo $total; ?>`;
            }
        } else {
            alert("Please select both payment and delivery methods before placing the order.");
        }
    }

    // Attach the placeOrder function to the button click event
    document.getElementById('placeOrderButton').addEventListener('click', placeOrder);
});
</script>


</body>
</html
