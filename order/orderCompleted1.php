<!DOCTYPE html>
<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("../session/session.php");
$username = $_SESSION['username'];
$email = $_SESSION['email'];


$id = $_GET['id'];
$total = $_GET['price'];
$deliveryMethod = $_GET['deliveryMethod'];
$paymentMethod = $_GET['paymentMethod'];

$conn = mysqli_connect("localhost", "root", "", "market");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM itemslisting WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id); 
$stmt->execute();
$stmt->bind_result($name);

// Fetch the result
if ($stmt->fetch()) {
    // The $name variable now holds the item's name
} else {
    echo "No data found for the given ID.";
}

// Close the statement
$stmt->close();

// Send an email using PHPMailer
$mail = new PHPMailer(true);
try {
    // Enable verbose debug output
    $mail->SMTPDebug = 0; // SMTP::DEBUG_SERVER;

    // Send using SMTP
    $mail->isSMTP();

    // Set the SMTP server to send through (e.g., Gmail)
    $mail->Host = 'smtp.gmail.com';

    // Enable SMTP authentication
    $mail->SMTPAuth = true;

    // SMTP username (replace with your Gmail email address)
    $mail->Username = 'market51bn@gmail.com';

    // SMTP password (replace with your Gmail password)
    $mail->Password = 'ixcnouumjkoxtcvs';

    // Enable TLS encryption;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('admin.market@gmail.com', 'MarketBN');
    $mail->addAddress($email);

    // Set email format to HTML
    $mail->isHTML(true);

// Generate a random receipt number
$receiptNumber = mt_rand(100000, 999999);

// Construct the email body with HTML line breaks
$mail->Subject = 'Receipt Number: ' . $receiptNumber;
$mail->Body = "Thank you for your order,<br><br>";
$mail->Body .= "Here is your order details:<br>";
$mail->Body .= 'Receipt Number: <b>' . $receiptNumber . "</b><br>";
$mail->Body .= "Item Name: <b>" . $name . "</b><br>";
$mail->Body .= "Delivery Method: <b>" . $deliveryMethod . "</b><br>";
$mail->Body .= "Payment Method: <b>" . $paymentMethod . "</b><br>";
$mail->Body .= "Total: $<b>" . $total . "</b><br>";

// Set the email content type to HTML
$mail->isHTML(true);

// The rest of your email sending code remains the same

// The rest of your email sending code remains the same

    $mail->send();
    
} catch (Exception $e) {
    echo "Email could not be sent. Error: " . $mail->ErrorInfo;
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
</script><br>
<br>
<br>
<div class="container" style=" box-radius:20px;padding:40px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); width:30% "> 
    <center>
        <img src="../image/logo.png" alt="market logo" style="height:100px">
        <h3>Your order is complete!</h3>
        <p style="color: #8F8F8F">You will receive a receipt from us with the complete order details.</p>
        <button onclick="backtohome()" class="btn btn-primary" style="width:300px"><h4>Back to Home</h4></button>
    </center>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
<script>
    function backtohome(){
        window.location.href = '../home/index.php';
    }
    
</script>
</html>
