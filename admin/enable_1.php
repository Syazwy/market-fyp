<?php require 'connection.php'; ?>

<?php 

if(isset($_GET['id'])){
    $id = $id = $_GET['id'];
}

// First, select the data to be transferred
$selectQuery = "SELECT * FROM `hide_account` WHERE `id` = '$id'";
$result = mysqli_query($conn, $selectQuery);

if(!$result){
    die("Query Failed: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) > 0){
    // Fetch the row to be transferred
    $rowToTransfer = mysqli_fetch_assoc($result);
    
    // Define the insert query for the destination table
    $insertQuery = "INSERT INTO `account` (id, username, email, password, membership, date, verification_code, email_verified_at, rating) VALUES ";
    
    // You need to specify the columns you want to transfer, e.g., column1, column2, ...
    // Use proper column names from your tables
    $insertQuery .= "('".$rowToTransfer['id']."', '".$rowToTransfer['username']."', '".$rowToTransfer['email']."', '".$rowToTransfer['password']."', '".$rowToTransfer['membership']."', '".$rowToTransfer['date']."', '".$rowToTransfer['verification_code']."', '".$rowToTransfer['email_verified_at']."', '".$rowToTransfer['rating']."')";
    
    $insertResult = mysqli_query($conn, $insertQuery);
    
    if(!$insertResult){
        die("Insertion Failed: " . mysqli_error($conn));
    }
    
    // Once the data is transferred successfully, you can delete it from the source table
    $deleteQuery = "DELETE FROM `hide_account` WHERE `id` = '$id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    
    if(!$deleteResult){
        die("Deletion Failed: " . mysqli_error($conn));
    } else {
        header('location: Ban_Acc.php?transfer_msg=Data has been transferred.');
    }
} else {
    // Handle the case where no data was found for the given ID
    header('location: Ban_Acc.php?error_msg=No data found for the given ID.');
}
?>