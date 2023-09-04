<?php require 'connection.php'; ?>

<?php 

if(isset($_GET['id'])){
    $id = $id = $_GET['id'];
}

$query = "delete from `itemslisting` where `id` = '$id'";

$result = mysqli_query($conn, $query);

if(!$result){
    die("Query Failed: " . mysqli_error($conn));

}

else{
    header('location: view_1.php?delete_msg=You have deleted the record.');
}

?>