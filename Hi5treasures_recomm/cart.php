<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('includes/connect.php');
include('functions/common_functions.php');
include('include_aboutus.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Cart</title>
  <link href="admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
  <link href="css/style.css" rel="stylesheet">

  <style>
    .bi-journal-text {
      font-size: 23px;
      color: black;
      cursor: pointer;
      padding-top: 5px;
      transition: all 0.4s;
    }

    .bi-journal-text:hover {
      color: rgb(197, 12, 99);
    }

    .bi-box-arrow-in-right {
      font-size: 30px;
      color: black;
      cursor: pointer;
      padding-top: 5px;
      transition: all 0.4s;
    }

    .bi-box-arrow-in-right:hover {
      color: rgb(197, 12, 99);
    }

    .nav-item a:hover {
      border-bottom: 2px solid #ccc;
    }

    .mbtn5 {
      height: 50px;
      outline: none;
      border: none;
      padding-right: 25px;
      padding-left: 25px;
      margin: auto;
      color: white;
      background: rgb(197, 12, 99);
      border-radius: 50px;
      transition: all 0.4s;
    }

    .mbtn5:hover {
      background-color: antiquewhite;
      color: black;
      border: 1px solid black;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <?php
      echo "<a class='navbar-brand' href='home.php'>
      <img src='admin_area/admin_images/$logo' alt='Company Logo' width='100' height='100'></a>";
      ?>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item ps-2">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reviews.php">Reviews</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="recommendation.php">Choices</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php"><i class="bi bi-cart-fill"></i><sup><?php cart_item(); ?></sup></a>
          </li>
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
           echo "<a class='nav-link tect-decoration-none text-dark' href='chatbox.php'><i class='bi bi-bell-fill text-dark'></i><sup><sup class='text-dark'>$unread</sup></sup></a>";
      }
           ?>
        </ul>
        <?php
        if (!isset($_SESSION['username'])) {
          echo "<a class='nav-link text-dark' href='./users_area/user_login.php'>
        <i class='bi bi-person'></i></a>";
          echo "<a class='nav-link text-dark ' href='./users_area/user_registration.php'>
        <i class='bi bi-journal-text'></i></a>";
        } else {
          echo "<a class='nav-link text-dark' href='./users_area/logout.php'>
        <i class='bi bi-box-arrow-in-right'></i></a>";
          echo "<a class='nav-link text-dark ' href='./users_area/profile.php'>
        <i class='bi bi-person'></i></a>";
        }

        ?>
      </div>

    </div>
  </nav>
  <nav class="navbar-light bg-light">
    <div class="container">
      <div class="navbar1">
        <p class="text-center fs-5 p-2">
          <?php
          if (!isset($_SESSION['username'])) {
            echo "<a class='nav-link text-dark' href='users_area/profile.php'>Welcome Guest</a>";
          } else {
            echo "<a class='nav-link text-dark' href='users_area/profile.php'>Welcome " . $_SESSION['username'] . "</a>";
          }

          ?>
        </p>
      </div>
    </div>
  </nav>

  <?php
  cart();
  ?>

  <div class="container">
    <div class="row">
      <div class="col-xl-12 col-sm-12 col-lg-12 col-md-12 col-12">
        <form action="" method="post">
          <div class="table-responsive">
            <table class="table border border-dark my-3 text-center">

              <tbody>
                <?php
                $get_ip_address = getIPAddress();
                $total_price = 0;
                $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                $result = mysqli_query($con, $cart_query);
                $result_count = mysqli_num_rows($result);

                if ($result_count > 0) {
                  echo "<thead>
        <tr>
        <th>Product Title</th>
        <th>Product Image</th>
        <th>Quantity</th>
        <th>Product Price</th>
        <th>Remove</th>
        <th colspan='2'>Operations</th>
        </tr>
    </thead>";

                  while ($row = mysqli_fetch_array($result)) {
                    $product_id = $row['product_id'];
                    $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
                    $result_products = mysqli_query($con, $select_products);

                    while ($row_product_price = mysqli_fetch_array($result_products)) {
                      $product_price = $row_product_price['product_price'];
                      $product_title = $row_product_price['product_title'];
                      $product_image1 = $row_product_price['product_image1'];
                      $product_quantity = $row['quantity'];
                      $total_product_price = $product_price * $product_quantity;
                      $total_price += $total_product_price;
                ?>
                      <tr>
                        <td><?php echo $product_title; ?></td>
                        <td><img src="./admin_area/product_images/<?php echo $product_image1; ?>" alt="<?php echo $product_title; ?>" height="100" width="100" style="object-fit: contain;"></td>
                        <td><input type="number" name="quantity[<?php echo $product_id; ?>]" class="form-input w-50" value="<?php echo $product_quantity; ?>"></td>
                        <td><?php echo $product_price . '/-'; ?></td>
                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                        <td>
                          <input type="submit" value="Update" class="mbtn5 px-2 mx-1 my-1" name="update_cart">
                          <input type="submit" value="Remove" class="mbtn5 px-2 mx-1 my-1" name="remove_cart">
                        </td>
                      </tr>
                <?php
                    }
                  }
                } else {
                  echo "<div width='300px' class='text-center my-5'><img src='images/cart.jpg'></div>";
                  echo "<h5 class='text-center'>Hey, You have nothing in your cart. Let’s add gifts to your cart.</h5>";
                }
                ?>

                <?php
                if (isset($_POST['update_cart'])) {
                  foreach ($_POST['quantity'] as $product_id => $quantity) {
                    $update_cart = "UPDATE `cart_details` SET quantity=$quantity WHERE ip_address='$get_ip_address' AND product_id='$product_id'";
                    mysqli_query($con, $update_cart);
                  }
                  echo "<script>window.open('cart.php', '_self')</script>";
                }
                ?>

              </tbody>
            </table>
          </div>
          <div class="m-3">
            <?php
            $get_ip_address = getIPAddress();
            $cart_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
            $result = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result);
            if ($result_count > 0) {
              echo "<h4 class='px-3'>SubTotal: <strong>$total_price/-</strong></h4>
                        <input type='submit' value='Continue Shopping' class='mbtn5 mx-1 my-1' name='continue_shopping'>
                        <button class='mbtn5 mx-1 my-1'><a href='./users_area/checkout.php' value='Checkout' class='text-light text-decoration-none'>Checkout</a></button>
                        <input type='submit' value='Delete ALL' class='mbtn5 mx-1 my-1' name='delete_all'>";
            } else {
              echo "<div class='container d-flex justify-content-center'><input type='submit' value='Shop Now' class='mbtn5 px-3 mx-1 my-3' name='continue_shopping'></div>";
            }

            if (isset($_POST['continue_shopping'])) {
              echo "<script>window.open('home.php','_self')</script>";
            }

            ?>

          </div>
      </div>
    </div>
  </div>
  </form>

  <?php
  function remove_cart_item()
  {
    global $con;
    if (isset($_POST['remove_cart'])) {
      $remove_items = $_POST['removeitem'];
      foreach ($remove_items as $remove_id) {
        $delete_query = "Delete from `cart_details` where product_id=$remove_id";
        $run_delete = mysqli_query($con, $delete_query);
        if ($run_delete) {
          echo "<script>window.open('cart.php','_self')</script>";
        }
      }
    }
  }
  echo $remove_item = remove_cart_item();

  ?>

  <?php
  if (isset($_POST['delete_all'])) {
    $delete_query = "Delete from `cart_details`";
    $run_delete = mysqli_query($con, $delete_query);
    if ($run_delete) {
      echo "<script>alert('Cart is empty')</script>";
      echo "<script>window.open('cart.php','_self')</script>";
    }
  }



  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php
include('footer.php');
?>