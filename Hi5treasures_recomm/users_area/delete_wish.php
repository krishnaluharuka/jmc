<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'];

if (!isset($username)) {
    echo "<script>window.open('user_login.php','_self')</script>";
}

// if (isset($_GET['delete_category'])) {
//     $delete_id = $_GET['delete_wish'];
//     $delete_category = "Delete from wishlist where product_id=$delete_id";
//     $result_category = mysqli_query($con, $delete_category);
//     if ($result_category) {
//         echo "<script>alert('Wish deleted successfully')</script>";
//         echo "<script>window.open('./profile.php?wishlist','_self')</script>";
//     }
// }

if (isset($_GET['delete_wish'])) {
        $delete_id = mysqli_real_escape_string($con, $_GET['delete_wish']);
        $user_id = $_SESSION['user_id'];
        $delete_wish = "DELETE FROM wishlist WHERE product_id='$delete_id' AND user_id='$user_id'";
        $delete_run = mysqli_query($con, $delete_wish);
        if ($delete_run) {
          echo "<script>window.open('profile.php?wishlist','_self');</script>";
        } else {
          echo "<script>alert('Failed to remove product from wishlist');</script>";
        }
      }
    