<?php
  require_once("../session/session.php");
  $sessionEmail = $_SESSION['email'];
  require '../connection/connection.php';

  $query = "SELECT * FROM account WHERE email = '$sessionEmail'";
 $result = mysqli_query($conn, $query);


if ($result) {
  while($row = $result->fetch_assoc()){
    $accountStatus = $row['status'];
    $name =  $row['username'];
    $profileimage = $row['profile_image'];
    $membership = $row['membership'];
    $wishlistCount = $row['wishlist_count'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ProductInfo.css">
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

  .carousel-item img {
    width: 600px;
    height: 300px;
}


  .product-container {
    background-color: white;
  }

  .product-info.description {
    background: transparent; /* Make the description box background clear */
  }

  .product-info.description {
  padding: 20px;
  border-radius: 5px;
  margin-top: 20px;
  margin-left: 50px;
}

.product-info{
width: 200px;
}

.itemdetail {
  background-color: white;
  width: 800px;
  margin: auto;
  height: 400px;
margin-top: 40px;
position: relative;
}

.userdetail{
background-color: #FFEAEA;
width: 450px;
margin: auto;
height: 5auto;
border-radius: 40px;
padding-bottom: 20px;
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
  border-radius: 18px;
  cursor: pointer;
  margin: 10px;
  height: 60px; 
  width: 120px;
  font-size: 1.5em;
}

#wishlistButton {
    background-color: #FF5353;
  color: #fff;
  border: none;
  padding: 12px;
  border-radius: 18px;
  cursor: pointer;
  margin: 10px;
  height: auto; 
  width: 180px;
  align-self: flex-start; 
}

.edit {
background-color: #FF5353;
  color: #fff;
  border: none;
  padding: 20px;
  border-radius: 18px;
  font-size: 2em;
  margin: 10px;
  height: 100px; 
  width: 100px;
  padding-bottom: 20px;
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
  margin: 20px;
  font-size: 20px;
  border-radius: 18px;
}


h1 {
            font-size: 30px;
        }

h5 {
            font-size: 20px;
        }





.action-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.wishlist-button-container {
    position: absolute;
    top: 10px; /* Adjust this value to your desired top position */
    right: 10px; /* Adjust this value to your desired right position */
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php">Sell</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                <?php 
                $profileimage = "SELECT * FROM account WHERE username = '$name'";
                $result = $conn-> query($profileimage);
                while ($profileimage = $result->fetch_assoc()) {
                    $pimage = $profileimage['profile_image'];
                }    
                    if (isset($pimage)) {
                        echo '<img src="../profile/' .$pimage . '" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
                    } else {
                        echo '<img src="../image/profile.png" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
                    }
                    ?>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../profile/myprofile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="../myPurchases/myPurchases.php">My Purchases</a></li>
                    <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
                    <li><a class="dropdown-item" href="../privatemessage/myChat.php">Messages</a></li>
                    <li><a class="dropdown-item" href="../home/index-guest.php" id="logout-link">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php
        if (isset($_GET['id'])) {
            $itemId = $_GET['id'];

            $query = "SELECT itemslisting.*, item_images.image_filename 
                      FROM itemslisting 
                      JOIN item_images ON itemslisting.id = item_images.item_id 
                      WHERE itemslisting.id = $itemId";
            $result = mysqli_query($conn, $query);

            if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="container1">
        <center><h6>Category - <?php echo $row["category"]; ?></h6></center>
            <div class="product-container">
                <div id="carouselExampleIndicators" class="carousel slide w-100" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../sellers/Upload/<?php echo $row['image_filename']; ?>">
                        </div>
                        <div class="carousel-item">
                            <img src="../sellers/Upload/<?php echo $row['image_filename']; ?>">
                        </div>
                        <div class="carousel-item">
                            <img src="../sellers/Upload/<?php echo $row['image_filename']; ?>">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button"
                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" ariahidden="true"></span>
                        <span class="">Next</span>
                    </button>
                </div>
            </div>
        </div>
 
        <!-- ------------------------------------------------------------------------------------ -->

        <div id="secondhalf">
            <div class="itemdetail">
                <br>
                <h1  style="font: size 60px;font-weight:thin"><?php echo $row["name"]; ?></h1>
                <h1 style="font: size 20px;font-weight:bolder">$<?php echo $row["price"]; ?></h1>

                <br>

                <!-- <h3>Details:</h3>
                <h6>condition <?php echo $row["item_condition"]; ?></h6>
                <br> -->
                
                <h3>Description:</h3>
                <br>
                <h5><?php echo $row["description"]; ?></h5>
                <br>
                <div class="wishlist-button-container">
                <button type="button"
                    id="wishlistButton" <?php echo ($sessionEmail === $row['email']) ? 'style="display: none;"' : ''; ?>
                    onclick="wishlist()">Add to wishlist</button></div>

                    
            <div class="wishlist-button-container">
            <?php
            // ... (previous code)

            // Assuming you have a table 'wishlist' with columns 'user_id' and 'item_id'
            $wishlistQuery = "SELECT COUNT(*) as wishlist_count FROM wishlist WHERE id = '$sessionEmail'";
            $wishlistResult = mysqli_query($conn, $wishlistQuery);

            if ($wishlistResult) {
                $wishlistCountRow = mysqli_fetch_assoc($wishlistResult);
                $wishlistCount = $wishlistCountRow['wishlist_count'];
            } else {
                $wishlistCount = 0; // Default to 0 if there's an error in the query
            }

            // Check the user's membership and wishlist count
            if ($membership === 'basic' && $wishlistCount >= 5) {
                echo '<p>You have reached your wishlist limit.</p>';
            } else {
                echo '<button type="button" id="wishlistButton" ';
                echo ($sessionEmail === $row['email']) ? 'style="display: none;"' : '';
                echo ' onclick="wishlist()">Add to wishlist</button>';
            }
            ?>

                
      </div>

            </div>

            <div class=" userdetail">
                <center>
              <?php
              $sessionEmail = $_SESSION['email'];
              $username = $row["username"];

              $reviewResult = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews WHERE users = '$username'");

              if ($reviewResult->num_rows > 0) {
                  $reviewRow = $reviewResult->fetch_assoc();
                  $averageRating = $reviewRow['avg_rating'] ?? 0;
                  $totalReviews = $reviewRow['total_reviews'];

                  function generateStarRating($rating) {
                      $output = '';
                      for ($i = 1; $i <= 5; $i++) {
                          if ($i <= ceil($rating)) {
                              $output .= '<i class="fa fa-star checked"></i>';
                          } else {
                              $output .= '<i class="fa fa-star"></i>';
                          }
                      }
                      return $output;
                  }

                  $href = ($row["email"] === $sessionEmail) ? '../profile/myProfile.php' : "../profile/usersprofile.php?email={$row["email"]}&username={$row["username"]}";

                  echo '<a href="' . $href . '" style="text-decoration: none; color: black;">';
                  echo '<div class="user">';
                  echo '<br>';

                  echo '<h2 style="font-size:20px;font-weight:thin"><img width="70px" src="../image/profile.png">' . " " . $row["username"] . ' (' . $totalReviews . ' reviews)'. 
                  '<small>'.
                  generateStarRating($averageRating)
                  .'<small></h2>';
                  
                  echo '<br>';
                  
                  echo '<center><h2 style="font-size:20px;font-weight:thin"> <img src="img/location-outline.svg" alt="location" style="width:60px;height:60px;margin-right:20px"> ' . $row["location"] . '</h2></center>';
                  
                  echo '<br>';
                  
                  echo '</a>';
              } else {
                  echo '- No reviews available.';
              }

              if ($sessionEmail === $row["email"]) {
                echo '<br>';
                  echo '<a href="../profile/profile_edit_item.php?id=' . $row["id"] . '" class="edit">Edit</a>';
                  echo '<br>'; 
              } else {
                  echo '<br>';
                  echo '<button type="button" class="btn btn-primary" id="chatButton" onclick="chat()">Chat</button>';
                  echo '<button type="button" class="btn btn-primary" id="buyButton" onclick="buy()">Buy</button>';
              }
              echo '</div>';
              ?>
              </center>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
                crossorigin="anonymous"></script>

            <script>
                var sessionEmail = "<?php echo $sessionEmail; ?>";
                if (sessionEmail === '<?php echo $row["email"]; ?>') {
                    document.getElementById('chatButton').style.display = 'none';
                    document.getElementById('buyButton').style.display = 'none';
                }

                function buy() {
                    window.location.href = '../order/orderItem.php?id=<?php echo $row["id"]; ?>&email=<?php echo $row["email"]; ?>';
    }

                function chat(username, id) {
                    var username = "<?php echo $row['username']; ?>";
                    var id = "<?php echo $row['id']; ?>";
                    var url = '../privatemessage/chat.php?' +
                        'username=' + encodeURIComponent(username) +
                        '&id=' + encodeURIComponent(id);

                    window.location.href = url;
                }
            </script>

            <script>
                function wishlist() {
                    var username = "<?php echo $row['username']; ?>";
                    var id = "<?php echo $row['id']; ?>";
                    var description = "<?php echo $row['description']; ?>";
                    var name = "<?php echo $row['name']; ?>";
                    var price = "<?php echo $row['price']; ?>";
                    var category = "<?php echo $row['category']; ?>";
                    var condition = "<?php echo $row['item_condition']; ?>";

                    var url = '../wishlist/add_to_wishlist.php?' +
                        '&item_id=' + encodeURIComponent(id) +
                        '&name=' + encodeURIComponent(name) +
                        '&price=' + encodeURIComponent(price) +
                        '&description=' + encodeURIComponent(description) +
                        '&category=' + encodeURIComponent(category) +
                        '&item_condition=' + encodeURIComponent(condition);

                    window.location.href = url;
                }
            </script>
    </div>

        <?php
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Product ID not specified.";
        }
        ?>
    </main>
</body>

</html>