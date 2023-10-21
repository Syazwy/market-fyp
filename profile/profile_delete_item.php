<?php
require '../connection/connection.php';

$id = $_GET["id"];

// Using prepared statements to prevent SQL injection
$query = "DELETE FROM itemslisting WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo '<script>alert("Item deleted successfully.");</script>';
    echo '<script>
        setTimeout(function(){
            window.location = "myprofile.php";
        }, 500); 
    </script>';
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the statement and the connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
