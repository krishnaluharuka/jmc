<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'];

if (!isset($username)) {
    echo "<script>window.open('user_login.php','_self')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order page</title>
    <style>
        .bg {
            background-color: antiquewhite;
        }
    </style>
</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $get_user = "Select * from user_table where username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];

    ?>
    <h3>All my <span class="px-4">orders</span></h3>
    <div class="table-responsive">
    <table class="table table-bordered border border-dark mt-5 me-2">
        <thead class="bg">
            <?php
            $get_order_details = "Select * from user_orders where user_id=$user_id";
            $result_orders = mysqli_query($con, $get_order_details);
            $row_count = mysqli_num_rows($result_orders);
            if ($row_count == 0) {
                echo "<h3 class='my-5 text-danger'>No orders yet</h3>";
            } else {
                echo "<tr>
                <th>S.No</th>
                <th>Amount Due</th>
                <th>Total products</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Receiver Details</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
                </tr>
                </thead>
                <tbody>";
                $number = 1;
                while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                    $order_id = $row_orders['order_id'];
                    $amount_due = $row_orders['amount_due'];
                    $total_products = $row_orders['total_products'];
                    $invoice_number = $row_orders['invoice_number'];
                    $order_status = $row_orders['order_status'];
                    if ($order_status == 'pending') {
                        $order_status = "Incomplete";
                    } else {
                        $order_status = "Complete";
                    }
                    $order_date = $row_orders['order_date'];

                    echo "<tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$total_products</td>
                    <td>$invoice_number</td>
                    <td>$order_date</td>
                    <td><a href='recipient_form.php?order_id=$order_id'>Insert Details</a></td>
                    <td>$order_status</td>";
                    if ($order_status == 'Complete') {
                        echo "<td>Paid</td>";
                    } else {
                        echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
                        </tr>";
                    }
                    $number++;
                }
            }
            ?>
            </tbody>
    </table>
    </div>
</body>

</html>
