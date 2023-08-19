<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pop-up Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
            /* Styles for the overlay */
    .popup {
        display: none;
        position: fixed;
        /* top: 30%;
        left: 40%;
        width: 500px;
        height: 500px; */
        top: 0;
        left: 0;
        width: 500px;
        height: 500px;
        /* background-color: rgba(0, 0, 0, 0.5); */
        justify-content: center;
        align-items: center;
       
    }

    /* Styles for the pop-up content */
    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        position: relative;
        text-align: center;
        max-width: 80%;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }
    .label{
        text-align: left ;
    }
    /* Other styling for form fields can be added here */
    </style>

</head>
<body>
<center>

<!-- REGISTERATION FORM -->


    <div class="popup-content">

        <span id="closeLogin" class="close">&times;</span>
        <h3>Login Form</h3>

        <br>
        <form action="#">

<div class="form-floating mb-3">
    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
    <label for="floatingInput">Email address</label>
</div>

<div class="form-floating">
    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
    <label for="floatingPassword">Password</label>
    <br><p ><a href="#" id="" style="color: rgb(255, 83, 83);"> Forgot password? </a></p>
</div>

<input type="submit" value="Log In" style="background-color: rgb(255, 83, 83);width: 100%;border-radius: 10px; padding: 5px;">
</form>

<br>
    </div>


</center>
</body>
</html>

<!-- <script>
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const firstName = document.getElementById("firstName").value;
    const lastName = document.getElementById("lastName").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    const registrationData = {
        firstName: firstName,
        lastName: lastName,
        email: email,
        password: password
    };

    // Send registration data to backend (make an API call)
    fetch('/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(registrationData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Registration successful! Please check your email for verification.');
        } else {
            alert('Registration failed. Please try again.');
        }
    });
});

</script> -->

<!-- <script>
    const registrationForm = document.getElementById("registrationForm");
    const loginForm = document.getElementById("loginForm");

    document.getElementById("openForm").addEventListener("click", function() {
        registrationForm.style.display = "block";
    });

    document.getElementById("closeForm").addEventListener("click", function() {
        registrationForm.style.display = "none";
    });

    document.getElementById("switchToLogin").addEventListener("click", function() {
        registrationForm.style.display = "none";
        loginForm.style.display = "block";
    });

    document.getElementById("closeLogin").addEventListener("click", function() {
        loginForm.style.display = "none";
    });

    document.getElementById("switchToRegistration").addEventListener("click", function() {
        loginForm.style.display = "none";
        registrationForm.style.display = "block";
    });

    
// email verification
// const express = require('express');
// const app = express();
// const bodyParser = require('body-parser');
// const nodemailer = require('nodemailer');
// const crypto = require('crypto'); // For generating verification tokens

// app.use(bodyParser.json());-

// // Mock database for simplicity
// const users = [];

// // Generate a random token
// function generateVerificationToken() {
//     return crypto.randomBytes(32).toString('hex');
// }

// // Send verification email
// function sendVerificationEmail(email, token) {
//     // Configure email sending service (e.g., nodemailer)
//     const transporter = nodemailer.createTransport({
//         service: 'your-email-service',
//         auth: {
//             user: 'your-email@example.com',
//             pass: 'your-email-password'
//         }
//     });

//     const verificationLink = `https://your-app.com/verify?token=${token}`;

//     // Send email
//     const mailOptions = {
//         from: '21ftt1753@student.pb.edu.bn',
//         to: email,
//         subject: 'Email Verification',
//         html: `Click <a href="${verificationLink}">here</a> to verify your email.`
//     };

//     transporter.sendMail(mailOptions, (error, info) => {
//         if (error) {
//             console.error(error);
//         } else {
//             console.log('Email sent: ' + info.response);
//         }
//     });
// }

// app.post('/register', (req, res) => {
//     const { username, email, password } = req.body;
//     const verificationToken = generateVerificationToken();

//     const newUser = {
//         username: username,
//         email: email,
//         password: password,
//         isVerified: false, // Initial status
//         verificationToken: verificationToken
//     };

//     users.push(newUser);

//     // Send verification email
//     sendVerificationEmail(email, verificationToken);

//     res.json({ success: true });
// });

// app.listen(3000, () => {
//     console.log('Server is running on port 3000');
// });

</script> -->


</body>
</html>


