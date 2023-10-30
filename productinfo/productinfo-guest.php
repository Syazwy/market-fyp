<?php
require '../connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../home/index.css">
    <link rel="stylesheet" href="prodInfoGuest.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>

.checked {
            color: orange;
        }

        .carousel-inner {
            background: white;
        }

        .carousel-item img {
            width: 600px;
            height: 400px;
        }

        .product-info.description {
            background: transparent;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            margin-left: 50px;
        }

        .product-info {
            width: 200px;
        }

        .itemdetail {
            background-color: white;
            width: 800px;
            height: 400px;
            margin-top: 40px;
            margin: auto;
        }

        .userdetail {
            background-color: #FFEAEA;
            width: auto;
            margin: auto;
            height: auto;
            border-radius: 40px;
            padding: 20px;
            margin-right: 250px;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn.btn-primary {
            background-color: #FF5353;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 18px;
            cursor: pointer;
            margin: 10px;
            height: 60px;
            width: 120px;
            font-size: 1.5em;
        }

        #wishlistButton {
            background-color: #FF5353;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 18px;
            cursor: pointer;
            margin: 10px;
            height: auto;
            width: 180px;
            align-self: flex-start;
        }

        .edit {
            background-color: #FF5353;
            color: #fff;
            border: none;
            padding: 20px;
            border-radius: 18px;
            font-size: 2em;
            margin: 10px;
            height: 100px;
            width: 100px;
            padding-bottom: 20px;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        h2 {
            font-size: 16px;
            margin: 10px 0;
        }

        .proInfo .btn {
            height: 65px;
            width: 120px;
            margin: 20px;
            font-size: 20px;
            border-radius: 18px;
        }

        h1 {
            font-size: 30px;
        }

        h5 {
            font-size: 20px;
        }

        .action-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .wishlist-button-container {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        body {
            font-family: Arial, sans-serif;
        }

        div {
            margin: 10px;
        }

        .rating {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .rating .fa {
            margin: 0 5px;
        }

        label {
            margin-right: 5px;
        }

        select {
            padding: 5px;
        }

        #products-list {
            display: flex;
            flex-wrap: wrap;
        }

        .product {
            width: 200px;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 5px;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #ffffff;
        }

        nav li {
            display: inline-block;
            margin: 0 10px;
        }

        nav li a {
            display: block;
            color: #000000;
            text-decoration: none;
            padding: 10px;
        }

        nav li a:hover {
            background-color: #ffb9b9;
        }

        .product-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin: auto;
            text-align: center;
            width: 1200px;
        }

        .product-info {
            flex: 1;
            padding: 0 20px;
            align-items: center;
            padding: 20px;
            width: 100px;
        }

        .product-info h1 {
            font-size: 24px;
            margin: 0;
        }

        .product-info p {
            margin: 10px 0;
        }

        .price {
            font-weight: bold;
        }

        #itemImages {
            width: 400px;
        }

        .user {
            width: 400px;
        }

        #secondhalf {
            display: flex;
            margin: auto;
        }

        .checked {
            color: orange;
        }

</style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-transparent">
    <div class="container">
        <a class="navbar-brand" href="../home/index.php">
            <img src="../image/logo.png" width="80" height="80">
        </a>
    </div>
</nav>
<main>
    <?php
    if (isset($_GET['id'])) {
        $itemId = $_GET['id'];

        $query = "SELECT itemslisting.*, item_images.image_filename 
                  FROM itemslisting 
                  JOIN item_images ON itemslisting.id = item_images.item_id 
                  WHERE itemslisting.id = $itemId";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="container1">
                <div class="product-container">
            <div id="carouselExampleIndicators" class="carousel slide w-100" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    // Fetch all associated images for this item
                    $imageQuery = "SELECT image_filename FROM item_images WHERE item_id = $itemId";
                    $imageResult = mysqli_query($conn, $imageQuery);
                    $numSlides = mysqli_num_rows($imageResult);
                    
                    for ($i = 0; $i < $numSlides; $i++) {
                    ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>"
                            <?php echo $i == 0 ? 'class="active" aria-current="true"' : ''; ?>
                            aria-label="Slide <?php echo $i + 1; ?>"></button>
                    <?php
                    }
                    ?>
                </div>
                <div class="carousel-inner">
                    <?php
                    $first = true;
                    while ($imageRow = mysqli_fetch_assoc($imageResult)) {
                    ?>
                        <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                            <img src="../sellers/upload/<?php echo $imageRow['image_filename']; ?>">
                        </div>
                    <?php
                        $first = false;
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="" style="color: black;">&lt; Previous</span>
                </button>
                <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="" style="color: black;">Next &gt;</span>
                </button>
            </div>
        </div>
            </div>
            <br>
            <br>
            <div id="secondhalf">
                <div class="itemdetail">
                    <br>
                    <h1 style="font: size 60px;font-weight:thin"><?php echo $row["name"]; ?></h1>
                    <h2 style="font: size 20px;font-weight:bolder">$<?php echo $row["price"]; ?></h2>
                    <br>
                    <h3>Condition: </h3>
                    <h5><?php echo $row["item_condition"]; ?></h5>
                    <br>
                    <h3>Description:</h3>
                    <h5><?php echo $row["description"]; ?></h5>
                    <br>
                </div>
                <center>
                    <?php
                    $username = $row["username"];
                    if ($conn->connect_error) {
                        die('Connection Failed: ' . $conn->connect_error);
                    }
                    $reviewResult = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews WHERE users = '$username'");
                    if ($reviewResult->num_rows > 0) {
                        $reviewRow = $reviewResult->fetch_assoc();
                        $averageRating = $reviewRow['avg_rating'];
                        $totalReviews = $reviewRow['total_reviews'];
                        function generateStarRating($rating) {
                            $output = '';
                            for ($i = 1; $i <= 5; $i++) {
                                if (isset($rating) && $i <= ceil($rating)) {
                                    $output .= '<i class="fa fa-star checked"></i>';
                                } else {
                                    $output .= '<i class="fa fa-star"></i>';
                                }
                            }
                            return $output;
                        }
                        echo '<div class="userdetail">';
                        echo '<br>';
                        $sellerimg = isset($row['profile_image']) ? $row['profile_image'] : null;
                        if (isset($sellerimg) && $sellerimg != null) {
                            echo '<h2 style="font-size:20px;font-weight:thin"><img src="../profile/' . $sellerimg . '" width="60px" height="60px" class="profile rounded-circle" alt="Profile Picture">' . " " . $row["username"] . ' (' . $totalReviews . ' reviews)' .
                                '<small>' .
                                generateStarRating($averageRating) .
                                '<small></h2>';
                        } else {
                            echo '<h2 style="font-size:20px;font-weight:thin"><img src="../image/profile.png" width="60px" height="60px" class="profile rounded-circle" alt="Profile Picture">' . " " . $row["username"] . ' (' . $totalReviews . ' reviews)' .
                                '<small>' .
                                generateStarRating($averageRating) .
                                '<small></h2>';
                        }
                        echo '<br>';
                        echo '<h2><img src="../image/location-outline.svg" alt="" width="50" height="50">' . $row["location"] . '</h2>';
                    } else {
                        echo '- No reviews available.';
                    }
                    echo '</div>';
                    ?>
                </center>
            </div>
        <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Product ID not specified.";
    }
    ?>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
<?php if (!empty($errorMessage)) : ?>
    <script>
        alert("<?php echo $errorMessage; ?>");
    </script>
<?php endif; ?>
</body>
</html>
