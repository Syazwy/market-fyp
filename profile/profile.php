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
    <a class="navbar-brand" href="../home/index.php">
      <img src="../image/logo.png" width="80" height="80">
    </a>

    <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Wishlist</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
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

                    <div class="col">
                        <div class="card h-100" style="background-color: #FFFFFF;">

                            <a><img src ="../sellers/upload/<?php echo $row['image_filename'];?>" class="card-img-top" width="150px" height="150px"></a>
                                <div class="card-body">
                                    <p class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></p>
                                    <h5 class="card-title"><b>$<?php echo $row["price"]; ?></b></h5>
                                    <p class="card-text" style="text-transform: capitalize"><small class="text-body-secondary"><?php echo $row["item_condition"]; ?></small></p>
                                </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
            </div>
        </div>
    
        </div>

</body>
</html>
