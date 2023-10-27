<?php
  require '../connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../home/index.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
   
   <style>
  /* Styles from the first <style> section */

  .checked {
    color: orange;
  }

  .carousel-inner {
    background: white; /* Make the carousel background clear */
  }

  .carousel-item img {
    width: 600px;
    height: 400px;
  }

  .product-info.description {
    background: transparent; /* Make the description box background clear */
    padding: 20px;
    border-radius: 5px;
    margin-top: 20px;
    margin-left: 50px;
  }

  .product-info {
    width: 200px;
  }

  .itemdetail {
    background-color: white;
    width: 800px;
    height: 400px;
    margin-top: 40px;
    margin: auto;
  }

  .userdetail {
    
    background-color: #FFEAEA;
    width: auto;
    margin: auto;
    height: auto;
    border-radius: 40px;
    padding: 20px;
    margin-right: 250px;
  }

  .product-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .btn.btn-primary {
    background-color: #FF5353;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 18px;
    cursor: pointer;
    margin: 10px;
    height: 60px;
    width: 120px;
    font-size: 1.5em;
  }

  #wishlistButton {
    background-color: #FF5353;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 18px;
    cursor: pointer;
    margin: 10px;
    height: auto;
    width: 180px;
    align-self: flex-start;
  }

  .edit {
    background-color: #FF5353;
    color: #fff;
    border: none;
    padding: 20px;
    border-radius: 18px;
    font-size: 2em;
    margin: 10px;
    height: 100px;
    width: 100px;
    padding-bottom: 20px;
  }

  .price {
    font-size: 18px;
    font-weight: bold;
    margin: 10px 0;
  }

  h2 {
    font-size: 16px;
    margin: 10px 0;
  }

  .proInfo .btn {
    height: 65px;
    width: 120px;
    margin: 20px;
    font-size: 20px;
    border-radius: 18px;
  }

  h1 {
    font-size: 30px;
  }

  h5 {
    font-size: 20px;
  }

  .action-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }

  .wishlist-button-container {
    position: absolute;
    top: 10px; /* Adjust this value to your desired top position */
    right: 10px; /* Adjust this value to your desired right position */
  }

  /* Styles from the second <style> section */

  body {
    font-family: Arial, sans-serif;
  }

  div {
    margin: 10px;
  }

  .rating {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
    font-size: 20px; /* Adjust the font size as needed */
  }

  .rating .fa {
    margin: 0 5px; /* Adjust the spacing between stars */
  }

  label {
    margin-right: 5px;
  }

  select {
    padding: 5px;
  }

  #products-list {
    display: flex;
    flex-wrap: wrap;
  }

  .product {
    width: 200px;
    border: 1px solid #ddd;
    padding: 10px;
    margin: 5px;
  }

  ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  nav {
    background-color: #ffffff;
  }

  nav li {
    display: inline-block;
    margin: 0 10px;
  }

  nav li a {
    display: block;
    color: #000000;
    text-decoration: none;
    padding: 10px;
  }

  nav li a:hover {
    background-color: #ffb9b9;
  }

  .product-container {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    margin: auto;
    text-align: center;
    width: 1200px;
    
  }

  .product-info {
    flex: 1;
    padding: 0 20px;
    align-items: center;
    padding: 20px;
    width: 100px;
  }

  .product-info h1 {
    font-size: 24px;
    margin: 0;
  }

  .product-info p {
    margin: 10px 0;
  }

  .price {
    font-weight: bold;
  }

  #itemImages {
    width: 400px;
  }

  .user {
    width: 400px;
  }

  #secondhalf {
    display: flex;
    margin: auto;
  }
</style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
     .checked {
    color: orange;
  }
  </style>
  </head>
<body>
<script>
$(document).ready(function() {
    var emailParam = "<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>";
    console.log("Email parameter from URL: " + emailParam);

    if (emailParam) {
        $("#verificationModal").modal("show");
    }
});
</script>

