<!DOCTYPE html>
<html>
<link rel="stylesheet" href="membership.css">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEMBERSHIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <div class="icon-left">
        <img src="../MarketLogo.png" alt="Left Icon" style="height: 80px">
    </div>
    <div class="icon-right">
        <img src="../User.png" alt="Right Icon" style="height: 60px">
    </div>
    <div class="button-container">
        <input type="button" name="Categories" class="button" value="Categories" />
        <input type="button" name="Register" class="button" value="Register" />
        <input type="button" name="Login" class="button" value="Login" />
        <input type="button" name="Sell" class="button" value="Sell" />
    </div>
    <div class="input-center">
        <input type="text" name="searchbar" class="search-bar" placeholder="Search for anything and everything" />
        <input type="button" name="Search" class="button" value="Search" />
    </div>

    <h3>Membership Plans</h3>
    <div class="membership-container">
       <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
        <div class="membership-box basic-membership" onclick="confirmRedirect('../payment/paymentBasic.php')">
        
        <h3>Basic</h3>
            <h4>Free</h4>
            <ul>
                <li>Can only sell a maximum of 2 items only</li>
                <li>Can add up to 5 wish lists</li>
            </ul>
        </div>
        <div class="membership-box premium-monthly-membership" onclick="confirmRedirect('../payment/paymentPremiumMonthly.php')">
        <h3>Premium Monthly</h3>    
        <h4>$4.99/monthly</h4>
            <ul>
                <li>Can sell an unlimited amount of items</li>
                <li>Can add an unlimited amount of Wish List</li>
                <li>Have discount option</li>
                <li>Can purchase items as gifts</li>
                <li>Receive gifts</li>
            </ul>
        </div>
        <div class="membership-box premium-annually-membership" onclick="confirmRedirect('../payment/paymentPremiumAnnually.php')">
        <h3>Premium Annually</h3>    
        <h4>$49.99/annually</h4>
            <ul>
                <li>Can sell an unlimited amount of items</li>
                <li>Can add an unlimited amount of Wish List</li>
                <li>Have discount option</li>
                <li>Can purchase items as gifts</li>
                <li>Receive gifts</li>
                <li>$10 off each year</li>
            </ul>
        </div>
    </div>
    <script>
        function confirmRedirect(url) {
            if (confirm("Do you want to subscribe to Premium Monthly for $4.99?This subscription will automatically renew until canceled.")) {
                window.location.href = url;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Subheading</div>
      Content for list item
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Subheading</div>
      Content for list item
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Subheading</div>
      Content for list item
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
</ol>
<script>const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))</script>
</body>
</html>
