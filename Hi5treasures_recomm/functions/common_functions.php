<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'path/to/phpmailer/src/Exception.php';
// require 'path/to/phpmailer/src/PHPMailer.php';
// require 'path/to/phpmailer/src/SMTP.php';

//Load Composer's autoloader
//require './vendor/autoload.php';

function sendemail_verify($user_username,$user_email,$verify_token)
{
  

// require 'path/to/phpmailer/src/Exception.php';
// require 'path/to/phpmailer/src/PHPMailer.php';
// require 'path/to/phpmailer/src/SMTP.php';

//Load Composer's autoloader
require '../vendor/autoload.php';

  $mail = new PHPMailer();
  try{
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hi5treasures.pkr@gmail.com';                     //SMTP username
    $mail->Password   = 'vsxg mxpy hvmo duue';                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587; 

    $mail->setFrom("hi5treasures.pkr@gmail.com", "hi5treasures_pkr");
    $mail->addAddress($user_email,$user_username);

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from Hi5treasures._.pkr ';

    $email_template="<h2>You have registered with Hi5treasures._.pkr</h2><h5>Verify your email address to login with the below given link</h5><br><br><a href='http://localhost/Hi5treasures_with_v_and_v/users_area/verify_email.php?token=$verify_token'>Click Me</a>";

      $mail->Body    = $email_template;
      $mail->send();
    //echo 'Message has been sent';
  }
  
    catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
  }

  function resend_email_verify($name, $email, $verify_token)
{
require '../vendor/autoload.php';

  $mail = new PHPMailer();
  try{
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hi5treasures.pkr@gmail.com';                     //SMTP username
    $mail->Password   = 'vsxg mxpy hvmo duue';                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587; 

    $mail->setFrom("hi5treasures.pkr@gmail.com", "hi5treasures_pkr");
    $mail->addAddress($email,$name);

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resend-Email Verification from Hi5treasures._.pkr ';

    $email_template="<h2>You have registered with Hi5treasures._.pkr</h2><br><h5>Verify your email address to login with the below given link</h5><br><br><a href='http://localhost/Hi5treasures_with_v_and_v/users_area/verify_email.php?token=$verify_token'>Click Me</a>";

      $mail->Body    = $email_template;
      $mail->send();
    //echo 'Message has been sent';
  }
  
    catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
  }

  function send_password_reset($name,$email,$token)
  
    {
      require '../vendor/autoload.php';
      
        $mail = new PHPMailer();
        try{
          //Server settings
          // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'hi5treasures.pkr@gmail.com';                     //SMTP username
          $mail->Password   = 'vsxg mxpy hvmo duue';                               //SMTP password
          $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
          $mail->Port       = 587; 
      
          $mail->setFrom("hi5treasures.pkr@gmail.com", "hi5treasures_pkr");
          $mail->addAddress($email,$name);
      
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Reset Password Notification';
      
          $email_template="<h2>Hello</h2><h4>You are receiving this email because we received a password reset request for your account</h4><br><br><a href='http://localhost/Hi5treasures_with_v_and_v/users_area/password_changed.php?token=$token&user_email=$email'>Click Me</a>";
      
            $mail->Body    = $email_template;
            $mail->send();
          //echo 'Message has been sent';
        }
        
          catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

  }
      
  
      
  
  
  



