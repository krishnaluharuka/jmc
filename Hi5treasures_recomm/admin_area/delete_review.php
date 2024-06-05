<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}

if (isset($_GET['delete_review'])) {
    $delete_id = $_GET['delete_review'];
    $delete_review = "Delete from feedback where feedback_id=$delete_id";
    $result_review = mysqli_query($con, $delete_review);
    if ($result_review) {
        echo "<script>alert('review deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_reviews','_self')</script>";
    }
}
