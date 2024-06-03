<?php
include('includes/connect.php');
include('navbar.php');
include('include_aboutus.php');

$results_per_page = 6;

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Check if a category filter is applied
$category_filter = "";
if (isset($_GET['category'])) {
    $category_id = (int)$_GET['category'];
    $category_filter = " WHERE category_id = $category_id";
}

// Find out the number of results stored in the database
$result = $con->query("SELECT COUNT(*) AS total FROM products $category_filter");
$row = $result->fetch_assoc();
$number_of_results = $row['total'];

// Determine number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

if ($page > $number_of_pages) $page = $number_of_pages;

// Determine the starting limit number for the results on the displaying page
$start_limit = ($page - 1) * $results_per_page;

// Retrieve the selected results from the database
$stmt = $con->prepare("SELECT * FROM products $category_filter LIMIT ?, ?");
$stmt->bind_param('ii', $start_limit, $results_per_page);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
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
    .pagination {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

.pagination a {
    padding: 10px 20px;
    margin: 0 5px;
    text-decoration: none;
    background: rgb(197, 12, 99);
    color: white;
    border-radius: 5px;
}

.pagination a.active {
    background:  rgb(197, 12, 99);
}

.pagination a:hover {
    background: white;
    color: black;
}
  </style>
</head>

<body>

  <div class="font-effect-shadow-multiple">
    <h1 class="text-center my-1"><?php echo $company_name; ?></h1>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
        <div class="row d-flex justify-content-center">
          <?php
          // Use the paginated results from the $result variable
          while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo "<div class='col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-3'>
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

  
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="home.php?page=<?php echo $page - 1; if (isset($category_id)) echo "&category=$category_id"; ?>">&laquo; Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $number_of_pages; $i++): ?>
      <a href="home.php?page=<?php echo $i; if (isset($category_id)) echo "&category=$category_id"; ?>"<?php if ($page == $i) echo ' class="active"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($page < $number_of_pages): ?>
      <a href="home.php?page=<?php echo $page + 1; if (isset($category_id)) echo "&category=$category_id"; ?>">Next &raquo;</a>
    <?php endif; ?>
  </div>

  <?php
  include('footer.php');
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<?php mysqli_close($con); ?>
