<?php
if (isset($_POST["verify_email"])) {
  $email = $_POST["email"];
  $verification_code = $_POST["verification_code"];

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