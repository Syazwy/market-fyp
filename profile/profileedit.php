<?php  require '../connection/connection.php'; 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profilecss_1.css">
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

<div class="profile-container">
        <div class="profile-picture">
            <img src="../image/profile.png" alt="Profile Picture">
        </div>

</div>

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

if(isset($_POST['submit'])){
    

    // if(isset($_GET['id_new'])){
    //     $idnew = $_GET['id_new'];
    // }

    $Nusername = $_POST['username'];
    $Nemail = $_POST['email'];
    $Npassword = $_POST['password'];


    

    $query = "UPDATE `account` set `username` = '$Nusername', `email` = '$Nemail', `password` = '$Npassword'
     where `username` = '".$_SESSION['username']."'";

     $result = mysqli_query($conn, $query);
            
     if (!$result) {
         die("Query Failed: " . mysqli_error($conn));
     } else {
        $_SESSION['username'] = $Nusername;
         header('location:myprofile.php?update_msg=You have successfully updated the data.');
     }
     
    
}

?>
<br>

<div class="container">

<div class="row row-cols-1 row-cols-md-1 g-4">


      <div  class="col border1">
        

<form action="profileedit.php?id_new=<?php echo $id; ?>" method="post" autocomplete="off" enctype="multipart/form-data">

    
    <div class="subcontainer">
        
        
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($row['username']) ? $row['username'] : ''; ?>"  >
        </div>
        </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" >
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <textarea class="form-control" name="password" id="password" rows="3"><?php echo isset($row['password']) ? $row['password'] : ''; ?></textarea>
    </div>


    
    <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;">Submit</button>
</form>
      </div>
</div>

</div>
</body>
</html>
