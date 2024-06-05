<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('../includes/connect.php');
include('navbar3.php');

$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
  echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin DashBoard</title>
  <link href="admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link href="../css/style.css" rel="stylesheet">
  <style>
    .bg {
      background-color: antiquewhite;

    }

    .nav-item a:hover {
      border-bottom: 2px solid #ccc;
    }
  </style>
</head>

<body>
  <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <?php
      // $select_query = mysqli_query($con, "Select * from about_us");
      // $result = mysqli_fetch_assoc($select_query);
      // $logo = $result['company_logo'];
      // echo "<a class='navbar-brand' href='index.php'><img src='./admin_images/$logo' alt='Company Logo' width='100' height='100'></a>";
      ?>
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
        <form class="d-flex" action="../search_product.php" method="get">
          <input class="px-2 search" type="search" height="60" placeholder="Search Here" name="search_data">
          <input type="submit" value="Search" class="btn1 px-3 me-2" name="search_data_product">
        </form>
        <?php
          // echo "<a class='nav-link text-dark' href='logout.php'><i class='bi bi-box-arrow-in-right fs-4'></i></a>";
        ?>

      </div>
    </div>
  </nav>
  <nav class="navbar-light bg-light">
    <div class="container">
      <div class="navbar1">
        <p class="text-center fs-5">
          <?php
          // if (!isset($_SESSION['admin_name'])) {
          //   echo "<a class='nav-link text-dark' href='#'>Welcome Guest</a>";
          // } else {
          //   echo "<a class='nav-link text-dark' href='#'>Welcome " . $_SESSION['admin_name'] . "</a>";
          // }

          ?>
        </p>
      </div>
    </div>
  </nav> -->

  <div class="container-fluid">
    <div class="row">
      <div class='col-lg-2 col-xl-2 col-md-3 col-sm-12 col-12 bg mb-3 mt-3'>
        <ul class="navbar-nav me-auto">
          <li class="nav-item m-auto my-3 text-center">
            <a class="nav-link text-dark fw-bold fs-6" aria-current="page" href="#">Admin Dashboard</a>
          </li>
          <?php
          $adminname = $_SESSION['admin_name'];
          $admin_image = "Select * from user_table where username='$adminname'";
          $result_image = mysqli_query($con, $admin_image);
          $row_image = mysqli_fetch_array($result_image);
          $admin_image = $row_image['user_image'];
          echo "<li class='nav-item1 text-center'>
                        <img src='../users_area/user_images/$admin_image' alt='' width='200px' height='200px'>
                        </li>";
          ?>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?edit_about_us"><i class="bi bi-box-arrow-in-down-left pe-2"></i> Edit About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?insert_faq"><i class="bi bi-question pe-2"></i> Insert faq</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?list_faq"><i class="bi bi-question-square pe-2"></i> View faq</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?insert_product"><i class="bi bi-plus pe-2"></i> Insert Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?insertcategoriess"><i class="bi bi-plus pe-2"></i> Insert Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?view_products"><i class="bi bi-gift pe-2"></i> View Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?view_categories"><i class="bi bi-list-task pe-2"></i> View Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?list_orders"><i class="bi bi-card-checklist pe-2"></i> All Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?list_payments"><i class="bi bi-wallet2 pe-2"></i> All Payments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?list_reviews"><i class="bi bi-star-fill pe-2"></i> All Reviews</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?list_users"><i class="bi bi-people pe-2"></i> List Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?edit_account"><i class="bi bi-box-arrow-in-down-left pe-2"></i> Edit Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="index.php?delete_account"><i class="bi bi-trash pe-2"></i> Delete Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="logout.php"><i class="bi bi-box-arrow-in-right pe-2"></i> Logout</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-10 col-md-9 col-sm-12  col-xl-10 col-12 text-center mt-5 m-auto">
        <?php
        admin_front();
        if (isset($_GET['get_message'])) {
          include('get_message.php');
        }
        if (isset($_GET['edit_about_us'])) {
          include('edit_about_us.php');
        }
        if (isset($_GET['insert_faq'])) {
          include('faq.php');
        }
        if (isset($_GET['list_faq'])) {
          include('list_faq.php');
        }
        if (isset($_GET['edit_faq'])) {
          include('edit_faq.php');
        }
        if (isset($_GET['delete_faq'])) {
          include('delete_faq.php');
        }
        if (isset($_GET['insert_product'])) {
          include('insert_product.php');
        }
        if (isset($_GET['insertcategoriess'])) {
          include('insertcategoriess.php');
        }
        if (isset($_GET['view_products'])) {
          include('view_products.php');
        }
        if (isset($_GET['edit_products'])) {
          include('edit_products.php');
        }
        if (isset($_GET['delete_product'])) {
          include('delete_product.php');
        }
        if (isset($_GET['view_categories'])) {
          include('view_categories.php');
        }
        if (isset($_GET['edit_category'])) {
          include('edit_category.php');
        }
        if (isset($_GET['delete_category'])) {
          include('delete_category.php');
        }
        if (isset($_GET['list_orders'])) {
          include('list_orders.php');
        }
        if (isset($_GET['view_details'])) {
          include('view_details.php');
        }
        if (isset($_GET['delete_order'])) {
          include('delete_order.php');
        }
        if (isset($_GET['list_payments'])) {
          include('list_payments.php');
        }
        if (isset($_GET['delete_payment'])) {
          include('delete_payment.php');
        }
        if (isset($_GET['list_reviews'])) {
          include('list_reviews.php');
        }
        if (isset($_GET['delete_review'])) {
          include('delete_review.php');
        }
        if (isset($_GET['list_users'])) {
          include('list_users.php');
        }
        if (isset($_GET['delete_user'])) {
          include('delete_user.php');
        }
        if (isset($_GET['edit_account'])) {
          include('edit_account.php');
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
