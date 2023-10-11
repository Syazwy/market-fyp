  <!-- add to cart button to insert the item to add to cart page
  <?php
    if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $name = $_SESSION['name']; // Assuming you have the name in the session

    // Perform the database insertion operation here based on $item_id and $name
    $conn = new mysqli('localhost', 'root', '', 'market');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    // Assuming your cart table structure contains columns 'item_id', 'name', and 'quantity'
    $sql = "INSERT INTO wishlist (item_id, name, price, item_condition, description, category) VALUES ($item_id, '$name', 1)";

    if ($conn->query($sql) === TRUE) {
        echo "Item added to wishlist successfully";
    } else {
        echo "Error adding item to wishlist: " . $conn->error;
    }

    $conn->close();
    }
    ?> -->



<?php
if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $username = $_SESSION['name']; // Assuming you have the name in the session

    // Perform the database insertion operation here based on $item_id and $name
    $conn = new mysqli('localhost', 'root', '', 'market');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    // Check the current wishlist count for the user
    $userWishlistCount = 0;
    $sql = "SELECT wishlist_count FROM account WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userWishlistCount = $row['wishlist_count'];
    }

    // Check if the user has exceeded the maximum limit (5)
    if ($userWishlistCount >= 5) {
        echo "Cannot add more items to your wishlist. Remove one item to add a new one.";
    } else {
        // Assuming your wishlist table structure contains columns 'item_id', 'name', 'price', 'item_condition', 'description', and 'category'
        $sql = "INSERT INTO wishlist ('item_id', 'name', 'price', 'item_condition', 'description', 'category') VALUES ($item_id, '$name', 1)";

        if ($conn->query($sql) === TRUE) {
            // Update the wishlist count for the user
            $userWishlistCount++;
            $updateSql = "UPDATE account SET wishlist_count = $userWishlistCount WHERE name = '$name'";
            $conn->query($updateSql);

            echo "Item added to wishlist successfully";
        } else {
            echo "Error adding item to wishlist: " . $conn->error;
        }
    }

    $conn->close();
}
?>
