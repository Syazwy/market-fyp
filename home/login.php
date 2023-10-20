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
                header("Location: index-guest.php?email=" . urlencode($user->email));
                exit();
            } else {

              // Check membership and date for 'Premium Monthly'
if ($user->membership === 'Premium Monthly') {
  // Calculate the date 30 days ago from today
  $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));

  // Compare the 'date' column in the database with the date 30 days ago
  if (strtotime($user->subscriptionDate) <= strtotime($thirtyDaysAgo)) {
      // Update the membership to 'Basic'
      $updateSql = "UPDATE account SET membership = 'Basic' WHERE email = ?";
      $updateStmt = mysqli_prepare($conn, $updateSql);
      mysqli_stmt_bind_param($updateStmt, "s", $user->email);
      mysqli_stmt_execute($updateStmt);
  }
}
// Check membership and date for 'Premium Annually'
if ($user->membership === 'Premium Annually') {
// Calculate the date 365 days ago from today
$threeHundredSixtyFiveDaysAgo = date('Y-m-d', strtotime('-365 days'));

// Compare the 'date' column in the database with the date 365 days ago
if (strtotime($user->subscriptionDate) <= strtotime($threeHundredSixtyFiveDaysAgo)) {
    // Update the membership to 'Basic'
    $updateSql = "UPDATE account SET membership = 'Basic' WHERE email = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($updateStmt, "s", $user->email);
    mysqli_stmt_execute($updateStmt);
}
}
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
