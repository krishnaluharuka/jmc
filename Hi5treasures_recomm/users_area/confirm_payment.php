<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
include('../include_aboutus.php');

$user_name = $_SESSION['username'];

if (!isset($user_name)) {
    echo "<script>window.open('user_login.php','_self')</script>";
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "Select * from user_orders where order_id=$order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "Insert into user_payments (order_id,invoice_number,amount,payment_mode)
    values ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        echo "<h3 class='text-center'>Successfully completed the payment</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders = "update user_orders set order_status='Complete' where order_id=$order_id";
    $result_orders = mysqli_query($con, $update_orders);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body style="background-color: antiquewhite;">
    <div>
        <div class="container my-5">
            <h2 class="text-center">Confirm Payment</h2>
            <form action="" method="post">
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number; ?>">
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <label for="">Amount</label>
                    <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due; ?>">
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <select name="payment_mode" class="form-select w-50 m-auto">
                        <option>Select Payment Mode</option>
                        <option>Mobile Banking</option>
                        <option>esewa</option>
                        <option>Cash on delivery</option>
                        <option>Pay offline</option>

                    </select>
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <input type="submit" class="mbtn1" value="Confirm" name="confirm_payment">
                </div>
            </form>

        </div>
    </div>
</body>

</html>
<?php mysqli_close($con); ?>