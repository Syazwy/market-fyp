
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

    <div class="collapse navbar-collapse">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../home/index-guest.php" id="logout-link">Logout</a></li>
    </ul>
    </div>
  </div>
</nav>

<script>
  document.getElementById('logout-link').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the link from immediately navigating

    // Display a confirmation dialog
    const confirmLogout = confirm("Are you sure you want to log out?");

    // If the user confirms, navigate to the logout page
    if (confirmLogout) {
      window.location.href = event.target.href;
    }
  });
</script>

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
                        <td><h1>Appeals</h1></td>
                    </tr>

                    <tr>
                        <td>#</td>
                        
                        <td>Username</td> 
                        <td>Date of appeal</td>
                        <td>Appeal Letter</td>                   
                       
                        
                    </tr>

                  <?php
                      $i = 1;
                      $rows = mysqli_query($conn, "SELECT * from `appeals` ORDER BY Id DESC");
                  ?>

                  <?php
                    foreach($rows as $row) :
                  ?>

                      <tr>
                          <td><?php echo $i++; ?></td>
                          
                          <td><?php echo $row["username"]; ?></td>
                          <td><?php echo $row["appeal"]; ?></td>                          
                          
                          
                          
                          
                          <td><a href="appealview2.php?id=<?php echo $row["id"]; ?>" class="btn btn-success">View</td>
                          
                          <td><a href="unban_1.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Unban</td>
                      </tr>

                  <?php endforeach; ?>

                </table>
        
      
      </div>
    </div>
    </div>


        

    

  
        






</body>
</html>