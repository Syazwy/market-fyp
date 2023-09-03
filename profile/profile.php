<?php
require 'connection.php';




?>

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

  
        




        <div class="container">
           

            <div class="row row-cols-1 row-cols-md-3 g-4">
                
            <?php
                    require '../sellers/connection.php';
                    $i = 1;
                    $query = "SELECT itemslisting.*, item_images.image_filename 
                            FROM itemslisting 
                            JOIN item_images ON itemslisting.id = item_images.item_id 
                            GROUP BY itemslisting.id 
                            ORDER BY itemslisting.id DESC";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) :
                    ?>

                    <div class="col d-flex align-items-center justify-content-center">
                        <div class="card item h-100" style="background-color: #FFFFFF;">
                        <a><img src ="../sellers/img/upload/<?php echo $productRow['image'];?>" class="card-img-top" width="150px" height="150px"></a>
                            <div class="card-body">

                                
                                
                                <p class="card-title" style="text-transform: capitalize"><?php echo $productRow["name"]; ?></p>
                                
                                <h5 class="card-title"><b>$<?php echo $productRow["price"]; ?></b></h5>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>

                            </div>
            
                        </div>


                </div>
            </div>
            <?php endwhile; ?>
    </div>


</body>
</html>
