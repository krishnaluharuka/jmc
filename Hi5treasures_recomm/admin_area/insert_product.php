<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_categories = $_POST['product_categories'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // accessing temp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // validation for empty condition
    if (
        $product_title == '' or $product_description == '' or $product_keywords == '' or
        $product_categories == '' or $product_price == '' or $product_image1 == '' or $product_image2 == '' or
        $product_image3 == '' or $temp_image1 == '' or $temp_image2 == '' or $temp_image3 == ''
    ) {
        echo "<script>alert('please fill all the available fields')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // insert query
        $insert_products = "insert into `products` (product_title,product_description,
        product_keywords,category_id,product_image1,product_image2,product_image3,
        product_price,date,status) values  ('$product_title','$product_description',
        '$product_keywords',$product_categories,'$product_image1','$product_image2',
        '$product_image3','$product_price',NOW(),'$product_status')";
        $result_query = mysqli_query($con, $insert_products);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the products')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <h1 class="text-center">INSERT<span class="px-4">PRODUCTS</span></h1>

    <form action="" method="post" enctype="multipart/form-data" class="mt-5">
        <!-- title -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product title</label>
            <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product name" required="required">
        </div>

        <!-- description -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_description" class="form-label">Product description</label>
            <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" required="required">
        </div>

        <!-- keywords -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_keywords" class="form-label">Product keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" required="required">
        </div>

        <!-- categories -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_categories" id="" class="form-select">
                <option value="">Select Category</option>
                <?php
                $select_query = "Select * from categories";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>

        <!-- image1 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image1" class="form-label">Product image1</label>
            <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
        </div>

        <!-- image2 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image2" class="form-label">Product image2</label>
            <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
        </div>

        <!-- image3 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image3" class="form-label">Product image3</label>
            <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
        </div>

        <!-- price -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product price</label>
            <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" required="required">
        </div>

        <!-- Submit -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="insert_product" class="mbtn2 m-auto" value="Insert Products">
        </div>
    </form>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php mysqli_close($con); ?>