<!DOCTYPE html>
<html lang="en">
<?php
 
 if (isset($_POST["verify_email"]))
 {
     $email = $_POST["email"];
     $verification_code = $_POST["verification_code"];

     // connect with database
     $conn = mysqli_connect("localhost", "root", "", "market");

     // mark email as verified
     $sql = "UPDATE account SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
     $result  = mysqli_query($conn, $sql);

     if (mysqli_affected_rows($conn) == 0)
     {
         die("Verification code failed.");
     }

     echo "<p>You can login now.</p>";
     exit();
 }

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verification</title>
</head>
<body>
<form method="POST">
    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
    <input type="text" name="verification_code" placeholder="Enter verification code" required />
 
    <input type="submit" name="verify_email" value="Verify Email">
</form>
</body>
</html>