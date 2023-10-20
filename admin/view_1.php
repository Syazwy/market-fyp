<?php
require '../connection/connection.php';

$email = $_GET['email'];

// Check if the 'email' parameter exists in the URL
if (isset($_GET['email'])) {
    // Retrieve the 'email' from the URL and sanitize it
    $desiredEmail = mysqli_real_escape_string($conn, $email);

    // Use prepared statements to safely include the email in the SQL query
    $query = "SELECT * FROM `account` WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $query)) {
        // Bind the email parameter to the query
        mysqli_stmt_bind_param($stmt, "s", $desiredEmail);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                // Your code to display user information
            } else {
                echo "User not found"; // If the email doesn't match any user
            }
        } else {
            die("Query Failed: " . mysqli_error($conn));
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        die("Statement Preparation Failed: " . mysqli_error($conn));
    }
} else {
    echo "No 'email' parameter provided in the URL";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #000;
    }
    

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr.hidden-row {
        background-color: #3C3636;
        color: white;
    }

    .POP {
        max-width: 100px;
        max-height: 100px;
    }

    .border1 {
        border: 1px solid #000;
        padding: 10px;
        margin: 10px;
    }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../image/logo.png" width="80" height="80">
    </a>
    <div class="collapse navbar-collapse">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../home/index-guest.php" id="logout-link">Logout</a></li>
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
        <center>
      <td><h1><?php echo $row["username"]; ?></h1></td>
      </center>
                <table  cellspacing = 0 cellpadding = 10>

                



            


                      <tr>
                          <td>#Item ID</td>
                          <td>Image</td>
                          <td>Name</td>                        
                          <td>Categories</td>
                          <td>Description</td>
                          <td>Price</td>   
                          <td>Location</td>       
                          <td>Action</td>                      
                      </tr>

                      <?php
                        $i = 1;
                        $query = "SELECT itemslisting.*, MAX(item_images.image_filename) AS image_filename, MAX(itemslisting.name) AS name, MAX(itemslisting.category) AS category, MAX(itemslisting.description) AS description, MAX(itemslisting.price) AS price, MAX(itemslisting.location) AS location
                        FROM itemslisting
                        JOIN item_images ON itemslisting.id = item_images.item_id
                        WHERE itemslisting.email = '$email' 
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
    <td><?php echo "$" . $row["price"]; ?></td>
    <td><?php echo $row["location"]; ?></td>
    <?php if ($row["status"] == 'hidden') : ?>
        <td><a href="remove_2.php?id=<?php echo $row["id"]; ?>&email=<?php echo $email ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to unhide this item?')">Unhide</td>
    <?php else : ?>
        <td><a href="remove_3.php?id=<?php echo $row["id"]; ?>&email=<?php echo $email ?>" class="btn btn-success" onclick="return confirm('Are you sure you want to hide this item?')">Hide</td>
    <?php endif; ?>
</tr>
<?php endwhile; ?>


                </table>
        
      
      </div>
    </div>
    </div>


        

    

  
        






</body>
</html>