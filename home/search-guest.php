<?php
require '../connection/connection.php';


// Get the search query from the Ajax request
$query = $_GET['query'];

// Perform the search query and retrieve the image filename
$query = "SELECT itemslisting.*, MAX(item_images.image_filename) AS image_filename
          FROM itemslisting
          JOIN item_images ON itemslisting.id = item_images.item_id
          JOIN account ON itemslisting.username = account.username
          WHERE account.status = 'Active' && itemslisting.status = 'active' && itemslisting.name LIKE '%$query%'
          GROUP BY itemslisting.id
          ORDER BY itemslisting.uploaded_at DESC";

$result = mysqli_query($conn, $query);

// Process the search results
while ($row = mysqli_fetch_assoc($result)) {
    $uploadedAt = strtotime($row["uploaded_at"]); // Convert uploaded_at datetime to a timestamp
    $currentTime = time(); // Current time timestamp
    $timeDiff = $currentTime - $uploadedAt;

    // Calculate time difference in human-readable format
    if ($timeDiff < 60) {
        $timeAgo = $timeDiff . " seconds ago";
    } elseif ($timeDiff < 3600) {
        $minutes = floor($timeDiff / 60);
        $timeAgo = $minutes . " minutes ago";
    } elseif ($timeDiff < 86400) {
        $hours = floor($timeDiff / 3600);
        $timeAgo = $hours . " hours ago";
    } else {
        $days = floor($timeDiff / 86400);
        $timeAgo = $days . " days ago";
    }

    // Output the search results in the same format as newly listed items
    echo '<div class="col d-flex align-items-center justify-content-center">';
    echo '<div class="card item h-100">';
    echo '<div class="card-header bg-transparent border border-0">';
    echo '<div class="row row-cols-1 row-cols-md-2 g-4">';
    echo '<div class="col col-lg-3">';
    echo '<a href="">';
    // Update the profile image section to match the updated code
    if (isset($row['profile_image']) && $row['profile_image'] != null) {
        echo '<img src="../profile/' . $row['profile_image'] . '" width="40" height="40" class="profile rounded-circle" alt="Profile Picture">';
    } else {
        echo '<img src="../image/profile.png" width="40" height="40" class="profile rounded-circle" alt="Profile Picture">';
    }
    echo '</a>';
    echo '</div>';
    echo '<div class="col-md-auto">';
    echo '<h6 class="card-title">';
    echo '<p style="text-transform: capitalize; margin:0px;">' . $row["username"] . '</p>';
    echo '</h6>';
    echo '<small class="text-body-secondary">';
    echo '<p class="card-text">' . $timeAgo . '</p>';
    echo '</small>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<a href="../productinfo/productinfo-guest.php?id=' . $row["id"] . '">';

    // Check if the "image_filename" key exists in the $row array
    if (isset($row["image_filename"])) {
        echo '<img src="../sellers/upload/' . $row['image_filename'] . '" class="card-img-top" width="150px" height="150px">';
    } else {
        // Handle the case where "image_filename" doesn't exist
        // You can show a default image or leave it empty, depending on your requirements
        echo '<img src="path_to_default_image.jpg" class="card-img-top" width="150px" height="150px">';
    }

    echo '</a>';
    echo '<div class="card-body">';
    echo '<p class="card-title" style="text-transform: capitalize">' . $row["name"] . '</p>';
    echo '<h5 class="card-title"><b>' . 'BND$' . $row["price"] . '</b></h5>';
    echo '<p class="card-text" style="text-transform: capitalize"><small class="text-body-secondary">' . $row["item_condition"] . '</small></p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
