    <!-- Login Database -->
    <?php
$errorMessage = ""; 
if (isset($_POST["login"])) {
    $emailOrUsername = $_POST["emailOrUsername"];
    $password = $_POST["password"];
 
    if ($emailOrUsername === "admin") {
       
        if ($password === "123") {
           
            $_SESSION['member'] = true;
            $_SESSION['email'] = ""; 
            $_SESSION['username'] = "admin";
            header("Location: ../admin/admin.php");
            exit();
        } else {
            $errorMessage = "Password is not correct";
        }
    } else {
       
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
  
if ($user->membership === 'Premium Monthly') {
  
  $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));
 
  if (strtotime($user->subscriptionDate) <= strtotime($thirtyDaysAgo)) {
     
      $updateSql = "UPDATE account SET membership = 'Basic' WHERE email = ?";
      $updateStmt = mysqli_prepare($conn, $updateSql);
      mysqli_stmt_bind_param($updateStmt, "s", $user->email);
      mysqli_stmt_execute($updateStmt);
  }
}

if ($user->membership === 'Premium Annually') {

$threeHundredSixtyFiveDaysAgo = date('Y-m-d', strtotime('-365 days'));

if (strtotime($user->subscriptionDate) <= strtotime($threeHundredSixtyFiveDaysAgo)) {
    
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