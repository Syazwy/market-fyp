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

if ($stmt->fetch()) {
<<<<<<< Updated upstream
    $stmt->close(); 
  
$updateSql = "UPDATE itemslisting SET status = 'sold', bought = ? WHERE id = ?";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bind_param("ss", $email, $id);

    if ($updateStmt->execute()) {
=======
  
    $stmt->close(); 
  
   
$updateSql = "UPDATE itemslisting SET status = 'sold', bought = ? WHERE id = ?";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bind_param("ss", $email, $id); 

    if ($updateStmt->execute()) {
      
>>>>>>> Stashed changes
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

$receiptNumber = mt_rand(100000, 999999);


$mailUser = new PHPMailer(true);
try {
<<<<<<< Updated upstream
    $mailUser->SMTPDebug = 0; 

    $mailUser->isSMTP();

    $mailUser->Host = 'smtp.gmail.com';

    $mailUser->SMTPAuth = true;

    $mailUser->Username = 'market51bn@gmail.com';

    $mailUser->Password = 'ixcnouumjkoxtcvs';

    $mailUser->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

=======
    
    $mailUser->SMTPDebug = 0; 

  
    $mailUser->isSMTP();

  
    $mailUser->Host = 'smtp.gmail.com';

   
    $mailUser->SMTPAuth = true;

   
    $mailUser->Username = 'market51bn@gmail.com';

   
    $mailUser->Password = 'ixcnouumjkoxtcvs';

 
    $mailUser->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    
>>>>>>> Stashed changes
    $mailUser->Port = 587;

    $mailUser->setFrom('admin.market@gmail.com', 'MarketBN');
    $mailUser->addAddress($email);

    $mailUser->Subject = 'Receipt Number: ' . $receiptNumber;
    $mailUser->Body = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border: 1px solid #ccc;">';
    $mailUser->Body .= '<div style="background-color: #333; color: #fff; padding: 10px; text-align: center;">Receipt</div>';
    $mailUser->Body .= '<div style="margin-top: 20px;">Thank you for your order.</div>';
    $mailUser->Body .= '<div style="margin-top: 20px;"><b>Receipt Number:</b> ' . $receiptNumber . '</div>';
    $mailUser->Body .= '<div style="margin-top: 20px;"><b>Item Name:</b> ' . $itemname . '</div>';
    $mailUser->Body .= '<div style="margin-top: 20px;"><b>Delivery Method:</b> ' . $deliveryMethod . '</div>';
    $mailUser->Body .= '<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">';
    $mailUser->Body .= '<tr>';
    $mailUser->Body .= '<td style="border: 1px solid #ccc; padding: 5px;">Payment Method:</td>';
    $mailUser->Body .= '<td style="border: 1px solid #ccc; padding: 5px;"><b>' . $paymentMethod . '</b></td>';
    $mailUser->Body .= '</tr>';
    $mailUser->Body .= '<tr>';
    $mailUser->Body .= '<td style="border: 1px solid #ccc; padding: 5px;">Total:</td>';
    $mailUser->Body .= '<td style="border: 1px solid #ccc; padding: 5px;">$<b>' . $total . '</b></td>';
    $mailUser->Body .= '</tr>';
    $mailUser->Body .= '</table>';
    $mailUser->Body .= '</div>';
    


    $mailUser->isHTML(true);

    $mailUser->send();
    
} catch (Exception $e) {
    echo "Confirmation Email could not be sent to the user. Error: " . $mailUser->ErrorInfo;
}



<<<<<<< Updated upstream
$sellerEmail = new PHPMailer(true);

try {
=======
$sellerEmail = new PHPMailer(true); 

try {
  
>>>>>>> Stashed changes
    $sellerEmail->SMTPDebug = 0; 
    $sellerEmail->isSMTP();
    $sellerEmail->Host = 'smtp.gmail.com';
    $sellerEmail->SMTPAuth = true;
    $sellerEmail->Username = 'market51bn@gmail.com';
    $sellerEmail->Password = 'ixcnouumjkoxtcvs';
    $sellerEmail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $sellerEmail->Port = 587;
    $sellerEmail->setFrom('admin.market@gmail.com', 'MarketBN');
    $sellerEmail->addAddress($usersemail);

    $sellerEmail->Subject = 'New Order Notification';

<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
    $sellerEmail->Body = "<style>
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
    
    $sellerEmail->Body .= '<div class="receipt">';
    $sellerEmail->Body .= '<div class="header">Order Receipt</div>';
    $sellerEmail->Body .= '<div class="details">You have a new order for your item.</div>';
    $sellerEmail->Body .= '<div class="details"><b>Receipt Number:</b> ' . $receiptNumber . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>Item Name:</b> ' . $itemname . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>Delivery Method:</b> ' . $deliveryMethod . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>District:</b> ' . $District . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>City:</b> ' . $City . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>Street Address:</b> ' . $StreetAddress . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>Postal Code:</b> ' . $PostalCode . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>Payment Method:</b> ' . $paymentMethod . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>Total:</b> $' . $total . '</div>';
    $sellerEmail->Body .= '<div class="details"><b>Bought by:</b> ' . $email . '</div>';
    $sellerEmail->Body .= '</div>';
    

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
