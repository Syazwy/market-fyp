<?php
require '../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $appeal = $_POST["appeal"];

    $statusQuery = "SELECT status FROM appeals WHERE username = ? ORDER BY appeal_id DESC LIMIT 1";
    $statusStmt = mysqli_prepare($conn, $statusQuery);
    mysqli_stmt_bind_param($statusStmt, "s", $username);
    mysqli_stmt_execute($statusStmt);
    $statusResult = mysqli_stmt_get_result($statusStmt);

    if ($statusResult && $row = mysqli_fetch_assoc($statusResult)) {
       
        if ($row["status"] === "pending") {
            header("Location: ../home/index-guest.php?message=You+already+have+a+pending+appeal!");
        } else {
           
            $insertSql = "INSERT INTO appeals (username, appeal) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $appeal);

            if (mysqli_stmt_execute($stmt)) {
              
                header("Location: ../home/index-guest.php?message=Appeal+submitted+successfully!");
                exit(); 
            } else {
             
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
     
        $insertSql = "INSERT INTO appeals (username, appeal) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insertSql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $appeal);

        if (mysqli_stmt_execute($stmt)) {
         
            header("Location: ../home/index-guest.php?message=Appeal+submitted+successfully!");
            exit(); 
        } else {
           
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
