<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}

if (isset($_GET['delete_faq'])) {
    $delete_id = $_GET['delete_faq'];
    $delete_faq = "Delete from faq where f_id=$delete_id";
    $result_faq = mysqli_query($con, $delete_faq);
    if ($result_faq) {
        echo "<script>alert('FAQ deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_faq','_self')</script>";
    }
}
