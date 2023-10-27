<?php
require_once("../session/session.php");
require '../connection/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="../image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="admin.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
    }

    th {
        background-color: #f2f2f2;
    }

    .border1 {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
    }

    .active-status {
        color: green;
    }

    .banned-status {
        color: red;
    }

    .btn {
        margin: 5px;
    }
</style>

<body>
<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../image/logo.png" width="80" height="80">
    </a>
    <div class="collapse navbar-collapse">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../home/index-guest.php" id="logout-link">Logout</a></li>
    </ul>
    </div>
  </div>
</nav>

<script>
  document.getElementById('logout-link').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the link from immediately navigating

    // Display a confirmation dialog
    const confirmLogout = confirm("Are you sure you want to log out?");

    // If the user confirms, navigate to the logout page
    if (confirmLogout) {
      window.location.href = event.target.href;
    }
  });
</script>
<div class="profile-container">
        <div class="profile-picture">
            <img src="image/admin.png" alt="Profile Picture">
           
        </div>
        <div class="admin">
        <h1>Admin</h1>
        </div>
    </div>

    <br>

    <div class="container">

    <div class="justify-content-center">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="admin.php">Overview</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="admin_2.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="appealview.php">Appeals</a></li>
        </ul>
    </div>
    <br>
    <div class="row row-cols-1 row-cols-md-1 g-4">
      <div class="col border1">

      <?php
     echo "<table cellspacing='0' cellpadding='20'>";
     echo "<tr><td><h1>Report</h1></td></tr>";
     echo "<tr><td>#</td><td>Name</td><td>Status</td><td>Reason</td><td>Type of report</td><td>Action</td><td>Remove</td></tr>";
     
     $i = 1;
     $query = "SELECT ru.*, a.status AS account_status 
               FROM `reportbyusers` AS ru 
               JOIN `account` AS a ON TRIM(ru.usersemail) = TRIM(a.email) 
               ORDER BY ru.Id DESC";
     
     $rows = mysqli_query($conn, $query);
     
     
     if (!$rows) {
       die("Query failed: " . mysqli_error($conn));
     }
     
     if ($rows) {
       if (mysqli_num_rows($rows) > 0) {
         foreach ($rows as $row) {
           $userEmail = $row["usersemail"];
           $userStatus = $row["account_status"];
     
           echo "<tr>";
           echo "<td>" . $i++ . "</td>";
           echo "<td>" . $row["username"] . "</td>";
           echo '<td><strong style="color: ' . ($userStatus === "Banned" ? 'red' : 'green') . ';">' . $userStatus . '</strong></td>';
           echo "<td style='max-width: 300px; overflow: auto;'>" . $row["reason"] . "</td>";
           echo "<td>" . $row["typeReport"] . "</td>";
           echo "<td>";
          
           echo "<form action='ban_2.php' method='POST'>";
           echo "<input type='hidden' name='action' value='ban'>"; // Set the action to 'ban'
           echo "<input type='hidden' name='userEmail' value='" . $userEmail . "'>";
           if ($userStatus === "Active") {
            echo "<form action='ban_2.php' method='POST'>";
            echo "<input type='hidden' name='action' value='ban'>"; // Set the action to 'ban'
            echo "<input type='hidden' name='userEmail' value='" . $userEmail . "'>";
            echo "<input type='submit' value='Ban' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to ban this person?\");'>";
            echo "</form>";
        } else {
            echo "<form action='ban_2.php' method='POST'>";
            echo "<input type='hidden' name='action' value='unban'>"; // Set the action to 'unban'
            echo "<input type='hidden' name='userEmail' value='" . $userEmail . "'>";
            echo "<input type='submit' value='Unban' class='btn btn-success' onclick='return confirm(\"Are you sure you want to unban this person?\");'>";
            echo "</form>";
        }

           echo "</td>";
     
           echo "<td>";
           echo "<form action='remove_1.php' method='POST'>           ";
           echo "<input type='hidden' name='rowId' value='" . $row['id'] . "'>";
           echo "<input type='submit' name='remove' value='Remove' class='btn btn-warning' onclick='return confirm(\"Are you sure you want to remove this report?\");'>";
           echo "</form>";
           echo "</td>";
           echo "</tr>";
         }
       } else {
        //  echo "No rows found in the reportbyusers table.";
       }
     } else {
       echo "Report query failed: " . mysqli_error($conn);
     }
     
     echo "</table>";
     
      ?>

      </div>
    </div>
  </div>
</body>
</html>
