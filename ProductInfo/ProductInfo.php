<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="productinfo.css">
    <link rel="stylesheet" href="../home/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
     .checked {
    color: orange;
  }

  .carousel-inner {
    background: transparent; /* Make the carousel background clear */
  }

  .product-container {
    background-color: white;
  }

  .product-info.description {
    background: transparent; /* Make the description box background clear */
  }

  .product-info.description {
  background-color: white;
  border: 1px solid #ddd;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  margin-top: 20px;
  margin-left: 50px;
}

.product-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.btn.btn-primary {
  background-color: #FF5353;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.price {
  font-size: 18px;
  font-weight: bold;
  margin: 10px 0;
}

h2 {
  font-size: 16px;
  margin: 10px 0;
}


.proInfo .btn {
  height: 65px; 
  width: 120px; 
  margin: 10px;
  font-size: 20px;
  border-radius: 10px;
}


.report-button {
  height: 40px; 
  width: 270px; 
  border-radius: 10px;
  padding-bottom: 40px;
  background-color: #FF5353;
  font-size: 25px;
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
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
      </ul>
    </div>

    <div class="dropdown">
      <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
        <img src="../image/profile.png" width="50" height="50" class="profile">
      </a>

      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../profile/myProfile.php">My Profile</a></li>
        <li><a class="dropdown-item" href="#">Your Listings</a></li>
        <li><a class="dropdown-item" href="../myPurchases/myPurchases.php">My Purchases</a></li>
        <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
        <li><a class="dropdown-item" href="index-guest.php">Log out</a></li>
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
                <img src="img/prev.svg" alt="" style="color: black;height:60px;width:60px;">
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <img src="img/next.svg" alt="" style="color: black;height:60px;width:60px;">
                </button>
              </div>
          </div>

          <br>

        <div id="secondhalf">
          <div class="product-info description">
          <div class="product-header">
            <h1 class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></h1>
            <button type="button" class="btn btn-primary" onclick="addToWishlist(<?php echo $row['id']; ?>)">Add to Wishlist</button>
          </div>
          <div>
          <h1>BND $<?php echo $row["price"]; ?></h1>
          <br>
          <h2>Category:</h2><h1><?php echo $row["category"]; ?></h1>
          <br>
          <h2>Description:</h2>
          <h1><?php echo $row["description"]; ?></h1>
          </div>
            </div>


<div class="proInfo">
<div class="proInfo-header">
    <img width="50px" src="images/pb.png">
    <?php 
        // Assuming you have a session variable $_SESSION['email']
        $sessionEmail = $_SESSION['email'];
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

        // Store the session email in a JavaScript variable
        echo "<script>var sessionEmail = '$sessionEmail';</script>";
    ?> 
    <p><?php echo $row["username"]; ?></p>
    <br>
  </div>

  <center>
    <p style="font-size:22px;"> <img src="img/location-outline.svg" style="height: 60px;width:60px" alt=""> <?php echo $row["location"]; ?></p>
  </center>

    <br>

    <!-- Use JavaScript to conditionally display the buttons -->
    <?php if ($sessionEmail === $row["email"]) { ?>
        <a href="../profile/profile_edit_item.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary">Edit</a>
    <?php } else { ?>
      <center>
        <button type="button" class="btn btn-primary" id="chatButton" onclick="chat()" > <b>Chat</b> </button>
        <button type="button" class="btn btn-primary" id="buyButton" onclick="buy()"> <b>Buy</b> </button>
      </center>
        <br>
    <?php } ?>

    <center><button type="button" class=" btn-danger report-button" onclick="report()"><b>REPORT !</b></button></center>
</div>


<script>
    // Check if the session email is the same as the email retrieved from the database
    if (sessionEmail === '<?php echo $row["email"]; ?>') {
        document.getElementById('chatButton').style.display = 'none';
        document.getElementById('buyButton').style.display = 'none';
    }
    
    function buy() {
        // Redirect to buyMembership.php with the selected plan as a URL parameter
        window.location.href = '../order/orderItem.php?id=<?php echo $row["id"]; ?>';
    }
    function chat() {
      var username = "<?php echo $row['username']; ?>";
var id = "<?php echo $row['id']; ?>";
var description = "<?php echo $row['description']; ?>";
var name = "<?php echo $row['name']; ?>";
var price = "<?php echo $row['price']; ?>";

var url = '../privatemessage/pm.php?' +
    'username=' + encodeURIComponent(username) +
    '&id=' + encodeURIComponent(id) +
    '&description=' + encodeURIComponent(description) +
    '&name=' + encodeURIComponent(name) +
    '&price=' + encodeURIComponent(price);

window.location.href = url;

    }

    function report(){
      window.location.href = '../profilereport/profilereport.php?id=<?php echo $row["id"]; ?>';
    }
</script>




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