<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order is complete</title>
    <style>
        .container{
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width:550px;
            margin:20px;
            padding:20px;
        }
        .subcontainer{
            margin: 20px;
            width:450px;
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0; 
        }
        #white{
            color:white;
        }
        
    </style>
</head>
<body>
    <center>
    <div class="container" >
    <div class="subcontainer">
        <img src="../image/logo.png" alt="market logo" style="height:100px">
        <h3>Your order is complete!</h3>
        <p style="color: #8F8F8F">You will be receiving aconfirmation email from us with the complete order detail.</p>
       
        <button onclick="backtohome()" style="background-color: #00A37C;width: 170px;height:50px;border-radius: 10px; "><h3 id="white">Back to Home</h3></button>
    </div>
    </div>
    </center>
<script>


    function backtohome(){

window.location.href =  "../home/index.html";
}
</script>
<?php
        $email = $_GET['data'];
      
        
        $conn = new mysqli('localhost', 'root', '', 'market');

        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        }

        function updateMembership($email) {
            global $conn;
            $sql = "UPDATE account SET membership = 'basic' WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $email);
            if ($stmt->execute()) {
               
            } else {
                echo "Error updating membership: " . $stmt->error;
            }
            $stmt->close();
        }

        updateMembership($email);

        $conn->close();
    

        
?>

 
</body>
</html>