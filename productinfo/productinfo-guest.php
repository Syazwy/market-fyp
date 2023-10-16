<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link rel="stylesheet" href="../home/index.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
<style>
   body {
    font-family: Arial, sans-serif;
  }
  
  div {
    margin: 10px;
  }
  
  .rating {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
    font-size: 20px; /* Adjust the font size as needed */
  }
  
  .rating .fa {
    margin: 0 5px; /* Adjust the spacing between stars */
  }

  label {
    margin-right: 5px;
  }
  
  select {
    padding: 5px;
  }
  
  #products-list {
    display: flex;
    flex-wrap: wrap;
  }
  
  .product {
    width: 200px;
    border: 1px solid #ddd;
    padding: 10px;
    margin: 5px;
  }
  
  ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }
  

  nav {
    background-color: #ffffff;
  }
  

  nav li {
    display: inline-block;
    margin: 0 10px;
  }
  
  nav li a {
    display: block;
    color: #000000;
    text-decoration: none;
    padding: 10px;
  }
  
  nav li a:hover {
    background-color: #ffb9b9;
  }

  .product-container {
    background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        margin: auto;
        text-align: center;
        width: 1200px;
        background-color: #e4e4e4;
  }
  
  .product-info {
    flex: 1;
    padding: 0 20px;
    align-items: center;
    padding: 20px;
   width: 100px;
  }
  
  .product-info h1 {
    font-size: 24px;
    margin: 0;
  }
  
  .product-info p {
    margin: 10px 0;
  }
  
  .price {
    font-weight: bold;
  }

  #itemImages {
    width: 400px;
  }

 .user{
  width:400px;
 }

  #secondhalf{
    
    display: flex;

  }

</style>

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
      <li class="nav-item"><a class="nav-link active" aria-current="page" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button" aria-controls="offcanvasRight">Categories</a></li>
      <li class="nav-item"><button id="registerModalTriggerButton" class="nav-link active" aria-current="page" data-toggle="modal" data-target="#registerModal" data-whatever="register">Register</button></li>
      <li class="nav-item"><button class="nav-link active" aria-current="page"  data-toggle="modal" data-target="#loginModal" data-whatever="login">Login</button></li>
     
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#sellModal">Sell</a>
</li>
   </ul>
    </div>
  </div>
</nav>

      <main>
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
<div class="container1">
        <div class="product-container">
              <div id="carouselExampleIndicators" class="carousel slide w-100" data-bs-ride="carousel" >
                <div class="carousel-indicators" >
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" >
                  </div>
                  <div class="carousel-item">
                  <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" >
                  </div>
                  <div class="carousel-item">
                  <img src ="../sellers/Upload/<?php echo $row['image_filename'];?>" >
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
          </div>

        <div id="secondhalf">
          <div class="product-info description">
              <h3>Item Name:</h3>
              <h6 style="text-transform: capitalize"><?php echo $row["name"]; ?></h6>
              <h3>Price:</h3>
              <h6>$<?php echo $row["price"]; ?></h6>
              <h3>Category:</h3>
              <h6><?php echo $row["category"]; ?></h6>
              <h3>Description:</h3>
              <h6><?php echo $row["description"]; ?></h6>
              <br>

              <br>
              <!-- <button type="button" class="buy-button">Buy Now</button>
              <button type="button" class="chat-button">Chat Now</button>
              <a href="../admin/report.php?id=<?php echo $row["id"]; ?>"><button type="button" class="chat-button">Report</button></a> -->
            </div>
     <!-- untuk kan ke page usersprofile -->
     <?php 
  
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

        // Determine the href value based on email comparison        
        echo '<div class="user">';
        echo '<img width="50px" src="../image/profile.png">';
        echo generateStarRating($averageRating) . ' (' . $totalReviews . ' reviews)';
        echo '<p>' . $row["username"] . '</p>';
        echo '<p>' . $row["location"] . '</p>';
        
    } else {
        echo '- No reviews available.';
    }
    
    echo '</div>';

?>

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
