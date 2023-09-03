<!DOCTYPE html>
<?php
require_once("../session/session.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order is Complete</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* This ensures that the content is centered vertically on the viewport. */
        }

        .container {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 550px;
            height:100%;
            padding: 20px;
            border-radius:20px;
        }

        .subcontainer {
            margin: 20px;
            width: 450px;
        }

        #white {
            color: white;
        }

        img {
            height: 100px;
        }

        button {
            background-color: #00A37C;
            width: 170px;
            height: 50px;
            border-radius: 10px;
            border:none;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <center>
        <div class="subcontainer" >
            <img src="../image/logo.png" alt="market logo">
            <h3>Your order is complete!</h3>
            <p style="color: #8F8F8F">You will be receiving a confirmation email from us with the complete order detail.</p>
            <button onclick="backtohome()"><h3>Back to Home</h3></button>
        </div>
        </center>
    </div>
</body>
<script>
    function backtohome(){
        window.location.href = '../home/index.php';
    }
</script>
</html>
