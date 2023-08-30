<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
    $query = "SELECT * FROM `itemslisting` WHERE `id` = '$id'";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    } else {
        $row = mysqli_fetch_assoc($result);
        echo $row['name'];
    }


?>

<form action="" method="post" autocomplete="off" enctype="multipart/form-data">

    
    <div class="subcontainer">
        <label>Select Item Category</label>
        <select class="form-select form-select-sm" name="category" id="category" aria-label="Small select example" value="<?php echo $row['category']; ?>">
            <option value="null"> </option>
            <option value="property" <?php if ($row['category'] === 'property') echo 'selected'; ?>>Property</option>
            <option value="vehicles" <?php if ($row['category'] === 'vehicles') echo 'selected'; ?>>Vehicles</option>
            <option value="electronics" <?php if ($row['category'] === 'electronics') echo 'selected'; ?>>Electronics</option>
            <option value="clothing" <?php if ($row['category'] === 'clothing') echo 'selected'; ?>>Clothing</option>
            <option value="furniture" <?php if ($row['category'] === 'furniture') echo 'selected'; ?>>Furniture</option>
        </select>
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $row['name']; ?>">
        </div>
        </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="" value="<?php echo $row['price']; ?>">
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3"><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea>
    </div>
    
    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" name="location" id="location" placeholder="" value="<?php echo $row['location']; ?>">
    </div>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="<?php echo $row['image']; ?>"> <br> <br>
    
    <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;">Submit</button>
</form>

</body>
</html>
