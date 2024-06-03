<?php
include('includes/connect.php');
include('navbar.php');
include('include_aboutus.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
    <link href="images/logo.jpg" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <link href="css/style.css" rel="stylesheet">
  <style>
    .bg {
      background-color: antiquewhite;
    }

    body {
      overflow-x: hidden;
    }

    h1 {
      font-family: 'Tangerine', serif;
      font-size: 300%;
      text-shadow: 4px 4px 4px #aaa;
      font-weight: bold;
      letter-spacing: 5px;
    }

    h5 {
      font-family: 'Tangerine', serif;
      font-size: 150%;
      text-shadow: 4px 4px 4px #aaa;
      font-weight: bolder;
    }
    img:hover{
       transition: 0.4;
    }
    
    img{
      opacity: 0.8;
    }

img:hover {
  opacity: 1;
  transition: all 0.4s;
    padding: .5rem;
}




  </style>
</head>

<body>
<h2> Hello Krishan. its me sadikshya.</h2>
    <div class="font-effect-shadow-multiple">
    <h1 class="text-center my-1"><?php echo $company_name; ?></h1>
    <!-- <div class="text-center">
      <img src="images/line.jpg" height="25em" width="35%">
    </div> -->
    <!-- <h5 class="text-center mb-3"><?php //echo $motto; ?></h5> -->
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
        <div class="row d-flex justify-content-center">
          <?php
          if (!isset($_GET['category'])) {
            $select_query = "Select * from `products` ORDER BY RAND()";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
              $product_id = $row['product_id'];
              $product_title = $row['product_title'];
              $product_description = $row['product_description'];
              $category_id = $row['category_id'];
              $product_image1 = $row['product_image1'];
              $product_price = $row['product_price'];

              echo "<div class='col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-3'>
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
          
          ?></div>
         <?php get_unique_categories(); ?> 
      </div>

      <div class='col-md-2 bg mb-3 mt-5 border border-dark'>
        <ul class="navbar-nav me-auto">
          <li class="nav-item m-auto my-3">
            <a href="#" class="nav-link">
              <h6>OUR <span class="px-3">CATEGORIES</span></h6>
            </a>
          </li>
          <li class="nav-item m-auto">
            <?php
            $select_query = "Select * from categories order by rand()";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
              $category_id = $row['category_id'];
              $category_title = $row['category_title'];
              echo "<a href='home.php?category=$category_id' class='nav-link'><h6>$category_title</h6></a>";
            }

            
            ?>

          </li>
        </ul>
      </div>
    </div>
  </div>
 



        
  
</body>
</html>

  <?php
  include('footer.php');
  ?>
 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
        $(function () {
            $(".bi-heart").on("click", function () {
                $(this).toggleClass("is-active");
            });
        });
    </script>

  

    

<?php mysqli_close($con); ?>
