
<?php
require '../connection/connection.php';

$query = "SELECT * FROM `account` ORDER BY Id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
} else {
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="admincss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .hidden-row {
    background-color: #242020; /* Gray background color */
    color:white;
}

    </style>
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
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../login-register/register.php">Register</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../login-register/login.php">Login</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Sell</a></li>
  
    </ul>
    </div>
  </div>
</nav>

<div class="profile-container">
        <div class="profile-picture">
            <img src="image/admin.png" alt="Profile Picture">
        </div>
        <div class="admin">
        <h1>Admin</h1>
        </div>
</div>

    <br>


          
    <div class="container">

    <div class="justify-content-center">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="admin.php">Overview</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="admin_2.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Appeals</a></li>
        </ul>
    </div>

    <br>

    <div class="row row-cols-1 row-cols-md-1 g-4">


      <div  class="col border1">
      
                <table  cellspacing = 0 cellpadding = 10>

                

                    <tr>
                        <td><img src="image/Tommy.jpeg" height="50px"></td>
                        <td><h1><?php echo $row["username"]; ?></h1></td>
                    </tr>

                    <tr>
                        <td>#ID</td>
                        <td>Username</td>
                        <td>Email</td>                      
                        <td>Membership</td>
                        <td>Date Joined</td>
                        <td>Date Verified</td>
                        
                    </tr>

                  

                      <tr>
                          <td><?php echo $row["id"]; ?></td>
                          <td><?php echo $row["username"]; ?></td>
                          <td><?php echo $row["email"]; ?></td>                        
                          <td><?php echo $row["membership"]; ?></td>
                          <td><?php echo $row["date"]; ?></td>
                          <td><?php echo $row["email_verified_at"]; ?></td>
                          
                          
                      </tr>



                      <tr>
                          <td>#Item ID</td>
                          <td>Image</td>
                          <td>Name</td>                        
                          <td>Categories</td>
                          <td>Description</td>
                          <td>Price</td>   
                          <td>Location</td>                      
                      </tr>

                      <?php
                        $i = 1;
                        $query = "SELECT itemslisting.*, MAX(item_images.image_filename) AS image_filename, MAX(itemslisting.name) AS name, MAX(itemslisting.category) AS category, MAX(itemslisting.description) AS description, MAX(itemslisting.price) AS price, MAX(itemslisting.location) AS location
                                FROM itemslisting
                                JOIN item_images ON itemslisting.id = item_images.item_id
                                GROUP BY itemslisting.id
                                ORDER BY itemslisting.id DESC";
                        $result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) :
?>

<tr <?php if ($row["status"] == 'hidden') echo 'class="hidden-row"'; ?>>
    <td><?php echo $row["id"]; ?></td>
    <td><img src="../sellers/upload/<?php echo $row['image_filename']; ?>" width="100px" height="100px" class="POP"></td>
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["category"]; ?></td>
    <td><?php echo $row["description"]; ?></td>
    <td><?php echo $row["price"]; ?></td>
    <td><?php echo $row["location"]; ?></td>
    <?php if ($row["status"] == 'hidden') : ?>
        <td><a href="remove_2.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to unhide this item?')">Unhide</td>
    <?php else : ?>
        <td><a href="remove_3.php?id=<?php echo $row["id"]; ?>" class="btn btn-success" onclick="return confirm('Are you sure you want to hide this item?')">Hide</td>
    <?php endif; ?>
</tr>
<?php endwhile; ?>


                </table>
        
      
      </div>
    </div>
    </div>


        

    

  
        






</body>
</html>