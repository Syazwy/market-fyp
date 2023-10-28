<?php
  require_once("../session/session.php");
  $sessionEmail = $_SESSION['email'];
  $myUsername = $_SESSION['username'];
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
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../productinfo/ProductInfo.css">
    <link rel="stylesheet" href="../home/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>

  .checked {
    color: orange;
  }

  .carousel-inner {
    background: white; 
  }

  .carousel-item img {
    width: 600px;
    height: 400px;
  }

  .product-info.description {
    background: transparent; 
    padding: 20px;
    border-radius: 5px;
    margin-top: 20px;
    margin-left: 100px;
  }

  .product-info {
    width: 200px;
  }

  .itemdetail {
    background-color: white;
    width: 800px;
    height: 400px;
    padding-top: 50px;
    margin: 30px;
    margin-left:200px ;
    position: relative;
  }

  .userdetail {
    background-color: #FFEAEA;
    width: 450px;
    margin: auto;
    height: auto;
    border-radius: 40px;
    padding-bottom:10px;
    margin-right: 250px;
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
   margin-top: 10px;
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

  h2 {
    font-size: 30px;
  }

  h5 {
    font-size: 20px;
  }

  .action-container {
    display: flex;
    justify-content: space between;
    align-items: flex-start;
  }

  .wishlist-button-container {
    position: absolute;
    top: 10px; 
    right: 10px; 
   
    padding: 50px;
  }


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
    font-size: 20px; 
  }

  .rating .fa {
    margin: 0 5px; 
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
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    margin: auto;
    text-align: center;
    width: 1200px;
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

  .user {
    width: 400px;
  }

  #secondhalf {
    display: flex;
    margin: auto;
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../wishlist/wishlist.php">Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php">Sell</a></li>
                </ul>
            </div>

            <?php echo "Hello,&nbsp<b style=\"text-transform: capitalize;\"> " . $myUsername . "</b>"; ?>
        

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
                <?php
                // Fetch all associated images for this item
                $imageQuery = "SELECT image_filename FROM item_images WHERE item_id = $itemId";
                $imageResult = mysqli_query($conn, $imageQuery);
                $numSlides = mysqli_num_rows($imageResult);
                
                for ($i = 0; $i < $numSlides; $i++) {
                ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>"
                        <?php echo $i == 0 ? 'class="active" aria-current="true"' : ''; ?>
                        aria-label="Slide <?php echo $i + 1; ?>"></button>
                <?php
                }
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                $first = true;
                while ($imageRow = mysqli_fetch_assoc($imageResult)) {
                ?>
                    <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                        <img src="../sellers/upload/<?php echo $imageRow['image_filename']; ?>">
                    </div>
                <?php
                    $first = false;
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button"
                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="" style="color: black;">&lt; Previous</span>
            </button>
            <button class="carousel-control-next" type="button"
                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="" style="color: black;">Next &gt;</span>
            </button>
        </div>
    </div>
</div>


 
        <!-- ------------------------------------------------------------------------------------ -->

        <div id="secondhalf">
            <div class="itemdetail">
                <br>
                <h1  style="font: size 60px;font-weight:thin"><?php echo $row["name"]; ?></h1>
                <h2 style="font-weight:bolder">$<?php echo $row["price"]; ?></h2>

                <br>

                
                <h3>Condition: </h3>
                  <h5><?php echo $row["item_condition"]; ?></h5>
                <br>
                
                <h3>Description:</h3>
                

                <h5><?php echo $row["description"]; ?></h5>
                <div class="wishlist-button-container">
                <button type="button"
        id="wishlistButton" <?php echo ($sessionEmail === $row['email']) ? 'style="display: none;"' : ''; ?>
        onclick="confirmAddToWishlist()">Add to wishlist</button></div>


                    
            <div class="wishlist-button-container">
            <?php

            $wishlistQuery = "SELECT COUNT(*) as wishlist_count FROM wishlist WHERE id = '$sessionEmail'";
            $wishlistResult = mysqli_query($conn, $wishlistQuery);

            if ($wishlistResult) {
                $wishlistCountRow = mysqli_fetch_assoc($wishlistResult);
                $wishlistCount = $wishlistCountRow['wishlist_count'];
            } else {
                $wishlistCount = 0; 
            }

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

                  $href = ($row["email"] === $sessionEmail) ? '../profile/myprofile.php' : "../profile/usersprofile.php?email={$row["email"]}&username={$row["username"]}";

                  echo '<a href="' . $href . '" style="text-decoration: none; color: black;">';
                  echo '<div class="user">';

                  echo '<h2 style="font-size:20px;font-weight:thin">';
                  if (isset($row['profile_image']) && $row['profile_image'] != null) {
                      echo '<img src="../profile/' . $row['profile_image'] . '" width="60px" height="60px" class="profile rounded-circle" alt="Profile Picture">';
                  } else {
                      echo '<img src="../image/profile.png" width="60px" height="60px" class="profile rounded-circle" alt="Profile Picture">';
                  }
                  echo ' ' . $row["username"] . ' (' . $totalReviews . ' reviews)' . '<small>' . generateStarRating($averageRating) . '</small></h2>';

                  echo '<br>';

                  echo '</a>';

                  echo '<center><h2 style="font-size:20px;font-weight:thin"> <img src="img/location-outline.svg" alt="location" style="width:60px;height:60px;margin-right:20px"> ' . $row["location"] . '</h2></center>';
              } else {
                  echo '- No reviews available.';
              }

              if ($sessionEmail === $row["email"]) {
                echo '<br>';
                echo '<br>'; 
                  echo '<a href="../profile/profile_edit_item.php?id=' . $row["id"] . '" class="edit" style="text-decoration: none;">Edit</a>';
                  echo '<br>'; 
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
  function confirmAddToWishlist() {
        if (confirm("Are you sure you want to add this item to your wishlist?")) {
            addToWishlist();
        }
    }
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