<?php
 require '../connection/connection.php';
 require_once("../session/session.php");
 $username = $_SESSION['username'];
 $yourEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="wishlist.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>

<!-- ------------------------------------------------------------------------------------------------------------------- -->

<!-- NAVIGATION BAR -->

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
       <li><a class="dropdown-item" href="../profile/myprofile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="../myPurchases/myPurchases.php">My Purchases</a></li>
                <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
                <li><a class="dropdown-item" href="../privatemessage/myChat.php">Messages</a></li>
                <li><a class="dropdown-item" href="../home/index-guest.php" id="logout-link">Log out</a></li>

    </ul>
    </div>
  </div>
</nav>

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

<!-- ------------------------------------------------------------------------------------------------------------------- -->

<!-- BODY -->

    <div class="wishlist-container">
        <div class="wishlist-picture">
            <img src="../profile/profileimage/wajdi.jpg" alt="Profile Picture">
        </div>   
    </div>

    <br>
    <center>
    <button class="no-background no-border " onclick="showListings()"><h5></h5></button>
    <button class="no-background no-border " onclick="showWishlists()"><h5>Wishlists</h5></button>
    <button class="no-background no-border " onclick="showReviews()"><h5></h5></button>
    
  </center>

<div class="box">

<!-- WISHLIST -->

<div class="box" id="wishlistbox" style="display: block;">

<br>  
  <h3>My Wishlist</h3>

      <!-- to show the wishlist items in database  -->

      <?php
require '../connection/connection.php';

// Assuming your wishlist table structure contains id, name, and price columns
// Modify the SQL query to filter by email
$result = $conn->prepare("SELECT * FROM wishlist WHERE email = ?");
$result->bind_param("s", $yourEmail);
$result->execute();

$result = $result->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">' . $row['name'] . ' || ' . $row['item_condition'] . '</h5>
                    <p class="card-text">Price: $' . $row['price'] . '</p>
                    <p class="card-text">' . $row['category'] . ' - ' . $row['description'] . '</p>
                    <div class="float-right">
                        <button class="btn btn-danger" onclick="removeFromWishlist(' . $row['id'] . ')">Remove</button>
                        <button class="btn btn-success" onclick="payment(' . $row['item_id'] . ')">Buy</button>
                    </div>
                </div>
            </div>';
    }

    $result->close();
} else {
    echo '<p>No items in your wishlist.</p>';
}

$conn->close();
?>

  <!-- TO REMOVE YOUR WISHLIST ITEM -->
  <script>
    function removeFromWishlist(id) {
        if (confirm("Are you sure you want to remove this item from your wishlist?")) {
            // Send an AJAX request to the PHP script to remove the item
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "remove_from_wishlist.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response (e.g., display a message)
                    alert(xhr.responseText);
                    // Reload the page or update the wishlist content as needed
                    location.reload(); // Refresh the page after removing the item
                }
            };

            // Send the 'id' parameter in the request
            xhr.send("id=" + id);
        }
    }

            function payment(id) {
                // Display a confirmation dialog
                if (confirm("Are you sure you want to proceed to payment?")) {
                    // Redirect to the payment page with the selected item's ID
                    window.location.href = '../order/orderItem.php?id=' + id;
                }
            }
  </script>

 
    <br>
</div> 


<!-- ------------------------------------------------------------------------------------------------------------------- -->

<!-- PROFILE -->

<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="addReviewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="addReviewModalLabel">Add New Review</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <form id="reviewForm" method="POST" action="review.php">
    <div class="form-group">
      <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>"  autocomplete="off" hidden >
    </div>
    <div class="form-group">
      <label for="content">Content</label> <!-- Change the label text here -->
      <textarea class="form-control" id="content"name="content" rows="3" required></textarea>
    </div>
    <div class="form-group">
      <label for="rating">Rating</label>
      <select class="form-control" name="rating" id="rating" required>
        <option value="1">1 Star</option>
        <option value="2">2 Stars</option>
        <option value="3">3 Stars</option>
        <option value="4">4 Stars</option>
        <option value="5">5 Stars</option>
      </select>
    </div>
    <input type="text" class="form-control" id="users" name="users" hidden value="<?php echo isset($_GET['users']) ? $_GET['users'] : ''; ?>">

  </form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="submitReviewBtn">Submit Review</button>
      </div>
    </div>
  </div>
</div>
</div>

<script>
// Function to show the Wishlists box content
function showWishlists() {
    document.getElementById("wishlistbox").style.display = "block"; 
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
