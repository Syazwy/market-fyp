<!-- session -->
<?php
 session_start();
?>

<html>  
<head>  
    <title>Forgot Password</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
    <link rel="stylesheet" href="forgot.css"> 
</head>

<!-- php for the forgot password -->
<?php
include_once('connection.php');

if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['email'];
  $check_email = mysqli_query($connection,"select email from tbl_student where email='$email'");
  $res = mysqli_num_rows($check_email);
  if($res>0)
  {
    $_SESSION['email'] = $email;
    $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we receIved a password reset request for your account.</p>
     <br>
     <p>
     <a href="http://localhost/Market/login-register/forgot/reset/passwordreset.php?secret='.$email.'">Reset Password</a></p>
     <br>
     <p>If you did not request a password reset, no further action is required.</p>
    </div>';

include_once("SMTP/class.phpmailer.php");
include_once("SMTP/class.smtp.php");
$email = $email;

// Send verification email 
$mail = new PHPMailer;

// Send using SMTP
$mail->IsSMTP();

//Enable SMTP authentication
$mail->SMTPAuth = true; 

//Enable TLS encryption;
$mail->SMTPSecure = "tls";

//Set the SMTP server to send through
$mail->Host = 'smtp.gmail.com';

//TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
$mail->Port = 587; 

//SMTP username
$mail->Username = 'market51bn@gmail.com';

//SMTP password
$mail->Password = 'ixcnouumjkoxtcvs';

//Recipients
$mail->setFrom('admin.market@gmail.com', 'admin.market');

//Add a recipient
$mail->AddAddress($email);

// Add email subject
$mail->Subject = "Reset Password";

//Set email format to HTML
$mail->isHTML(true);

// Set the content inside the email
$mail->Body =$message;


if($mail->send())
{
  $msg = "We have e-mailed your password reset link!";
}
}
else
{
  $msg = "We can't find a user with that email address";
}
}

?>
<body>
<div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Forgot Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" action="reset/passwordreset.php">  
       <div class="form-group">
       <label for="email">Email Address</label>
       <input type="text" name="email" id="email" placeholder="Enter Email" required 
       data-parsley-type="email" data-parsley-trigg
       er="keyup" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" id="login" name="pwdrst" value="Send Password Reset Link" class="btn btn-success" />
       </div>
       
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
</body>
</html>