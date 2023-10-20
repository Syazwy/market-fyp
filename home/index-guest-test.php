<?php
require '../connection/connection.php';
include 'register.php';
include 'verification.php';
// include 'login.php';
// include 'forgot.php';
include 'sell.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Market</title>
  <link rel="stylesheet" href="forgot/forgot.css">
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
        <li class="nav-item"><a class="nav-link active" aria-current="page" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button" aria-controls="offcanvasRight">Categories</a></li>
        <li class="nav-item"><button id="registerModalTriggerButton" class="nav-link active" aria-current="page" data-toggle="modal" data-target="#registerModal" data-whatever="register">Register</button></li>
        <li class="nav-item"><button class="nav-link active" aria-current="page" data-toggle="modal" data-target="#loginModal" data-whatever="login">Login</button></li>
        <li class="nav-item">
          <a id="sellLink" class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#sellModal">Sell</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">All Categories</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Property</a></li>
    <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Vehicles</a></li>
    <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Furnitures</a></li>
    <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Electronics</a></li>
    <li class="list-group-item"><a href="#" class="list-group-item list-group-item-action" style="border:none;">Fashion</a></li>
  </ul>
</div>

<div class="search">
  <input class="searchbar" type="text" id="searchInput" placeholder="Search for anything" style="padding-left: 20px;">
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
  <br>
  <h4>Newly Listed</h4>
</div>

<div class="container">
  <div class="row row-cols-1 row-cols-md-5 g-4">
    <?php
      $i = 1;
      $query = "SELECT itemslisting.*, MAX(item_images.image_filename) AS image_filename
      FROM itemslisting
      JOIN item_images ON itemslisting.id = item_images.item_id
      JOIN account ON itemslisting.username = account.username
      WHERE account.status = 'Active' && itemslisting.status = 'active'
      GROUP BY itemslisting.id
      ORDER BY itemslisting.uploaded_at DESC";

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
            <a href="../productinfo/productinfo-guest.php?id=<?php echo $row["id"]; ?>">
              <img src="../sellers/upload/<?php echo $row['image_filename']; ?>" class="card-img-top" width="150px" height="150px">
            </a>
            <div class="card-body">
              <p class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></p>
              <h5 class="card-title"><b><?php echo "BND$".$row["price"]; ?></b></h5>
              <p class="card-text" style="text-transform: capitalize"><small class="text-body-secondary"><?php echo $row["item_condition"]; ?></small></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <!-- Search Results Section -->
    <div id="searchResults" class="row row-cols-1 row-cols-md-5 g-4">
      <!-- Search results will be displayed here -->
    </div>

  </div>
</div>

<!-- JavaScript for handling the search -->
<script>
  $(document).ready(function() {
    // Function to display search results and toggle item visibility
    function displaySearchResults(query) {
      var url = "search.php";
      var data = { query: query };

      $.ajax({
        type: "GET",
        url: url,
        data: data,
        success: function(response) {
          // Hide newly listed items
          $(".card.item.h-100").hide();
          // Display search results
          $("#searchResults").html(response).show();
        }
      });
    }

    // Function to handle input changes and trigger search
    function handleSearchInput() {
      var query = $("#searchInput").val();
      if (query) {
        displaySearchResults(query);
      } else {
        // Show all newly listed items when the search input is empty
        $(".card.item.h-100").show();
        $("#searchResults").hide();
      }
    }

    // Automatically update search results as the user types
    $("#searchInput").on("input", handleSearchInput);
  });
</script>

<script>
  $(document).ready(function() {
    $('#myModal').on('shown.bs.modal', function() {
      $('#myInput').trigger('focus');
    });

    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var recipient = button.data('whatever'); // Extract info from data-* attributes
    });
  });
</script>

<script>
  $(document).ready(function() {
    // Handle the click event on the "Sell" link
    $("#sellLink").click(function(e) {
      e.preventDefault(); // Prevent the default link behavior
      // Show the "sellModal" modal
      $("#sellModal").modal("show");
    });
  });
</script>

<?php if (!empty($errorMessage)) : ?>
  <script>
    alert("<?php echo $errorMessage; ?>");
  </script>
<?php endif; ?>

</body>
</html>
<?php
session_destroy();
?>
