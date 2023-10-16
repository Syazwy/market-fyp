<?php
  require '../connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ProductInfo.css">
    <link rel="stylesheet" href="../home/index.css">
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
    // Check if the email parameter is present in the URL
    var emailParam = "<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>";
    console.log("Email parameter from URL: " + emailParam);

    // Check if emailParam is not empty before showing the modal
    if (emailParam) {
        $("#verificationModal").modal("show"); // Show the verification modal
    }
});
</script>

<!-- Add this script to your productinfo-guest.php file -->
<script>
    // Function to check the URL parameters
    function getURLParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Check if the 'verified' parameter is set to 1
    const verifiedParam = getURLParameter('verified');
    if (verifiedParam === '1') {
        $(document).ready(function() {
            $("#verifiedModal").modal("show"); // Show the 'verifiedModal'
        });
    }
</script>

<?php
if (isset($_POST["verify_email"])) {
  $email = $_POST["email"];
  $verification_code = $_POST["verification_code"];

  // Prepare and execute the SQL query with parameter binding
  $sql = "UPDATE account SET email_verified_at = NOW() WHERE email = ? AND verification_code = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $email, $verification_code);
  mysqli_stmt_execute($stmt);

  // Check the affected rows and handle accordingly
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

  // Close the database connection
  mysqli_close($conn);

  exit();
}
?>

