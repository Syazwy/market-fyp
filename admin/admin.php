
<?php
require_once("../session/session.php");
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="admincss.css">
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
            <img src="image/admin.png" alt="Profile Picture">
        </div>
        <div class="admin">
        <h1>Admin</h1>
        </div>
</div>

    <br>


          
    <div class="container">

    <div class="justify-content-center">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="admin.php">Overview</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="admin_2.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Appeals</a></li>
        </ul>
    </div>

    <br>

    <div class="row row-cols-1 row-cols-md-1 g-4">


      <div  class="col border1">
      
                <table  cellspacing = 0 cellpadding = 10>

                    <tr>
                        <td><h1>Overview</h1></td>
                    </tr>

                    <tr>
                        <td>#</td>
                        <td>Username</td>
                        <td>Email</td>                      
                        <td>Membership</td>
                        <td>Date Joined</td>
                        <td>Date Verified</td>
                        
                    </tr>

                  <?php
                      $i = 1;
                      $rows = mysqli_query($conn, "SELECT * from `account` ORDER BY Id DESC");
                  ?>

                  <?php
                    foreach($rows as $row) :
                  ?>

                      <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $row["username"]; ?></td>
                          <td><?php echo $row["email"]; ?></td>                        
                          <td><?php echo $row["membership"]; ?></td>
                          <td><?php echo $row["date"]; ?></td>
                          <td><?php echo $row["email_verified_at"]; ?></td>
                          
                          
                          <td><a href="view_1.php?id=<?php echo $row["id"]; ?>" class="btn btn-success">View</td>
                          <td><a href="Edit_2.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary">Edit</td>
                          <td><a href="remove_2.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</td>
                      </tr>

                  <?php endforeach; ?>

                </table>
        
      
      </div>
    </div>
    </div>


        

    

  
        






</body>
</html>