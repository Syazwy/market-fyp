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
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Sanitize the input

    $check_email = mysqli_query($conn, "SELECT email FROM account WHERE email='$email'");
    $res = mysqli_num_rows($check_email);

    if ($res > 0) {
        $verification_code = mt_rand(100000, 999999);

        mysqli_query($conn, "UPDATE account SET verification_code = '$verification_code' WHERE email = '$email'");

        // Send the verification code to the user's email
        $message = "Your verification code is: $verification_code";

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
        $mail->isHTML(false); // Send plain text message
        $mail->Body = $message;

        if ($mail->send()) {
            $msg = "A verification code has been sent to your email address.";
        } else {
            $msg = "Failed to send the verification code. Please try again later.";
        }
    } else {
        $msg = "We can't find a user with that email address";
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
            $msg = 'Your password has been updated successfully.';
        } else {
            $msg = "Error while updating password: " . mysqli_error($conn); // Debugging
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
