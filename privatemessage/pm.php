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
    <link rel="stylesheet" href="pm.css">
   
</head>
<body>


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



<div class="container-fluid">
    <div class="row">
        <div class="container-flex">
           
            <div class="col-md-3">
            <ul class="list-group mt-5">
               
               <br>
               <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user1">
                       <div class="user-icon">
                           <img src="../image/lakaka.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>Na Dyma</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Ds4</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">3</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user2">
                       <div class="user-icon">
                           <img src="../image/civic.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>Ascension_Virus</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Lego minifig -DC Batgirl</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">1</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user3">
                       <div class="user-icon">
                           <img src="../image/cs.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>ESP_Streck</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Dragon lore</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">2</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user4">
                       <div class="user-icon">
                           <img src="../image/supra.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>Lapik_Supra</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Karambit Fade</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">1</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user5">
                       <div class="user-icon">
                           <img src="../image/tofu.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>G2 Tofu</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Honda Civic 1999 Type-R</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">3</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user6">
                       <div class="user-icon">
                           <img src="../image/User.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>Wajid_Ball</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Small Cabinet</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">1</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user7">
                       <div class="user-icon">
                           <img src="../image/User.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>Masdo</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Songkok Tenunan</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">0</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user8">
                       <div class="user-icon">
                           <img src="../image/bag.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>Barslir</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Hotwheels Rx-7</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">2</span>
                   </li>
                   <li class="list-group-item d-flex justify-content-between align-items-center contact" data-user="user9">
                       <div class="user-icon">
                           <img src="../image/User.png" alt="User Icon" style="height: 60px;">
                           <div class="user-info">
                               <h5>Shark</h5>
                           </div>
                       </div>
                       <div class="user-info">
                           <p>Canon f5j Fujifilm</p>
                       </div>
                       <span class="badge bg-primary rounded-pill">0</span>
                   </li>
               </ul>
           </div>
            
            <div class="chat">
                <div class="user-info-right">
                <h4></h4>
        <p></p>
                </div>
                <div class="chat-content">
                <h3>Select a chat or start a new conversation</h3>
                </div>
                
                <div class="message-container">
                    <div class="messages">
                     
                    </div>
                    <div class="message-input">
                        <input type="text" placeholder="Type your message">
                        <button>Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Include Bootstrap JS (Optional, for certain Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
       document.addEventListener("DOMContentLoaded", function() {
    const chatDiv = document.querySelector(".chat h3");
    const userItems = document.querySelectorAll(".contact");
    const userInfoDiv = document.querySelector(".user-info-right");
    const messagesContainer = document.querySelector(".messages");
    const chatContent = document.querySelector(".chat-content h3");

    const userMessages = {
                user1: "Hello, how are you?",
                user2: "Interested in the Lego set?",
                user3: "Is the Dragon Lore still available?",
                user4: "can nego?",
                user5: "swap with iphone add cash?",
                user6: "location?",
                user7: "Is it waterproof",
                user8: "can swap with my lego brz nissan mchyundai?",
                user9: "my camera better",
               
            };

    userItems.forEach(function(item) {
        item.addEventListener("click", function() {
            const userName = this.querySelector(".user-info h5").textContent;
            const userTitle = this.querySelector(".user-info p").textContent;
            const dataUser = this.getAttribute("data-user");

            messagesContainer.innerHTML = `
                <div class="message left">
                    <div class="text">${userMessages[dataUser]}</div>
                </div>
            `;

            userInfoDiv.innerHTML = `
                <h4>${userName}</h4>
                <p>${userTitle}</p>
            `;

            chatContent.textContent = "Chatting with " + userName;
        });
    });
});

    </script>

</body>
</html>
