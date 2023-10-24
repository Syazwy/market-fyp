<!DOCTYPE html>
<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("../session/session.php");
require '../connection/connection.php';
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$usersemail = $_GET['usersemail'];
$District = $_GET['District'];
$City = $_GET['City'];
$StreetAddress = $_GET['StreetAddress'];
$PostalCode = $_GET['PostalCode'];
$id = $_GET['id'];
$total = $_GET['price'];
$deliveryMethod = $_GET['deliveryMethod'];
$paymentMethod = $_GET['paymentMethod'];

$sql = "SELECT name FROM itemslisting WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id); 
$stmt->execute();
$stmt->bind_result($itemname);

// Fetch the result
if ($stmt->fetch()) {
    // The $name variable now holds the item's name
    $stmt->close(); // Close the $stmt result set
  
    // Update the status to 'sold' and set the 'bought' column to the email
$updateSql = "UPDATE itemslisting SET status = 'sold', bought = ? WHERE id = ?";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bind_param("ss", $email, $id); // Assuming 'bought' column type is string

    if ($updateStmt->execute()) {
        // Status updated successfully
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {

}

$query = "SELECT * FROM account WHERE username = '$username'";
 $result = mysqli_query($conn, $query);

 
if ($result) {
  while($row = $result->fetch_assoc()){
    $accountStatus = $row['status'];
    $name =  $row['username'];
    $profileimage = $row['profile_image'];
   }
}

// Generate a random receipt number
$receiptNumber = mt_rand(100000, 999999);

// ----------------------
$mailUser = new PHPMailer(true);
try {
    // Enable verbose debug output for the $mailUser instance
    $mailUser->SMTPDebug = 0; // SMTP::DEBUG_SERVER;

    // Send using SMTP
    $mailUser->isSMTP();

    // Set the SMTP server to send through (e.g., Gmail)
    $mailUser->Host = 'smtp.gmail.com';

    // Enable SMTP authentication
    $mailUser->SMTPAuth = true;

    // SMTP username (replace with your Gmail email address)
    $mailUser->Username = 'market51bn@gmail.com';

    // SMTP password (replace with your Gmail password)
    $mailUser->Password = 'ixcnouumjkoxtcvs';

    // Enable TLS encryption;
    $mailUser->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mailUser->Port = 587;

    $mailUser->setFrom('admin.market@gmail.com', 'MarketBN');
    $mailUser->addAddress($email);

    // Construct the email body with a different message
    $mailUser->Subject = 'Receipt Number: ' . $receiptNumber;
    $mailUser->Body = "Thank you for your order,<br><br>";
    $mailUser->Body .= "Here is your order details:<br>";
    $mailUser->Body .= 'Receipt Number: <b>' . $receiptNumber . "</b><br>";
    $mailUser->Body .= "Item Name: <b>" . $itemname . "</b><br>";
    $mailUser->Body .= "Delivery Method: <b>" . $deliveryMethod . "</b><br>";
    $mailUser->Body .= "Payment Method: <b>" . $paymentMethod . "</b><br>";
    $mailUser->Body .= "Total: $<b>" . $total . "</b><br>";

    $mailUser->isHTML(true);

    // Send the confirmation email to the user
    $mailUser->send();
    
} catch (Exception $e) {
    echo "Confirmation Email could not be sent to the user. Error: " . $mailUser->ErrorInfo;
}

// ----------------------------


// Send an email using PHPMailer
$sellerEmail = new PHPMailer(true); // Create a PHPMailer instance for seller's email

try {
    // Enable verbose debug output
    $sellerEmail->SMTPDebug = 0; // SMTP::DEBUG_SERVER;
    $sellerEmail->isSMTP();
    $sellerEmail->Host = 'smtp.gmail.com';
    $sellerEmail->SMTPAuth = true;
    $sellerEmail->Username = 'market51bn@gmail.com';
    $sellerEmail->Password = 'ixcnouumjkoxtcvs';
    $sellerEmail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $sellerEmail->Port = 587;
    $sellerEmail->setFrom('admin.market@gmail.com', 'MarketBN');
    $sellerEmail->addAddress($usersemail);

    // Construct the email body for the seller
    $sellerEmail->Subject = 'New Order Notification';
    $sellerEmail->Body = "You have a new order for your item.<br><br>";
    $sellerEmail->Body .= "Here is your order details:<br>";
    $sellerEmail->Body .= 'Receipt Number: <b>' . $receiptNumber . "</b><br>";
    $sellerEmail->Body .= "Item Name: <b>" . $itemname . "</b><br>";
    $sellerEmail->Body .= "Delivery Method: <b>" . $deliveryMethod . "</b><br>";
    $sellerEmail->Body .= "District: <b>" . $District. "</b><br>";
    $sellerEmail->Body .= "City: <b>" . $City . "</b><br>";
    $sellerEmail->Body .= "Street Address: <b>" . $StreetAddress . "</b><br>";
    $sellerEmail->Body .= "Postal Code: <b>" . $PostalCode . "</b><br>";
    $sellerEmail->Body .= "Payment Method: <b>" . $paymentMethod . "</b><br>";
    $sellerEmail->Body .= "Total: $<b>" . $total . "</b><br>";
    $sellerEmail->Body .= "Bought by: <b>" . $email . "</b><br>";
  

// Set the email content type to HTML
$sellerEmail->isHTML(true);


    $sellerEmail->send();
    
} catch (Exception $e) {
    echo "Email could not be sent. Error: " . $sellerEmail->ErrorInfo;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order is Complete</title>
    <style>
 
    </style>
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
</script><br>
<br>
<br>
<div class="container" style=" box-radius:20px;padding:40px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); width:30% "> 
    <center>
        <img src="../image/logo.png" alt="market logo" style="height:100px">
        <h3>Your order is complete!</h3>
        <p style="color: #8F8F8F">You will receive a receipt from us with the complete order details.</p>
        <button onclick="myPurchases()" class="btn btn-primary" style="width:300px"><h4>Check your purchases!</h4></button>
    </center>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
<script>
    function myPurchases(){
        window.location.href = '../myPurchases/myPurchases.php';
    }
    
</script>
</html>
