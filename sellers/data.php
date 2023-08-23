<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
</head>
<body>
    
    <table border = 1 cellspacing = 0 cellpadding = 10>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Price</td>
            <td>Description</td>
            <td>Location</td>
            <td>Image</td>
        </tr>

        <?php
        $i = 1;
        $rows = mysqli_query($conn, "SELECT * from itemslisting ORDER BY Id DESC");
        ?>

        <?php
        foreach($rows as $row) :
        ?>

        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["description"]; ?></td>
            <td><?php echo $row["location"]; ?></td>
            <td><img src ="upload/<?php echo $row['image'];?>" width= 200></td>    
        </tr>

        <?php endforeach; ?>

    </table>

</body>
</html>