function get_unique_categories()
{
  global $con;
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $select_query = "Select * from `products` where category_id=$category_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<div class='text-center my-5 m-auto'><img src='./images/sad.png' alt='' width='25%' height='25%'></div>";
      echo "<h2 class='text-center text-danger'>No product in this category!!!</h3>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $category_id = $row['category_id'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];

      echo "<div class='col-md-4 col-sm-6 mb-3'>
          <div class='card border border-dark h-100'>
          <img src='./admin_area/product_images/$product_image1' title='$product_title'
          class='card-img-top object-fit-contain p-2' alt='$product_title' width='100%' height='350px'>
          <div class='card-body'>
            <h4 class='card-title'><a href='wishlist.php?product_id=$product_id' class='btn1 text-dark ms-0' title='Like this image'><i class='bi bi-heart fs-5 me-2'></i></a>$product_title</h4>
              <p class='card-text'>$product_description</p>
              <p class='card-text'>NPR. <strong>$product_price/-</strong></p>
            <a href='home.php?add_to_cart=$product_id' 
            class='mbtn3 px-3 py-2 my-1'>Add to cart</a>
            <a href='product_details.php?product_id=$product_id' 
            class='mbtn3 px-3 py-2 my-1'>View More</a>
          </div>
          </div>
          </div>";
    }
  }
}

function search_product()
{
  global $con;
  $search_data_value = $_GET['search_data'];
    $search_query = "Select * from `products` where product_keywords like 
                   '%$search_data_value%'";
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);

    if ($num_of_rows == 0) {
      echo "<h2 class='text-center text-danger' ><img src='images/search.gif'></h2>";
    }
    else{
      // echo "<h6 class='text-center' ><img src='images/searchdone.gif' width='261' height='261'></h6>";
      // echo "<h2 class='text-center text-dark mb-5 fw-lighter'>Search Successful... Here are your products<img src='images/down1.gif' width='50' height='100'></h2>";
      echo "<div class='container-fluid'>
      <div class='row'>
          <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
              <div class='row d-flex justify-content-center'>";

    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $category_id = $row['category_id'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      if (isset($_GET['search_data_product'])) {
        if(isset($_SESSION['user_id'])){
          $user_id=$_SESSION['user_id'];

          $check_query = "SELECT * FROM search WHERE user_id = $user_id AND product_id = $product_id AND category_id = $category_id";
          $check_result = mysqli_query($con, $check_query);

          // $insert="insert into search(user_id,product_id,category_id) values($user_id,$product_id,$category_id)";
          // $insert_run=mysqli_query($con,$insert);
          if (mysqli_num_rows($check_result) == 0) {
            // Insert the record only if it doesn't already exist
            $insert_query = "INSERT IGNORE INTO search (user_id, product_id, category_id) VALUES ($user_id, $product_id, $category_id)";
            $insert_result = mysqli_query($con, $insert_query);

            if (!$insert_result) {
                // Handle insertion error
                echo "Error: " . mysqli_error($con);
            }
        }
        }
      echo "<div class='col-xl-3 col-lg-3 col-md-6 col-12 col-sm-12 mb-3'>
                        <div class='card border border-dark h-100'>
                        <img src='./admin_area/product_images/$product_image1' title='$product_title'
                        class='card-img-top object-fit-contain p-2' alt='$product_title' width='100%' height='350px'>
                        <div class='card-body'>
                          <h4 class='card-title'><a href='wishlist.php?product_id=$product_id' class='btn1 text-dark ms-0' title='Like this image'><i class='bi bi-heart fs-5 me-2'></i></a>$product_title</h4>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>NPR. <strong>$product_price/-</strong></p>
                          <a href='home.php?add_to_cart=$product_id' 
                          class='mbtn3 px-3 py-2 my-1'>Add to cart</a>
                          <a href='product_details.php?product_id=$product_id' 
                          class='mbtn3 px-3 py-2 my-1'>View More</a>
                        </div>
                        </div>
                        </div>";
    }
  }
  echo "</div></div></div></div>";
}
}

