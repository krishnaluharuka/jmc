<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_GET['delete_product'])) {
    $delete_id = $_GET['delete_product'];
    $delete_product = "Delete from products where product_id=$delete_id";
    $result_product = mysqli_query($con, $delete_product);
    if ($result_product) {
        echo "<script>alert('Product deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_products','_self')</script>";
    }
}
