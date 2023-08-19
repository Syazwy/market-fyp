<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pop-up Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="login-register.css">
    <style>
    

    </style>
     <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get a reference to the form and the "Create" button
        const form = document.querySelector("form");
        const createButton = document.querySelector("input[type='submit']");
        const verifyButton = document.querySelector("#verifyButton"); // Add an ID to your verification button

        // Add a click event listener to the "Create" button
        createButton.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent form submission

            // Assuming email verification is successful, show the verify button
            verifyButton.style.display = "block";
        });

        // Add a click event listener to the verification button
        verifyButton.addEventListener("click", function() {
            // Display an alert indicating that the email address has been verified
            alert("Email address has been verified!");
        });
    });
    </script>

</head>
<body>
<center>
    <div class="popup-content">

        <span id="closeForm" class="close">&times;</span>
        <h3>Create Account</h3>

        <br>
        <form action="#" style="border: 1px solid black;border-radius: 10px;padding: 15px;">


            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="firstName" placeholder="First Name" required>
                <label for="firstName">First Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastName" placeholder="Last Name" required>
                <label for="lastName">Last Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <br>

            <div class="form-floating">
                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                <label for="confirm_password">Confirm Password</label>
            </div>

            <br>

            <input type="submit" onclick="verification()" value="Create" style="background-color: rgb(255, 83, 83);width: 100%;border-radius: 10px; padding: 5px;">
                  
        </form>
            <br>
    </div>
</center>
<script>
        function verification(){
            window.location.href = "verification.php";
        }
    </script>
</body>
</html>



