<html>  
<head>  
    <title>Forgot Password</title>  
    <link rel="stylesheet" href="forgotphp.css" />
    <link rel="stylesheet" href="../forgot/forgot.css">  
</head>
<?php
include_once('connection.php');
if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['email'];
  $check_email = mysqli_query($connection,"select email from account where email='$email'");
  $res = mysqli_num_rows($check_email);
  if($res>0)
  {
    $message = '<div>
     <p><b>Hello!</b></p>
     <p>We are sorry to hear that you are having trouble with logging in to our website. We have received a message that you have forgotten your password. If this was you, you can get straight back into your account or reset your password now.</p>
     <br>
     <p><a style="background-color: #FF5353;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;" href="http://localhost/Market/login-register/forgot/reset/passwordreset.php?secret='.($email).'"> Click to Reset Your Password </a></p>
     <br>
     <p>If you didnt request a login link or password reset, you can ignore this message. </p>
    <p>Only people who know your password or click the login link in this email can log in to your account </p>
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

// $mail->FromName = "Tech Area";

//Recipients
$mail->setFrom('admin.market@gmail.com', 'admin.market');

//Add a recipient
$mail->AddAddress($email);

$mail->Subject = "Reset Password";

$mail->isHTML( TRUE );

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
     <form id="validate_form" method="post" >  
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