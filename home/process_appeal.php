<?php
require '../connection/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $appeal = $_POST["appeal"];

    // Perform any necessary data validation

    // Check the user's current status
    $statusQuery = "SELECT status FROM appeals WHERE username = ? ORDER BY appeal_id DESC LIMIT 1";
    $statusStmt = mysqli_prepare($conn, $statusQuery);
    mysqli_stmt_bind_param($statusStmt, "s", $username);
    mysqli_stmt_execute($statusStmt);
    $statusResult = mysqli_stmt_get_result($statusStmt);

    if ($statusResult && $row = mysqli_fetch_assoc($statusResult)) {
        // Check if the user's status is "pending"
        if ($row["status"] === "pending") {
            header("Location: ../home/index-guest.php?message=You+already+have+a+pending+appeal!");
        } else {
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
        }
    } else {
        // User doesn't have any pending appeals, proceed with the appeal submission
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
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
