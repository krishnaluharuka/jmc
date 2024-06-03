<?php

// Check if session is not already started, then start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('includes/connect.php');
include('navbar.php');
include('include_aboutus.php');

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    echo "<script>window.open('users_area/user_login.php','_self')</script>";
    exit;
}

// Fetch user ID from session
$userId = $_SESSION['user_id'];

// Get IP address
$ip_address = getIPAddress();

// Insert user's cart items into recommendations table
$select = "SELECT DISTINCT product_id FROM cart_details WHERE user_id = $userId AND ip_address = '$ip_address'";
$select_run = mysqli_query($con, $select);
while ($row = mysqli_fetch_array($select_run)) {
    $productId = $row['product_id'];
    $cart_query = "SELECT * FROM `recommendations` WHERE user_id='$userId' and product_id='$productId'";
    $result = mysqli_query($con, $cart_query);
    $result_count = mysqli_num_rows($result);
    if ($result_count > 0) {
    } else {
        $sql = "INSERT INTO recommendations (user_id, product_id) 
        VALUES ($userId, $productId)";
        $sql_run = mysqli_query($con, $sql);
        if (!$sql_run) {
            echo "Error inserting recommendation: " . mysqli_error($con);
        }
    }
}

// $select_orders = "SELECT DISTINCT product_id FROM orders_pending WHERE user_id = $userId ";
// $select_run1 = mysqli_query($con, $select_orders);
// while ($row_order = mysqli_fetch_array($select_run1)) {
//     $productid = $row_order['product_id'];
//     $sql1 = "INSERT INTO recommendations (user_id, product_id) 
//             VALUES ($userId, $productid)";
//     $sql_run1 = mysqli_query($con, $sql1);
//     if (!$sql_run1) {
//         echo "Error inserting recommendation: " . mysqli_error($con);
//     }
// }

$select_wish = "SELECT DISTINCT product_id FROM wishlist WHERE user_id = $userId ";
$select_run2 = mysqli_query($con, $select_wish);
while ($row_wish = mysqli_fetch_array($select_run2)) {
    $product_Id = $row_wish['product_id'];
    $wish_query = "SELECT * FROM `recommendations` WHERE user_id='$userId' and product_id='$product_Id'";
    $result2 = mysqli_query($con, $wish_query);
    $result_count2 = mysqli_num_rows($result2);
    if ($result_count2 > 0) {
    } else {
        $sql2 = "INSERT INTO recommendations (user_id, product_id) 
            VALUES ($userId, $product_Id)";
        $sql_run2 = mysqli_query($con, $sql2);
        if (!$sql_run2) {
            echo "Error inserting recommendation: " . mysqli_error($con);
        }
    }
}

$select_search = "SELECT DISTINCT product_id,category_id FROM search WHERE user_id = $userId ";
$select_run3 = mysqli_query($con, $select_search);
while ($row_search = mysqli_fetch_array($select_run3)) {
    $product_id = $row_search['product_id'];
    $category_id = $row_search['category_id'];
    $search_query = "SELECT * FROM `recommendations` WHERE user_id='$userId' and product_id='$product_id' or category_id='$category_id'";
    $result3 = mysqli_query($con, $search_query);
    $result_count3 = mysqli_num_rows($result3);
    if ($result_count3 > 0) {
    } else {
        $sql3 = "INSERT INTO recommendations (user_id, product_id,category_id) 
            VALUES ($userId, $product_id,$category_id)";
        $sql_run3 = mysqli_query($con, $sql3);
        if (!$sql_run3) {
            echo "Error inserting recommendation: " . mysqli_error($con);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Choices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <?php
    $recommendedProducts = recommendProducts($con, $userId);
    echo "<div class='text-center'><h1 class=''><b>RECOMMENDATIONS</b> for You</h1></div>";

    echo "<div class=''><p class='text-center'>$company_name has new recommendations for you based on  your choice</p></div><hr>";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row d-flex justify-content-center">
                    <?php
                    foreach ($recommendedProducts as $product) {
                        $product_id = $product[0];
                        $product_title = $product[1];
                        $product_image1 = $product[2];
                        $product_description = $product[3];
                        $product_price = $product[4];
                        echo "<div class='col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3'>
                  <div class='card border border-dark h-100'>
                    <img src='./admin_area/product_images/$product_image1' 
                      class='card-img-top object-fit-contain p-2' alt='$product_title' width='100%' height='350px' >
                      <div class='card-body'>
                        <h4 class='card-title'>$product_title</h4>
                          <p class='card-text'>$product_description</p>
                          <p class='card-text'>NPR. <strong>$product_price/-</strong></p>
                        <a href='home.php?add_to_cart=$product_id' 
                        class='mbtn3 p-2 my-1'>Add to cart</a>
                        <a href='product_details.php?product_id=$product_id' 
                        class='mbtn3 p-2 my-1'>View More</a>
                      </div>
                  </div>
                  </div>";
                    }


                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>
<?php mysqli_close($con); ?>