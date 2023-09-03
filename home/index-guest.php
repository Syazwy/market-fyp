<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"></head>
  <style>
  .modal-header {
    text-align: center;
    border: none;
  }

  .modal-title {
    margin: 0 auto;
  }

  .modal-header .close {
    position: absolute;
    right: 15px;
    top: 15px;
  }

  .modal-content{
    padding: 20px; 
    padding-bottom: 60px;
    padding-top: 60px;
    border-radius: 15px;
  }
</style>

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

<!-- Add this script to your index-guest.php file -->
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
session_start();
?>
<?php
if (isset($_POST["verify_email"])) {
  $email = $_POST["email"];
  $verification_code = $_POST["verification_code"];

  // connect with the database
  $conn = mysqli_connect("localhost", "root", "", "market");

  // Check for a successful database connection
  if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
  }

  // Prepare and execute the SQL query with parameter binding
  $sql = "UPDATE account SET email_verified_at = NOW() WHERE email = ? AND verification_code = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $email, $verification_code);
  mysqli_stmt_execute($stmt);

  // Check the affected rows and handle accordingly
  if (mysqli_affected_rows($conn) > 0) {
    header("Location: index-guest.php?verified=1");
    exit();
  } else {
    echo '<script>alert("Verification code failed.");</script>';
    echo '<script>
             setTimeout(function(){
               window.location = "index-guest.php?email=' . urlencode($email) . '";
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
            echo '<script>
             setTimeout(function(){
               window.location = "index-guest.php?";
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
              window.location = "index-guest.php?";
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

    $insertSql = "INSERT INTO account(username, email, password, membership, date, verification_code, email_verified_at) VALUES (?, ?, ?, ?, ?, ?, NULL)";
    $insertStmt = mysqli_prepare($conn, $insertSql);

    if ($insertStmt) {
        $membership = "basic";
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

            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

            $mail->send();

            header("Location: index-guest.php?email=" . urlencode($email));

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

    // Connect to the database (consider using a separate file for database configuration)
    $conn = mysqli_connect("localhost", "root", "", "market");

    // Check if the connection was successful
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM account WHERE email = ? OR username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $emailOrUsername, $emailOrUsername); // Bind the same value twice
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 0) {
        $errorMessage = "Email or username not found.";
    } else {
        $user = mysqli_fetch_object($result);
        if (!password_verify($password, $user->password)) {
            $errorMessage = "Password is not correct";
        } elseif ($user->email_verified_at == null) {
            header("Location: index-guest.php?email=" . urlencode($user->email));
            exit();
        } else {
            // Set session variables to indicate the user is logged in
            $_SESSION['member'] = true;
            $_SESSION['email'] = $user->email;
            $_SESSION['username'] = $user->username;

            header("Location: ../home/index.php");
            exit();
        }
    }
}
?>

<body>
<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="../image/logo.png" width="80" height="80">
    </a>

    <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
      <li class="nav-item"><button id="registerModalTriggerButton" class="nav-link active" aria-current="page" data-toggle="modal" data-target="#registerModal" data-whatever="register">Register</button></li>
      <li class="nav-item"><button class="nav-link active" aria-current="page"  data-toggle="modal" data-target="#loginModal" data-whatever="login">Login</button></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Sell</a></li>
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

    <center>
  <div class="container">
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
  </div>
  </center>

    <div>
      <h4>Newly Listed</h4>
    </div>

    <div class="container">
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <?php
        require '../sellers/connection.php';
        
        $i = 1;
        $query = "SELECT itemslisting.*, item_images.image_filename 
                  FROM itemslisting 
                  JOIN item_images ON itemslisting.id = item_images.item_id 
                  GROUP BY itemslisting.id 
                  ORDER BY itemslisting.id DESC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) :
        ?>

      <div class="col d-flex align-items-center justify-content-center">
        <div class="card item h-100" style="background-color: #FFFFFF;">
          <a href="">
            <img src="../sellers/upload/<?php echo $row['image_filename']; ?>" class="card-img-top" width="150px" height="150px">
          </a>
          <div class="card-body">
            <p class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></p>
            <h5 class="card-title"><b><?php echo "BND$".$row["price"]; ?></b></h5>
            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
      </div>
    </div>

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
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
    <p><a href="../forgot/forgot.php" id="" style="color: rgb(255, 83, 83);">Forgot password?</a></p>
    </center>
    <input type="submit" name="login" value="Log In" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;">
</form>
      </div>
      
    </div>
  </div>
</div>

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
      <a id="changeemail" style="text-decoration:none;color: #FF5353; cursor: pointer;" href="index-guest.php?show_register_modal=1">Change Email</a>

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