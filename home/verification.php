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