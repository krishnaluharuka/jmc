<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['authenticated']))
{
    echo "<script>alert(please login to access dashboard)</script>";
    echo "<script>window.open('user_login.php','_self')";
    exit(0);
}
?>