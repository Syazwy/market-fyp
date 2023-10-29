<?php
  require_once("../session/session.php");
  require '../connection/connection.php';
$username =  $_SESSION['username'];

  $query = "SELECT * FROM account WHERE username = '$username'";
 $result = mysqli_query($conn, $query);

 
if ($result) {
  while($row = $result->fetch_assoc()){
    $accountStatus = $row['status'];
    $name =  $row['username'];
    $profileimage = $row['profile_image'];
   }
}
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['complete-button'])) {
  
    $itemId = $_POST['complete-button'];
    
    $updateQuery = "UPDATE itemslisting SET status = 'completed' WHERE id = $itemId";
    
    if (mysqli_query($conn, $updateQuery)) {
   
    } else {
      
        echo "Error updating item status: " . mysqli_error($conn);
    }
  
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Purchases</title>
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="myPurchases.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
</head>
<body>
<nav class="navbar navbar-expand-lg bg-transparent">
    <div class="container">
        <a class="navbar-brand" href="../home/index.php">
            <img src="../image/logo.png" width="80" height="80">
        </a>

        <div class="collapse navbar-collapse justify-content-center">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="../wishlist/wishlist.php">Wishlist</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php">Sell</a></li>
            </ul>
        </div>

        <?php echo "Hello,&nbsp<b style=\"text-transform: capitalize;\"> " . $username . "</b>"; ?>
        

        <div class="dropdown">
            <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
            <?php 
      if (isset($profileimage)) {
            echo '<img src="../profile/' .$profileimage . '" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
        } else {
            echo '<img src="../image/profile.png" width="50" height="50" class="profile rounded-circle" alt="Profile Picture">';
        }
        ?>
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../profile/myprofile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="../myPurchases/myPurchases.php">My Purchases</a></li>
                <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
                <li><a class="dropdown-item" href="../privatemessage/myChat.php">Messages</a></li>
                <li><a class="dropdown-item" href="../home/index-guest.php" id="logout-link">Log out</a></li>

            </ul>
        </div>
    </div>

</nav>
<script>
    document.getElementById('logout-link').addEventListener('click', function (event) {
        event.preventDefault(); 

        const confirmLogout = confirm("Are you sure you want to log out?");

        if (confirmLogout) {
            window.location.href = event.target.href;
        }
    });
</script>
<h3 style="text-align: center;">My Purchases</h3>
<div style="padding-left:50px;border-bottom: 1px solid #C7C7C7">
    <button class="transparent-button active-button" onclick="showDiv('div1')" id="btn1">In Progress</button>
    <button class="transparent-button" onclick="showDiv('div2')" id="btn2">Completed</button>

</div>
<div id="div1" class="content active">
    <div class="card-container">
        <?php
       $email = $_SESSION['email']; 
       $query = "SELECT itemslisting.*, MIN(item_images.image_filename) AS image_filename 
                 FROM itemslisting 
                 LEFT JOIN item_images ON itemslisting.id = item_images.item_id 
                 WHERE itemslisting.status = 'sold' AND itemslisting.bought = ?
                 GROUP BY itemslisting.id, itemslisting.name, itemslisting.description, itemslisting.price, itemslisting.item_condition";
       

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();


        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
            
                $itemId = $row['id'];
                $username = $row['username'];
                echo '<div class="card">';
                echo '<p>Name: ' . $row['name'] . '</p>';
                echo '<center><img src="../sellers/upload/' . $row['image_filename'] . '"></center>';
                echo '<p>Description: ' . $row['description'] . '</p>';
                echo '<p>Price: $' . $row['price'] . '</p>';
                echo '<p>Condition: ' . $row['item_condition'] . '</p>';
                echo '<p>Seller: ' . $row['username'] . '</p>';
               
                echo '<a href="../privatemessage/chat.php?id=' . $itemId . '&username=' . urlencode($row['username']) . '&name=' . urlencode($row['name']) . '&description=' . urlencode($row['description']) . '&price=' . urlencode($row['price']) . '" class="btn btn-primary">Chat</a>';
                echo '<br><a href="../profile/usersprofile.php?username=' . urlencode($row['username']) . '&email=' . urlencode($row['email']) . '" class="btn btn-secondary">Check Seller</a>';
                echo '<br><form method="POST" id="complete-form-' . $itemId . '">';
                echo '<button class="complete-button" style="width:300px; color:white;" onclick="confirmMarkCompleted(' . $itemId . ')" name="complete-button" value="' . $itemId . '">Complete</button>';
                echo '</form>';
                echo '</div>'; 
            }
        } else {
            echo '<p>You have not made any purchases that are currently in progress.</p>';
        }
        ?>
    </div> 
</div>


    <!-- closing -->

    <script>
function openPrivateMessage() {
    var username = "<?php echo $row['username']; ?>";
var id = "<?php echo $row['id']; ?>";
var description = "<?php echo $row['description']; ?>";
var name = "<?php echo $row['name']; ?>";
var price = "<?php echo $row['price']; ?>";

var url = '../privatemessage/chat.php?' +
    'username=' + encodeURIComponent(username) +
    '&id=' + encodeURIComponent(id) +
    '&description=' + encodeURIComponent(description) +
    '&name=' + encodeURIComponent(name) +
    '&price=' + encodeURIComponent(price);

window.location.href = url;
}
</script>


</div>
<div id="div2" class="content">
    <div class="card-container">
        <?php
       
       $email = $_SESSION['email']; 
       $query = "SELECT itemslisting.*, MIN(item_images.image_filename) AS image_filename 
                 FROM itemslisting 
                 LEFT JOIN item_images ON itemslisting.id = item_images.item_id 
                 WHERE itemslisting.status = 'completed' AND itemslisting.bought = ?
                 GROUP BY itemslisting.id, itemslisting.name, itemslisting.description, itemslisting.price, itemslisting.item_condition";
       

     
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

     
        $result = $stmt->get_result();

   
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card1">';
                echo '<p>Name: ' . $row['name'] . '</p>';
                echo '<center><img src="../sellers/upload/' . $row['image_filename'] . '"></center>';
                echo '<p>Description: ' . $row['description'] . '</p>';
                echo '<p>Price: $' . $row['price'] . '</p>';
                echo '<p>Condition: ' . $row['item_condition'] . '</p>';
                echo '<p>Seller: ' . $row['username'] . '</p>';
                echo '<a href="../profile/usersprofile.php?username=' . urlencode($row['username']) . '&email=' . urlencode($row['email']) . '" class="btn btn-secondary">Check Seller</a>';
                echo '</div>'; 
            }
        } else {
            echo '<p>You have not made any completed purchases.</p>';
        }
        ?>
    </div> <!-- Close the card-container -->
</div>

<script>


    function showDiv(divId) {
        const buttons = document.querySelectorAll('.transparent-button');
        buttons.forEach((button) => {
            button.classList.remove('active-button');
        });

        const divs = document.querySelectorAll('.content');
        divs.forEach((div) => {
            div.style.display = 'none';
        });

        document.getElementById('btn' + divId.substr(3)).classList.add('active-button');
        document.getElementById(divId).style.display = 'block';
    }

    function confirmMarkCompleted(itemId) {
    var confirmed = confirm("Are you sure you want to mark this item as completed?");
    if (confirmed) {
      
        document.getElementById('complete-form-' + itemId).submit();
    } else {
    
        event.preventDefault();
    }
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
