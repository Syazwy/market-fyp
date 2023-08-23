<?php
  require 'connection.php';

  if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    
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
      $query = "INSERT INTO itemslisting VALUES ('', '$name', '$price' , '$description', '$location', '$newImageName')";
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
</head>
<body>
    <form action="" method= "post" autocomplete="off" enctype="multipart/form-data">
        <label for="name">Name :</label>
        <input type="text" name="name" id = "name"> <br>
        <label for="price">Price :</label>
        <input type="text" name="price" id = "price"> <br>
        <label for="description">Description :</label>
        <input type="text" name="description" id = "description"> <br>
        <label for="location">Location :</label>
        <input type="text" name="location" id = "location"> <br>

        <label for="image">Image : </label>
        <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png"> <br> <br>

        <button type="submit" name="submit">Submit</button>

    </form>
    <a href="data.php">Data</a>
</body>
</html>