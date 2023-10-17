<?php
  require_once("../session/session.php");
  $sessionEmail = $_SESSION['email'];
  require '../connection/connection.php';
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
                    <img src="../image/profile.png" width="50" height="50" class="profile">
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
        <div id="secondhalf">
            <div class="product-info description">
                <h3>Item Name:</h3>
                <h6 style="text-transform: capitalize"><?php echo $row["name"]; ?></h6>
                <h3>Price:</h3>
                <h6>$<?php echo $row["price"]; ?></h6>
                <h3>Category:</h3>
                <h6><?php echo $row["category"]; ?></h6>
                <h3>Condition:</h3>
                <h6><?php echo $row["item_condition"]; ?></h6>
                <h3>Description:</h3>
                <h6><?php echo $row["description"]; ?></h6>
                <br>
                <button type="button" class="btn btn-primary"
                    id="wishlistButton" <?php echo ($sessionEmail === $row['email']) ? 'style="display: none;"' : ''; ?>
                    onclick="wishlist()">Add to wishlist</button>
            </div>

            <div class="product-info description">
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
                  echo '<img width="50px" src="../image/profile.png">';
                  echo generateStarRating($averageRating) . ' (' . $totalReviews . ' reviews)';
                  echo '<p>' . $row["username"] . '</p>';
                  echo '<p>' . $row["location"] . '</p>';

                  echo '</a>';
              } else {
                  echo '- No reviews available.';
              }

              if ($sessionEmail === $row["email"]) {
                  echo '<a href="../profile/profile_edit_item.php?id=' . $row["id"] . '" class="btn btn-primary">Edit</a>';
              } else {
                  echo '<button type="button" class="btn btn-primary" id="chatButton" onclick="chat()">Chat</button>';
                  echo '<button type="button" class="btn btn-primary" id="buyButton" onclick="buy()">Buy</button>';
              }
              echo '</div>';
              ?>
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
                    window.location.href = '../order/orderItem.php?id=<?php echo $row["id"]; ?>';
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
