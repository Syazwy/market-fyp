<?php
  require_once("../session/session.php");
  require '../connection/connection.php';
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
    <a class="navbar-brand" href="../home/index.php">
      <img src="../image/logo.png" width="80" height="80">
    </a>
  
  <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button" aria-controls="offcanvasRight">Categories</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../wishlist/wishlist.php">Wishlist</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
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
      <li><a class="dropdown-item" href="index-guest.php" id="logout-link">Log out</a></li>

    </ul>
  </div>
  </div>
</nav>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">All Categories</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!-- <div class="offcanvas-body"> -->
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Property</a></li>
      <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Vehicles</a></li>
      <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Furnitures</a></li>
      <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Electronics</a></li>
      <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Fashion</a></li>
    </ul>
  <!-- </div> -->
</div>
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
         require '../connection/connection.php';
        $i = 1;
        $query = "SELECT itemslisting.*, item_images.image_filename 
                  FROM itemslisting 
                  JOIN item_images ON itemslisting.id = item_images.item_id 
                  GROUP BY itemslisting.id 
                  ORDER BY itemslisting.id DESC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) :
          $uploadedAt = strtotime($row["uploaded_at"]); // Convert uploaded_at datetime to a timestamp
          $currentTime = time(); // Current time timestamp
          $timeDiff = $currentTime - $uploadedAt;
      
          // Calculate time difference in human-readable format
          if ($timeDiff < 60) {
              $timeAgo = $timeDiff . " seconds ago";
          } elseif ($timeDiff < 3600) {
              $minutes = floor($timeDiff / 60);
              $timeAgo = $minutes . " minutes ago";
          } elseif ($timeDiff < 86400) {
              $hours = floor($timeDiff / 3600);
              $timeAgo = $hours . " hours ago";
          } else {
              $days = floor($timeDiff / 86400);
              $timeAgo = $days . " days ago";
          }
          ?>

      <div class="col d-flex align-items-center justify-content-center">
        <div class="card item h-100">
          <div class="card-header bg-transparent border border-0">
            <div class="row row-cols-1 row-cols-md-2 g-4">
              <div class="col col-lg-3">
                <a href="">
                  <img src="../image/profile.png" width="40" height="40">
                </a>
              </div>
              <div class="col-md-auto">
                <h6 class="card-title">
                  <p style="text-transform: capitalize; margin:0px;"><?php echo $row["username"]; ?></p>
                </h6>
                <small class="text-body-secondary">
                  <p class="card-text">
                    <?php echo $timeAgo; ?>
                  </p>
                </small>
              </div>
            </div>
          </div>
          <!-- <div class="card-header bg-transparent border border-0">
            <h6 class="card-title">
              <a class="navbar-brand" href="index.php">
                <img src="../image/profile.png" width="40" height="40">
                <p style="text-transform: capitalize"><?php echo $row["username"]; ?></p>
              </a>
              
            </h6>
            <p class="card-text"><?php echo $timeAgo; ?></p>
          </div> -->
          <a href="../ProductInfo/ProductInfo.php?id=<?php echo $row["id"]; ?>">
            <img src="../sellers/upload/<?php echo $row['image_filename']; ?>" class="card-img-top" width="150px" height="150px">
          </a>
          <div class="card-body">
            <p class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></p>
            <h5 class="card-title"><b><?php echo "BND$".$row["price"]; ?></b></h5>
            <p class="card-text" style="text-transform: capitalize"><small class="text-body-secondary"><?php echo $row["item_condition"]; ?></small></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary" onclick="addToWishlist(<?php echo $row['id']; ?>)">Add to Wishlist</button>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
      </div>
    </div>
    
    <?php
// Connect to your MySQL database
$mysqli = new mysqli('localhost', 'username', 'password', 'your_database_name');

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve the itemId from the POST request
$itemId = $_POST['itemId'];

// Insert the item into the wishlist table (you may need to adjust the table and column names)
$query = "INSERT INTO wishlist (item_id) VALUES (?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $itemId);

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}

$stmt->close();
$mysqli->close();
?>



    <script>
  function addToWishlist(itemId) {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Define the PHP script URL
    var url = 'addToWishlist.php';

    // Create a FormData object to send data to the server
    var formData = new FormData();
    formData.append('itemId', itemId);

    // Configure the request
    xhr.open('POST', url, true);

    // Set up the callback function to handle the response
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response here (e.g., show a success message)
        var response = xhr.responseText;
        if (response === 'success') {
          alert('Item added to wishlist successfully!');
        } else {
          alert('Failed to add item to wishlist.');
        }
      }
    };

    // Send the request with the form data
    xhr.send(formData);
  }
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>