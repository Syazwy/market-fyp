<?php
session_start();
require '../connection/connection.php';
include '../home/register.php';
include '../home/verification.php';
include '../home/login.php';
// include 'forgot.php';

// Check if a message parameter is present in the URL
if (isset($_GET["message"])) {
    $message = urldecode($_GET["message"]);
    // Use JavaScript to display the message as an alert
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>
    <link rel="stylesheet" href="forgot/forgot.css">
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
a.nav-link.active {
    background-color: #FF5353 !important;
    margin-right: 20px;
    border-radius: 18px;
    width: 150px;
    text-align: center;
  }

  button.nav-link.active {
    background-color: #FF5353 !important;
    margin-right: 20px;
    border-radius: 18px;
    width: 150px;
    text-align: center;
    border: none;
  }

  .imagecat{
    height: 20px;
    width: 20px;
    
  }
  .search {
    margin: auto;
    width: 80%;
    padding: 20px;
  }

  .margin{
    padding-top: 20px;
  }

  .searchbar {
    width: 100%;
    height: 30px;
    border-radius: 18px;
    border: none;
    background-color: #FFEAEA;
    margin-right: 15px;
    margin: auto;
  }
  .sidesearchbar {
    width: 100%;
    height: 40px;
    /* border-radius: 18px; */
    border: none;
    background-color: #ffffff;
    /* margin-left: 15px; */
    margin: auto;
  }

  .btn.btn-primary {
    background-color: #FF5353;
    border-radius: 18px;
    border: none;
    width: 200px;
  }

  h4 {
    margin: auto;
    width: 80%;
    padding: 20px;
  }

  .card {
    width: 50px;
    height: 50px;
    
  }
  
  img.image {
    width: 100px;
    height: 100px;
    /* display: block; */
    /* margin-left: auto;
    margin-right: auto; */
    margin-top: 15%;
  }

  div.card {
    width: 150px;
    height: 150px;
    background-color: #FFEAEA;
    border: none;
  }

  div.card-header.bg-transparent.border.border-0 {
    background-color: #FFFFFF !important;
    padding: 0px;
    padding-top: 16px;
  }

  div.card-body {
    width: 150px;
    height: 150px;
    background-color: #FFFFFF !important;
    padding: 0px;
    padding-top: 16px;
  }

  div.text {
    position: absolute;
    top: 50%;
    left: 50%;
  }



</style>

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="../home/index-guest.php">
                <img src="../image/logo.png" width="80" height="80">
            </a>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button" aria-controls="offcanvasRight">Categories</a></li>
                    <li class="nav-item"><button class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#registerModal" data-whatever="register">Register</button></li>
                    <li class="nav-item"><button class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#loginModal" data-whatever="login">Login</button></li>
                    <li class="nav-item">
                        <a id="sellLink" class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#sellModal">Sell</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- The Bootstrap Modal for Banned Users -->
    <div class="modal fade" id="bannedModal" tabindex="-1" role="dialog" aria-labelledby="bannedModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <center>
                <div class="modal-header">
                    <h5 class="modal-title" id="bannedModalLabel">Account Banned</h5>   
        </div>
                    </center>
                <div class="modal-body">
        <p>Your account has been banned. You can submit an appeal below:</p>
        <p></p>
        <form id="appealForm" method="post" action="process_appeal.php">
          <input type="hidden" name="username" value="<?php echo $user->username; ?>">
          <div class="form-group">
            <label for="appealText">Appeal Message:</label>
            <textarea class="form-control" id="appealText" name="appeal" rows="4" required></textarea>
                        </div>
                        <br>
          <center>
          <button type="submit" class="btn btn-primary">Submit Appeal</button>
          </center>        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" style="border: none;">
                    <h3 class="modal-title d-flex justify-content-center text-center" id="registerModalLabel">Create Account</h3>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" onsubmit="return validateForm();">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            <label for "email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                            <label for="confirmPassword">Confirm Password</label>
                        </div>
                        <br>
                        <input type="submit" name="register" value="Create" class="btn btn-primary" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Modal -->
    <div class="modal fade" id="verificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="text-align: center;">
                        <img src="../image/email.png" alt="mail logo" style="width: 70px;">
                        <h4>Verify your email address</h4>
                        <h5 class="modal-title" id="exampleModalLabel">
                            Please enter the 6-digit code sent to
                            <span style="color: #FF5353;"><?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?></span>
                        </h5>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
                            <input type="text" class="form-control" name="verification_code" id="verification_code" placeholder="Enter verification code" required />
                            <br>
                            <div style="text-align: center;">
                                <input type="submit" name="verify_email" value="Verify" style="background-color:#FF5353 ; width: 50%; border-radius: 10px; padding: 5px;">
                            </div>
                        </div>
                    </form>
                </div>
                <div style="text-align: center;">
                    <a id="changeemail" style="text-decoration:none;color: #FF5353; cursor: pointer;" href="index-guest.php?show_register_modal=1">Change Email</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Verified modal -->
    <div class="modal fade" id="verifiedModal" tabindex="-1" role="dialog" aria-labelledby="verifiedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 400px;">
                <div class="modal-body">
                    <center>
                        <img src="../image/check.png" alt="" style="width: 100px;">
                        <br>
                        <p></p>
                        <h3>Verified!</h3>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center" style="border: none;">
                    <h3 class="modal-title d-flex justify-content-center text-center" id="loginModalLabel">Login</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: 1px solid white;background-color:white">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="emailOrUsername" name="emailOrUsername" placeholder="Email or Username" required>
                            <label for="emailOrUsername">Email or Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <br>
                        <center>
                            <p><a class="active" aria-current="page" data-toggle="modal" data-target="#forgotModal" data-whatever="login" href="forgot.php" id="" style="color: rgb(255, 83, 83);">Forgot password?</a></p>
                        </center>
                        <input type="submit" name="login" value="Log In" style="background-color: rgb(255, 83, 83); width: 100%; border-radius: 10px; padding: 10px;">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sell Modal -->
    <div class="modal fade" id="sellModal" tabindex="-1" aria-labelledby="sellModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>Please log in or create an account first.</h3>
                </div>
            </div>
        </div>
    </div>

<!-- Categories -->
<div class="offcanvas offcanvas-end catcol" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="background-color: #ffd7d7; padding: 20px;">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="offcanvasRightLabel"><b>All Categories</b></h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <ul class="list-group list-group-flush" style="background-color: #ffd7d7;">
        <li class="list-group-item" style="background-color: #ffd7d7; border: none;"><a id="property" class="list-group-item list-group-item-action" style="border: none; background-color: #ffd7d7" data-bs-dismiss="offcanvas">
                <h6><img class="image imagecat" src="../image/property.png" alt="" style="width: 60px;height:60px;margin-bottom:20px;margin-right:90px;"> Property
                </h6></a>
        </li>

        <li class="list-group-item" style="background-color: #ffd7d7; border: none;"><a id="vehicle" class="list-group-item list-group-item-action" style="border: none; background-color: #ffd7d7" data-bs-dismiss="offcanvas">
                <h6><img class="image imagecat" src="../image/vehicle.png" alt="" style="width: 60px;height:60px;margin-bottom:20px;margin-right:90px;"> Vehicle
                </h6></a>
        </li>

        <li class="list-group-item" style="background-color: #ffd7d7; border: none;"><a id="furniture" class="list-group-item list-group-item-action" style="border: none; background-color: #ffd7d7" data-bs-dismiss="offcanvas">
                <h6><img class="image imagecat" src="../image/furniture.png" alt="" style="width: 60px;height:60px;margin-bottom:20px;margin-right:90px;"> Furniture
                </h6></a>
        </li>

        <li class="list-group-item" style="background-color: #ffd7d7; border: none;"><a id="electronic" class="list-group-item list-group-item-action" style="border: none; background-color: #ffd7d7" data-bs-dismiss="offcanvas">
                <h6><img class="image imagecat" src="../image/electronic.png" alt="" style="width: 60px;height:60px;margin-bottom:20px;margin-right:90px;"> Electronic
                </h6></a>
        </li>

        <li class="list-group-item" style="background-color: #ffd7d7; border: none;"><a id="clothing" class="list-group-item list-group-item-action" style="border: none; background-color: #ffd7d7" data-bs-dismiss="offcanvas">
                <h6>
                    <img class="image imagecat" src="../image/fashion.png" alt="" style="width: 60px;height:60px;margin-bottom:20px;margin-right:90px;"> Clothing
                </h6></a>
        </li>
    </ul>
    <br>
</div>

    <!-- SEARCH INPUT -->
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
                        <a data-category="Property">
                            <img class="image" src="../image/property.png" alt="">
                        </a>
                        <p>Property</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <a data-category="Vehicle">
                            <img class="image" src="../image/vehicle.png" alt="">
                        </a>
                        <p>Vehicle</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <a data-category="Furniture">
                            <img class="image" src="../image/furniture.png" alt="">
                        </a>
                        <p>Furniture</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <a data-category="Electronic">
                            <img class="image" src="../image/electronic.png" alt="">
                        </a>
                        <p>Electronic</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <a data-category="Clothing">
                            <img class="image" src="../image/fashion.png" alt="">
                        </a>
                        <p>Clothing</p>
                    </div>
                </div>
            </div>
        </div>
    </center>

    <div>
        <br>
        <h4 id="sectionTitle">Newly Listed</h4>
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
          ORDER BY itemslisting.id DESC";

          $result = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($result)) :
              $uploadedAt = strtotime($row["uploaded_at"]);
              $currentTime = time();
              $timeDiff = $currentTime - $uploadedAt;
              $sellerid = $row['id'];
              $item_image = $row['image_filename'];
              $id = $row['id'];
              $profileimage = "SELECT * FROM account WHERE id = '$id'";
              $profileResult = $conn->query($profileimage);
              $profileimage = $profileResult->fetch_assoc();
              $sellerimg = isset($profileimage['profile_image']) ? $profileimage['profile_image'] : NULL;

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
                            <div class="row row-cols-1 row-cols-md-2 g-4"  style="padding-bottom: 10px;">
                                <div class="col col-lg-3">
                                    <a href="">
                                        <?php
                                        if (isset($row['profile_image']) && $row['profile_image'] != null) {
                                            echo '<img src="../profile/' . $row['profile_image'] . '" width="40" height="40" class="profile rounded-circle" alt="Profile Picture">';
                                        } else {
                                            echo '<img src="../image/profile.png" width="40" height="40" class="profile rounded-circle" alt="Profile Picture">';
                                        }
                                        ?>
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
                            <img src="../sellers/upload/<?php echo $item_image; ?>" class="card-img-top" width="150px" height="150px">
                        </a>
                        <div class="card-body">
                            <p class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></p>
                            <h5 class="card-title"><b><?php echo "BND$" . $row["price"]; ?></b></h5>
                            <p class="card-text" style="text-transform: capitalize"><small class="text-body-secondary"><?php echo $row["item_condition"]; ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endwhile;  ?>
        </div>

        <!-- Search Results Section -->
        <div id="searchResults" class="row row-cols-1 row-cols-md-5 g-4">
            <!-- Search results will be displayed here -->
        </div>
    </div>
    
    <!-- JavaScript for handling the search -->
    <script>
        $(document).ready(function() {
            // Function to display search results and toggle item visibility
            function displaySearchResults(query) {
                var url = "../home/search-guest.php";
                var data = {
                    query: query
                };
                $.ajax({
                    type: "GET",
                    url: url,
                    data: data,
                    success: function(response) {
                        // Hide newly listed items
                        $(".card.item.h-100").hide();
                        // Display search results
                        $("#searchResults").html(response).show();
                        // Update the section title
                        $("#sectionTitle").text("Searched Item");
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
                    // Restore the section title
                    $("#sectionTitle").text("Newly Listed");
                }
            }

            // Automatically update search results as the user types
            $("#searchInput").on("input", handleSearchInput);
        });
    </script>

    <!-- JavaScript for handling the category clicks -->
    <script>
    $(document).ready(function() {
        // Function to handle category clicks and filter listings
        function handleCategoryClick(category) {
            var url = "../home/category-guest.php";
            var data = { category: category };

            $.ajax({
                type: "GET",
                url: url,
                data: data,
                success: function(response) {
                    // Hide newly listed items
                    $(".card.item.h-100").hide();

                    // Display category-specific results
                    $("#searchResults").html(response).show();

                    // Update the section title
                    $("#sectionTitle").text("Category: " + category);
                }
            });
        }

        // Event handler for category clicks
        $("#property").click(function() {
            handleCategoryClick("Property");
        });

        $("#vehicle").click(function() {
            handleCategoryClick("Vehicle");
        });

        $("#furniture").click(function() {
            handleCategoryClick("Furniture");
        });

        $("#electronic").click(function() {
            handleCategoryClick("Electronic");
        });

        $("#clothing").click(function() {
            handleCategoryClick("Clothing");
        });

        // Event handler for category clicks
        $("a[data-category]").click(function() {
            var category = $(this).data("category");
            handleCategoryClick(category);
        });
    });
    </script>

<script>
$(document).ready(function() {
    // Check if the email parameter is present in the URL
    var emailParam = "<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>";
    console.log("Email parameter from URL: " + emailParam);

    // Check if emailParam is not empty before showing the modal
    if (emailParam) {
        $("#verificationModal").modal("show"); // Show the verification modal
    }
});
</script>

<script>
    // Function to check the URL parameters
    function getURLParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Check if the 'verified' parameter is set to 1
    const verifiedParam = getURLParameter('verified');
    if (verifiedParam === '1') {
        $(document).ready(function() {
            $("#verifiedModal").modal("show"); // Show the 'verifiedModal'
        });
    }
</script>

    <script type="text/javascript">
        // Check if a message parameter is present in the URL
        if (window.location.search.indexOf('message') > -1) {
            var message = decodeURIComponent(window.location.search.split('message=')[1].replace(/\+/g, ' '));
            alert(message);
            // Clear the message parameter from the URL
            var newURL = window.location.href.replace(/\?message=.*$/, "");
            history.replaceState(null, document.title, newURL);
        }
    </script>

    <script>
        $(document).ready(function() {
            // Handle the click event on the "Sell" link
            $("#sellLink").click(function(e) {
                e.preventDefault();
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
session_destroy();
?>