<script>
    function getURLParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    const verifiedParam = getURLParameter('verified');
    if (verifiedParam === '1') {
        $(document).ready(function() {
            $("#verifiedModal").modal("show"); 
        });
    }
</script>

<?php
if (isset($_POST["verify_email"])) {
  $email = $_POST["email"];
  $verification_code = $_POST["verification_code"];

  $sql = "UPDATE account SET email_verified_at = NOW() WHERE email = ? AND verification_code = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $email, $verification_code);
  mysqli_stmt_execute($stmt);

  if (mysqli_affected_rows($conn) > 0) {
    header("Location: productinfo-guest.php?verified=1");
    exit();
  } else {
    echo '<script>alert("Verification code failed.");</script>';
    echo '<script>
             setTimeout(function(){
               window.location = "productinfo-guest.php?email=' . urlencode($email) . '";
             }, 500); 
          </script>';
  }

  mysqli_close($conn);

  exit();
}
?>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["register"])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if (empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

    $emailCheckSql = "SELECT * FROM account WHERE email = ?";
    $emailCheckStmt = mysqli_prepare($conn, $emailCheckSql);
    if ($emailCheckStmt) {
        mysqli_stmt_bind_param($emailCheckStmt, "s", $email);
        mysqli_stmt_execute($emailCheckStmt);
        $emailResult = mysqli_stmt_get_result($emailCheckStmt);

        if (mysqli_num_rows($emailResult) > 0) {
            echo "<script>alert('Email already exists. Please choose another email.');</script>";
            echo '<script>
             setTimeout(function(){
               window.location = "productinfo-guest.php?";
             }, 500); 
          </script>';
            exit;
        }

        mysqli_stmt_close($emailCheckStmt);
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    $usernameCheckSql = "SELECT * FROM account WHERE username = ?";
    $usernameCheckStmt = mysqli_prepare($conn, $usernameCheckSql);
    if ($usernameCheckStmt) {
        mysqli_stmt_bind_param($usernameCheckStmt, "s", $username);
        mysqli_stmt_execute($usernameCheckStmt);
        $usernameResult = mysqli_stmt_get_result($usernameCheckStmt);

        if (mysqli_num_rows($usernameResult) > 0) {
            echo "<script>alert('Username already exists. Please choose another username.');</script>";
            echo '<script>
            setTimeout(function(){
              window.location = "productinfo-guest.php?";
            }, 500); 
         </script>';
            exit;
        }

        mysqli_stmt_close($usernameCheckStmt);
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    $currentDateTime = new DateTime();
    $date = $currentDateTime->format('Y-m-d');
    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

   $insertSql = "INSERT INTO account(username, email, password, membership, date, verification_code, email_verified_at, status) VALUES (?, ?, ?, ?, ?, ?, NULL, 'Active')";
$insertStmt = mysqli_prepare($conn, $insertSql);

if ($insertStmt) {
    $membership = "Basic"; 
    mysqli_stmt_bind_param($insertStmt, "ssssss", $username, $email, $encrypted_password, $membership, $date, $verification_code);
    mysqli_stmt_execute($insertStmt);

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
            $mail->Subject = 'Your Verification Code for Our Online Store';
            $mail->Body = '<html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f7f7f7;
                        padding: 20px;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        background-color: rgb(255, 83, 83); 
                        color: #fff;
                        padding: 10px 0;
                    }
                    .content {
                        padding: 20px;
                    }
                    .verification-code {
                        font-size: 30px;
                        font-weight: bold;
                        text-align: center;
                        margin-top: 20px;
                    }
                    .button {
                        display: block;
                        width: 200px;
                        margin: 20px auto;
                        background-color: rgb(255, 83, 83);
                        color: #fff;
                        text-align: center;
                        padding: 10px 20px;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>Thank you for joining Market</h1>
                    </div>
                    <div class="content">
                        <p>Dear valued customer,</p>
                        <p>Your verification code is:</p>
                        <div class="verification-code">' . $verification_code . '</div>
                        <p>Please enter this code to complete your registration.</p>
                        <a href="http://localhost/Market/home/productinfo-guest.php?secret='.($email).' class="button">Verify Your Email</a>
                        <p>If you have any questions or need assistance, feel free to contact our support team.</p>
                    </div>
                </div>
            </body>
            </html>';

            
            $mail->send();

            header("Location: productinfo-guest.php?email=" . urlencode($email));

            echo '<script>
                $("#verificationModal").modal("show"); // Show the verification modal
            </script>';
        } catch (Exception $e) {
          echo '<script>alert("Account not registered: ' . $mail->ErrorInfo . '");</script>';
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        mysqli_close($conn);
        exit;
    }
}
?>

<!-- Login Database -->

<?php

$errorMessage = ""; 

if (isset($_POST["login"])) {
    $emailOrUsername = $_POST["emailOrUsername"];
    $password = $_POST["password"];

    if ($emailOrUsername === "admin") {
        if ($password === "123") {
            $_SESSION['member'] = true;
            $_SESSION['email'] = ""; 
            $_SESSION['username'] = "admin";

            header("Location: ../admin/admin.php");
            exit();
        } else {
            $errorMessage = "Password is not correct";
        }
    } else {
        $sql = "SELECT * FROM account WHERE email = ? OR username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $emailOrUsername, $emailOrUsername);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            $errorMessage = "Email or username not found.";
        } else {
            $user = mysqli_fetch_object($result);
            if (!password_verify($password, $user->password)) {
                $errorMessage = "Password is not correct";
            } elseif ($user->email_verified_at == null) {
                header("Location: productinfo-guest.php?email=" . urlencode($user->email));
                exit();
            } else {
                $_SESSION['member'] = true;
                $_SESSION['email'] = $user->email;
                $_SESSION['username'] = $user->username;

                header("Location: ../home/index.php");
                exit();
            }
        }
    }
}

?>


<body>
  <!-- Verification Modal --> 
 
 <div class="modal fade" id="verificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
        <div style="text-align: center;">
          <img src="../image/email.png" alt="mail logo" style="width: 70px;">
          <h4>Verify your email address</h4>
          <h5 class="modal-title" id="exampleModalLabel">
            Please enter the 6-digit code sent to
            <span style="color: #FF5353;"><?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?></span>
          </h5>
        </div>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
            <input type="text" class="form-control" name="verification_code" id="verification_code" placeholder="Enter verification code" required />
            <br>
            <div style="text-align: center;">
              <input type="submit" name="verify_email" value="Verify" style="background-color:#FF5353 ; width: 50%; border-radius: 10px; padding: 5px;">
            </div>
          </div>
        </form>
      </div>
      <div style="text-align: center;">
      <a id="changeemail" style="text-decoration:none;color: #FF5353; cursor: pointer;" href="productinfo-guest.php?show_register_modal=1">Change Email</a>

      </div>
    </div>
  </div>
</div>


 <!-- Verified modal --> 
 
 <div class="modal fade" id="verifiedModal"  tabindex="-1" role="dialog" aria-labelledby="verifiedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="width: 400px;">
      <div class="modal-body">
        <center>
      <img src="../image/check.png" alt="" style="width: 100px;">
      <br>
      <p></p>
      <h3>Verified!</h3>
      </center>
      </div>
    </div>
  </div>
</div>



<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="../home/index.php">
      <img src="../image/logo.png" width="80" height="80">
    </a>

    <div class="collapse navbar-collapse justify-content-center">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link active" aria-current="page" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button" aria-controls="offcanvasRight">Categories</a></li>
        <li class="nav-item"><button id="registerModalTriggerButton" class="nav-link active" aria-current="page" data-toggle="modal" data-target="#registerModal" data-whatever="register">Register</button></li>
        <li class="nav-item"><button class="nav-link active" aria-current="page"  data-toggle="modal" data-target="#loginModal" data-whatever="login">Login</button></li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#sellModal">Sell</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="sellModal" tabindex="-1" aria-labelledby="sellModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
           
            <div class="modal-body text-center"> 
               <h3>Please log in or create an account first.</h3>
            </div>
        </div>
    </div>
</div>

      <main>
        <?php

        if (isset($_GET['id'])) {
            $itemId = $_GET['id'];
            
            $query = "SELECT itemslisting.*, item_images.image_filename 
                      FROM itemslisting 
                      JOIN item_images ON itemslisting.id = item_images.item_id 
                      WHERE itemslisting.id = $itemId"; 
            $result = mysqli_query($conn, $query);
            
            if ($row = mysqli_fetch_assoc($result)) {
          
          
          
      ?>
          <div class="container1">
            <div class="product-container">
              <div id="carouselExampleIndicators" class="carousel slide w-100" data-bs-ride="carousel" >
                <div class="carousel-indicators" >
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src ="../sellers/upload/<?php echo $row['image_filename'];?>" >
                  </div>
                  <div class="carousel-item">
                  <img src ="../sellers/upload/<?php echo $row['image_filename'];?>" >
                  </div>
                  <div class="carousel-item">
                  <img src ="../sellers/upload/<?php echo $row['image_filename'];?>" >
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="" style="color:black;">< Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="" style="color:black;">Next ></span>
                </button>
              </div>
            </div>
          </div>
          <br>
          <br>

        <div id="secondhalf">

            <div class="itemdetail">
                <br>
                <h1  style="font: size 60px;font-weight:thin"><?php echo $row["name"]; ?></h1>
                <h2 style="font: size 20px;font-weight:bolder">$<?php echo $row["price"]; ?></h2>

                <br>
          
                <h3>Condition: </h3>
                  <h5><?php echo $row["item_condition"]; ?></h5>
                <br>
                
                <h3>Description:</h3>
                <h5><?php echo $row["description"]; ?></h5>
                <br>
               </div>
   
     <center>
     <?php
    $username = $row["username"];
    
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    $reviewResult = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews WHERE users = '$username'");

    if ($reviewResult->num_rows > 0) {
        $reviewRow = $reviewResult->fetch_assoc();
        $averageRating = $reviewRow['avg_rating'];
        $totalReviews = $reviewRow['total_reviews'];

        function generateStarRating($rating) {
            $output = '';
            for ($i = 1; $i <= 5; $i++) {
                if (isset($rating) && $i <= ceil($rating)) {
                    $output .= '<i class="fa fa-star checked"></i>';
                } else {
                    $output .= '<i class="fa fa-star"></i>';
                }
            }
            return $output;
        }

        echo '<div class="userdetail">';
        echo '<br>';

        $sellerimg = isset($row['profile_image']) ? $row['profile_image'] : null;
        
        if (isset($sellerimg) && $sellerimg != null) {
            echo '<h2 style="font-size:20px;font-weight:thin"><img src="../profile/' . $sellerimg . '" width="60px" height="60px" class="profile rounded-circle" alt="Profile Picture">' . " " . $row["username"] . ' (' . $totalReviews . ' reviews)' .
                '<small>' .
                generateStarRating($averageRating) .
                '<small></h2>';
        } else {
            echo '<h2 style="font-size:20px;font-weight:thin"><img src="../image/profile.png" width="60px" height="60px" class="profile rounded-circle" alt="Profile Picture">' . " " . $row["username"] . ' (' . $totalReviews . ' reviews)' .
                '<small>' .
                generateStarRating($averageRating) .
                '<small></h2>';
        }

        echo '<br>';
        echo '<h2><img src="../image/location-outline.svg" alt="" width="50" height="50">' . $row["location"] . '</h2>';

    } else {
        echo '- No reviews available.';
    }

    echo '</div>';
?>

</center>
<script>
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var recipient = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>

<!-- Register Modal -->
<div class="modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" >
  <div class="modal-header justify-content-center" style="border: none;">
  <h3 class="modal-title d-flex justify-content-center text-center" id="registerModalLabel">Create Account</h3>
  <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <div class="modal-body">
        <form method="post" onsubmit="return validateForm();" >
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <label for="email">Email </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                    <label for="confirmPassword">Confirm Password</label>
                </div>
                <br>
               <input type="submit" name="register" value="Create" class="btn btn-primary" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;">
            </form>
      </div>
     
    </div>
  </div>
</div>

<!-- Login Modal -->
<div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
  <div class="modal-header justify-content-center" style="border: none;">
      <h3 class="modal-title d-flex justify-content-center text-center" id="loginModalLabel">Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: 1px solid white;background-color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Login form content goes here -->
        <form method="POST" >
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="emailOrUsername" name="emailOrUsername" placeholder="Email or Username" required>
        <label for="emailOrUsername">Email or Username</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
    </div>
    <br>
    <center>
    <p><a class="active" aria-current="page"  data-toggle="modal" data-target="#forgotModal" data-whatever="login" href="forgot/forgot.php" id="" style="color: rgb(255, 83, 83);">Forgot password?</a></p>
    </center>
    <input type="submit" name="login" value="Log In" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;">
</form>
      </div>
    </div>
  </div>
</div>

<!-- forgot modal -->
<div class="modal" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
  <div class="modal-header justify-content-center" style="border: none;">
      <!-- <h3 class="modal-title d-flex justify-content-center text-center" id="forgotModalLabel">Login</h3> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: 1px solid white;background-color:white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Login form content goes here -->
        <form method="POST" >

<?php


if (isset($_POST['send_verification_code'])) {
  $email = $_POST['email'];
  $check_email = mysqli_query($connection, "SELECT email FROM account WHERE email='$email'");
  $res = mysqli_num_rows($check_email);

  if ($res > 0) {
    $verification_code = mt_rand(100000, 999999);

    mysqli_query($connection, "UPDATE account SET verification_code = $verification_code WHERE email = '$email'");

    $message = "Your verification code is: $verification_code";

    include_once("forgot/SMTP/class.phpmailer.php");
    include_once("forgot/SMTP/class.smtp.php");

    $email = $email;

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->Username = 'market51bn@gmail.com';
    $mail->Password = 'ixcnouumjkoxtcvs';
    $mail->setFrom('admin.market@gmail.com', 'admin.market');
    $mail->AddAddress($email);
    $mail->Subject = "Verification Code";
    $mail->isHTML(false); 
    $mail->Body = $message;

    if($mail->send()) {
      $msg = "A verification code has been sent to your email address.";
    } else {
      $msg = "Failed to send the verification code. Please try again later.";
    }
  } else {
    $msg = "We can't find a user with that email address";
  }
}

if (isset($_POST['verify_code'])) {
  $email = $_POST['email'];
  $user_code = $_POST['verification_code'];

  $result = mysqli_query($connection, "SELECT verification_code FROM account WHERE email='$email'");
  $row = mysqli_fetch_assoc($result);

  if ($row['verification_code'] == $user_code) {
    $newPassword = $_POST['pwd']; 

     $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $reset_pwd = mysqli_query($connection, "UPDATE account SET password='$hashedPassword' WHERE email='$email'");

    if ($reset_pwd) {
        $msg = 'Your password has been updated successfully.';
    } else {
        $msg = "Error while updating password.";
    }
  } else {
    $msg = "Invalid verification code. Please try again.";
  }
}
?>

<!-- HTML content goes here -->
<div class="container">
  <div class="table-responsive" style="padding: 20px; border-radius: 10px; box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.1), 0 0 0 2px rgb(255, 83, 83), 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);">
    <br>
    <h3 align="center">Forgot Password</h3><br/>
    <div class="box">
      <form method="post">
        <div class="form-group" style="border: 1px solid white">
          <label for="email">Email Address</label>
          <br>
          <input type="text" name="email" id="email" placeholder="Enter Email" required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" />
        </div>
        <br>
        <div class="form-group">
          <input type="submit" id="send_verification_code" name="send_verification_code" value="Send Verification Code" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;" class="btn btn-success" />
        </div>
      </form>
      <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
    </div>
    <br>
    <?php
    if (isset($_POST['email'])) {
    ?>
    <h3 align="center">Verify Code and Reset Password</h3><br/>
    <div class="box">
      <form method="post">
        <div class="form-group">
          <label for="verification_code">Verification Code</label>
          <br>
          <input type="text" name="verification_code" id="verification_code" placeholder="Enter Verification Code" required class="form-control" />
          <input type="hidden" name="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" />
        </div>
        <div class="form-group">
          <label for="pwd">New Password</label>
          <input type="password" name="pwd" id="pwd" placeholder="Enter New Password" required class="form-control"/>
        </div>
        <br>
        <div class="form-group">
          <input type="submit" id="verify_code" name="verify_code" value="Verify Code and Reset Password" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;" class="btn btn-success" />
        </div>
      </form>
      <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
    </div>
    <?php
    }
    ?>
  </div>
</div>


<!-- ---------------------------------------------------------------- -->

 


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

<script>
  const showRegisterModalParam = getURLParameter('show_register_modal');
  if (showRegisterModalParam === '1') {
    $(document).ready(function() {
      $("#registerModal").modal("show");
    });
  }
</script>

<script>
 
    function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var email = document.getElementById("email").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        if (username === "" || password === "" || email === "" || confirmPassword === "") {
            alert("All fields are required");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return false;
        }

        // if (password === confirmPassword) {
        //     if (password.length < 8) {
        //         alert("Password must be at least 8 characters");
        //         return false;
        //     }
        //     if (password.search(/[a-z]/i) < 0) {
        //         alert("Password must contain at least one letter");
        //         return false;
        //     }
        //     if (password.search(/[0-9]/) < 0) {
        //         alert("Password must contain at least one digit");
        //         return false;
        //     }
        //     if (password.search(/[!@#$%^&*]/) < 0) {
        //         alert("Password must contain at least one special character");
        //         return false;
        //     }
        // }
       
        localStorage.setItem("email", email);

        return true;
    }
    
</script>
<script>
  $(document).ready(function () {
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus');
    });

    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); 
      var recipient = button.data('whatever'); 
      
    });
  });
