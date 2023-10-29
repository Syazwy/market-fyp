<?php 
require '../connection/connection.php';
require_once("../session/session.php");

$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
    // Existing code...

    $Ncategory = $_POST['category'];
    $Nname = $_POST['name'];
    $Nprice = $_POST['price'];
    $Ndescription = $_POST['description'];
    $Nlocation = $_POST['location'];

    if ($Ncategory !== $_POST['originalCategory']) {
        // Update the category in the database
        $query = "UPDATE `itemslisting` SET `category` = '$Ncategory' WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query Failed: " . mysqli_error($conn));
        }
    }

 $query = "SELECT * FROM account WHERE username = '$username'";
 $result = mysqli_query($conn, $query);

 
if ($result) {
  while($row = $result->fetch_assoc()){
    $accountStatus = $row['status'];
    $name =  $row['username'];
    $profileimage = $row['profile_image'];
   }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="profilecss_1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
</head>
<body>

<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="../home/index.php">
      <img src="../image/logo.png" width="80" height="80">
    </a>

    <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../wishlist/wishlist.php ">Wishlist</a></li>
    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php">Sell</a></li>
    </ul>
    </div>

    <?php echo "Hello,&nbsp<b style=\"text-transform: capitalize;\"> " . $username . "</b>"; ?>
        
    <div class="dropdown">
    <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
    <?php 
      if (isset($profileimage)) {
            echo '<img src="../profile/' .$profileimage . '" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
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
        <?php 
      if (isset($profileimage)) {
            echo '<img src="../profile/' .$profileimage . '" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
        } else {
            echo '<img src="../image/profile.png" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
        }
        ?>
        </div>
</div>

<?php


if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "SELECT * FROM `itemslisting` WHERE `id` = '$id'";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }else{
        $row = mysqli_fetch_assoc($result);
    }

}


?>

<?php 

if(isset($_POST['submit'])){

    if(isset($_GET['id_new'])){
        $idnew = $_GET['id_new'];
    }

    $Ncategory = $_POST['category'];
    $Nname = $_POST['name'];
    $Nprice = $_POST['price'];
    $Ndescription = $_POST['description'];
    $Nlocation = $_POST['location'];

    

    $query = "update `itemslisting` set `category` = '$Ncategory', `name` = '$Nname', `price` = '$Nprice', `description` = '$Ndescription', `location` = '$Nlocation'
     where `id` = '$idnew'";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }

    else {
        header('location:myprofile.php?update_msg=You have successfully update the data.');
    }
    
}

?>
<br>

<div class="container">

<div class="row row-cols-1 row-cols-md-1 g-4">


      <div  class="col border1">
        

<form action="profile_edit_item.php?id_new=<?php echo $id; ?>" method="post" autocomplete="off" enctype="multipart/form-data">

    
    <div class="subcontainer">
        <label>Select Item Category</label>
        <select class="form-select form-select-sm" name="category" id="category" aria-label="Small select example">
    <option value="property" <?php if ($row['category'] === 'property') echo 'selected'; ?>>Property</option>
    <option value="vehicles" <?php if ($row['category'] === 'vehicles') echo 'selected'; ?>>Vehicles</option>
    <option value="electronics" <?php if ($row['category'] === 'electronics') echo 'selected'; ?>>Electronics</option>
    <option value="clothing" <?php if ($row['category'] === 'clothing') echo 'selected'; ?>>Clothing</option>
    <option value="furniture" <?php if ($row['category'] === 'furniture') echo 'selected'; ?>>Furniture</option>
</select>
<input type="hidden" name="originalCategory" value="<?php echo $row['category']; ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>">
        </div>
        </div>
        <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" name="price" id="price" placeholder="<?php echo isset($row['price']) ? $row['price'] : ''; ?>" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>" required pattern="^(?!0+$)\d{1,6}(\.\d{1,2})?$">
</div>


    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3"><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea>
    </div>
    
    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" name="location" id="location" placeholder="<?php echo isset($row['location']) ? $row['location'] : ''; ?>" value="<?php echo isset($row['location']) ? $row['location'] : ''; ?>">
    </div>


    
    <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;">Submit</button>
</form>
      </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const priceInput = document.getElementById("price");
    const submitButton = document.querySelector("button[name='submit']");

    priceInput.addEventListener("input", function () {
        const price = parseFloat(priceInput.value);

        if (price < 1 || price > 999999) {
            priceInput.setCustomValidity("Price must be between 1 and 999,999");
        } else {
            priceInput.setCustomValidity("");
        }
    });

    submitButton.addEventListener("click", function (event) {
        if (priceInput.checkValidity() === false) {
            event.preventDefault();
        }
    });
});
</script>


<script>
function updateCategory(selectElement) {
    const originalCategoryInput = document.querySelector("input[name='originalCategory']");
    originalCategoryInput.value = originalCategoryInput.value || selectElement.value;
}
</script>


</body>
</html>
