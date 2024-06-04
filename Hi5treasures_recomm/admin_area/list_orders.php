<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .bg {
            background-color: antiquewhite;
        }
    </style>
</head>

<body>
    <h3 class="text-center my-3">ALL <span class="px-4">ORDERS</span></h3>
    <table class="table table-bordered">
        <thead class="bg">
            <?php
            $get_orders = "Select * from user_orders";
            $result = mysqli_query($con, $get_orders);
            $row_count = mysqli_num_rows($result);
            if ($row_count == 0) {
                echo "<h2 class='text-danger text-center mt-5'>No orders yet</h2>";
            } else {
                echo "<tr>
                <th>S.No</th>
                <th>Due Amount</th>
                <th>Invoice Number</th>
                <th>Total Products</th>
                <th>View Products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Receiver Details</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody>";
                $number = 0;
                while ($row_data = mysqli_fetch_assoc($result)) {
                    $order_id = $row_data['order_id'];
                    $user_id = $row_data['user_id'];
                    $amount_due = $row_data['amount_due'];
                    $invoice_number = $row_data['invoice_number'];
                    $total_products = $row_data['total_products'];
                    $order_date = $row_data['order_date'];
                    $order_status = $row_data['order_status'];
                    $number++;
                    echo "<tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$invoice_number</td>
                    <td>$total_products</td>
                    <td><a href='generate_pdf.php?order_id=<?= $order_id; ?>'>View</a></td>
                    <td>$order_date</td>
                    <td>
                    <td>$order_status</td>
                    <td>
                        <a href='index.php?delete_order=$order_id' type='button' 
                           class='text-dark' data-bs-toggle='modal' data-bs-target='#Modal_$order_id'>
                            <i class='bi bi-trash'></i>
                        </a>
                    </td>
                </tr>";
                    echo "<div class='modal fade' id='Modal_$order_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete this?</h5>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='mbtn1' data-bs-dismiss='modal'><a href='./index.php?list_orders' class='text-light text-decoration-none'>No</a></button>
                        <button type='button' class='mbtn1'><a href='index.php?delete_order=$order_id' class='text-light text-decoration-none'>Yes</a></button>
                    </div>
                </div>
            </div>
        </div>";
                }
            }
            ?>
            </tbody>
    </table>
</body>

</html>