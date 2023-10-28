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

$selectedPlan = $_GET['plan'];

$price = 0; 
if ($selectedPlan === "Basic") {
    $price = 0;
} elseif ($selectedPlan === "Premium Monthly") {
    $price = 4.99;
} elseif ($selectedPlan === "Premium Annually") {
    $price = 49.99;
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

$sql = "UPDATE account SET membership = ? WHERE username = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $selectedPlan, $username);
    $stmt->execute();
    $stmt->close();
}
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0;

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;

    $mail->Username = 'market51bn@gmail.com';

    $mail->Password = 'ixcnouumjkoxtcvs';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;

    $mail->setFrom('admin.market@gmail.com', 'MarketBN');
    $mail->addAddress($email);

    $mail->isHTML(true);

$receiptNumber = mt_rand(100000, 999999);

$mail->Subject = 'Receipt Number: ' . $receiptNumber;

$mail->Body = "<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }
    .receipt {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
    }
    .header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
    }
    .details {
        margin-top: 20px;
    }
    .details b {
        display: inline-block;
        width: 50%;
    }
</style>";

$mail->Body .= '<div class="receipt">';
$mail->Body .= '<div class="header">Membership Receipt</div>';
$mail->Body .= 'Thank you for your order.<br><br>';
$mail->Body .= '<div class="details"><b>Receipt Number:</b> ' . $receiptNumber . '</div>';
$mail->Body .= '<div class="details"><b>Selected Plan:</b> ' . $selectedPlan . '</div>';
$mail->Body .= '<div class="details"><b>Total:</b> $' . $price . '</div>';
$mail->Body .= '</div>';



$mail->isHTML(true);



    $mail->send();
 $sqlUpdateSubscriptionDate = "UPDATE account SET subscriptionDate = NOW() WHERE email = ?";
 $stmtUpdateSubscriptionDate = $conn->prepare($sqlUpdateSubscriptionDate);

 if ($stmtUpdateSubscriptionDate) {
     $stmtUpdateSubscriptionDate->bind_param("s", $email);
     $stmtUpdateSubscriptionDate->execute();
     $stmtUpdateSubscriptionDate->close();
 } else {
     echo "Failed to prepare the SQL statement for updating subscriptionDate.";
 }

} catch (Exception $e) {
 echo "Email could not be sent. Error: " . $mail->ErrorInfo;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order is Complete</title>
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
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
