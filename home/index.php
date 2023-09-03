<?php
  require_once("../session/session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Market</title>
  <link rel="stylesheet" href="index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="../image/logo.png" width="80" height="80">
    </a>
  
  <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Wishlist</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
    </ul>
  </div>

  <div class="dropdown">
    <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
      <img src="../image/profile.png" width="50" height="50" class="profile">
    </a>

    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="../profile/profile.php">My Profile</a></li>
      <li><a class="dropdown-item" href="#">Your Listings</a></li>
      <li><a class="dropdown-item" href="#">My Purchases</a></li>
      <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
      <li><a class="dropdown-item" href="index-guest.php">Log out</a></li>
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

    <center>
  <div class="container">
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
  </div>
  </center>

    <div>
      <h4>Newly Listed</h4>
    </div>

  <div class="container">
    <div class="row row-cols-1 row-cols-md-5 g-4">
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
        <div class="card item">
          <div class="card-header bg-transparent border border-0" style="background-color: #FFFFFF !important;">
            <h6 class="card-title">
              <a class="navbar-brand" href="index.php">
            <img src="../image/logo.png" width="20" height="20">
          </a style="text-transform: capitalize">
          <?php echo $row["username"]; ?>
            </h6>
          </div>
          <a href="">
            <img src="../sellers/upload/<?php echo $row['image_filename']; ?>" class="card-img-top" width="150px" height="150px">
          </a>
          <div class="card-body h-100">
            <p class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></p>
            <h5 class="card-title"><b><?php echo "BND$".$row["price"]; ?></b></h5>
            <p class="card-text" style="text-transform: capitalize"><small class="text-body-secondary"><?php echo $row["item_condition"]; ?></small></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
      </div>
    </div>
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>