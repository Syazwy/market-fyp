<!DOCTYPE html>
<?php
require_once("../session/session.php");
$users = $_GET['users'];
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller Reviews</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="review.css">

</head>
<body>
  
<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../image/logo.png" width="80" height="80">
    </a>
  
  <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Wishlist</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#" >Sell</a></li>
    </ul>
  </div>

  <div class="dropdown">
    <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
      <img src="../image/profile.png" width="50" height="50" class="profile">
    </a>

    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Your Listings</a></li>
      <li><a class="dropdown-item" href="#">My purchases</a></li>
      <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
      <li><a class="dropdown-item" href="index-guest.php">Log out</a></li>
    </ul>
  </div>
  </div>
</nav>


<div class="main-container">
<button type="button" class="btn btn-secondary" id="goBackBtn">Go Back</button>

    <div class="card-header">
        <img src="../image/user.png" alt="" style="height: 100px;">
        <?php
echo "<h2>" . $users ;

  $conn = new mysqli('localhost', 'root', '', 'market');

  if ($conn->connect_error) {
      die('Connection Failed : '.$conn->connect_error);
  }
  $result = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews WHERE users = '$users'");

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $averageRating = $row['avg_rating'];
      $totalReviews = $row['total_reviews'];
      
      // Function to generate star rating based on the average rating
      function generateStarRating($rating) {
          $output = '';
          for ($i = 1; $i <= 5; $i++) {
              if ($i <= $rating) {
                  $output .= '<span class="fa fa-star checked"></span>';
              } else {
                  $output .= '<span class="fa fa-star"></span>';
              }
          }
          return $output;
      }
      
      echo ' ' . generateStarRating($averageRating) . ' (' . $totalReviews . ' reviews)';
    } else {
      echo '- No reviews available.';
  }
  echo "</h2>";
  $conn->close();

  ?>
  </h2>
<button class="btn mb-3" id="addReviewBtn" data-toggle="modal" data-target="#addReviewModal" style="border:1px solid black">Add New Review</button>

<div class="container1" style="">
<?php
      $conn = new mysqli('localhost', 'root', '', 'market');

      if ($conn->connect_error) {
          die('Connection Failed : '.$conn->connect_error);
      }

      if (isset($_POST['username']) && isset($_POST['content']) && isset($_POST['rating'])) {
          $username = $_POST['username'];
          $content = $_POST['content'];
          $rating = $_POST['rating'];
          $users = $_POST['users'];

          $currentDateTime = new DateTime();
          $timedate = $currentDateTime->format('Y-m-d H:i:s');

          $stmt = $conn->prepare("INSERT INTO reviews(username, content, rating, time, users) VALUES (?, ?, ?, ?, ?)");
          $stmt->bind_param("sssss", $username, $content, $rating, $timedate, $users);
          $stmt->execute();

          $stmt->close();
      } else {
        $result = $conn->query("SELECT * FROM reviews WHERE users = '$users' ORDER BY time DESC");


          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $reviewDate = date('Y-m-d', strtotime($row['time']));
          
              echo '
                  <div class="card mb-4">
                      <div class="card-body">
                          <h5 class="card-title">' . $row['username'] . '</h5>
                          <p class="rating">'; // Open the rating container
          
              for ($i = 1; $i <= 5; $i++) {
                  echo '<span class="fa fa-star ' . ($i <= $row['rating'] ? 'checked' : '') . '"></span>';
              }
          
              echo '</p>'; // Close the rating container
              
              echo '<p class="card-text">' . $row['content'] . '</p>
                    <p class="time">Posted on ' . $reviewDate . '</p>
                      </div>
                  </div>'; // Close the card
          }
          
          
             $result->close();
          } else {
              echo '<p>No reviews available.</p>';
          }
      }
      $conn->close();
      
      ?>
</div>
</div>    
<div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="addReviewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addReviewModalLabel">Add New Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <form id="reviewForm" method="POST" action="review.php">
    <div class="form-group">
      <label for="username">Name</label>
      <input type="text" class="form-control" id="username" name="username"  autocomplete="off" required>
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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>

function addReview(username, content, rating) {
    const starIcons = Array.from({ length: 5 }, (_, i) => {
        return `<span class="fa fa-star ${i < rating ? 'checked' : ''}"></span>`;
    }).join('');

    const newReview = `
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">${username}</h5>
                <p class="card-text">${content}</p>
                <div class="rating">${starIcons}</div>
            </div>
        </div>`;
    
   
}
document.getElementById("goBackBtn").addEventListener("click", function() {
    // Navigate back to the previous page
    history.back();
});


document.getElementById("submitReviewBtn").addEventListener("click", function() {
    const username = document.getElementById("username").value;
    const content = document.getElementById("content").value;
    const rating = parseInt(document.getElementById("rating").value);
    
    // Get the value of the hidden input field
    const users = document.getElementById("users").value;

    const formData = new FormData();
    formData.append("username", username);
    formData.append("content", content);
    formData.append("rating", rating);
    formData.append("users", users);

    fetch("review.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);

        // Clear form fields and close modal
        document.getElementById("reviewForm").reset();
        $('#addReviewModal').modal('hide');
        
        // Assuming addReview function needs to be called here, but not sure
        addReview(username, content, rating);
        
        // If you really need to refresh the page after adding a review, use window.location.href
        window.location.href = "review.php?users=" + encodeURIComponent(users);

    })
    .catch(error => {
        // Handle errors
        console.error("Error:", error);
    });
});


</script>
</div>
</body>
</html>