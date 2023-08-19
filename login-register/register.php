<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pop-up Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    
    .popup {
        display: none;
        position: fixed;

        top: 0;
        left: 0;
        width: 500px;
        height: 500px;
        /* background-color: rgba(0, 0, 0, 0.5); */
        justify-content: center;
        align-items: center;
       
    }

    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        position: relative;
        text-align: center;
        max-width: 30%;
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

    </style>

</head>
<body>
<center>
    <div class="popup-content">

        <span id="closeForm" class="close">&times;</span>
        <h3>Create Account</h3>

        <br>
        <form action="#" style="border: 1px solid black;border-radius: 5px;padding: 15px;">


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
                <label for="floatingInput">Email </label>
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

            <button type="submit" onclick="verify()" style="background-color: rgb(255, 83, 83);width: 100%;border-radius: 10px; padding: 5px;">Create</button>         
        </form>
        <br>
    </div>
</center>
<script>
    function verify(){
        window.location="verification.php";
    }



</script>
</body>
</html>


