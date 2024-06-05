<?php
include('includes/connect.php');
include('include_aboutus.php');
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="images/logo.jpg" rel="icon" type="image/icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
  <link href="css/style.css" rel="stylesheet">
</head>

<body> -->

  <footer class="contact">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12 pt-5 ">
          <div class="social-media ">
            <h3><?php echo $company_name; ?></h3>
            <p style="line-height: 1.8;">Feel Free to follow us on our social media handlers.All the links are given
              below.</p>
            <div class="socio ">
              <a href="<?php echo $fb_link; ?>" class="fa-brands fa-facebook h-50"></a>
              <a href="<?php echo $whatsapp_link; ?>" class="fa-brands fa-whatsapp h-50"></a>
              <a href="<?php echo $insta_link; ?>" class="fa-brands fa-instagram h-50"></a>
              <a href="<?php echo $viber_link; ?>" class="fa-brands fa-viber h-50"></a>
            </div>
          </div>
        </div>

        <div class="Contact-info col-lg-4 col-md-12 col-sm-12 pt-5">
          <h3>Contact-Info</h3>
          <p>
            </h1><i class="bi bi-telephone-fill"></i> <?php echo $contact; ?></p>
          <p><i class="bi bi-envelope-fill"></i> <?php echo $email; ?></p>
          <p><i class="bi bi-geo-alt-fill"></i><?php echo $address; ?></p>

        </div>
        <div class="quick-links col-lg-4 col-md-12 col-sm-12 py-5 text-center">
          <h3>Quick-Links</h3>
          <!-- <p><i class="bi bi-arrow-right-circle"></i> <a href="home.php" class="text-decoration-none">Home</a></p>
          <p><i class="bi bi-arrow-right-circle"></i> <a href="aboutus.php" class="text-decoration-none">About Us</a></p>
          <p><i class="bi bi-arrow-right-circle"></i> <a href="reviews.php" class="text-decoration-none">Reviews</a></p>
          <p><i class="bi bi-arrow-right-circle"></i> <a href="contact.php" class="text-decoration-none">Contact Us</a></p> -->
          <p><a href="home.php" class="text-decoration-none">Home</a></p>
          <p><a href="aboutus.php" class="text-decoration-none">About Us</a></p>
          <p><a href="reviews.php" class="text-decoration-none">Reviews</a></p>
          <p><a href="contact.php" class="text-decoration-none">Contact Us</a></p>
        </div>
      </div>
    </div>
    </div>
    <p class="text-center bg-light py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
  </footer>
</body>

</html>
