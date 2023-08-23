<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Outlook Inbox</title>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="login-register.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 sidebar">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action active">Inbox</a>
          <a href="#" class="list-group-item list-group-item-action">Sent Items</a>
          <a href="#" class="list-group-item list-group-item-action">Drafts</a>
          <a href="#" class="list-group-item list-group-item-action">Trash</a>
        </div>
      </div>
      <div class="col-md-9">
      <div class="card">
          <div class="card-header">Inbox</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-7">
                <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action" onclick="showEmailContent('Market Change Password', '', 'Click Here to change your password', '')">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Market Change Password</h5>
                      <small>Just now</small>
                    </div>
                    <p class="mb-1">Click Here to change your password</p>
                    
                    <small>Admin&lt;Market@admin.com&gt;</small>
                  </a>
                  <a href="#" class="list-group-item list-group-item-action" >
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Market Email verification</h5>
                      <small>Just now</small>
                    </div>
                    <p class="mb-1">Click Here to verify your email</p>
                    
                    <small>Admin&lt;Market@admin.com&gt;</small>
                  </a>
                
                  <a href="#" class="list-group-item list-group-item-action"  >
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">No subject</h5>
                      <small>3 days ago</small>
                    </div>
                    <p class="mb-1">+1 Attachment</p>
                    <small>John Elston &lt;John@123.com&gt;</small>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action"  >
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Discord Nitro</h5>
                      <small>5 days ago</small>
                    </div>
                    <p class="mb-1">Subcription failed</p>
                    <small>Admin &lt;discord@nitro.com&gt;</small>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action"  >
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Minimart Qalfidah</h5>
                      <small>1 week ago</small>
                    </div>
                    <p class="mb-1">Thank you for shopping</p>
                    <small>Manager &lt;qalfidah@935.com&gt;</small>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action"  >
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Receipt No#5372</h5>
                      <small>1 week ago</small>
                    </div>
                    <p class="mb-1">TechHiockCom</p>
                    <small>Hiock see &lt;hiock@see.com&gt;</small>
                  </a>

                  <a href="#" class="list-group-item list-group-item-action"  >
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">PTM</h5>
                      <small>1 week ago</small>
                    </div>
                    <p class="mb-1">Good Evening</p>
                    <small>Pc  &lt;jse@js.com&gt;</small>
                  </a>
                </div>
              </div>
              <div class="col-md-5">
                <div id="email-content" >
                    <center>
                  <p><b>Select an item to read</b></p>
                  <p>Nothing is selected</p>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  

  <script>
    function showEmailContent(subject, timestamp, content, sender) {
      var emailContentDiv = document.getElementById("email-content");
      var emailContent = `
        <h5>${subject}</h5>
        <p>${content}</p>
      `;

      if (subject === 'Market Change Password') {
        emailContent += `<button class="btn btn-primary" onclick="verifyEmail()">Change Password</button>`;
      }

      emailContentDiv.innerHTML = emailContent;
      emailContentDiv.style.display = "block";
    }

    function verifyEmail() {
   
    window.location.href = "changepasswordform.php";
  }
  </script>
</body>
</html>

</body>
</html>
