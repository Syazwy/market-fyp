<?php
require_once("../session/session.php");
require '../connection/connection.php';
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
            <img src="image/Tommy.jpeg" alt="Profile Picture">
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

        
          
    <div class="container">
      <div class="row row-cols-1 row-cols-md-5 g-4">
      

        <div class="col d-flex align-items-center justify-content-center">
          <div class="card item h-100" style="background-color: #FFFFFF;">
         
                <table border = 1 cellspacing = 0 cellpadding = 10>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Status</td>
                        <td>Item</td>
                        <td>Report</td>
                        <td>Remarks</td>
                    </tr>

                  <?php
                      $i = 1;
                      $rows = mysqli_query($conn, "SELECT * from `report` ORDER BY Id DESC");
                  ?>

                  <?php
                    foreach($rows as $row) :
                  ?>

                      <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $row["name"]; ?></td>
                          <td><?php echo $row["status"]; ?></td>
                          <td><?php echo $row["item"]; ?></td>
                          <td><?php echo $row["report"]; ?></td>
                          <td><?php echo $row["remarks"]; ?></td>
                          
                          <td><a href="edit_page_1.php?id=<?php echo $row["id"]; ?>" class="btn btn-success">Ban</td> 
                          <td><a href="remove_page_1.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Unban</td>
                      </tr>

                  <?php endforeach; ?>

                </table>

          </div>
        </div>
      
      </div>
    </div>


        

    </div>

  
        






</body>
</html>