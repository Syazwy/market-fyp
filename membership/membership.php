<!DOCTYPE html>
<?php
require_once("../session/session.php");
?>
<html>
<link rel="stylesheet" href="membership.css">
<link rel="stylesheet" href="../home/index.css">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEMBERSHIP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

</head>

<body>
  
<div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="height:300px;width:450px" >
            <div class="modal-header" style="border:none">
              <br>
            </div><center>
            <div class="modal-body"  style="border:1px solid black; width: 300px; height:200px">
                
                    <img id="tick" src="../image/check.png" style="height: 60px" alt="check">
                    <h2>verified!</h2>
                
            </div></center>
        </div>
    </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    var previousPageURL = document.referrer;

    if (previousPageURL && previousPageURL.endsWith("email.php")) {
        var modalElement = document.getElementById('exampleModalCenter');
        modalElement.style.display = 'block'; 

        modalElement.addEventListener('click', function (event) {
            if (event.target === modalElement) {
                modalElement.style.display = 'none'; 
            }
        });
    }

</script>
  
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Do you want to subscribe to this plan? This subscription will automatically renew until you switch to a different plan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSubscription">Confirm</button>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="../home/index.php">
      <img src="../image/logo.png" width="80" height="80">
    </a>
  
  <div class="collapse navbar-collapse justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Categories</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Wishlist</a></li>
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Sell</a></li>
    </ul>
  </div>

  <div class="dropdown">
    <a href="#" class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
      <img src="../image/profile.png" width="50" height="50" class="profile">
    </a>

    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Your Listings</a></li>
      <li><a class="dropdown-item" href="#">My purchases</a></li>
      <li><a class="dropdown-item" href="../membership/membership.php">Membership</a></li>
      <li><a class="dropdown-item" href="../home/index-guest.php">Log out</a></li>
    </ul>
  </div>
  </div>
</nav>

    <center>
    <div class="current-plan-container">
        <h3>Current Plan</h3>
        <div class="current-plan" id="currentPlan">
            Basic
        </div>
        </div>
    </center>
    <br>
    <center>
    <h3>Membership Plans</h3>
    </center>
    <div class="membership-container">

       <div class="membership-box basic-membership" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-plan="Basic" data-url="../payment/paymentBasic.php">
        <center>
        <h3>Basic</h3>
            <h4>Free</h4>
            </center>
            <ul>
                <li>Can only sell a maximum of 2 items only</li>
                <li>Can add up to 5 wish lists</li>
            </ul>
        </div>
        <div class="membership-box premium-monthly-membership" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-plan="Premium Monthly" data-url="../payment/paymentPremiumMonthly.php">
        <center>
        <h3>Premium Monthly</h3>    
        <h4>$4.99/monthly</h4>
        </center>
            <ul>
                <li>Can sell an unlimited amount of items</li>
                <li>Can add an unlimited amount of Wish List</li>
                <li>Have discount option</li>
                <li>Can purchase items as gifts</li>
                <li>Receive gifts</li>
            </ul>
        </div>
        <div class="membership-box premium-annually-membership" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-plan="Premium Annually" data-url="../payment/paymentPremiumAnnually.php">
        <center>
        <h3>Premium Annually</h3>    
        <h4>$49.99/annually</h4>
        </center>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

<script>
const currentPlanElement = document.getElementById('currentPlan');
const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
const membershipBoxes = document.querySelectorAll('.membership-box');
const confirmSubscriptionButton = document.getElementById('confirmSubscription');


currentPlanElement.setAttribute('data-initial-plan', currentPlanElement.textContent.trim());

membershipBoxes.forEach(function (box) {
    box.addEventListener('click', function () {
        membershipBoxes.forEach(function (otherBox) {
            otherBox.classList.remove('active');
        });
        box.classList.add('active');

        const planName = box.querySelector('h3').textContent;
        currentPlanElement.setAttribute('data-selected-plan', planName); 

        confirmationModal.show();
    });
});

confirmSubscriptionButton.addEventListener('click', function () {
    const selectedPlan = currentPlanElement.getAttribute('data-selected-plan');
    
    if (selectedPlan) {
        currentPlanElement.textContent = selectedPlan;
    }

    confirmationModal.hide();
});


confirmSubscriptionButton.addEventListener('click', function () {
    const selectedPlan = currentPlanElement.getAttribute('data-selected-plan');
    
    if (selectedPlan ) { 
        currentPlanElement.textContent = selectedPlan;
        
        const planUrl = document.querySelector('.membership-box.active').getAttribute('data-url');
        
        if (planUrl) {
            window.location.href = planUrl; 
        }
    }

    confirmationModal.hide();
});
</script>

</body>
</html>
