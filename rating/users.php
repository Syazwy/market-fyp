<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-link {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .user-link:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pick sellers and review them</h1>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "market");

        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT username FROM account"; // Select only the 'username' column
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No usernames found.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $users = $row['username'];
                echo "<a class='user-link' href='review.php?users=" . urlencode($users) . "'>" . $users . "</a>";
            }
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
