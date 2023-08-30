<?php
  require 'connection.php';

  if(isset($_POST["submit"])){
    $category = $_POST["category"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $imaage = $_POST["image"];
    
    if($_FILES['image']["error"] === 4){
      echo
      "<script> alert('image does not exist'); <script>"
      ;
    }else{
      $fileName = $_FILES ["image"]["name"];
      $fileSize = $_FILES ["image"]["size"];
      $tmpName = $_FILES ["image"]["tmp_name"];

      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $fileName);
      $imageExtension = strtolower(end($imageExtension));
      if(!in_array($imageExtension, $validImageExtension)){
        echo
      "<script> alert('Invalid Image Extension'); <script>"
      ;
      }else if($fileSize > 1000000){
      echo
      "<script> alert('Image Size is too large'); <script>"
      ;
    }else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'upload/'. $newImageName);
      $query = "INSERT INTO itemslisting VALUES ('','$category' , '$name', '$price' , '$description', '$location', '$newImageName')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Successfully Added');
      document.location.href = 'data.php';
      </script>";
    
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
     .container {
      display: flex;
     }

     .subcontainer {

      margin: auto;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0px 0px 3px black;
      height: 550px;

     }
     
     #home{
      display: flex;
      justify-content: center;
      align-items: center;

     }
  </style>

</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
    <br>
    <section id="home">
      <h1>List Your Item</h1> 
    </section>
    <br>
    <div class="container" >
   
   <div class="subcontainer" style="background: #FFEAEA; width: 550px;">
   <form action="" method= "post" autocomplete="off" enctype="multipart/form-data">
     <label for="image">Image : </label>
        <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png"> <br> <br>
   </div>

    <div class="subcontainer">
    <label>Select Item Category </label>
    <select class="form-select form-select-sm" name="category" id="category" aria-label="Small select example">
    <option value="null"> </option>
    <option value="property"> Property</option>
    <option value="vehicles">  Vehicles</option>
    <option value="electronics">  Electronics</option>
    <option value="clothing"> Clothing</option>
    <option value="furniture">  Furniture</option>
  </select>

    
    <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control"  name="name" id="name" placeholder="">
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="number" class="form-control" name="price" id="price" placeholder="">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
  </div>
  <div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input type="text" class="form-control"  name="location" id="location" placeholder="">
  </div>

        

        <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;">Submit </button>
        </div>

    </form>
    </div>
    <a href="data.php">Data</a>
</body>
</html>