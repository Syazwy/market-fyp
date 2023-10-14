<?php
// session.php

// Start the session
session_start();

// Check if the 'member' session variable is set and true
if (isset($_SESSION['member']) && $_SESSION['member'] === true) {
    // User is logged in, do nothing
} else {
    // User is not logged in, redirect to index-guest.php
    header("Location: ../home/index-guest.php");
    exit(); // Important to stop further execution
}
?>