function view_details()
{
  global $con;
  if (isset($_GET['product_id'])) {
    $product_id1 = $_GET['product_id'];
    $select_query = "Select * from products where product_id=$product_id1 ";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $category_id = $row['category_id'];
      $product_image1 = $row['product_image1'];
      $product_image2 = $row['product_image2'];
      $product_image3 = $row['product_image3'];
      $product_price = $row['product_price'];
      echo "<section class='products' id='productss'>
                        <div class='container'>
                          <div class='row d-flex justify-content-center'>
                            <div id='carouselExampleControls' class='carousel carousel-dark slide' data-bs-ride='carousel'>
                              <div class='carousel-inner'>
                                <div class='carousel-item active'>
                                  <div class='row g-3 d-flex justify-content-center'>
                                  <div class='col-lg-4 col-md-6 col-sm-12'>
                        <div class='cards-wrapper'>
                          <div class='card py-3 mb-3' style='width: 18rem;'>
                            <div class='image-wrapper'>
                              <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                            </div>
                            <div class='card-body'>
                              <h5 class='card-title'>$product_title</h5>
                              <p class='card-text'>$product_description</p>
                              <p class='card-text'>NPR: $product_price /-</p>
                              <a href='home.php?add_to_cart=$product_id' class='mbtn3 p-2 my-1'>Add To Cart</a>
                              <a href='home.php' class='mbtn3 p-2 my-1'>Go home</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                      <h1 class='text-center'>RELATED <span class='px-4'>PRODUCTS</span></h1>
</div>
                      <div class='col-lg-3 col-md-6 col-sm-12'>
                  <div class='cards-wrapper'>
                    <div class='card py-3 mb-3' style='width: 18rem;'>
                      <div class='image-wrapper'>
                        <img src='./admin_area/product_images/$product_image2' alt='...'>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='col-lg-3 col-md-6 col-sm-12'>
                  <div class='cards-wrapper'>
                    <div class='card py-3 mb-3' style='width: 18rem;'>
                      <div class='image-wrapper'>
                        <img src='./admin_area/product_images/$product_image3' alt='...'>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div> </div></div></div></div></div></div></section>";
    }
  }
}

function getIPAddress()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip; 


function cart()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_address = getIPAddress();
    $get_product_id = $_GET['add_to_cart'];
    $select_query = "Select * from cart_details where ip_address='$get_ip_address' and
       product_id=$get_product_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);

    if ($num_of_rows > 0) {
      echo "<script>alert('This item is already present inside cart')</script>";
      echo "<script>window.open('home.php','_self')</script>";
    } else {
      if (!isset($_SESSION['user_id'])) {
        $insert_query = "Insert into cart_details (product_id,quantity,ip_address,user_id) values
        ($get_product_id,1,'$get_ip_address',0)";
        $result_query = mysqli_query($con, $insert_query);
        echo "<script>alert('Item is added to cart')</script>";
        echo "<script>window.open('home.php','_self')</script>";
      }
      else if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $insert_query = "Insert into cart_details (product_id,quantity,ip_address,user_id) values
        ($get_product_id,1,'$get_ip_address',$user_id)";
        $result_query = mysqli_query($con, $insert_query);
        echo "<script>alert('Item is added to cart')</script>";
        echo "<script>window.open('home.php','_self')</script>";
      }
    }
  }
}


