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
    <h3 class="text-center my-3">ALL <span class="px-4">PAYMENTS</span></h3>
    <table id="myTable" class="table table-bordered">
        <thead class="bg">
            <?php
            $get_payments = "Select * from user_payments";
            $result = mysqli_query($con, $get_payments);
            $row_count = mysqli_num_rows($result);
            if ($row_count == 0) {
                echo "<h2 class='text-danger text-center mt-5'>No payments received yet</h2>";
            } else {
                echo "<tr>
                <th>S.No</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Order Date</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody>";
                $number = 0;
                while ($row_data = mysqli_fetch_assoc($result)) {
                    $payment_id = $row_data['payment_id'];
                    $order_id = $row_data['order_id'];
                    $invoice_number = $row_data['invoice_number'];
                    $amount = $row_data['amount'];
                    $payment_mode = $row_data['payment_mode'];
                    $date = $row_data['date'];
                    $number++;
                    echo "<tr>
                    <td>$number</td>
                    <td>$invoice_number</td>
                    <td>$amount</td>
                    <td>$payment_mode</td>
                    <td>$date</td>
                    <td>
                        <a href='index.php?delete_payment=$payment_id' type='button' 
                           class='text-dark' data-bs-toggle='modal' data-bs-target='#Modal_$payment_id'>
                            <i class='bi bi-trash'></i>
                        </a>
                    </td>
                </tr>";
                    // echo "<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' 
                    // aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    //   <div class='modal-dialog' role='document'>
                    //     <div class='modal-content'>
                    //       <div class='modal-body'>
                    //         <h4>Are you sure you want to delete this?</h4>
                    //       </div>
                    //       <div class='modal-footer'>
                    //         <button type='button' class='mbtn1' data-dismiss='modal'>
                    //             <a href='./index.php?list_payments' class='text-light text-decoration-none'>No</a></button>
                    //         <button type='button' class='mbtn1'><a href='index.php?delete_payment=$payment_id' 
                    //         class='text-light text-decoration-none'> Yes</a></button>
                    //       </div>
                    //     </div>
                    //   </div>
                    // </div>";
                    echo "<div class='modal fade' id='Modal_$order_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete this?</h5>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='mbtn1' data-bs-dismiss='modal'><a href='./index.php?list_payments' class='text-light text-decoration-none'>No</a></button>
                        <button type='button' class='mbtn1'><a href='index.php?delete_payment=$payment_id' class='text-light text-decoration-none'>Yes</a></button>
                    </div>
                </div>
            </div>
        </div>";
                }
            }
            ?>
            </tbody>
    </table>
            <?php
include('page.php');
?>
</body>

</html>
