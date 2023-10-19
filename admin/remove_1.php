<?php require '../connection/connection.php'; ?>

<?php 

if(isset($_GET['id'])){
    $id = $id = $_GET['id'];
}

$query = "delete from `reportbyusers` where `id` = '$id'";

$result = mysqli_query($conn, $query);

if(!$result){
    die("Query Failed: " . mysqli_error($conn));

}

else{
    header('location: admin_2.php?delete_msg=You have deleted the record.');
}

?>