<?php
    require_once("../session/session.php");
    require '../connection/connection.php';
    $username = $_SESSION['username'];
?>
<?php
// Function to get the user's membership level
function getUserMembership($conn, $username) {
    $query = "SELECT TRIM(membership) FROM account WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $membership);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $membership;
}


// Function to get the number of submissions made by the user
function getUserSubmissions($conn, $username) {
    $query = "SELECT COUNT(*) FROM itemslisting WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $numSubmissions);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $numSubmissions;
}

$membership = getUserMembership($conn, $username);
$numSubmissions = getUserSubmissions($conn, $username);

// Define the submission limits for different membership levels
$minSubmissionsForBasic = 0;
$maxSubmissionsForBasic = 2;
$minSubmissionsForPremium = 0; // Both Premium Monthly and Premium Annually
$maxSubmissionsForPremium = PHP_INT_MAX; // Unlimited submissions for Premium

// Check the user's membership level and submission limit
if ($membership === 'Basic') {
    if ($numSubmissions >= $minSubmissionsForBasic && $numSubmissions <= $maxSubmissionsForBasic) {
        // Basic members are allowed to submit within the defined limit
        $submissionLimitReached = false; // Reset the flag
    } else {
        // Basic members have exceeded the submission limit
        $submissionLimitReached = true;
    }
} elseif ($membership === 'Premium Monthly' || $membership === 'Premium Annually') {
    // Premium members (both Monthly and Annually) can submit unlimited times
    // Proceed with the item creation logic
    $submissionLimitReached = false; // Reset the flag
} else {
    // Handle other cases or errors as needed
    echo "Unknown membership level or an error occurred.";
    $submissionLimitReached = false; // Reset the flag
}

// Check if the user is a basic member and has reached the submission limit
$submissionLimitReached = ($membership == 'Basic' && $numSubmissions >= $maxSubmissionsForBasic);



if(isset($_POST["submit"])){
    // Get form data and sanitize
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $item_condition = mysqli_real_escape_string($conn, $_POST["item_condition"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $price = floatval($_POST["price"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $currentDateTime = new DateTime();
    $timedate = $currentDateTime->format('Y-m-d H:i:s');

    // Insert item data into the database
    $query = "INSERT INTO itemslisting (category, item_condition, name, price, description, location, username, time, uploaded_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssdsssss", $category, $item_condition, $name, $price, $description, $location, $username, $timedate, $timedate);
    mysqli_stmt_execute($stmt);
    $itemId = mysqli_insert_id($conn); // Get the last inserted item ID
    mysqli_stmt_close($stmt);

    // Handle uploaded images
    $uploadedImages = $_FILES['photos'];
    $imageNames = [];

    foreach ($uploadedImages['tmp_name'] as $key => $tmpName) {
        $fileName = uniqid() . '_' . basename($uploadedImages['name'][$key]);
        $targetPath = 'upload/' . $fileName;
        
        if (move_uploaded_file($tmpName, $targetPath)) {
            $imageNames[] = $fileName;
        } else {
            echo "Failed to move uploaded file: " . $uploadedImages['name'][$key] . "<br>";
        }
    }

    // Insert image filenames into the database
    foreach ($imageNames as $imageName) {
        $imageQuery = "INSERT INTO item_images (item_id, image_filename) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $imageQuery);
        mysqli_stmt_bind_param($stmt, "is", $itemId, $imageName);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Image inserted successfully: " . $imageName . "<br>";
        } else {
            echo "Failed to insert image: " . $imageName . "<br>";
        }
        
        mysqli_stmt_close($stmt);
    }

    // Redirect to data.php
    header("Location: ../home/index.php");
    exit(); // Make sure to exit after sending the header
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELLS PAGE</title>
    <link rel="stylesheet" href="../home/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="dist/image-uploader.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
        }

        .subcontainer {
            margin: auto;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0px 0px 3px black;
            height: 590px;
        }

        #home {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input-images-2 img {
            max-width: 100%;
            max-height: 300px;
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
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
    </ul>
  </div>

  <div class="dropdown">
    <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
      <img src="../image/profile.png" width="50" height="50" class="profile">
    </a>

    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="../profile/myprofile.php">My Profile</a></li>
      <li><a class="dropdown-item" href="#">My Purchases</a></li>
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

<div class="modal" tabindex="-1" id="submissionLimitModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submission Limit Reached</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
      </div>
      <div class="modal-body">
        <p>You have reached the maximum limit for submissions as a basic member.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Close</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
   

    <header>

    </header>

    <main>
        <section id="home">
            <h1>List Your Item</h1>
        </section>
        <br>
        <div class="container">
            <br>
                <div id="imagePreview" class="subcontainer" style="background: #FFEAEA; width: 550px;">
                <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="input-images">
                        <center>
                            <h2>Upload up to 6 Photos</h2>
                        </center>
                    </div>
                    <div class="input-field">
                        <div class="input-images-2" style="padding-top: .5rem; padding-bottom: .5rem;"></div>
                    </div>
                    <!-- Uploaded images will be displayed here -->
                </div>
                <br>
                <div class="subcontainer">
                    <label>Select Item Category:</label>
                    <select class="form-select form-select-sm" aria-label="Small select example" name="category" required>
                        <option value="null"> </option>
                        <option value="property"> <img src="../image/property.png"> Property</option>
                        <option value="vehicles"> <img src="../image/vehicle.png"> Vehicles</option>
                        <option value="electronics"> <img src="../image/electronic.png"> Electronics</option>
                        <option value="clothing"> <img src="../image/fashion.png">Clothing</option>
                        <option value="furniture"> <img src="../image/furniture.png"> Furniture</option>
                    </select>
                    <label>Condition</label>
                    <select class="form-select form-select-sm" aria-label="Small select example" name="item_condition" required>
                        <option value=""> </option>
                        <option value="New"> <img src="../image/property.png"> New </option>
                        <option value="Used - Like New"> <img src="../image/vehicle.png"> Used - Like New </option>
                        <option value="Used - Good"> <img src="../image/electronic.png"> Used - Good</option>
                        <option value="Used - fair"> <img src="../image/fashion.png">Used - fair</option>
                    </select>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder=""required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" id="location" placeholder="" required>
                    </div>
                    <input type="text" class="form-control" name="username" id="username" placeholder="" value="<?php echo $username ?>" hidden>
                    <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;"<?php if ($submissionLimitReached) echo 'disabled'; ?>>Create</button>
                </div>
            </form>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src="dist/image-uploader.min.js"></script>
        <script>
    $(document).ready(function() {
        // Check if the submission limit has been reached for basic members
        if (<?php echo json_encode($submissionLimitReached); ?>) {
            // Use JavaScript to trigger the modal
            $('#submissionLimitModal').modal('show');
        }

        $('.input-images-2').imageUploader({
            maxFiles: 6,
            imagesInputName: 'photos', // This should match the name attribute of the file input
            preloadedInputName: 'old'
        });

        // Input and label handler
        $('input').on('focus', function() {
            $(this).parent().find('label').addClass('active');
        }).on('blur', function() {
            if ($(this).val() == '') {
                $(this).parent().find('label').removeClass('active');
            }
        });
    });

    function closeModal() {
        // Redirect to index.php when closing the modal
        window.location.href = "../home/index.php";
    }
</script>
</body>
</html>
