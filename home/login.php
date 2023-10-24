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
            if ($user->status === 'Banned') {
                // User is banned, display a modal popup with JavaScript
                echo '<script>
                $(document).ready(function() {
                    $("#bannedModal").modal("show");
                });
            </script>';
            } elseif (!password_verify($password, $user->password)) {
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
                $_SESSION['member'] = true;
                $_SESSION['email'] = $user->email;
                $_SESSION['username'] = $user->username;
                $_SESSION['id'] = $user->id;
                header("Location: ../home/index.php");
                exit();
            }
        }
    }
}
?>