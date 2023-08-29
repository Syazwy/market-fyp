<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-register.css">
    <link rel="stylesheet" href="../home/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Log in</title>
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
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Sell</a></li>
    </ul>
    </div>
  </div>
</nav>
    <div class="search">
        <input class="searchbar" type="text" placeholder="Search for anything and everything" style="padding-left: 20px;">
        <button type="button" class="btn btn-primary">Search</button>
    </div>
   
    <div>
      <h4>What would you like to find?</h4>
    </div>
    
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/property.png" alt="">
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/vehicle.png" alt="">
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/furniture.png" alt="">
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/electronic.png" alt="">
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a href="">
            <img class="image" src="../image/fashion.png" alt="">
          </a>
        </div>
      </div>
    </div>
   
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <div class="card" style="width: 18rem;">
            <img src="../image/iphone.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Iphone 12</h5>
              <p class="card-text">Price: $1000</p>
              <a href="#" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card" style="width: 18rem;">
            <img src="../image/iphone.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Iphone 12</h5>
              <p class="card-text">Price: $1000</p>
              <a href="#" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card" style="width: 18rem;">
            <img src="../image/iphone.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Iphone 12</h5>
              <p class="card-text">Price: $1000</p>
              <a href="#" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
      </div>
  
<center>
<div class="popup-overlay" >
    <div class="popup-content" style="padding:40px; height:480px">
    <a href="../home/index-guest.php" class="d-grid gap-2 d-md-flex justify-content-md-end" style="color: inherit; 
  text-decoration: none;"><h2>x</h2></a>
        <h3>Login</h3>
        <br>
        <div style="">
        <form method="POST">
    <div class="form-floating mb-3" >
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required >
        <label for="email">Email</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
    </div>
    </div>
    <br><p ><a href="forgot-password.php" id="" style="color: rgb(255, 83, 83);"> Forgot password? </a></p>
    <input type="submit" name="login" value="Log In" style="background-color: rgb(255, 83, 83);width: 100%;border-radius: 10px; padding: 10px;">
            </form>
            <br>
        </div>
    </div>
</div>
</center>
</body>
<?php
     
     if (isset($_POST["login"]))
     {
         $email = $_POST["email"];
         $password = $_POST["password"];
  
         // connect with database
         $conn = mysqli_connect("localhost", "root", "", "market");
  
         // check if credentials are okay, and email is verified
         $sql = "SELECT * FROM account WHERE email = '" . $email . "'";
         $result = mysqli_query($conn, $sql);
  
         if (mysqli_num_rows($result) == 0)
         {
             die("Email not found.");
         }
  
         $user = mysqli_fetch_object($result);

          
    if (!password_verify($password, $user->password)) {
        die("Password is not correct");
    }
  
         if (!password_verify($password, $user->password))
         {
             die("Password is not correct");
         }
  
         if ($user->email_verified_at == null)
         {
             die("Please verify your email <a href='emailverification.php?email=" . $email . "'>from here</a>");
         }
  
         header("Location:../home/index.php"); 
            exit();
     }
 ?>
</html>