<?php
session_start();
session_unset();
session_destroy();
echo "<script>window.open('../users_area/user_login.php','_self')</script>";
?>