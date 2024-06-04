<?php
include('setting.php');
echo "<h1>Payment Success</h1>";
// $invoice_number = isset($invoice_number) ? mysqli_real_escape_string($con, $invoice_number) : null;
// $invoice_number=isset($invoice_number);
        
// $oid=$_GET['oid'];
// $amt=$_GET['amt'];
// $ref=$_GET['refId'];
// echo $oid."<br>";
// echo $amt."<br>";
// echo $ref."<br>";
        
$ref = isset($_GET['refId']) ? $_GET['refId'] : null;
$order_id = isset($_GET['oid']) ? $_GET['oid'] : null;
$actualamount = isset($_GET['amt']) ? $_GET['amt'] : null;

$update_orders = "update user_payments set invoice_number='$invoice_number' where order_id='$order_id'";
        $result_orders = mysqli_query($con, $update_orders);

if (!$ref || !$order_id || !$actualamount) {
    die('Required GET parameters are missing.');
}

$data =[
    'amt'=>$actualamount,
    'rid'=>$ref,
    'pid'=>$order_id,
    'scd'=> $merchant_code
];

$curl = curl_init($fraudcheck_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    echo $response;
 
    curl_close($curl);

    if (strpos($response, "Success") !== false) {
        $insert_query = "Insert into user_payments (order_id,amount)
        values ('$order_id','$actualamount')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<h3 class='text-center'>Successfully completed the payment</h3>";
            echo "<script>window.open('profile.php?my_orders','_self')</script>";
        }
        $update_orders = "update user_orders set order_status='Complete' where order_id=$order_id";
        $result_orders = mysqli_query($con, $update_orders);
    }
    else{
        echo "<a href='http://localhost/hi5treasures_recomm/users_area/profile.php?my_order'>Go back</a>";
    }
    
    // if(){
    //     echo "<a href='http://localhost/hi5treasures_recomm/users_area/profile.php?my_order'>Go back</a>";
    // } else{
    //     //  header("Location: https://brp.com.np/esewa");
    //     echo "<a href='http://localhost/hi5treasures_recomm/users_area/profile.php?my_order'>Go back</a>";
    // }

    
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
