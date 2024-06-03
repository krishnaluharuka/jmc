<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_GET['delete_payment'])) {
    $delete_id = $_GET['delete_payment'];
    $delete_payment = "Delete from user_payments where payment_id=$delete_id";
    $result_payment = mysqli_query($con, $delete_payment);
    if ($result_payment) {
        echo "<script>alert('Payment deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_payments','_self')</script>";
    }
}
