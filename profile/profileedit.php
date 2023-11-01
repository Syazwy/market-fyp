<?php
require '../connection/connection.php';
session_start();
// Get the user's ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
// Retrieve the user's profile image from the database
$query = "SELECT * FROM `account` WHERE `id` = '$id'";
$result = mysqli_query($conn, $query);
if ($result) {
    while($row = $result -> fetch_assoc()){
        $username = $row['username'];
    }
}
// Handle the image upload and database update here
if (isset($_FILES['newProfileImage'])) {
    // Define the folder where uploaded images will be stored
    $uploadDir = 'profileimage/';
    // Create the folder if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    // Generate a unique filename for the uploaded image
    $newProfileImage = $uploadDir . uniqid() . '_' . $_FILES['newProfileImage']['name'];
    // Move the uploaded image to the folder
    if (move_uploaded_file($_FILES['newProfileImage']['tmp_name'], $newProfileImage)) {
        // Update the user's profile image in the database
        $query = "UPDATE `account` SET `profile_image` = '$newProfileImage' WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);
        $query2 = "UPDATE `itemslisting` SET `profile_image` = '$newProfileImage' WHERE `username` = '$username'";
        $result2 = mysqli_query($conn, $query2);
        if (!$result) {
            die("Query Failed: " . mysqli_error($conn));
        }
        
        // Call the JavaScript function to update the profile image on the page
        echo '<script>updateProfileImage("' . $newProfileImage . '");</script>';
    }
    // Redirect back to the same URL with the ID retained
    header('Location: profileedit.php?id=' . $id);
    exit();
}
?>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "SELECT * FROM `account` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }else{
        $row = mysqli_fetch_assoc($result);
    }
}
?>
<?php
require '../connection/connection.php';
if (isset($_POST['submit'])) {
    $Nusername = $_POST['username'];
    $Nemail = $_SESSION['email'];
    $Npassword = $_POST['newPassword']; // Get the new password from the form
    // Hash the new password
    $hashedPassword = password_hash($Npassword, PASSWORD_DEFAULT);
    try {
        mysqli_begin_transaction($conn);
    
        // Update the 'account' table
        if ($Npassword) {
            $query = "UPDATE `account` SET `username` = '$Nusername', `email` = '$Nemail', `password` = '$hashedPassword' WHERE `username` = '" . $_SESSION['username'] . "'";
        } else {
            $query = "UPDATE `account` SET `username` = '$Nusername', `email` = '$Nemail' WHERE `username` = '" . $_SESSION['username'] . "'";
        }
        $result = mysqli_query($conn, $query);
        if (!$result) {
            throw new Exception("Query Failed: " . mysqli_error($conn));
        } else {
            
        }
    
        $tablesToUpdate = ['appeals', 'itemslisting', 'reportbyusers', 'reviews', 'chat'];
        foreach ($tablesToUpdate as $table) {
            if ($table === 'chat') {
                // For the 'chat' table, update 'sender' and 'receiver' columns
                $query = "UPDATE `$table` SET `sender` = '$Nusername' WHERE `sender` = '" . $_SESSION['username'] . "'";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    throw new Exception("Query Failed: " . mysqli_error($conn));
                }
        
                $query = "UPDATE `$table` SET `receiver` = '$Nusername' WHERE `receiver` = '" . $_SESSION['username'] . "'";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    throw new Exception("Query Failed: " . mysqli_error($conn));
                }
            } else {
                // For other tables, update the 'username' column
                $query = "UPDATE `$table` SET `username` = '$Nusername' WHERE `username` = '" . $_SESSION['username'] . "'";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    throw new Exception("Query Failed: " . mysqli_error($conn));
                }
        
                // For the 'reviews' table, update the 'users' column
                if ($table === 'reviews') {
                    $query = "UPDATE `$table` SET `users` = '$Nusername' WHERE `users` = '" . $_SESSION['username'] . "'";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        throw new Exception("Query Failed: " . mysqli_error($conn));
                    }
                }
            }
        }
        
        
        $_SESSION['username'] = $Nusername;
        $username =  $_SESSION['username'];
        // echo $username;
    
        echo '<script>alert("Profile information has been updated.");</script>';
        mysqli_commit($conn);
   // After the profile information is successfully updated, show the modal
} catch (Exception $e) {
    // Roll back the transaction if any query fails
    mysqli_rollback($conn);
    echo "Transaction failed: " . $e->getMessage();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Edit</title>
    <link rel="stylesheet" href="profilecss_1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
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
        <?php echo "Hello,&nbsp<b style=\"text-transform: capitalize;\"> " . $username . "</b>"; ?>
        
        <div class="dropdown">
    <a href="#" class="btn" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
        <?php
        if (isset($row['profile_image'])) {
            echo '<img src="' . $row['profile_image'] . '" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
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
<div class="profile-container">
    <div class="profile-picture">
        <a href="#" data-bs-toggle="modal" data-bs-target="#changeProfileImageModal">
            <?php
            if (isset($row['profile_image'])) {
                echo '<img id="profileImage" src="' . $row['profile_image'] . '" alt="Profile Picture">';
            } else {
                echo '<img id="profileImage" src="../image/profile.png" alt="Profile Picture">';
            }
            ?>
        </a>
    </div>
</div>
<br>
<div class="container">
    <div class="row row-cols-1 row-cols-md-1 g-4">
        <div class="col border1">
        <form action="profileedit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $username ;?>">
            </div>
            <div class="mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <div class="input-group">
                <input type="password" class="form-control" name="newPassword" id="newPassword">
                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('newPassword')">
                    <i class="bi bi-eye">Show password</i> <!-- This is a sample icon; you can use your own icon or text -->
                </button>
            </div>
        </div>
            <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px; color: white ;" onclick="modalUpdated()">Confirm</button>
        </form>
        </div>
    </div>
</div>
<!-- Profile Picture Modal -->
<div class="modal fade" id="changeProfileImageModal" tabindex="-1" aria-labelledby="changeProfileImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeProfileImageModalLabel">Change Profile Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add a form to upload a new profile image -->
                <form action="profileedit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="newProfileImage" class="form-label">Select Image</label>
                        <input type="file" class="form-control" name="newProfileImage" id="newProfileImage">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<script>
function togglePasswordVisibility(inputId) {
    const passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text"; // Change to text to reveal the password
    } else {
        passwordInput.type = "password"; // Change back to password to hide the password
    }
}
</script>

<script>
function updateProfileImage(newImageSrc) {
    var profileImage = document.getElementById('profileImage');
    profileImage.src = newImageSrc;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>