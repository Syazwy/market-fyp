<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button Div Switcher</title>
    <link rel="stylesheet" href="../profile/profilecss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Style for the divs */
        .content {
            display: none;
            padding: 20px;
            background-color: #white;
            height:750px;
        }

        /* Style for the active div */
        .active {
            display: block;
        }

        .transparent-button {
            background: transparent;
            border: none;
            color: #000; /* You can change the text color to your preference */
            cursor: pointer;
            /* You can further style the button as needed */
        }
        .card-container {
            display: flex; /* Use flexbox to arrange cards horizontally */
            flex-wrap: wrap; /* Allow cards to wrap to the next row if needed */
           
        }
        .card {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    height: 645px;
    width: calc(20% - 20px); /* Four cards side by side with some spacing */
    display: flex;
    flex-direction: column; /* Stack the elements vertically inside the card */
    justify-content: space-between; /* Space elements evenly vertically */
    align-items: center; /* Center elements horizontally */
    text-align: center; /* Center text horizontally */
}

.card img {
    max-width: 75%;
    max-height: 150px;
    margin-bottom: 10px;
}

.card p {
    margin: 10px 0; /* Add vertical margin to paragraphs */
}

.complete-button, .cancel-button {
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    width: 40%;
    border-radius: 20px;
}

.complete-button {
    background-color: #00A37C;
    margin-bottom: 20px;
}

.cancel-button {
    background-color: #FF5353;
    margin-bottom: 20px;
}

/* Add a CSS class for the active button */
.active-button {
    border-bottom: 1px solid black;
}

  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="../home/index.php">
      <img src="../image/logo.png" width="80" height="80">
    </a>
  
  <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Wishlist</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="../sellers/sells-page.php" >Sell</a></li>
    </ul>
  </div>

  <div class="dropdown">
    <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
      <img src="../image/profile.png" width="50" height="50" class="profile">
    </a>

    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="../profile/myprofile.php">My Profile</a></li>
      <li><a class="dropdown-item" href="../myPurchases/myPurchases.php">My Purchases</a></li>
      <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
      <li><a class="dropdown-item" href="../home/index-guest.php" id="logout-link">Log out</a></li>

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
  <center>
<h3>My Purchases</h3>
</center>
<div style="padding-left:50px;border-bottom: 1px solid #C7C7C7">
<button class="transparent-button active-button" onclick="showDiv('div1')" id="btn1">In Progress</button>
    <button class="transparent-button" onclick="showDiv('div2')" id="btn2">Completed</button>
    <button class="transparent-button" onclick="showDiv('div3')" id="btn3">Canceled</button>
    </div>

    <div id="div1" class="content active">

    <div class="card-container">
        <div class="card">
            <p>Username</p>
            <center>
            <img src="../image/supra.png" alt="Card 1 Image" >
            </center>
            <p>Description</p>
            <p>Price</p>
            <p>Status</p>
            <button class="complete-button">Complete</button>
            <button class="cancel-button">Cancel</button>
        </div>
        <div class="card">
        <p>Username</p>
        <center>
            <img src="../image/civic.png" alt="Card 2 Image">
            </center>
            <p>Description</p>
            <p>Price</p>
            <p>Status</p>
            <button class="complete-button">Complete</button>
            <button class="cancel-button">Cancel</button>
        </div>
    </div>
</div>


    <div id="div2" class="content">
        <h1>Yg completed sini</h1>

    </div>

    <div id="div3" class="content">
        <h1>Yg canceled sini</h1>

    </div>

    <script>
    function showDiv(divId) {
        // Remove the "active-button" class from all buttons
        document.getElementById('btn1').classList.remove('active-button');
        document.getElementById('btn2').classList.remove('active-button');
        document.getElementById('btn3').classList.remove('active-button');

        // Add the "active-button" class to the clicked button
        document.getElementById('btn' + divId.substr(3)).classList.add('active-button');

        // Hide all divs with the class "content"
        const divs = document.querySelectorAll('.content');
        divs.forEach((div) => {
            div.classList.remove('active');
        });

        // Show the selected div
        const selectedDiv = document.getElementById(divId);
        selectedDiv.classList.add('active');

        // Your logic to show/hide the corresponding div here
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
