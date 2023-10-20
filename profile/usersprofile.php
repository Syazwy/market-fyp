<?php
require '../connection/connection.php';
require_once("../session/session.php");

$usersemail = $_GET['email'];
$user = $_GET['username'];
$myusername = $_SESSION['username'];
$username = $_SESSION['username'];

$query = "SELECT * FROM account WHERE username = '$user'";
$result = mysqli_query($conn, $query);

if ($result) {
 while($row = $result->fetch_assoc()){
   $accountStatus = $row['status'];
   $name =  $row['username'];
   $profileimage = $row['profile_image'];
  }
}

$query2 = "SELECT * FROM account WHERE username = '$username'";
$result2 = mysqli_query($conn, $query2);
if ($result2) {
    while($row = $result2->fetch_assoc()){
      $profileimage2 = $row['profile_image'];
     }
   }

?>

<?php

require_once("../session/session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['content']) && isset($_POST['rating'])) {
    $content = $_POST['content'];
    $rating = $_POST['rating'];
    $users = $_POST['username']; // Retrieve username from the form
    $usersemail = $_POST['email'];
    $myusername = $_SESSION['username']; // Assuming the username comes from a session
    $currentDateTime = new DateTime();
    $timedate = $currentDateTime->format('Y-m-d H:i:s');

    // Use a prepared statement to insert the review into the database
    $stmt = $conn->prepare("INSERT INTO reviews (username, content, rating, time, users) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $myusername, $content, $rating, $timedate, $users);
    
    if ($stmt->execute()) {
        // Review submitted successfully
    } else {
        // Error occurred while inserting the review
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    
}
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user = $_POST['username'];
    $usersemail = $_POST['usersemail'];
    $item_id = $_POST['item_id'];
    $typeReport = $_POST['typeReport'];
    $report_reason = $_POST['report_reason'];
    
    // Define the SQL query to insert data into the reportbyusers table
    $sql = "INSERT INTO reportbyusers (typeReport, reason, usersemail, username ) VALUES ('$typeReport', '$report_reason', '$usersemail ', '$user')";
    
    if ($conn->query($sql) === TRUE) {
        // The report has been successfully submitted, now we trigger the success modal
        echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#successModal").modal("show");
            });
        </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
   
// Redirect to usersprofile.php with email and username as query parameters
header("Location: usersprofile.php?email=" . $usersemail . "&username=" . $user);
exit; 
}
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">
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
    <?php 
      if (isset($profileimage2)) {
            echo '<img src="../profile/' .$profileimage2 . '" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
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
        <?php 
      if (isset($profileimage   )) {
            echo '<img src="../profile/' .$profileimage . '" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
        } else {
            echo '<img src="../image/profile.png" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
        }
        ?>
        </div>   
    </div>

    <br>
    <center>
    <button class="no-background no-border " onclick="showListings()"><h5>Listings</h5></button>
    <button class="no-background no-border " onclick="showReviews()"><h5>Reviews</h5></button>
  </center>

<div class="box">

  <div  id="box1">
    <div class="user-info"> 
        
      <?php 
      echo "<h3>" . $user . "</h3><br>";

      $result = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews WHERE users = '$user'");
    
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
       
      ?> 
      <br>
        <p></p>  
    <?php
        
        // Query to get the account creation date for the user
        $stmt = $conn->prepare("SELECT date FROM account WHERE username = ?");
        
        if ($stmt) {
            $stmt->bind_param("s", $user);
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
                      $rows = mysqli_query($conn, "SELECT * from account WHERE username = '$user' ORDER BY id DESC ");
                  ?>
                  

<button class="report-button btn btn-primary" onclick="openReportModal(' . $itemId . ')">Report</button>

                      <!-- Modal for reporting an user -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Report User</h5>
            </div>
            <div class="modal-body">
                <!-- Add a form for reporting the item here -->
                <form id="reportForm" method="post" action="usersprofile.php" onsubmit="return validateForm();">
                    <input type="hidden" name="item_id" id="reportItemID">
                    <div class="form-group">
                        <label for="type_of_report" name="typeReport" required>Type of Report</label>
                        <br>
                        <select class="form-select form-select-sm" id="typeReport" name="typeReport" aria-label="Small select example" required>
                            <option value=""></option>
                            <option value="Scam">Scam</option>
                            <option value="Selling of illegal item">Selling of Illegal Item</option>
                            <option value="Product quality">Product Quality</option>
                            <option value="Sales of animals">Sales of animals</option>
                            <option value="No intent to sell">No intent to sell</option>
                        </select>
                        <input type="hidden" name="username" value="<?php echo htmlspecialchars($user); ?>">
                        <input type="hidden" name="usersemail" value="<?php echo htmlspecialchars($usersemail); ?>">
                        <br>
                        <label for="report_reason">Reason</label>
                        <textarea class="form-control" name="report_reason" id="report_reason" rows="4" required></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-danger">Submit Report</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Hidden success message modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Report Sent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Your report has been sent and is now under review.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openReportModal(itemId) {
    // Set the item_id in the hidden input field of the modal form
    document.getElementById('reportItemID').value = itemId;
    
    // Show the report modal
    $('#reportModal').modal('show');
}

// Function to validate the form before submission
function validateForm() {
        var typeReport = document.getElementById("type_of_report").value;
        var reportReason = document.getElementById("report_reason").value;

        // Check if both fields are empty
        if (typeReport === "" || reportReason === "") {
            // Display a warning message in the modal
            alert("Please fill out both fields before submitting the report.");
            return false; // Prevent form submission
        }
    }

</script>

<!-- ------------------------------------------------------------------------------------------------------------------- -->
  
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">Review</button>

<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="reviewModalLabel">Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="usersprofile.php">
      <input type="hidden" name="email" value="<?php echo $usersemail; ?>">
    <input type="hidden" name="username" value="<?php echo $user; ?>">
       
    <div class="modal-body">
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Content</label>
            <textarea class="form-control" id="message-text" name="content" rows="4" required></textarea>
        </div>
     
        <div class="form-group">
            <label for="rating">Rating:</label>
            <select class="form-control" name="rating" id="rating" required>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
      </div>
    </div>
  </div>
</div>                    
 
<!-- ------------------------------------------------------------------------------------------------------------------- -->
</div>
  <div class="box" id="box2" style="display: block;">
    <?php
require '../connection/connection.php';
$i = 1;
$query = "SELECT itemslisting.*, MAX (item_images.image_filename) AS image_filename
          FROM itemslisting 
          JOIN item_images ON itemslisting.id = item_images.item_id 
          WHERE itemslisting.username = '$user' 
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

                </div>  
                           
            <?php endwhile; ?>
     
    <?php else : ?>
        <h4>No listings available.</h4>
    <?php endif; ?>
    <br>

</div>
    </div>

<!-- ------------------------------------------------------------------------------------------------------------------- -->

<div class="box" id="box3" style="display: none;">


<div class="container1" style="">
<?php
require '../connection/connection.php';


// Fetch and display reviews
$result = $conn->query("SELECT * FROM reviews WHERE users = '$user' ORDER BY time DESC");

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
} else {
    echo '<h4>No reviews available.</h4>';
}

$conn->close();
?>

</div>
</div>    

<script>
    function showListings() {
        document.getElementById("box2").style.display = "block"; // Show box2
        document.getElementById("box3").style.display = "none"; // Hide box3
    }

    function showReviews() {
        document.getElementById("box2").style.display = "none"; // Hide box2
        document.getElementById("box3").style.display = "block"; // Show box3
    }
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>