<!-- Register Database --> 

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

    // Validate input
    if (empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash password
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    // $encrypted_password = $password;

    // Check if email exists
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

    // Check if username exists
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

    // Insert new user into database
    $currentDateTime = new DateTime();
    $date = $currentDateTime->format('Y-m-d');
    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

   $insertSql = "INSERT INTO account(username, email, password, membership, date, verification_code, email_verified_at, status) VALUES (?, ?, ?, ?, ?, ?, NULL, 'Active')";
$insertStmt = mysqli_prepare($conn, $insertSql);

if ($insertStmt) {
    $membership = "Basic"; // Note: removed the extra space before "Basic"
    mysqli_stmt_bind_param($insertStmt, "ssssss", $username, $email, $encrypted_password, $membership, $date, $verification_code);
    mysqli_stmt_execute($insertStmt);

        // Send verification email
        $mail = new PHPMailer(true);
        try {
            // Enable verbose debug output
            $mail->SMTPDebug = 0; // SMTP::DEBUG_SERVER;

            // Send using SMTP
            $mail->isSMTP();

            // Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';

            // Enable SMTP authentication
            $mail->SMTPAuth = true;

            // SMTP username
            $mail->Username = 'market51bn@gmail.com';

            // SMTP password
            $mail->Password = 'ixcnouumjkoxtcvs';

            // Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('admin.market@gmail.com', 'MarketBN');

            // Add a recipient
            $mail->addAddress($email);

            // Set email format to HTML
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

            // Now, display the verification modal
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

$errorMessage = ""; // Initialize an empty error message

if (isset($_POST["login"])) {
    $emailOrUsername = $_POST["emailOrUsername"];
    $password = $_POST["password"];

    // Check if the input name is "admin"
    if ($emailOrUsername === "admin") {
        // Verify the admin password
        if ($password === "123") {
            // Set session variables to indicate the user is logged in as admin
            $_SESSION['member'] = true;
            $_SESSION['email'] = ""; // Set as needed
            $_SESSION['username'] = "admin";

            header("Location: ../admin/admin.php");
            exit();
        } else {
            $errorMessage = "Password is not correct";
        }
    } else {
        // Use prepared statements to prevent SQL injection
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
                // Set session variables for a regular user
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
        <!-- Remove the button to close the modal -->
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
      <!-- Move the "Change Email" link outside the form -->
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

        // Check if the 'id' query parameter is set in the URL
        if (isset($_GET['id'])) {
            $itemId = $_GET['id'];
            
            // Fetch the specific product based on the 'id' parameter
            $query = "SELECT itemslisting.*, item_images.image_filename 
                      FROM itemslisting 
                      JOIN item_images ON itemslisting.id = item_images.item_id 
                      WHERE itemslisting.id = $itemId"; // Make sure to sanitize and validate the input
            $result = mysqli_query($conn, $query);
            
            // Check if a product with the specified 'id' exists
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
                    <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" >
                  </div>
                  <div class="carousel-item">
                  <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" >
                  </div>
                  <div class="carousel-item">
                  <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" >
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="">Next</span>
                </button>
              </div>
          </div>
          </div>

        <div id="secondhalf">
          <div class="product-info description">
              <h3>Item Name:</h3>
              <h6 style="text-transform: capitalize"><?php echo $row["name"]; ?></h6>
              <h3>Price:</h3>
              <h6>$<?php echo $row["price"]; ?></h6>
              <h3>Category:</h3>
              <h6><?php echo $row["category"]; ?></h6>
              <h3>Description:</h3>
              <h6><?php echo $row["description"]; ?></h6>
              <br>

              <br>
              <!-- <button type="button" class="buy-button">Buy Now</button>
              <button type="button" class="chat-button">Chat Now</button>
              <a href="../admin/report.php?id=<?php echo $row["id"]; ?>"><button type="button" class="chat-button">Report</button></a> -->
            </div>
     <!-- untuk kan ke page usersprofile -->
     <?php 
  
    $username = $row["username"];

    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    }

    $reviewResult = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews WHERE users = '$username'");

    if ($reviewResult->num_rows > 0) {
        $reviewRow = $reviewResult->fetch_assoc();
        $averageRating = $reviewRow['avg_rating'];
        $totalReviews = $reviewRow['total_reviews'];

        // Function to generate star rating based on the average rating
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

        // Determine the href value based on email comparison        
        echo '<div class="user">';
        echo '<img width="50px" src="../image/profile.png">';
        echo generateStarRating($averageRating) . ' (' . $totalReviews . ' reviews)';
        echo '<p>' . $row["username"] . '</p>';
        echo '<p>' . $row["location"] . '</p>';
        
    } else {
        echo '- No reviews available.';
    }
    
    echo '</div>';

?>

<script>
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
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

$msg = ''; // Initialize a message variable

if (isset($_POST['send_verification_code'])) {
  $email = $_POST['email'];
  $check_email = mysqli_query($connection, "SELECT email FROM account WHERE email='$email'");
  $res = mysqli_num_rows($check_email);

  if ($res > 0) {
    // Generate a verification code
    $verification_code = mt_rand(100000, 999999);

    // Store the verification code in the database (you need to have a column for this)
    mysqli_query($connection, "UPDATE account SET verification_code = $verification_code WHERE email = '$email'");

    // Send the verification code to the user's email
    $message = "Your verification code is: $verification_code";

    include_once("forgot/SMTP/class.phpmailer.php");
    include_once("forgot/SMTP/class.smtp.php");

    $email = $email;

    // Send verification email
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
    $mail->isHTML(false); // Send plain text message
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

  // Retrieve the stored verification code from the database
  $result = mysqli_query($connection, "SELECT verification_code FROM account WHERE email='$email'");
  $row = mysqli_fetch_assoc($result);

  if ($row['verification_code'] == $user_code) {
    // Verification code matches, allow the user to reset their password
    $newPassword = $_POST['pwd']; // Get the new password

    // Hash the new password securely
     $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    //$hashedPassword = $newPassword;

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
  // Check if the 'show_register_modal' parameter is set to 1
  const showRegisterModalParam = getURLParameter('show_register_modal');
  if (showRegisterModalParam === '1') {
    $(document).ready(function() {
      $("#registerModal").modal("show"); // Show the register modal
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
      var button = $(event.relatedTarget); // Button that triggered the modal
      var recipient = button.data('whatever'); // Extract info from data-* attributes
      
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
    // Check if the session email is the same as the email retrieved from the database
    if (sessionEmail === '<?php echo $row["email"]; ?>') {
        document.getElementById('chatButton').style.display = 'none';
        document.getElementById('buyButton').style.display = 'none';
    }
    
    function buy() {
        // Redirect to buyMembership.php with the selected plan as a URL parameter
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
                // Handle the case where the specified product doesn't exist
                echo "Product not found.";
            }
        } else {
            // Handle the case where the 'id' parameter is not set
            echo "Product ID not specified.";
        }
      ?>



      </main>
      
      <script>
        function buy(id) {
    // Redirect to buyMembership.php with the selected plan as a URL parameter
    window.location.href = '../order/orderItem.php?id=' + <?php echo $row["id"]; ?>
}
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
