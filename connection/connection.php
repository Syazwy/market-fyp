<?php
// $conn = mysqli_connect("localhost", "root", "",  "market");

$db_host = 'market-do-user-14433181-0.b.db.ondigitalocean.com';
$db_user = 'doadmin';
$db_password = 'AVNS_w_qd5GqeixD_cXzs29n'; 
$db_name = 'market';
$db_port = 25060; 

$conn = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo " connected successfully";
}
?>