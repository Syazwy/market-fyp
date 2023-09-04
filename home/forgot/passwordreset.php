<?php
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <link rel="stylesheet" href="forgotphp.css">
    <link rel="stylesheet" href="forgot.css">
</head>
<body>
<?php
include_once('connection.php');

$msg = ''; // Initialize a message variable

if (isset($_POST['pwdrst'])) {
    $email = $_POST['email'];
    $newPassword = $_POST['pwd']; // Get the new password

    // Hash the new password securely
    // $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    $hashedPassword = $newPassword;

    // Set 'email' in the $_SESSION array
    $_SESSION['email'] = $email;

    $reset_pwd = mysqli_query($connection, "UPDATE account SET password='$hashedPassword' WHERE email='$email'");

    if ($reset_pwd) {
        $msg = 'Your password has been updated successfully. <a href="../index.php">Click here</a> to login.';
    } else {
        $msg = "Error while updating password.";
    }
}
?>
<div class="container">
    <h3 align="center">Reset Password</h3><br/>
    <div class="box">
        <form id="validate_form" method="post">
            <input type="hidden" name="email" value="<?php echo $email; ?>"/>
            <div class="form-group">
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" placeholder="Enter Password" required class="form-control"/>
            </div>
            <div class="form-group">
                <label for="cpwd">Confirm Password</label>
                <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" required class="form-control"/>
            </div>
            <div class="form-group">
                <input type="submit" id="login" name="pwdrst" value="Reset Password" class="btn btn-success" />
            </div>
            <p class="error"><?php echo $msg; ?></p> <!-- Display the message -->
        </form>
    </div>
</div>
</body>
</html>
