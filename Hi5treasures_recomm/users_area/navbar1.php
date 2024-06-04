<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('../includes/connect.php');
include('../functions/common_functions.php');
include('../include_aboutus.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link href="css/style.css" rel="stylesheet">
  <style>
    .bi-journal-text {
      font-size: 23px;
      color: black;
      cursor: pointer;
      /* padding-top: 5px; */
      transition: all 0.4s;
    }

    .bi-journal-text:hover {
      color: rgb(197, 12, 99);
    }

    .bi-box-arrow-in-right {
      font-size: 30px;
      color: black;
      cursor: pointer;
      /* padding-top: 5px; */
      transition: all 0.4s;
    }

    .bi-box-arrow-in-right:hover {
      color: rgb(197, 12, 99);
    }

    .nav-item a:hover {
      border-bottom: 2px solid #ccc;
    }
    .bg{
    background-image: url(../images/bg9.jpg);
            background-size: cover;
            background-repeat: no-repeat;
    }
    .bg1{
      background-color: antiquewhite;
    }
    
  </style>
</head>

<body>
  <nav class="navbar navbar-container navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid m-2">
      <?php
      echo "<a class='navbar-brand' href='home.php'>
      <img src='../admin_area/admin_images/$logo' alt='Company Logo' width='100' height='100'></a>";
      ?>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../aboutus.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../reviews.php">Reviews</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contact.php">Contact</a>
          </li>
          <?php 
          if(isset($_SESSION['user_id'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='../recommendation.php'>Choices</a>
          </li>";
          }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="../faq_display.php">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../cart.php"><i class="bi bi-cart-fill m-0"></i><sup><?php cart_item(); ?></sup></a>
          </li>
          <li>
          <?php 
          if(isset($_SESSION['username'])){
          $username=$_SESSION['username'];
           $get_notification = "Select COUNT(*) as unread from chat where username='$username' AND is_read=1 and is_seen= 0";
           $result5 = mysqli_query($con, $get_notification);
           $unread=0;
           if ($result5) {
            $message_data = mysqli_fetch_assoc($result5);
            $unread= $message_data['unread'];
        }
        else{
          $unread=0;
        }
           $row_count5 = mysqli_num_rows($result5);
           echo "<a class='nav-link tect-decoration-none text-dark' href='../chatbox.php'><i class='bi bi-bell-fill fs-5 text-dark'></i><sup><sup class='text-dark'>$unread</sup></sup></a>";
      }
           ?>
           </li>
           <li>

<?php 
          if(isset($_SESSION['username'])){
           echo "<a class='nav-link tect-decoration-none text-dark' href='../wishlist.php'><i class='bi bi-bookmark-heart fs-5 mx-1'></i></a>";
          }
      
           ?>
           </li>
         
        </ul>
        <form class="d-flex" action="../search_product.php" method="get">
          <input class="px-2 search" type="search" height="60" placeholder="Search Here" name="search_data">
          <input type="submit" value="Search" class="btn1 px-3 me-2" name="search_data_product">
        </form>
        <?php
        if (!isset($_SESSION['username'])) {
          echo "<a class='nav-link text-dark' href='user_login.php'>
        <i class='bi bi-person'></i></a>";
          echo "<a class='nav-link text-dark ' href='user_registration.php'>
        <i class='bi bi-journal-text'></i></a>";
        } else {
          echo "<a class='nav-link text-dark' href='logout.php'>
        <i class='bi bi-box-arrow-in-right'></i></a>";
          echo "<a class='nav-link text-dark ' href='profile.php'>
        <i class='bi bi-person'></i></a>";
        }



        ?>

      </div>
    </div>
  </nav>
  <nav class="navbar-light bg">
    <div class="container">
      <div class="navbar1">
        <p class="text-center fs-5 p-2">
          <?php
          if (!isset($_SESSION['username'])) {
            echo "<a class='nav-link text-dark' href='#'>Welcome Guest</a>";
          } else {
            echo "<a class='nav-link text-dark' href='profile.php'>Welcome " . $_SESSION['username'] . "</a>";
          }

          ?>
        </p>
      </div>
    </div>
  </nav>
  <?php
  cart();
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
