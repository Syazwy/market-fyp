<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

body {
            font-family: Arial, sans-serif; 
        }
        .container{
            border: 1px solid black;
            width: 600px;
            border-radius: 10px;
            position: relative;
            justify-content: center;
            align-items: center;
            display:flex;
            text-align: center;
        }

        .subcontainer{
            border: 1px solid black;
            width: 500px;
            margin: 50px;
            border-radius: 10px;
        }
        button{
            background-color:#FF5353;
            border-radius:10px;
            height: 50px;
            width:300px
        }
    </style>
</head>
<body>
    <center>
    <div class="container">
        <div class="subcontainer">
            <br>
            <img src="../icons/email.png" alt="" style="height:30px">
            <h3>Verify your email address</h3>
            <p>_________________________________________</p> 
            <center>
            <h4 style="color:#5C5C5C; width:350px">In order to register your account, you need to confirm your email address.</h4>
            </center>
            <br>
            <button onclick="email()"><h3>Verify Email Address</h3></button>
            <br>
            <p>__________________________________________</p>
            
            <h4 style="color:#5C5C5C">If you did not receive any mail,</h4> 
                <h4 style="color:#FF5353">resend confirmation mail</h4>
            
        </div>
    </div>
    </center>

    <script>
        function email(){
            window.location.href = "email.php";
        }
    </script>
</body>
</html>