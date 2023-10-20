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
