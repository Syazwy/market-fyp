<?php
require_once("../session/session.php");
require '../connection/connection.php';

$username = $_SESSION['username'];
$query = "SELECT * FROM account WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $accountStatus = $row['status'];
        $name = $row['username'];
        $id = $row['id'];
    }
} else {
    die("Query Failed: " . mysqli_error($conn));
}

// Close the result and database connection
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
<!-- NAV BAR -->
<nav class="navbar navbar-expand-lg bg-transparent">
    <div class="container">
        <a class="navbar-brand" href="../home/index.php">
            <img src="../image/logo.png" width="80" height="80">
        </a>

        <div class="collapse navbar-collapse justify-content-center">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" aria-current="page" data-bs-toggle="offcanvas"
                                      href="#offcanvasRight" role="button" aria-controls="offcanvasRight">Categories</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="../wishlist/wishlist.php">Wishlist</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php">Sell</a></li>
            </ul>
        </div>

        <?php echo "Hello,&nbsp<b style=\"text-transform: capitalize;\"> " . $username . "</b>"; ?>
        
        <div class="dropdown">
            <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
               style="border: none;">
                <?php
                $profileimage = "SELECT * FROM account WHERE id = '$id'";
                $result = $conn->query($profileimage);
                while ($profileimage = $result->fetch_assoc()) {
                    $pimage = $profileimage['profile_image'];
                }
                if (isset($pimage)) {
                    echo '<img src="../profile/' . $pimage . '" width="50" height="50" class="profile rounded-circle"
                             alt="Profile Picture">';
                } else {
                    echo '<img src="../image/profile.png" width="50" height="50" class="profile rounded-circle"
                             alt="Profile Picture">';
                }
                ?>
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../profile/myprofile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="../myPurchases/myPurchases.php">My Purchases</a></li>
                <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
                <li><a class="dropdown-item" href="../privatemessage/myChat.php">Messages</a></li>
                <li><a class="dropdown-item" href="index-guest.php" onclick="return confirm('Are you sure you want to logout?')">Log out</a></li>
            </ul>
        </div>
    </div>
</nav>

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


<!-- Search Bar and Button -->
<div class="search">
    <input class="searchbar" type="text" id="searchInput" placeholder="Search for anything" style="padding-left: 20px;">
</div>

<!-- "What would you like to find?" Section -->
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

<!-- Newly Listed Section -->
<div>
    <br>
    <h4 id="sectionTitle">Newly Listed</h4>
</div>

<!-- Newly Listed Items Section -->
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
            $uploadedAt = strtotime($row["uploaded_at"]); // Convert uploaded_at datetime to a timestamp
            $currentTime = time(); // Current time timestamp
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
                        <div class="row row-cols-1 row-cols-md-2 g-4" style="padding-bottom: 10px;">
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
                    <a href="../productinfo/productinfo.php?id=<?php echo $row["id"]; ?>">
                        <img src="../sellers/upload/<?php echo $item_image; ?>" class="card-img-top" width="150px" height="150px">
                    </a>
                    <div class="card-body">
                        <p class="card-title" style="text-transform: capitalize"><?php echo $row["name"]; ?></p>
                        <h5 class="card-title"><b><?php echo "BND$" . $row["price"]; ?></b></h5>
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

    <div class="col d-flex align-items-center justify-content-center">
        <div class="card item h-100" data-category="<?php echo $row['category']; ?>">
            <!-- Your card content -->
        </div>
    </div>
</div>

<!-- JavaScript for handling the search -->
<script>
    $(document).ready(function () {
        // Function to display search results and toggle item visibility
        function displaySearchResults(query) {
            var url = "search.php";
            var data = {query: query};

            $.ajax({
                type: "GET",
                url: url,
                data: data,
                success: function (response) {
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
        var url = "category.php";
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

</body>
</html>
