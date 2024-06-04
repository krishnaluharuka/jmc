<?php 
include('../includes/connect.php');

$epay_url = "https://uat.esewa.com.np/epay/main";
$successurl = "http://localhost/hi5treasures_recomm/users_area/success.php?q=su";
$failedurl = "http://localhost/hi5treasures_recomm/users_area/failed.php?q=fu";
$merchant_code = "EPAYTEST";
$fraudcheck_url = "https://uat.esewa.com.np/epay/transrec";

// For Amount Check
$actualamount = 1000;
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM user_orders WHERE order_id='$order_id'";
    $result = mysqli_query($con, $select_data);
    if ($result) {
        $row_fetch = mysqli_fetch_assoc($result);
        $invoice_number = $row_fetch['invoice_number'];
        $amount_due = $row_fetch['amount_due'];
        $damt = 100;
        $actualamount = $amount_due + $damt;
    } else {
        die('Error fetching order details: ' . mysqli_error($con));
    }
}
?>
