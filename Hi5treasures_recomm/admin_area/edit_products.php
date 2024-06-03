<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_data = "Select * from products where product_id=$edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];

    //fetching category id
    $select_category = "Select * from categories where category_id=$category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center my-5">EDIT <span class="px-4">PRODUCTS</span></h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" id="product_title" name="product_title" value="<?php echo $product_title; ?>" class="form-control my-3" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_desc" class="form-label">Product Description</label>
                <input type="text" id="product_desc" value="<?php echo $product_description; ?>" name="product_desc" class="form-control my-3" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" id="product_keywords" name="product_keywords" value="<?php echo $product_keywords; ?>" class="form-control my-3" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_category" class="form-label">Product Categories</label>
                <select name="product_category" class="form-select">
                    <option value="<?php echo $category_title; ?>"><?php echo $category_title; ?></option>
                    <?php
                    $select_category_all = "Select * from categories";
                    $result_category_all = mysqli_query($con, $select_category_all);
                    while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                        $category_title = $row_category_all['category_title'];
                        $category_id = $row_category_all['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    };
                    ?>
                </select>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image1" class="form-label">Product image1</label>
                <div class="d-flex">
                    <input type="file" id="product_image1" name="product_image1" class="form-control my-3 w-90 m-auto" required="required">
                    <img src="./product_images/<?php echo $product_image1; ?>" alt="" width="100px" height="80px">
                </div>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image2" class="form-label">Product image2</label>
                <div class="d-flex">
                    <input type="file" id="product_image2" name="product_image2" class="form-control my-3 w-90 m-auto" required="required">
                    <img src="./product_images/<?php echo $product_image2; ?>" alt="" width="100px" height="80px">
                </div>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_image3" class="form-label">Product image3</label>
                <div class="d-flex">
                    <input type="file" id="product_image3" name="product_image3" class="form-control my-3 w-90 m-auto" required="required">
                    <img src="./product_images/<?php echo $product_image3; ?>" alt="" width="100px" height="80px">
                </div>
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" id="product_price" name="product_price" value="<?php echo $product_price; ?>" class="form-control my-3" required="required">
            </div>
            <div class="text-center">
                <input type="submit" name="edit_product" class="mbtn1 mb-3" value="Update product">
            </div>
        </form>
    </div>
</body>

</html>


<!-- editing Products -->
<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_desc = $_POST['product_desc'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    move_uploaded_file($temp_image1, "./product_images/$product_image1");
    move_uploaded_file($temp_image2, "./product_images/$product_image2");
    move_uploaded_file($temp_image3, "./product_images/$product_image3");

    $update_product = "Update products set product_title='$product_title',product_description=
    '$product_description',product_keywords='$product_keywords',category_id='$product_category',
    product_image1='$product_image1',product_image2='$product_image2',product_image3
    ='$product_image3',product_price='$product_price',date=NOW() where product_id=$edit_id";

    $result_update = mysqli_query($con, $update_product);
    if ($result_update) {
        echo "<script>alert('Product updated successfully')</script>";
        echo "<script>window.open('./index.php?view_products','_self')</script>";
    }
}

?>