<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
$order_id=$_GET['order_id'];
if(isset($_GET['order_id']))
{
    $order_id=$_GET['order_id'];
    $get_orders = "SELECT * FROM user_orders where order_id='$order_id'";
                $result = mysqli_query($con, $get_orders);
                $row_count = mysqli_num_rows($result);
                while ($row_data = mysqli_fetch_assoc($result)) {
                    // $product_id = $row_data['product_id'];
                    $user_id=$row_data['user_id'];
                    $select_user="Select username from user_table where user_id='$user_id'";
                    $user_run=mysqli_query($con,$select_user);
                    $row_user = mysqli_fetch_assoc($user_run);
                    $username=$row_user['username'];
                    // echo $user_id;
                    $amount_due = $row_data['amount_due'];
                    // echo $amount_due;
                    $invoice_number = $row_data['invoice_number'];
                    // echo $invoice_number;
                    $order_date = $row_data['order_date'];
                    // echo $order_date;
                    $total_products=$row_data['total_products'];
                    // echo $user_id;
                    // $image = $row_data['image'];
                }
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
        .container {
            text-align: center;
        }
        .table {
            margin: auto;
            width: 80%; /* Adjust the width as needed */
        }
        th, td {
            text-align: center;
        }
    </style>
</head>

<body>
     <h3 class="container text-center my-3">ALL ORDERS</h3>
     <div class="container-fluid">
     <div class="row">
            <div class="md-6">
                <h4>Customer Id: <?= $user_id;?></h4>
                <h4>Quantity: <?php echo $total_products; ?></h4>
            </div>
            <div class="md-6">
               <h4> Order Date: <?= $order_date;?></h4>
            </div>
        </div>
     </div>
    <div class="container">
        <table class="table table-bordered">
            <thead class="bg">
                <?php
                if ($row_count == 0) {
                    echo "<tr><td colspan='4'><h2 class='text-danger'>No orders yet</h2></td></tr>";
                }
                else{
                ?>

                <tr>
                    <th>SN</th>
                    <th>Amount</th>
                    <th>Product</th>                
                    <!-- <th>Product Image</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $select="Select * from orders_pending where"
                while($row_data=)
                
                
                    
                        
                        echo "<tr>
                        
                            <td>$order_id</td>
                            <td>$amount_due</td>
                            <td>$invoice_number</td>
                            
                        </tr>";
                    }
                
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
