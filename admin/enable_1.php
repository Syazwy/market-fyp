<?php require '../connection/connection.php'; ?>

<?php 

if(isset($_GET['id'])){
    $id = $id = $_GET['id'];
}

$selectQuery = "SELECT * FROM `hide_account` WHERE `id` = '$id'";
$result = mysqli_query($conn, $selectQuery);

if(!$result){
    die("Query Failed: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) > 0){
    $rowToTransfer = mysqli_fetch_assoc($result);
    
    $insertQuery = "INSERT INTO `account` (id, username, email, password, membership, date, verification_code, email_verified_at, rating) VALUES ";
    
    $insertQuery .= "('".$rowToTransfer['id']."', '".$rowToTransfer['username']."', '".$rowToTransfer['email']."', '".$rowToTransfer['password']."', '".$rowToTransfer['membership']."', '".$rowToTransfer['date']."', '".$rowToTransfer['verification_code']."', '".$rowToTransfer['email_verified_at']."', '".$rowToTransfer['rating']."')";
    
    $insertResult = mysqli_query($conn, $insertQuery);
    
    if(!$insertResult){
        die("Insertion Failed: " . mysqli_error($conn));
    }
    
    $deleteQuery = "DELETE FROM `hide_account` WHERE `id` = '$id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    
    if(!$deleteResult){
        die("Deletion Failed: " . mysqli_error($conn));
    } else {
        header('location: Ban_Acc.php?transfer_msg=Data has been transferred.');
    }
} else {
    header('location: Ban_Acc.php?error_msg=No data found for the given ID.');
}
?>