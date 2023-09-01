<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profilecss.css">
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

    <div class="profile-container">
        <div class="profile-picture">
            <img src="profileimage/wajdi.jpg" alt="Profile Picture">
        </div>
       
        
    </div>

    <br>

    <div class="box">
        <div class="box1">
            <div class="user-info">
                <div class="user-name">John Doe</div>
                <div class="user-bio">Web Developer | Designer</div>
            </div>
        </div>


        <div class="box2">
            <div class="contact-info">
                <a href="mailto:johndoe@example.com">Listings</a>
                <a href="https://twitter.com/johndoe" target="_blank">Reviews</a>
                <a href="https://linkedin.com/in/johndoe" target="_blank">Wishlist</a>
            </div>
        </div>
    </div>

</body>
</html>
