<?php

require '../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the posted data from the form
    $username = $_POST["username"];
    $appeal = $_POST["appeal"];

    // Perform any necessary data validation

    // Insert the data into the "appeals" table
    $insertSql = "INSERT INTO appeals (username, appeal) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $insertSql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $appeal);

    if (mysqli_stmt_execute($stmt)) {
        // Insertion was successful
        // Redirect to the target page
        header("Location: ../home/index-guest.php?message=Appeal+submitted+successfully!");
        exit(); // Make sure to exit to prevent further script execution
    } else {
        // Insertion failed
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
