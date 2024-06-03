<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('../includes/connect.php');
include('../include_aboutus.php');
$user_name = $_SESSION['username'];

if (!isset($user_name)) {
  echo "<script>window.open('user_login.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link href="../css/style.css" rel="stylesheet">
  <style>
    .nav-item a:hover {
      border-bottom: 2px solid #ccc;
    }
  </style>
</head>

<body>
  <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container p-0">
      <img src="../images/logo.jpg" alt="logo" width="100" height="100">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../aboutus.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../reviews.php">Reviews</a>
          </li>
        </ul>
        <form class="d-flex" action="search_product.php" method="get">
          <input class="px-2 search" type="search" height="60" placeholder="Search Here" name="search_data">
          <input type="submit" value="Search" class="btn1 px-3 me-2" name="search_data_product">
        </form>
        <?php
        // if (!isset($_SESSION['username'])) {
        //   echo "<a class='nav-link text-dark' href='user_login.php'>
        //  <i class='bi bi-person'></i></a>";
        //   echo "<a class='nav-link text-dark ' href='user_registration.php'>
        //  <i class='bi bi-journal-text'></i></a>";
        // } else {
        //   echo "<a class='nav-link text-dark' href='logout.php'>
        //  <i class='bi bi-box-arrow-in-right text-dark fs-4'></i></a>";
        //   echo "<a class='nav-link text-dark ' href='profile.php'>
        //  <i class='bi bi-person'></i></a>";
        // }

        ?>


      </div>
    </div>
  </nav>
  <nav class="navbar-light bg-light">
    <div class="container">
      <div class="navbar1">
        <p class="text-center fs-5 p-2">
          <?php
          // if (!isset($_SESSION['username'])) {
          //   echo "<a class='nav-link text-dark' href='#'>Welcome Guest</a>";
          // } else {
          //   echo "<a class='nav-link text-dark' href='#'>Welcome " . $_SESSION['username'] . "</a>";
          // }

          ?>
        </p>
      </div>
    </div>
  </nav> -->

  <div class="row px-1">
    <div class="col-md-12">
      <div class="row">
        <?php
        if (!isset($_SESSION['username'])) {
          include('user_login.php');
        } else {
          include('payment.php');
        }
        ?>
      </div>
    </div>
  </div>


  <footer class="footer">
    <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
