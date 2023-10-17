<?php
require_once("../session/session.php");
require '../connection/connection.php';

// Get the search query from the Ajax request
$query = $_GET['query'];

// Perform the search query
$query = "SELECT * FROM itemslisting WHERE name LIKE '%$query%'";
$result = mysqli_query($conn, $query);

// Process the search results
while ($row = mysqli_fetch_assoc($result)) {
    // Output the search results in a format that can be inserted into the page
    echo '<div class="search-result">' . $row['name'] . '</div>';
}
?>
