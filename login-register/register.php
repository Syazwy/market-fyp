<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-register.css">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <center>
        <div class="popup-content">
            <span id="closeForm" class="close">&times;</span>
            <h3>Create Account</h3>
            <br>
            <form action="register.php" method="post" onsubmit="return validateForm();" style="border: 1px solid black; border-radius: 5px; padding: 15px;">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    <label for="name"> Name</label>
                </div>
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
                <button type="submit" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 5px;">Create</button>
            </form>
            <br>
        </div>
    </center>
    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var email = document.getElementById("email").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (name === "" || username === "" || password === "" || email === "" || confirmPassword === "") {
                alert("All fields are required");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }

            return true;
        }
    </script>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    $conn = new mysqli('localhost', 'root', '', 'market');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    $currentDateTime = new DateTime();
    $date = $currentDateTime->format('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO account(name, username, email, password, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $username, $email, $password, $date);
    

    if ($stmt->execute()) {
        
        header("Location: verification.php"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
    
</body>
</html>
