<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Info</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="ProductInfo.css">
    
</head>
<body>

    <header>
        <nav>
          <ul>
            <img id="pPictures" src="images/logo.png">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </nav>
      </header>
    
      <main>

      <?php
        $i = 1;
        $rows = mysqli_query($conn, "SELECT * from itemslisting ORDER BY Id DESC");
        ?>

        <?php
        foreach($rows as $row) 
        ?>
    
        <h1>Market</h1>
    
        <section id="home">
          <h1><?php echo $row["name"]; ?></h1>
        </section>
    
        <div>
          <label for="category">Filter by Category:</label>
          <select id="category" onchange="filterProducts()">
            <option value="all">All</option>
            <option value="electronics">Electronics</option>
            <option value="clothing">Clothing</option>
            <option value="furniture">Furniture</option>
          </select>
        </div>

        <div class="product-container">
            


              <div id="carouselExampleIndicators" class="carousel slide w-100" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src ="../sellers/upload/<?php echo $row['image'];?>" width= 200>
                  </div>
                  <div class="carousel-item">
                    <img src ="upload/<?php echo $row['image'];?>" width= 200>
                  </div>
                  <div class="carousel-item">
                    <img src ="upload/<?php echo $row['image'];?>" width= 200>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="">Next</span>
                </button>




              </div>

          </div>

          <br>

        <div id="secondhalf">
          <div class="product-info description">
              <h1><?php echo $row["name"]; ?></h1>
              <br>
              <p><b><?php echo $row["category"]; ?></b></p>
              <p><b>Description:</b></p>
              <p><?php echo $row["description"]; ?></p>
              <br>
              <p class="price"><?php echo $row["price"]; ?></p>
              <br>
              <button type="button" class="buy-button">Buy Now</button>
              <button type="button" class="chat-button">Chat Now</button>
            </div>

            <div class="proInfo">

              <img width="50px " src="images/pb.png">
              <p>Username</p>
              <br>
              <p>Location</p>



            </div>
    
        </div>

          <br>

      <div id="footer1">
        <section id="about">
          <h2>About Us</h2>
          <p>This is the about section of the website template.</p>
        </section>
    
        <section id="services">
          <h2>Our Services</h2>
          <p>This is the services section of the website template.</p>
        </section>
    
        <section id="contact">
          <h2>Contact Us</h2>
          <p>This is the contact section of the website template.</p>
        </section>
      </div>

      </main>
    
      <footer>
        <p>&copy; 2023 Your Company. All rights reserved.</p>
      </footer>
      <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>