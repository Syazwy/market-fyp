<!-- Register Database --> 

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../home/PHPMailer/src/Exception.php';
require '../home/PHPMailer/src/PHPMailer.php';
require '../home/PHPMailer/src/SMTP.php';

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
               window.location = "../home/index-guest.php?";
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
              window.location = "../home/index-guest.php?";
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
  
      $wishlist_count = 0; 
      $membership = "Basic"; 
  
      $insertSql = "INSERT INTO account(username, email, password, membership, subscriptionDate, date, verification_code, email_verified_at, status, wishlist_count) VALUES (?, ?, ?, ?, ?, ?, ?, NULL, 'Active', ?)";
      $insertStmt = mysqli_prepare($conn, $insertSql);
  
    
    if ($insertStmt) {
        mysqli_stmt_bind_param($insertStmt, "sssssssi", $username, $email, $encrypted_password, $membership, $date, $date, $verification_code, $wishlist_count);
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
                    </div>
                </div>
            </body>
            </html>';

            
            $mail->send();

            header("Location: ../home/index-guest.php?email=" . urlencode($email));

            echo '<script>
                $("#verificationModal").modal("show"); 
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

        if (password === confirmPassword) {
            if (password.length < 8) {
                alert("Password must be at least 8 characters");
                return false;
            }
            if (password.search(/[a-z]/i) < 0) {
                alert("Password must contain at least one letter");
                return false;
            }
            if (password.search(/[0-9]/) < 0) {
                alert("Password must contain at least one digit");
                return false;
            }
            // if (password.search(/[!@#$%^&*]/) < 0) {
            //     alert("Password must contain at least one special character");
            //     return false;
            // }
        }
       
        localStorage.setItem("email", email);

        return true;
    }
    
</script>