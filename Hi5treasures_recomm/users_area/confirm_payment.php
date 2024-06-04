<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
include('../include_aboutus.php');

$user_name = $_SESSION['username'];

if (!isset($user_name)) {
    echo "<script>window.open('user_login.php','_self')</script>";
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $select_data = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    if ($result && mysqli_num_rows($result) > 0) {
        $row_fetch = mysqli_fetch_assoc($result);
        $invoice_number = $row_fetch['invoice_number'];
        $amount_due = $row_fetch['amount_due'];
    } else {
        echo "<h3 class='text-center text-danger'>Invalid order ID.</h3>";
        exit();
    }
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = intval($_POST['invoice_number']);
    $payment_mode = htmlspecialchars(trim($_POST['payment_mode']));
    $order_id = intval($_POST['order_id']);

    // Check if order_id is set and valid
    if (!$order_id) {
        die('Invalid order ID.');
    }

    // Retrieve the correct amount from the database
    $query = "SELECT amount_due FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $amount_due = $row['amount_due']; // Get the correct amount from the database

        $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode) VALUES ($order_id, $invoice_number, $amount_due, '$payment_mode')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<h3 class='text-center'>Successfully completed the payment</h3>";
            echo "<script>window.open('profile.php?my_orders','_self')</script>";

            // Update the order status to complete
            $update_orders = "UPDATE user_orders SET order_status = 'Complete' WHERE order_id = $order_id";
            mysqli_query($con, $update_orders);
        } else {
            echo "<h3 class='text-center text-danger'>Payment could not be processed. Please try again.</h3>";
        }
    } else {
        echo "<h3 class='text-center text-danger'>Order not found. Please try again.</h3>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body style="background-color: antiquewhite;">
    <div>
        <div class="container my-5">
            <h2 class="text-center">Confirm Payment</h2>
            <form action="confirm_payment.php" method="post">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number; ?>" readonly>
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due; ?>" readonly>
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <select name="payment_mode" class="form-select w-50 m-auto" required>
                        <option value="" disabled selected>Select Payment Mode</option>
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
