<?php

$user_name = $_SESSION['username'];

if (!isset($user_name)) {
    echo "<script>window.open('user_login.php','_self')</script>";
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "Select * from user_orders where order_id=$order_id";
    $result = mysqli_query($con, $select_data);
    // $row_fetch = mysqli_fetch_assoc($result);
    // $invoice_number = $row_fetch['invoice_number'];
    // $amount_due = $row_fetch['amount_due'];
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
    // $invoice_number = $_POST['invoice_number'];
    // $amount = $_POST['amount'];
    // $payment_mode = $_POST['payment_mode'];
    $invoice_number = intval($_POST['invoice_number']);
    $payment_mode = htmlspecialchars(trim($_POST['payment_mode']));
    $order_id = intval($_POST['order_id']);

    // Check if order_id is set and valid
    if (!$order_id) {
        die('Invalid order ID.');
    }

    // Retrieve the correct amount from the database
    $query = "SELECT amount FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $amount = $row['amount']; // Get the correct amount from the database

        $insert_query = "Insert into user_payments (order_id,invoice_number,amount,payment_mode)
        values ($order_id,$invoice_number,$amount,'$payment_mode')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            
            echo "<h3 class='text-center'>Successfully completed the payment</h3>";
            echo "<script>window.open('profile.php?my_orders','_self')</script>";

            // Update the order status to complete
            $update_orders = "update user_orders set order_status='Complete' where order_id=$order_id";
            $result_orders = mysqli_query($con, $update_orders);
        }
        else {
            echo "<h3 class='text-center text-danger'>Payment could not be processed. Please try again.</h3>";
        }
    }
    else {
        echo "<h3 class='text-center text-danger'>Order not found. Please try again.</h3>";
    }
}
?>