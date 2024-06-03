<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}

if (isset($_GET['delete_category'])) {
    $delete_id = $_GET['delete_category'];
    $delete_category = "Delete from categories where category_id=$delete_id";
    $result_category = mysqli_query($con, $delete_category);
    if ($result_category) {
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }
}
