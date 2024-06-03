<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('../includes/connect.php');
include('navbar1.php');
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
  <title>Welcome <?php echo $_SESSION['username']; ?></title>
  <!-- <link href="../images/logo.jpg" rel="icon" type="image/icon"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link href="../css/style.css" rel="stylesheet">

  <style>
    body {
      overflow-x: hidden;
    }

    .list1 {
      background-color: rgb(255, 162, 205);
    }

    .nav-item a:hover {
      border-bottom: 2px solid #ccc;
    }

    .bi-box-arrow-in-right {
      color: black;
      cursor: pointer;
      padding-top: 5px;
      transition: all 0.4s;
    }

    .bi-box-arrow-in-right:hover {
      color: rgb(197, 12, 99);
    }

    .bg {
      background-color: antiquewhite;
    }
  </style>
</head>

<body>

  <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container"> -->
      <?php
      // $select_query = mysqli_query($con, "Select * from about_us");
      // $result = mysqli_fetch_assoc($select_query);
      // $logo = $result['company_logo'];
      // echo "<img src='../admin_area/admin_images/$logo' alt='Company Logo' width='100' height='100'>";
      ?>
      <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
          <li class="nav-item">
            <a class="nav-link" href="../contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../cart.php"><i class="bi bi-cart-fill"></i><sup><?php //cart_item(); ?></sup></a>
          </li>
          <?php 
        //   $username=$_SESSION['username'];
        //    $get_notification = "Select COUNT(*) as unread from chat where username='$username' AND is_read=1 and is_seen= 0";
        //    $result5 = mysqli_query($con, $get_notification);
        //    $unread=0;
        //    if ($result5) {
        //     $message_data = mysqli_fetch_assoc($result5);
        //     $unread= $message_data['unread'];
        // }
        // else{
        //   $unread=0;
        // }
        //    $row_count5 = mysqli_num_rows($result5);
           ?>
          <li class="nav-item">
            <a class="nav-link" href="../chatbox.php"><i class="bi bi-bell-fill"></i><sup><?php //echo "<sup>$unread</sup>"; ?></sup></a>
          </li> -->
          <!-- <li class="nav-item">
             <a class="nav-link" href="#">Total Price: <?php ?></a> -->
          <!-- </li>
        </ul>
        <form class="d-flex" action="../search_product.php" method="get">
          <input class="px-2 search" type="search" height="60" placeholder="Search Here" name="search_data">
          <input type="submit" value="Search" class="btn1 px-3 me-2" name="search_data_product">
        </form> -->
        <?php
        // if (!isset($_SESSION['username'])) {
        //   echo "<a class='nav-link text-dark' href='user_login.php'><i class='bi bi-person'></i></a>";
        // } else {
        //   echo "<a class='nav-link text-dark' href='logout.php'><i class='bi bi-box-arrow-in-right fs-4'></i></a>";
        // }
        ?>

      <!-- </div>
    </div>
  </nav>
  <nav class="navbar-light bg-light">
    <div class="container">
      <div class="navbar1">
        <p class="text-center fs-5"> -->
          <?php
          // if (!isset($_SESSION['username'])) {
          //   echo "<a class='nav-link text-dark' href='#'>Welcome Guest</a>";
          // } else {
          //   echo "<a class='nav-link text-dark' href='#'>Welcome " . $_SESSION['username'] . "</a>";
          // }

          ?>
        </p>
      <!-- </div>
    </div>
  </nav> -->
  <?php
  cart();
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 bg1 mb-3 m-auto">
        <ul class="navbar-nav me-auto">
          <li class="nav-item1 m-auto my-3 text-center">
            <a class="nav-link text-dark fs-4" aria-current="page" href="#">Your Profile</a>
          </li>
          <?php
          $username = $_SESSION['username'];
          $user_image = "Select * from user_table where username='$username'";
          $result_image = mysqli_query($con, $user_image);
          $row_image = mysqli_fetch_array($result_image);
          $user_image = $row_image['user_image'];
          echo "<li class='nav-item1 text-center mb-3'>
        <img src='./user_images/$user_image' alt='' width='90%' height='90%'>
        </li>";

          ?>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="profile.php">
              <i class="bi bi-clock-history pe-2"></i> Pending orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark w-100" aria-current="page" href="profile.php?my_orders">
              <i class="bi bi-list-ul pe-2"></i> My orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="profile.php?feedback">
              <i class="bi bi-chat pe-2"></i> Feedback</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="profile.php?wishlist">
              <i class="bi bi-bookmark-heart pe-2"></i> Wish List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="profile.php?edit_account">
              <i class="bi bi-box-arrow-in-down-left pe-2"></i> Edit Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="profile.php?delete_account">
              <i class="bi bi-trash pe-2"></i> Delete Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="logout.php">
              <i class="bi bi-box-arrow-in-right pe-2 m-0 fs-5 fw-normal"></i> Logout</a>
          </li>
        </ul>
      </div>

      <div class="col-md-10 text-center">
        <?php
        get_user_order_details();
        if (isset($_GET['feedback'])) {
          include('feedback.php');
        }
        if(isset($_GET['wishlist'])){
          include('wishlist1.php');
        }
        if (isset($_GET['edit_account'])) {
          include('edit_account.php');
        }
        if(isset($_GET['delete_wish'])){
          include('delete_wish.php');
        }
        if (isset($_GET['my_orders'])) {
          include('user_orders.php');
        }
        if (isset($_GET['delete_account'])) {
          include('delete_account.php');
        }

        ?>
      </div>
    </div>
  </div>

  <footer class="contact">
    <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>