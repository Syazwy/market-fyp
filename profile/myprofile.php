<?php
 require '../connection/connection.php';
 require_once("../session/session.php");
 $username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profilecss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../wishlist/wishlist.php">Wishlist</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
    </ul>
  </div>

  <div class="dropdown">
    <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
      <img src="../image/profile.png" width="50" height="50" class="profile">
    </a>

    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="../myPurchases/myPurchases.php">My Purchases</a></li>
      <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
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


    <div class="profile-container">
        <div class="profile-picture">
            <img src="../image/profile.png" alt="Profile Picture">
        </div>   
    </div>

    <br>
    <center>
    <button class="no-background no-border " onclick="showListings()"><h5>My Listings</h5></button>
    <button class="no-background no-border " onclick="showReviews()"><h5>Reviews</h5></button>
  </center>

<div class="box">

  <div  id="box1">
    <div class="user-info"> 
        
      <?php 
      echo "<h3>" . $username . "</h3><br>";
      $conn = new mysqli('localhost', 'root', '', 'market');
    
      if ($conn->connect_error) {
          die('Connection Failed : '.$conn->connect_error);
      }
      $result = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews WHERE users = '$username'");
    
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $averageRating = $row['avg_rating'];
          $totalReviews = $row['total_reviews'];
          
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
      <br>
        <p></p>  
    <?php
  

        $conn = new mysqli('localhost', 'root', '', 'market');
        
        if ($conn->connect_error) {
            die('Connection Failed : ' . $conn->connect_error);
        }
        
        // Query to get the account creation date for the user
        $stmt = $conn->prepare("SELECT date FROM account WHERE username = ?");
        
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $accountCreatedDate = new DateTime($row['date']);
                $currentDate = new DateTime();
                $interval = $accountCreatedDate->diff($currentDate);
        
                // Function to format the interval in days ago
                function formatDaysAgo($interval) {
                    if ($interval->d > 0) {
                        return $interval->format('%ad ago');
                    } else {
                        return 'Today';
                    }
                }
        
                echo 'Joined ' . formatDaysAgo($interval);
        
                // Close the database connection
                $stmt->close();
            } else {
                echo '- No account information available.';
            }
        } else {
            echo 'Error in preparing the SQL statement.';
        }

       
                   
                  
        
        
        
        ?>
        
        
          
    </div>
    <br>

                  <?php
                      $i = 1;
                      $rows = mysqli_query($conn, "SELECT * from account WHERE username = '$username' ORDER BY id DESC ");
                  ?>

                  

                  <?php
                    foreach($rows as $row) :
                  ?>
                      <a href="profileedit.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary"> Edit Profile </a>
                      <?php endforeach; ?>

                  
      
  </div>

<!-- ------------------------------------------------------------------------------------------------------------------- -->
  <div class="box" id="box2" style="display: block;">
    <?php
require '../connection/connection.php';
$i = 1;
$username = $_SESSION['username']; // Get the logged-in user's username
$query = "SELECT itemslisting.*, item_images.image_filename 
          FROM itemslisting 
          JOIN item_images ON itemslisting.id = item_images.item_id 
          WHERE itemslisting.username = '$username' 
          GROUP BY itemslisting.id 
          ORDER BY itemslisting.id DESC";

$result = mysqli_query($conn, $query);
?>


    <?php if (mysqli_num_rows($result) > 0) : ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-6 g-4">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="card" style="width: 150px; height: 200px; border:none">
                    <div class="image-container" style="height: 50%;">
                        <img src="../sellers/upload/<?php echo $row['image_filename']; ?>" alt="Product Image" style="max-height: 100%;">
                    </div>
                    <div class="card-content">
                        <p style="text-transform: capitalize; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $row["name"]; ?></p>
                        <h5><b>$<?php echo $row["price"]; ?></b></h5>
                        <p style="text-transform: capitalize; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><small class="text-body-secondary"><?php echo $row["item_condition"]; ?></small></p>
                    </div>



                    <?php
                          $i = 1;
                          $rows = mysqli_query($conn, "SELECT * from itemslisting  ORDER BY id DESC ");
                          
                    ?>
                    
                          <a href="profile_edit_item.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary"> Edit item </a>
                          


                </div>  
                           
            <?php endwhile; ?>

            <a href="../sellers/sells-page.php" style="text-decoration:none">
    <div class="card" style="width: 150px; height: 170px; border:none; ">
        <div class="image-container" style="height: 75%;padding:20px; background-color: #FFCBCB; border-radius:20px">
            <img src="../image/plus.png" alt="Product Image" style="height: 30%;">
        </div>
        <div class="card-content">
            <p style="text-transform: capitalize; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></p>
            <center><p>Add New Listing</p></center>
            <p style="text-transform: capitalize; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></p>
        </div>
    </div>
</a>
        </div>
    <?php else : ?>
        <h4>You have not made any listings.</h4>
    <?php endif; ?>
    <br>



</div>

<!-- ------------------------------------------------------------------------------------------------------------------- -->

<div class="box" id="box3" style="display: none;">
<!-- <button class="btn mb-3" id="addReviewBtn" data-toggle="modal" data-target="#addReviewModal" style="border: 1px solid black; position: fixed; top: 240px; right: 710px; <?php echo $addReviewButtonStyle; ?>">Add New Review</button> -->



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

          $stmt = $conn->prepare("INSERT INTO reviews(username, content, rating, time, user) VALUES (?, ?, ?, ? )");
          $stmt->bind_param("ssss", $username, $content, $rating, $timedate, );
          $stmt->execute();

          $stmt->close();
      } else {
        $result = $conn->query("SELECT * FROM reviews WHERE users = '$username' ORDER BY time DESC");


          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $reviewDate = date('Y-m-d', strtotime($row['time']));
          
              echo '
                  <div class="card mb-4">
                      <div class="card-body"><center>
                          <h5 class="card-title">' . $row['username'] . '</h5>
                          <p class="rating">'; // Open the rating container
          
              for ($i = 1; $i <= 5; $i++) {
                  echo '<span class="fa fa-star ' . ($i <= $row['rating'] ? 'checked' : '') . '"></span>';
              }
          
              echo '</p>'; // Close the rating container
              
              echo '<p class="card-text">' . $row['content'] . '</p>
                    <p class="time">Posted on ' . $reviewDate . '</p>
                      </center></div>
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
 var box2Content = document.getElementById("box2").innerHTML; // Store the initial content of box2
 function showListings() {
  document.getElementById("box2").style.display = "block"; // Show box2
  document.getElementById("box3").style.display = "none"; // Hide box3
}

function showReviews() {
  document.getElementById("box2").style.display = "none"; // Hide box2
  document.getElementById("box3").style.display = "block"; // Show box3
}

  </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
