<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="productinfo.css">
    <link rel="stylesheet" href="../home/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
     .checked {
    color: orange;
  }
  </style>
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

      <main>

      

        
    
        <h1>Market</h1>

        <?php
         require '../connection/connection.php';

        // Check if the 'id' query parameter is set in the URL
        if (isset($_GET['id'])) {
            $itemId = $_GET['id'];
            
            // Fetch the specific product based on the 'id' parameter
            $query = "SELECT itemslisting.*, item_images.image_filename 
                      FROM itemslisting 
                      JOIN item_images ON itemslisting.id = item_images.item_id 
                      WHERE itemslisting.id = $itemId"; // Make sure to sanitize and validate the input
            $result = mysqli_query($conn, $query);
            
            // Check if a product with the specified 'id' exists
            if ($row = mysqli_fetch_assoc($result)) {
          
          
          
      ?>

    
        <section id="home">
          <h1><?php echo $row["name"]; ?></h1>
        </section>

        <div class="product-container">
            


              <div id="carouselExampleIndicators" class="carousel slide w-100" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" width= 500px>
                  </div>
                  <div class="carousel-item">
                  <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" width= 500px>
                  </div>
                  <div class="carousel-item">
                  <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" width= 500px>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="">Next</span>
                </button>




              </div>

          </div>

          <br>

        <div id="secondhalf">
          <div class="product-info description">
              <h1 class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></h1>
              <br>
              <h1>Price:</h1>
              <p class="price">$<?php echo $row["price"]; ?></p>
              <p><b><?php echo $row["category"]; ?></b></p>
              <p><h2>Description:</h2></p>
              <p><?php echo $row["description"]; ?></p>
              <br>
              <h2>Price:</h2>
              <p class="price">$<?php echo $row["price"]; ?></p>
              <br>
              <button type="button" class="buy-button">Buy Now</button>
              <button type="button" class="chat-button">Chat Now</button>
              <a href="../admin/report.php?id=<?php echo $row["id"]; ?>"><button type="button" class="chat-button">Report</button></a>
            </div>

            <div class="proInfo">
    <img width="50px" src="images/pb.png">
    <?php 
        $conn = new mysqli('localhost', 'root', '', 'market');
        $username = $row["username"];
        
        if ($conn->connect_error) {
            die('Connection Failed : '.$conn->connect_error);
        }
        
        $reviewResult = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews WHERE users = '$username'");
        
        if ($reviewResult->num_rows > 0) {
            $reviewRow = $reviewResult->fetch_assoc();
            $averageRating = $reviewRow['avg_rating'];
            $totalReviews = $reviewRow['total_reviews'];

            // Function to generate star rating based on the average rating
            function generateStarRating($rating) {
                $output = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= ceil($rating)) { // Use ceil to round up decimal ratings
                        $output .= '<i class="fa fa-star checked"></i>';
                    } else {
                        $output .= '<i class="fa fa-star"></i>';
                    }
                }
                return $output;
            }
            
            echo generateStarRating($averageRating) . ' (' . $totalReviews . ' reviews)';
        } else {
            echo '- No reviews available.';
        }

        $conn->close();
    ?> 
    <p><?php echo $row["username"]; ?></p>
    <br>
    <p><?php echo $row["location"]; ?></p>
      
    <!-- <a type="button" class="btn btn-primary"><img src="../image/chat.png"></img></a> -->
    <button type="button" class="btn btn-primary">Chat</button>
    <button type="button" class="btn btn-primary" onclick="buy()">Buy</button>
</div>


          <br>

      <?php

            } else {
                // Handle the case where the specified product doesn't exist
                echo "Product not found.";
            }
        } else {
            // Handle the case where the 'id' parameter is not set
            echo "Product ID not specified.";
        }
      ?>



      </main>
      
      <script>
        function buy(id) {
    // Redirect to buyMembership.php with the selected plan as a URL parameter
    window.location.href = '../order/orderItem.php?id=' + <?php echo $row["id"]; ?>
}
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>