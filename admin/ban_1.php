<?php require 'connection.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admincss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
</head>
<body>

<?php


$row = []; // Initialize the $row variable

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "SELECT * FROM `report` WHERE `id` = '$id'";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }else{
        $row = mysqli_fetch_assoc($result); // Update the $row variable
    }
}


?>

<?php 

if(isset($_POST['submit'])){

    if(isset($_GET['id_new'])){
        $idnew = $_GET['id_new'];
    }


    $Nname = $_POST['name'];
    $Nstatus = $_POST['status'];
    $Nitem = $_POST['item'];
    $Nreport = $_POST['report'];
    $Ntype = $_POST['typeofreport'];
    

    $query = "update `report` set  `name` = '$Nname', `status` = '$Nstatus', `item` = '$Nitem', `report` = '$Nreport', `typeofreport` = '$Ntype'
     where `id` = '$idnew'";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }
    else {
        header('location:admin.php?update_msg=You have successfully update the data.');
    }

    
    
}

?>

        <div class="container">
            <form action="ban_1.php?id_new=<?php echo $id; ?>" method="post" autocomplete="off" enctype="multipart/form-data">

                
                <div class="subcontainer">
                    <input type="text" name="name" id="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" hidden>
                    <label>Select Item Category</label>
                    <select class="form-select form-select-sm" name="status" id="status" aria-label="Small select example" >
                        <option value="Ban" <?php if ($row['status'] === 'ban') echo 'selected'; ?>>Ban</option>
                        <option value="Active" <?php if ($row['status'] === 'Active') echo 'selected'; ?>>Active</option>
                        <?php echo isset($row['status']) ? $row['status'] : ''; ?>
                    </select>
                    <input type="text" name="item" id="item" value="<?php echo isset($row['item']) ? $row['item'] : ''; ?>" hidden>
                    <input type="text" name="report" id="report" value="<?php echo isset($row['report']) ? $row['report'] : ''; ?>" hidden>
                    <input type="text" name="typeofreport" id="typeofreport" value="<?php echo isset($row['typeofreport']) ? $row['typeofreport'] : ''; ?>" hidden>
                    
                    
                
                <button type="submit" name="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;">Submit</button>
            </form>
        </div>
</body>
</html>