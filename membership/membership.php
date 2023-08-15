<!DOCTYPE html>
<html>
<link rel="stylesheet" href="membership.css">
<head>
    <title>MEMBERSHIP</title>
</head>
<body>
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
        <div class="membership-box basic-membership" onclick="confirmRedirect('../payment/paymentBasic.php')">
            <h3>Free</h3>
            <ul>
                <li>Can only sell a maximum of 2 items only</li>
                <li>Can add up to 5 wish lists</li>
            </ul>
        </div>
        <div class="membership-box premium-monthly-membership" onclick="confirmRedirect('../payment/paymentPremiumMonthly.php')">
            <h3>$4.99/monthly</h3>
            <ul>
                <li>Can sell an unlimited amount of items</li>
                <li>Can add an unlimited amount of Wish List</li>
                <li>Have discount option</li>
                <li>Can purchase items as gifts</li>
                <li>Receive gifts</li>
            </ul>
        </div>
        <div class="membership-box premium-annually-membership" onclick="confirmRedirect('../payment/paymentPremiumAnnually.php')">
            <h3>$49.99/annually</h3>
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
</body>
</html>
