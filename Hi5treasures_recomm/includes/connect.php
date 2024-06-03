<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con = mysqli_connect('localhost', 'root', '', 'hi5treasues_recomm');
if (!$con) {
    die(mysqli_connect_error());
}
?>