</script>

        <?php if (!empty($errorMessage)) : ?>
            <script>
                alert("<?php echo $errorMessage; ?>");
            </script>
        <?php endif; ?>

        
        </body>
</html>
<?php
session_destroy();
?>

<script>
    if (sessionEmail === '<?php echo $row["email"]; ?>') {
        document.getElementById('chatButton').style.display = 'none';
        document.getElementById('buyButton').style.display = 'none';
    }
    
    function buy() {
        window.location.href = '../order/orderItem.php?id=<?php echo $row["id"]; ?>';
    }
    function chat() {
      var username = "<?php echo $row['username']; ?>";
var id = "<?php echo $row['id']; ?>";
var description = "<?php echo $row['description']; ?>";
var name = "<?php echo $row['name']; ?>";
var price = "<?php echo $row['price']; ?>";

var url = '../privatemessage/pm.php?' +
    'username=' + encodeURIComponent(username) +
    '&id=' + encodeURIComponent(id) +
    '&description=' + encodeURIComponent(description) +
    '&name=' + encodeURIComponent(name) +
    '&price=' + encodeURIComponent(price);

window.location.href = url;

    }
</script>




          <br>

      <?php

            } else {
                echo "Product not found.";
            }
        } else {
            echo "Product ID not specified.";
        }
      ?>



      </main>
      
      <script>
        function buy(id) {
    window.location.href = '../order/orderItem.php?id=' + <?php echo $row["id"]; ?>
}
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
