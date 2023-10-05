<?php 
require_once("../session/session.php");
require 'connection.php';
?>

<?php
if(isset($_POST["submit"])){
    // Get form data and sanitize
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $appeal = mysqli_real_escape_string($conn, $_POST["appeal"]);
    
    
    

    // Insert item data into database
    $query = "INSERT INTO `appeals` (username, appeal ) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $username, $appeal);
    mysqli_stmt_execute($stmt);
    $itemId = mysqli_insert_id($conn); // Get the last inserted item ID
    mysqli_stmt_close($stmt);

    


    // Redirect to data.php
    header("Location: ../home/index.php");
    exit(); // Make sure to exit after sending the header
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reportcss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../image/logo.png" width="80" height="80">
    </a>

    <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../login-register/register.php">Register</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../login-register/login.php">Login</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Sell</a></li>
  
    </ul>
    </div>
  </div>
</nav>

    
    <div class="container">
        <div class="box1">

        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="input-images">
                        <center>
                            <h2>Appeal</h2>
                            <div class="profile-picture">
                                <img src="image/Tommy.jpeg" alt="Profile Picture">
                            </div>
                            <h2>Username</h2>
                        </center>
                    </div>
                    <div class="input-field">
                        <div class="input-images-2" style="padding-top: .5rem; padding-bottom: .5rem;"></div>
                    </div>
                    <!-- Uploaded images will be displayed here -->
                </div>
                <br>
                <div class="subcontainer">
                   


                    
                    <div class="mb-3">
                        
                        <input type="text" name="username" id="username" value="Barzun" hidden>


                        
                        
                        <label for="report" class="form-label">Appeal</label>
                        <textarea class="form-control" name="appeal" id="report" rows="3"></textarea>
                    </div>
                    
                    <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;">Submit</button>
                </div>
            </form>


        </div>
    </div>
    

</body>
</html>