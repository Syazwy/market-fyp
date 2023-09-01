<?php
session_start(); // Start the session at the beginning of your script

$errorMessage = ""; // Initialize an empty error message

if (isset($_POST["login"])) {
    $emailOrUsername = $_POST["emailOrUsername"]; // Modified to handle email or username
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
            header("Location: emailverification.php?email=" . urlencode($user->email));
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
        <?php if (!empty($errorMessage)) : ?>
            <script>
                alert("<?php echo $errorMessage; ?>");
            </script>
        <?php endif; ?>
