<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('../includes/connect.php');
include('../include_aboutus.php');
if (!isset($_SESSION['user_id'])) {
  echo "<script>window.open('user_login.php','_self');</script>";
}
$user_id = $_SESSION['user_id'];
// else {
//   
//   if (isset($_GET['product_id'])) {
//     $p_id = mysqli_real_escape_string($con, $_GET['product_id']);

//     $wish_query = "SELECT * FROM `wishlist` WHERE user_id='$user_id' and product_id='$p_id'";
//     $result = mysqli_query($con, $wish_query);
//     $result_count = mysqli_num_rows($result);
//     if ($result_count == 1) {
//       echo "<script>alert('product already exist in wishlist')</script>";
//       //echo "<script>window.open('home.php','_self')</script>";
//     } else {
//       $insertWish = "Insert into wishlist (product_id,user_id) values ('$p_id','$user_id')";
//       $insertwish_run = mysqli_query($con, $insertWish);
//       echo "<script>alert('product added to your wishlist')</script>";
//       echo "<script>window.open('home.php','_self')</script>";
//     }
//   } 
// }



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Wishlist</title>
  <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
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
<h3>My <span class="px-4"> Wishlist</span></h3>
    <div class="table-responsive">
    <table class="table table-bordered border border-dark mt-5 me-2">
        <thead class="bg1">
            <?php
          $wish_query = "SELECT * FROM `wishlist` WHERE user_id=$user_id";
                    $result1 = mysqli_query($con, $wish_query);
                    $result_count = mysqli_num_rows($result1);
                    
                    if ($result_count > 0) {
                      echo "<tr>
                <th>S.No</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Description</th>
                <th>Price</th>
                <th>Remove</th>
                </tr>
                </thead>
                <tbody>";
                $number = 1;
               
                      while ($row = mysqli_fetch_array($result1)) {
                        $product_id = $row['product_id'];
                        $select_products = "SELECT DISTINCT product_price,product_title,product_image1,product_description FROM products WHERE product_id='$product_id'";
                        $result_products = mysqli_query($con, $select_products);
          
                        while ($row_product = mysqli_fetch_array($result_products)) {
                          $product_price = $row_product['product_price'];
                          $product_title = $row_product['product_title'];
                          $product_image1 = $row_product['product_image1'];
                          $product_description = $row_product['product_description'];
                

                    echo "<tr>
                    <td>$number</td>
                    <td>$product_title</td>
                    <td><img src='../admin_area/product_images/$product_image1' alt='' width='100px'
                    height='80'></td>
                    <td class='text-start'>$product_description</td>
                    <td>$product_price/-</td>
                    <td><a href='profile.php?delete_wish=$product_id' type='button' 
                           class='text-dark' data-bs-toggle='modal' data-bs-target='#Modal_$product_id'>
                            <i class='bi bi-trash'></i>
                        </a></td>";
                    
                    $number++;
                }
            
            echo "<div class='modal fade' id='Modal_$product_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete this?</h5>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='mbtn1' data-bs-dismiss='modal'><a href='./profile.php?wishlist' class='text-light text-decoration-none'>No</a></button>
                        <button type='button' class='mbtn1'><a href='profile.php?delete_wish=$product_id' class='text-light text-decoration-none'>Yes</a></button>
                    </div>
                </div>
            </div>
        </div>";
          }
          }
            ?>
            </tbody>
    </table>
    </div>

  

  <!-- <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row d-flex justify-content-center text-start">
          <?php

//           $wish_query = "SELECT * FROM `wishlist` WHERE user_id=$user_id";
//           $result1 = mysqli_query($con, $wish_query);
//           $result_count = mysqli_num_rows($result1);
          
//           if ($result_count > 0) {
//             while ($row = mysqli_fetch_array($result1)) {
//               $product_id = $row['product_id'];
//               $select_products = "SELECT DISTINCT product_price,product_title,product_image1,product_description FROM products WHERE product_id='$product_id'";
//               $result_products = mysqli_query($con, $select_products);

//               while ($row_product = mysqli_fetch_array($result_products)) {
//                 $product_price = $row_product['product_price'];
//                 $product_title = $row_product['product_title'];
//                 $product_image1 = $row_product['product_image1'];
//                 $product_description = $row_product['product_description'];
//                 echo "<div class='col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-3'>
//                   <div class='card border border-dark h-100'>
//                   <img src='../admin_area/product_images/$product_image1' title='$product_title'
//                   class='card-img-top object-fit-contain p-2' alt='$product_title' width='100%' height='350px'>
//                   <div class='card-body'>
//                     <h4 class='card-title'><a href='wishlist1.php?delete_wish=$product_id' class='btn1 text-dark ms-0' title='Like this image'><i class='bi bi-heart fs-5 me-2'></i></a>$product_title</h4>
//                       <p class='card-text'>$product_description</p>
//                       <p class='card-text'>NPR. <strong>$product_price/-</strong></p>
//                     <a href='home.php?add_to_cart=$product_id' 
//                     class='mbtn3 px-3 py-2 my-1'>Add to cart</a>
//                     <a href='product_details.php?product_id=$product_id' 
//                     class='mbtn3 px-3 py-2 my-1'>View More</a>
//                   </div>
//                   </div>
//                   </div>";
//                   remove_wish1();
//               }
//             }
//           } 
        
//           else {
//             echo "<div width='300px' class='text-center my-5 m-auto'><img src='../images/sad.png'></div>
//             <div class='text-center my-5'><h5>Hey, You have nothing in your wishlist. </h5></div>";
            
           
//           }
//           echo "</div></div></div></div>";

//           function remove_wish1()
// {
//   global $con;
//   if (isset($_GET['delete_wish'])) {
//     $delete_id = mysqli_real_escape_string($con, $_GET['delete_wish']);
//     $user_id = $_SESSION['user_id'];
//     $delete_wish = "DELETE FROM wishlist WHERE product_id='$delete_id' AND user_id='$user_id'";
//     $delete_run = mysqli_query($con, $delete_wish);
//     if ($delete_run) {
//       echo "<script>alert('Product removed from wishlist');</script>";
//       echo "<script>window.open('profile.php?wishlist','_self');</script>";
//     } else {
//       echo "<script>alert('Failed to remove product from wishlist');</script>";
//     }
//   }
// } -->
          
          ?>

          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
 

