<?php
require_once("../session/session.php");
require '../connection/connection.php';
$email = $_SESSION['email'];

?>

<?php
  

    $id = $_GET['id'];

  
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

    $stmt->close();
  $conn->close();
  ?>
  <?php

require '../connection/connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get form data
  
      $district = $_POST["District"];
      $city = $_POST["City"];
      $streetAddress = $_POST["StreetAddress"];
      $postalCode = $_POST["PostalCode"];
      
      // Debugging
      echo "District: " . $district . "<br>";
      echo "City: " . $city . "<br>";
      echo "Street Address: " . $streetAddress . "<br>";
      echo "Postal Code: " . $postalCode . "<br>";
      
  
      // Update the 'account' table with order details
      $updateAccountSQL = "UPDATE account SET District = ?, City = ?, StreetAddress = ?, PostalCode = ? WHERE email = ?";
      $updateStmt = $conn->prepare($updateAccountSQL);
      $updateStmt->bind_param("sssss", $district, $city, $streetAddress, $postalCode, $email);
      
      if ($updateStmt->execute()) {
          // Handle success
          print_r($_POST);

          exit();
      } else {
          echo "Failed to update the account table." . mysqli_error($conn);
      }
  }
  
  // Close the database connection
  
  $conn->close();
  ?>


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

    <div class="modal" id="deliveryModal" tabindex="-1" role="dialog" aria-labelledby="deliveryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 70%;">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="deliveryModalLabel" style="text-align: center; margin: 0 auto;">Address Form</h5>
        <button type="button" class="btn" data-bs-dismiss="modal"><h5>X</h5></button>
      </div>

      <div class="modal-body">
      <form id="deliveryForm" method="post">
        <div class="form-group">
          <label for="District">District:</label>
          <select class="form-control" id="District" name="District">
            <option value="Brunei Muara">Brunei Muara</option>
            <option value="Tutong">Tutong</option>
            <option value="Belait">Belait</option>
            <option value="Temburong">Temburong</option>
          </select>
          <br>
          <input type="text" class="form-control" id="City" name="City" placeholder="City">
          <br>
          <input type="text" class="form-control" id="StreetAddress" name="StreetAddress" placeholder="Street Address">
          <br>
          <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="Postal Code" maxlength="6">
          <br>
          <button type="button" class="btn btn-primary d-block mx-auto" id="confirmDelivery" name="placeOrderButton" style="background-color: #FF5353; border-radius: 10px; padding: 10px; width: 450px;" disabled>Confirm</button>
 </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  // Get references to the input fields
  const districtInput = document.getElementById('District');
  const cityInput = document.getElementById('City');
  const streetAddressInput = document.getElementById('StreetAddress');
  const postalCodeInput = document.getElementById('PostalCode');
  const confirmDeliveryButton = document.getElementById('confirmDelivery');

  // Function to check if all fields are filled
  function areAllFieldsFilled() {
    return districtInput.value.trim() !== '' &&
      cityInput.value.trim() !== '' &&
      streetAddressInput.value.trim() !== '' &&
      postalCodeInput.value.trim() !== '';
      console.log("District:", districtInput.value.trim());
console.log("City:", cityInput.value.trim());
console.log("Street Address:", streetAddressInput.value.trim());
console.log("Postal Code:", postalCodeInput.value.trim());

  }

  // Function to handle the Confirm button click
  function confirmDelivery() {

        // Collect form data
  const formData = new FormData(document.getElementById('deliveryForm'));
  const params = new URLSearchParams(formData);
  console.log("District:", districtInput.value.trim());
  console.log("City:", cityInput.value.trim());
  console.log("Street Address:", streetAddressInput.value.trim());
  console.log("Postal Code:", postalCodeInput.value.trim());

  
  document.getElementById('deliveryForm').submit();
  // Check the payment method
  const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
  const deliveryMethod = document.querySelector('input[name="deliveryMethod"]:checked');

  if (paymentMethod && deliveryMethod) {
  const id = <?php echo $id; ?>;
  if (paymentMethod.id === 'paypal') {
    // Redirect to PayPal payment page with all parameters
    window.location.href = `../payment/itemPaypal.php?id=${id}&total=<?php echo $total; ?>&deliveryMethod=${deliveryMethod.id}&paymentMethod=${paymentMethod.id}&District=${districtInput.value}&City=${cityInput.value}&StreetAddress=${streetAddressInput.value}&PostalCode=${postalCodeInput.value}`;
  } else if (paymentMethod.id === 'cash') {
    // Redirect to Cash payment page with all parameters
    window.location.href = `orderCompleted1.php?id=${id}&price=<?php echo $total; ?>&deliveryMethod=${deliveryMethod.id}&paymentMethod=${paymentMethod.id}&District=${districtInput.value}&City=${cityInput.value}&StreetAddress=${streetAddressInput.value}&PostalCode=${postalCodeInput.value}`;
  }
} else {
  alert("Please select both payment and delivery methods before confirming delivery.");
}

}


  // Attach an event listener to each input field to enable/disable the Confirm button
  districtInput.addEventListener('input', function () {
    confirmDeliveryButton.disabled = !areAllFieldsFilled();
  });

  cityInput.addEventListener('input', function () {
    confirmDeliveryButton.disabled = !areAllFieldsFilled();
  });

  streetAddressInput.addEventListener('input', function () {
    confirmDeliveryButton.disabled = !areAllFieldsFilled();
  });

  postalCodeInput.addEventListener('input', function () {
    confirmDeliveryButton.disabled = !areAllFieldsFilled();
  });

  // Attach the confirmDelivery function to the button click event
  confirmDeliveryButton.addEventListener('click', confirmDelivery);

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
    
    // Check if the delivery method and payment method are selected
    const deliveryMethod = document.querySelector('input[name="deliveryMethod"]:checked');
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

    if (deliveryMethod && paymentMethod) {
      if (deliveryMethod.id === 'delivery') {

        

        // Show the delivery address modal
        $('#deliveryModal').modal('show');
      } else {
        // Check payment method and redirect accordingly
        if (paymentMethod.id === 'cash') {
          // Redirect to a page for cash payment with pickup
          window.location.href = `orderHalfwayCompleted.php?id=${id}&total=<?php echo $total; ?>&deliveryMethod=${deliveryMethod.id}&paymentMethod=${paymentMethod.id}`;
        } else if (paymentMethod.id === 'paypal') {
          // Redirect to a page for PayPal payment with pickup
         window.location.href = `../payment/itemPaypal.php?id=${id}&total=<?php echo $total; ?>&deliveryMethod=${deliveryMethod.id}&paymentMethod=${paymentMethod.id}`;
        } else {
          alert("Invalid payment method selected.");
        }
      }
    } else {
      alert("Please select both payment and delivery methods before placing the order.");
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