// function cart_item()
// {
//   if (isset($_GET['add_to_cart'])) {
//     global $con;
//     $get_ip_address = getIPAddress();
//     $select_query = "Select * from cart_details where ip_address='$get_ip_address'";
//     $result_query = mysqli_query($con, $select_query);
//     $count_cart_items = mysqli_num_rows($result_query);
//   } else {
//     global $con;
//     $get_ip_address = getIPAddress();
//     $select_query = "Select * from cart_details where ip_address='$get_ip_address'";
//     $result_query = mysqli_query($con, $select_query);
//     $count_cart_items = mysqli_num_rows($result_query);
//   }
//   echo $count_cart_items;
// }
function cart_item()
{
    global $con;
    $get_ip_address = getIPAddress();
    $quantity=0;
    if(isset($_SESSION['user_id']))
    {
      $user_id=$_SESSION['user_id'];
    }
    else{
      $user_id=0;
    }
    if(isset($_GET['add_to_cart()'])){
      $product_id=$_GET['add_to_cart'];
      $insert_query=mysqli_query($con,"Insert into cart_details(product_id,quantity,ip_address,user_id) values
      ($product_id,$quantity,'$get_ip_address',$user_id) where product_id=$product_id");

    $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
    }
    else {
          global $con;
          $get_ip_address = getIPAddress();
          $select_query = "Select * from cart_details where ip_address='$get_ip_address'";
          $result_query = mysqli_query($con, $select_query);
          $count_cart_items = mysqli_num_rows($result_query);
}
echo $count_cart_items;
}


// function total_cart_price()
// {
//   global $con;
//   $user_id=$_SESSION['user_id'];
//   $total_price = 0;
//   $cart_query = "Select * from cart_details where user_id=$user_id";
//   $result = mysqli_query($con, $cart_query);
//   while ($row = mysqli_fetch_array($result)) {
//     $product_id = $row['product_id'];
//     $select_products = "Select * from products where product_id=$product_id";
//     $result_products = mysqli_query($con, $select_products);
//     while ($row_product_price = mysqli_fetch_array($result_products)) {
//       $product_price = array($row_product_price['product_price']);
//       $product_values = array_sum($product_price);
//       $total_price += $product_values;
//     }
//   }
//   echo $total_price;
// }






//get user order 
function get_user_order_details()
{
  global $con;
  $username = $_SESSION['username'];
  $get_details = "Select * from user_table where username='$username'";
  $result_query = mysqli_query($con, $get_details);
  while ($row_query = mysqli_fetch_array($result_query)) {
    $user_id = $row_query['user_id'];
    if (!isset($_GET['feedback'])) {
      if (!isset($_GET['edit_account'])) {
        if (!isset($_GET['my_orders'])) {
          if(!isset($_GET['wishlist'])){
          if (!isset($_GET['delete_account'])) {
            $get_orders = "Select * from user_orders where user_id=$user_id and 
           order_status='pending'";
            $result_orders_query = mysqli_query($con, $get_orders);
            $row_count = mysqli_num_rows($result_orders_query);
            if ($row_count > 0) {
              echo "<h3 class='text-center my-5 pt-5'>You have <b class='text-danger'>$row_count</b>
             pending orders</h3>";
              echo "<p class='text-center fs-4'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
            } else {
              echo "<h3 class='text-center my-5 pt-5'>You have zero pending orders</h3>";
              echo "<p class='text-center fs-4'><a href='../home.php' class='text-dark'>Explore Products</a></p>";
            }
          }
        }
      }
      }
    }
  }
}

function admin_front()
{
  global $con;
  // if(!isset($_GET['insert_about_us']))
  // {
  // if (!isset($_GET['list_about_us'])) {
    if (!isset($_GET['get_message'])) {
    if (!isset($_GET['edit_about_us'])) {
      if (!isset($_GET['insert_faq'])) {
        if (!isset($_GET['list_faq'])) {
          if (!isset($_GET['edit_faq'])) {
            if (!isset($_GET['delete_faq'])) {
    if (!isset($_GET['insert_product'])) {
      if (!isset($_GET['insertcategoriess'])) {
        if (!isset($_GET['view_products'])) {
          if (!isset($_GET['edit_products'])) { 
          if (!isset($_GET['view_categories'])) {
            if (!isset($_GET['edit_category'])) {
            if (!isset($_GET['list_users'])) {
              if (!isset($_GET['list_orders'])) {
                if (!isset($_GET['view_details'])) {
                if (!isset($_GET['delete_account'])) {
                  if (!isset($_GET['edit_account'])) {
                    if (!isset($_GET['list_payments'])) {
                      $get_products = "Select * from products";
                      $result1 = mysqli_query($con, $get_products);
                      $row_count1 = mysqli_num_rows($result1);

                      $get_categories = "Select * from categories";
                      $result2 = mysqli_query($con, $get_categories);
                      $row_count2 = mysqli_num_rows($result2);

                      $get_orders = "Select * from user_orders";
                      $result3 = mysqli_query($con, $get_orders);
                      $row_count3 = mysqli_num_rows($result3);

                      $get_users = "Select * from user_table where user_type='User'";
                      $result4 = mysqli_query($con, $get_users);
                      $row_count4 = mysqli_num_rows($result4);

                      $get_notification = "Select * from chat where is_read = 0";
                      $result5 = mysqli_query($con, $get_notification);
                      $row_count5 = mysqli_num_rows($result5);

                      echo "
                      
          <div class='d-flex justify-content-center align-items-center' style='height: 100vh;'>
          <div class='row'>
              <div class='col-sm-6 col-lg-6 mb-3'>
                  <div class='card  bg1 border shadow rounded'>
                  <div class='card-body text-center'>
                      <h5 class='card-title'><i class='bi bi-gift d-block fs-1 mb-3'></i>Products
                   ($row_count1)
                   </h5>
                      
                  </div>
                  </div>
              </div>";

                      echo "<div class='col-sm-6 col-lg-6 mb-3'>
                  <div class='card  bg1 border shadow rounded'>
                  <div class='card-body text-center'>
                  <h5 class='card-title'><i class='bi bi-list-task d-block fs-1 mb-3'></i>Categories
                  ($row_count2) 
                 </h5>
                      
                  </div>
                  </div>
              </div>
              <div class='col-sm-6 col-lg-6 mb-3'>
                  <div class='card bg1 border shadow rounded'>
                  <div class='card-body text-center'>
                  <h5 class='card-title'><i class='bi bi-card-checklist d-block fs-1 mb-3'></i>Order
                   ($row_count3) 
                  </h5>
                      
                  </div>
                  </div>
              </div>";
                      echo "<div class='col-sm-6 col-lg-6 mb-3'>
                        <div class='card  bg1 border shadow rounded'>
                        <div class='card-body text-center'>
                        <h5 class='card-title'><i class='bi bi-people d-block fs-1 mb-3'></i>Users 

                         ($row_count4) 
                        </h5>
                            
                        </div>
                        </div>
                    </div>";
                    echo"<div class='col-sm-6 col-lg-6 mb-3'>
                    <div class='card  bg1 border shadow rounded'>
                    <div class='card-body text-center'>
                    <h5 class='card-title'><i class='bi bi-bell d-block fs-1 mb-3'></i>Notifications 

                     ($row_count5) 
                    </h5>
                        
                    </div>
                    </div>
                </div>
              </div>
              </div>
              ";
                    }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}}}}}}})
  

function remove_wish()
{
  global $con;
  if (isset($_GET['delete_wish'])) {
    $delete_id = mysqli_real_escape_string($con, $_GET['delete_wish']);
    $user_id = $_SESSION['user_id'];
    $delete_wish = "DELETE FROM wishlist WHERE product_id='$delete_id' AND user_id='$user_id'";
    $delete_run = mysqli_query($con, $delete_wish);
    if ($delete_run) {
      echo "<script>alert('Product removed from wishlist');</script>";
      echo "<script>window.open('wishlist.php','_self');</script>";
    } else {
      echo "<script>alert('Failed to remove product from wishlist');</script>";
    }
  }
}

function recommendProducts($con, $userId) {
  $sql = "SELECT DISTINCT p.product_title,p.product_image1,p.product_description,p.product_price,p.product_id
          FROM products p
          JOIN recommendations r ON p.product_id = r.product_id or p.category_id=r.category_id
          WHERE r.user_id = $userId
          ORDER BY RAND()";

  $result = mysqli_query($con, $sql);
  $recommendations = [];
  if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          $recommendations[] = [$row["product_id"],$row["product_title"],$row["product_image1"],$row["product_description"],$row["product_price"]];
      }
  }
  return $recommendations;
}

?>
