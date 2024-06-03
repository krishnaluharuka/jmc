<?php
include('includes/connect.php');

$select_query = mysqli_query($con, "Select * from about_us");
$result = mysqli_fetch_assoc($select_query);
$company_name = $result['company_name'];
$logo = $result['company_logo'];
$motto = $result['motto'];
$contact = $result['phone'];
$address = $result['location'];
$email = $result['email'];
$fb_link = $result['fb_link'];
$whatsapp_link = $result['whatsapp_link'];
$viber_link = $result['viber_link'];
$insta_link = $result['insta_link'];
$about_us = $result['about_us'];
$extra_info = $result['extra_info'];
?>