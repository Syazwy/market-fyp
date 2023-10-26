<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="icon" href="../image/logo.png" type="image/x-icon">
</head>
<body>
  
<!-- forgot modal -->
<div class="modal" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel" aria-hidden="true" style="margin-top: 200px;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center" style="border: none;">
        <!-- <h3 class="modal-title d-flex justify-content-center text-center" id="forgotModalLabel">Login</h3> -->
        <a href="index-guest.php" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:500px;border: 1px solid white; background-color: white; color: black; font-size: 2em; text-decoration: none;"> &times; </a>
      </div>
      <br>
        <div class="modal-body">
          <!-- Login form content goes here -->
          <form method="POST" >



<?php
include_once('../connection/connection.php');
session_start();
    $msg = ''; // Initialize a message variable

if (isset($_POST['send_verification_code'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Sanitize the input

    $check_email = mysqli_query($conn, "SELECT email FROM account WHERE email='$email'");
    $res = mysqli_num_rows($check_email);

    if ($res > 0) {
        $verification_code = mt_rand(100000, 999999);

        mysqli_query($conn, "UPDATE account SET verification_code = '$verification_code' WHERE email = '$email'");

        // Send the verification code to the user's email
        // $message = "Your verification code is: $verification_code";

        include_once("forgot/SMTP/class.phpmailer.php");
        include_once("forgot/SMTP/class.smtp.php");

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
        $mail->isHTML(true); // Send plain text message
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
                    <h1 style="font-family: "Lobster", cursive;">Forgot Password Verification Code</h1>
                </div>
                <div class="content">
                    <p>Dear valued customer,</p>
                    <p>We are sorry to hear that you are having trouble with logging in to our website. We have received a message that you have forgotten your password. If this was you, you can get straight back into your account or reset your password now.</p>
                    <br>
                    <center><h4>Your Verification Code Is:</h4>
                    <div class="verification-code">' . $verification_code . '</div>
                    <p>Please enter this code to verify if youre allowed to change your password</p></center>
                    <br>
                    <p style="color:red;">If you did not request this verification code or reset code, please disregard this message. It is crucial that you do not share this verification code with anyone else. 
                    Only individuals who have access to this code will be able to use it for its intended purpose.</p>
                </div>
            </div>
        </body>
        </html>';

        if ($mail->send()) {
            $msg = '<p class="error" style="color:green;">A verification code has been sent to your email address.</p>';
        } else {
            $msg = '<p class="error" style="color:red;">Failed to send the verification code. Please try again later.</p>';
        }
    } else {
        $msg = '<p class="error" style="color:red;">We cant find a user with that email address</p>';;
    }
}


$show = 'none';
$fphidden = 'block';
$noEmail = '';


if (isset($_POST['email'])) {
  $forgotEmail = $_POST['email'];
  $fetchEmail = "SELECT email FROM account WHERE email = '$forgotEmail'";
  $result = $conn -> query($fetchEmail);

    while ($emailData = $result -> fetch_assoc()){
        $existingEmail = $emailData['email'];
      }

        if (isset($existingEmail)){
          $show = 'block';
          $fphidden = 'none';
          $noEmail = '';
        }

        else {
        $noEmail = '<p class="error" style="color:red;">We cant find a user with that email address</p>';
        }
}

if (isset($_POST['verify_code'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_code = $_POST['verification_code'];

    $result = mysqli_query($conn, "SELECT verification_code FROM account WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row['verification_code'] == $user_code) {
        $newPassword = $_POST['pwd'];
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $reset_pwd = mysqli_query($conn, "UPDATE account SET password='$hashedPassword' WHERE email='$email'");

        if ($reset_pwd) {
          $msg = '<p class="success" style="color:green;">Your password has been updated successfully.</p>';

          // Redirect the user to index-guest.php
          header("Location: index-guest.php");
          exit(); // Ensure that no other code is executed after the redirect
      
        } else {
            $msg = '<p class="error" style="color:red;">Error while updating password: ' . mysqli_error($conn).'</p>'; // Debugging
        }
    } else {
        $msg = '<p class="error" style="color:red;">Invalid verification code. Please try again.</p>';
    }
}
?>


<!-- HTML content goes here -->
<div class="container">
<div class="table-responsive" style="margin:auto;width:600px;padding: 20px; border-radius: 10px; box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.1), 0 0 0 2px rgb(255, 83, 83), 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);">
<center>
  <div class="container" id="forgot-password-section" style="display: <?php echo $fphidden ?>"> 
      
    <br>

      <h2 align="center">Forgot Password</h2><br/>

      <div class="box">
          <form method="post">
            <div class="form-group" style="border: 1px solid white">
              <label for="email"><h4>Email Address: </h4></label>
              
              <input type="text" name="email" id="email" placeholder="Enter Email" required data-parsley-type="email" data-parsley-trigger="keyup" 
              class="form-control" style="width:300px;height:20px;" />
            </div>
            <br>
            <br>
            <div class="form-group">
              <input type="submit" id="send_verification_code" name="send_verification_code" value="Send Verification Code" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;" 
              class="btn btn-success" />
            </div>
          </form>
          
      </div>
    <br>
    </div>
     

  
 
      <div class="container" id="reset-password-section" style="display: <?php echo $show ?> ;margin:auto;">
            <h2 align="center">Verify Code and Reset Password</h2><br/>

            <div class="box">
                <form method="post">
                  <div class="form-group" >
                    <label for="verification_code"><h4>Verification Code</h4></label>
                    <input type="text" name="verification_code" id="verification_code" placeholder="Enter Verification Code" required class="form-control" />
                    <input type="hidden" name="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" />

                  </div>
                  <br>
                  <div class="form-group">
                    <label for="pwd"><h4>New Password</h4></label>
                    <input type="password" name="pwd" id="pwd" placeholder="Enter New Password" required class="form-control"/>
                  </div>

                  <br>

                  <div class="form-group">
                    <input type="submit" id="verify_code" name="verify_code" value="Verify Code and Reset Password" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;" class="btn btn-success" />
                  </div>

                </form>
            </div>
        </div>
        </center>
        <?php echo $noEmail ?>
        
</div>
</div>

</body>
</html>
