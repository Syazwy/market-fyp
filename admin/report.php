<?php 
require_once("../session/session.php");
require '../connection/connection.php';
$id = $_SESSION['id'];
?>

<?php

if(isset($_POST["submit"])){
    // Get form data and sanitize
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $item = mysqli_real_escape_string($conn, $_POST["item"]);
    $report = mysqli_real_escape_string($conn, $_POST["report"]);
    $typeofreport = mysqli_real_escape_string($conn, $_POST["typeofreport"]);

    // Insert item data into database
    $query = "INSERT INTO `report` (name, item, report, typeofreport ) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $item, $report, $typeofreport);
    mysqli_stmt_execute($stmt);
    $itemId = mysqli_insert_id($conn); 
    mysqli_stmt_close($stmt);

    header("Location: ../home/index.php");
    exit(); 

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="report.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

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
    
    <div class="container">
        <div class="box1">

        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="input-images">
                        <center>
                            <h2>Report</h2>
                            <div class="profile-picture">
                                <img src="image/Tommy.jpeg" alt="Profile Picture">
                            </div>
                            <h2>Username</h2>
                        </center>
                    </div>
                    <div class="input-field">
                        <div class="input-images-2" style="padding-top: .5rem; padding-bottom: .5rem;"></div>
                    </div>
                    <!-- Uploaded images will be displayed here -->
                </div>
                <br>
                <div class="subcontainer">
                    <label>Select Type Of Report:</label>
                    <select class="form-select form-select-sm" aria-label="Small select example" name="typeofreport">
                        <option value="null"> </option>
                        <option value="ProductQuality">  Product Quality</option>
                        <option value="Misleading">  Misleading</option>
                        <option value="Shipping">  Shipping and Delivery Issues</option>
                        <option value="CustomerService"> Customer Service</option>
                        <option value="PNAE">  Product Not as Expected</option>
                    </select>
    
                    <div class="mb-3">
                    <input type="text" name="name" id="username" value="Muin" hidden>
                        <input type="text" name="name" id="username" value="Muin" hidden>
                        <input type="text" name="item" id="item" value="Barang" hidden>
                        <label for="report" class="form-label">Report</label>
                        <textarea class="form-control" name="report" id="report" rows="3"></textarea>
                    </div>
                    
                    <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;">Submit</button>
                </div>
            </form>


        </div>
    </div>
    

</body>
</html>