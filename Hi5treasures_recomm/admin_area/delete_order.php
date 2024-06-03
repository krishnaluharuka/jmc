<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_GET['delete_order'])) {
    $delete_id = $_GET['delete_order'];
    $delete_order = "Delete from user_orders where order_id=$delete_id";
    $result_order = mysqli_query($con, $delete_order);
    if ($result_order) {
        echo "<script>alert('Order deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_orders','_self')</script>";
    }
}
