<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-register.css">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>
<body>
<center>
    <div class="popup-content">
        <h3>Login</h3>
        <br>
        <div style="border: 1px solid black; border-radius: 5px; padding: 15px;">
        <form action="login.php" method="post" onsubmit="return validateForm();">
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
        <label for="email">Email</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
    </div>
    </div>
    <br><p ><a href="#" id="" style="color: rgb(255, 83, 83);"> Forgot password? </a></p>
    <input type="submit" value="Log In" style="background-color: rgb(255, 83, 83);width: 100%;border-radius: 10px; padding: 5px;">
            </form>
            <br>
        </div>
    </div>
</center>
<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var email = document.getElementById("email").value;
        if (password === "" || email === "") {
            alert("All fields are required");
            return false;
        }
    }
</script>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email1 = $_POST['email'];
    $password1 = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'market');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT id, email, password, email FROM account");
        $stmt->execute();

        $num = 0;
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $email = $row['email'];
            $password = $row['password'];

            $string1 = $email . $password;
            $string2 = $email1 . $password1;

            if ($string1 == $string2) {
                $num = $num + 1;
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                break;
            }
        }

        if ($num === 1) {
            header("Location:index.html"); 
            exit();
        } else {
            echo "<br><center> <h3>Incorrect email or password</h3></center>";
            exit();
        }

        $stmt->close();
        $conn->close();
    }
}
?>



</body>
</html>

</body>
</html>


