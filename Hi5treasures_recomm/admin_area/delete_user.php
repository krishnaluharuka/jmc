<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_GET['delete_user'])) {
    $delete_id = $_GET['delete_user'];
    $delete_user = "Delete from user_table where user_id=$delete_id";
    $result_user = mysqli_query($con, $delete_user);
    if ($result_user) {
        echo "<script>alert('User deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_users','_self')</script>";
    }
}
