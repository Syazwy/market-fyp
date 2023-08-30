<!DOCTYPE html>
<?php
require_once("../session/session.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEMBERSHIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="payment.css">
</head>
<body>
  
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  
</div>

<div class="icon-left">
    <img src="../image/MarketLogo.png" alt="Left Icon" style="height: 80px">
</div>

<div class="icon-right">
        <img src="../image/User.png" alt="Right Icon" style="height: 60px;">
    </div>
<div class="button-container mb-10">
    <input type="button" name="Categories" class="button" value="Categories" />
    <input type="button" name="Register" class="button" value="Register" />
    <input type="button" name="Login" class="button" value="Login" />
    <input type="button" name="Sell" class="button" value="Sell" />
</div>
    
<br>
   <br>
   
<div style="width:400px">
<a href="javascript:history.back()"  class="left d-flex align-items-start mb-10 ms-5 back-button">
    <img src="../image/Left.png" alt="Left Icon" style="height: 30px"> 
    <h3 class="ms-4">Order Request</h3>
</a>
</div>

<br>
<div class="payment-container d-flex align-items-center mb-10 ms-5 justify-content-between">
    <div class="d-flex align-items-center">
        <img src="../image/MarketLogo.png" alt="Left Icon" style="height: 80px">
        <div class="ms-3">
            <h4 class="d-flex align-items-center">Safer deals when paying via BIBD</h4>
            <p>Payment is only released to the other seller after you receive your order as listed</p>
        </div>
    </div>
    <img src="../image/Right.png" alt="Right Icon" style="height: 20px;">
</div>

<br>

<div class="payment-container d-flex flex-column align-items-start mb-10 ms-5">
    <h4>Payment</h4>
    <input type="checkbox" class="btn-check" id="btn-check-2-outlined" autocomplete="off" disabled>
    <label class="btn btn-outline-secondary" for="btn-check-2-outlined">Mastercard</label>

    <input type="radio" class="btn-check" name="options-base" id="option7" autocomplete="off" disabled>
    <label class="btn" for="option7">Add credit / debit card</label>
    
    <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
    <label class="btn btn-outline-primary" for="btn-check-outlined">Paypal</label> 
    <input type="radio" class="btn-check" name="options-base" id="option7" autocomplete="off" disabled>
    <label class="btn" for="option7">Pay using PayPal directly to user</label>
    
    <input type="checkbox" class="btn-check" id="btn-check-2-outlined" autocomplete="off" disabled>
    <label class="btn btn-outline-secondary" for="btn-check-2-outlined">Cash</label>
    <input type="radio" class="btn-check" name="options-base" id="option7" autocomplete="off" disabled>
    <label class="btn" for="option7">Pay using cash in person</label> 
</div>
<div class="payment-container order-summary container" style="width: 500px">
    <h4>Order Summary</h4>
    <h5>Basic Market Membership</h5>
    <table class="table borderless">
    
        <tbody>
            <tr>
                <td>Subscription</td>
                <td></td>
                <td></td>
                <td></td>
                <td>BND$ <b>0</b></td>
            </tr>
           
            <tr>
                <td>Application fee</td>
                <td></td>
                <td></td>
                <td></td>
                <td>BND$ <b>2</b></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total</th>
              <td></td>
                <td><b>BND$ 2</b></td>
            </tr>
        </tfoot>
    </table>

    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter Promo Code">
        
            <input type="button" class="btn btn-primary align-self-start" value="Apply" id="applyButton">
        </div>
    
    <div class="text-center">
    <button id="placeOrderButton" onclick="placeorder()" class="btn btn-primary" disabled>Place Order</button>
    </div>
    <br>
    <p>By tapping on Place order, you accept the terms of service from <span style="color: #00A307;">Market</span> and the payments provider.</p>
</div>

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Choose Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please select a payment method before placing your order.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
   
    var paypalCheckbox = document.getElementById("btn-check-outlined");
    var placeOrderButton = document.getElementById("placeOrderButton");
    var paymentModal = new bootstrap.Modal(document.getElementById("paymentModal"));

  
    placeOrderButton.addEventListener("click", function(event) {
    
        if (!paypalCheckbox.checked) {
            event.preventDefault(); 
            paymentModal.show();
        }
    });

    
    paypalCheckbox.addEventListener("change", function() {
    
        placeOrderButton.disabled = !paypalCheckbox.checked;

       
        if (paypalCheckbox.checked) {
            paymentModal.hide();
        }
    });
});

function placeorder(){

window.location.href = 'ordercompleted.php?data=' + localStorage.getItem('email');
}

</script>

</body>
</html>