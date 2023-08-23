<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELLS PAGE</title>
    <link rel="stylesheet" href="../looks.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="dist/image-uploader.min.css" rel="stylesheet">
    <style>
     .container {
      display: flex;
     }

     .subcontainer {
      margin: auto;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0px 0px 3px black;
      height: 550px;

     }

  </style>
      
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <img src="../icons/MarketLogo.png" alt="" class="uploaded-image">

  <header>
  
  </header>

  <main>


    <section id="home">
      <h3>List Your Item</h3>
    </section>
    <div class="container">

<br>

<div id="imagePreview" class="subcontainer" style="background: #FFEAEA; width: 550px;">

  

  <form action="url" enctype="multipart/form-data">
    <div class="input-images"> <center>
      <h2>Upload up to 6 Photos</h2></center>
    </div>

    <div class="input-field">
      <div class="input-images-2" style="padding-top: .5rem;padding-bottom: .5rem;"></div>
    </div>

  
  <br>
 
    <!-- Uploaded images will be displayed here --> 
</div>


<div class="subcontainer">
  <label>Select Item Category:</label>
  <select class="form-select form-select-sm" aria-label="Small select example">
    <option value="null"> </option>
    <option value="property"> <img src="../icons/map.png"> Property</option>
    <option value="vehicles"> <img src="../icons/car.png"> Vehicles</option>
    <option value="electronics"> <img src="../icons/microchip.png"> Electronics</option>
    <option value="clothing"> <img src="../icons/fashion.png">Clothing</option>
    <option value="furniture"> <img src="../icons/furnitures.png"> Furniture</option>
  </select>

  <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="mb-3">
    <label for="Price" class="form-label">Price</label>
    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="mb-3">
    <label for="Description" class="form-label">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="mb-3">
    <label for="Location" class="form-label">Location</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <button type="submit" style="background-color: #FF5353; width: 100%; border-radius: 10px; padding: 5px;">Create</button>
</div>
</form>
<!-- <h2>Upload up to 6 Photos</h2> -->

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="dist/image-uploader.min.js"></script>
<script>
        $('.input-images-2').imageUploader({
            maxFiles: 6,
            imagesInputName: 'photos',
            preloadedInputName: 'old'
        });

        $('form').on('submit', function (event) {

            // Stop propagation
            event.preventDefault();
            event.stopPropagation();

            // Get some vars
            let $form = $(this),
                $modal = $('.modal');

            // Set name and description
            $modal.find('#display-name span').text($form.find('input[id^="name"]').val());
            $modal.find('#display-description span').text($form.find('input[id^="description"]').val());

            // Get the input file
            let $inputImages = $form.find('input[name^="images"]');
            if (!$inputImages.length) {
                $inputImages = $form.find('input[name^="photos"]')
            }

            // Get the new files names
            let $fileNames = $('<ul>');
            for (let file of $inputImages.prop('files')) {
                $('<li>', {text: file.name}).appendTo($fileNames);
            }

            // Set the new files names
            $modal.find('#display-new-images').html($fileNames.html());

            // Get the preloaded inputs
            let $inputPreloaded = $form.find('input[name^="old"]');
            if ($inputPreloaded.length) {

                // Get the ids
                let $preloadedIds = $('<ul>');
                for (let iP of $inputPreloaded) {
                    $('<li>', {text: '#' + iP.value}).appendTo($preloadedIds);
                }

                // Show the preloadede info and set the list of ids
                $modal.find('#display-preloaded-images').show().html($preloadedIds.html());

            } else {

                // Hide the preloaded info
                $modal.find('#display-preloaded-images').hide();

            }

            // Show the modal
            $modal.css('visibility', 'visible');
        });

        // Input and label handler
        $('input').on('focus', function () {
            $(this).parent().find('label').addClass('active')
        }).on('blur', function () {
            if ($(this).val() == '') {
                $(this).parent().find('label').removeClass('active');
            }
        });

</script>
</div>
</body>
</html>

