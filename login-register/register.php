<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login-register.css">
    <link rel="stylesheet" href="../home/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
 <nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../image/logo.png" width="80" height="80">
    </a>

    <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../login-register/register.php">Register</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../login-register/login.php">Login</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Sell</a></li>
    </ul>
    </div>
  </div>
</nav>
    <div class="search">
        <input class="searchbar" type="text" placeholder="Search for anything and everything" style="padding-left: 20px;">
        <button type="button" class="btn btn-primary">Search</button>
    </div>
   
    <div>
      <h4>What would you like to find?</h4>
    </div> 
    
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/property.png" alt="">
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/vehicle.png" alt="">
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/furniture.png" alt="">
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/electronic.png" alt="">
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/fashion.png" alt="">
          </a>
        </div>
      </div>
    </div>
   
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <div class="card" style="width: 18rem;">
            <img src="../image/iphone.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Iphone 12</h5>
              <p class="card-text">Price: $1000</p>
              <a href="#" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card" style="width: 18rem;">
            <img src="../image/iphone.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Iphone 12</h5>
              <p class="card-text">Price: $1000</p>
              <a href="#" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card" style="width: 18rem;">
            <img src="../image/iphone.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Iphone 12</h5>
              <p class="card-text">Price: $1000</p>
              <a href="#" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
      </div> 
  
<center>
    <div class="popup-overlay">
        <div class="popup-content" style="padding:40px;">
        <a href="../home/index-guest.php" class="d-grid gap-2 d-md-flex justify-content-md-end" style="color: inherit; 
  text-decoration: none;"><h2>x</h2></a>
            <h3>Create Account    </h3>
            <br>
            <form method="post" onsubmit="return validateForm();" style=" ">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <label for="email">Email </label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <br>
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                    <label for="confirmPassword">Confirm Password</label>
                </div>
                <br>
                <input type="submit" name="register" value="register" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;"></input>
            </form>
            <br>
        </div>
        </div>
    </center>
</body>
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

    // Connect to database
    $conn = mysqli_connect("localhost", "root", "", "market");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if email exists
$emailCheckSql = "SELECT * FROM account WHERE email = ?";
$emailCheckStmt = mysqli_prepare($conn, $emailCheckSql);
if ($emailCheckStmt) {
    mysqli_stmt_bind_param($emailCheckStmt, "s", $email);
    mysqli_stmt_execute($emailCheckStmt);
    $emailResult = mysqli_stmt_get_result($emailCheckStmt);

    if (mysqli_num_rows($emailResult) > 0) {
        echo "<script>alert('Email already exists. Please choose another email.');</script>";
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

        $insertSql = "INSERT INTO account(username, email, password, membership, date, verification_code, email_verified_at) VALUES (?, ?, ?, ?, ?, ?, NULL)";
        $insertStmt = mysqli_prepare($conn, $insertSql);

        if ($insertStmt) {

            $membership = "basic";
            mysqli_stmt_bind_param($insertStmt, "ssssss", $username, $email, $encrypted_password, $membership, $date, $verification_code);
            mysqli_stmt_execute($insertStmt);

            // Send verification email
            $mail = new PHPMailer(true);
            try {
                //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
 
            //Send using SMTP
            $mail->isSMTP();
 
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
 
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
 
            //SMTP username
            $mail->Username = 'market51bn@gmail.com';
 
            //SMTP password
            $mail->Password = 'ixcnouumjkoxtcvs';
 
            //Enable TLS encryption;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;
 
            //Recipients
            $mail->setFrom('admin.market@gmail.com', 'admin.market');
 
            //Add a recipient
            $mail->addAddress($email);
 
            //Set email format to HTML
            $mail->isHTML(true);
 
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
 
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
 
            $mail->send();
            // echo 'Message has been sent'; 
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            echo '<script>window.location.href = "emailverification.php?email=' . $email . '";</script>';
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
    mysqli_close($conn);
    exit;
}
}
    
        ?>
</html>

