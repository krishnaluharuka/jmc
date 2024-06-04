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
    <h3 class="text-center my-5">ALL <span class="px-3">PRODUCTS</span></h3>
    <table id="myTable" class="table table-bordered border border-dark mt-5">
        <thead class="bg">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $get_products = "Select * from products";
            $result = mysqli_query($con, $get_products);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $status = $row['status'];
                $get_count = "Select * from orders_pending where product_id=$product_id";
                $result_count = mysqli_query($con, $get_count);
                $rows_count = mysqli_num_rows($result_count);
                $number++;
                echo "<tr>
                    <td>$number</td>
                    <td>$product_title</td>
                    <td><img src='./product_images/$product_image1' alt='' width='100px'
                     height='80'></td>
                    <td>$product_price</td>
                    <td>$rows_count</td>
                    <td>$status</td>
                    <td>
                        <a href='index.php?edit_products=$product_id' class='text-dark'>
                            <i class='bi bi-box-arrow-in-down-left'></i>
                        </a>
                    </td>
                    <td>
                        <a href='index.php?delete_product=$product_id' type='button' 
                           class='text-dark' data-bs-toggle='modal' data-bs-target='#Modal_$product_id'>
                            <i class='bi bi-trash'></i>
                        </a>
                    </td>
                </tr>";
                //     echo " <div class='modal fade' id='modal_$product_id' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                //     <div class='modal-dialog' role='document'>
                //       <div class='modal-content'>
                //         <div class='modal-body'>
                //           <h4>Are you sure you want to delete this?</h4>
                //         </div>
                //         <div class='modal-footer'>
                //           <button type='button' class='mbtn1' data-dismiss='modal'>
                //               <a href='./index.php?view_products' class='text-light text-decoration-none'>No</a></button>
                //           <button type='button' class='mbtn1'><a href='index.php?delete_product=$product_id'
                //           class='text-light text-decoration-none'> Yes</a></button>
                //         </div>
                //       </div>
                //     </div>
                //   </div>";
                echo "<div class='modal fade' id='Modal_$product_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete this?</h5>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='mbtn1' data-bs-dismiss='modal'><a href='./index.php?view_products' class='text-light text-decoration-none'>No</a></button>
                        <button type='button' class='mbtn1'><a href='index.php?delete_product=$product_id' class='text-light text-decoration-none'>Yes</a></button>
                    </div>
                </div>
            </div>
        </div>";
            }
            ?>

        </tbody>
    </table>
    <?php 
include ('page.php');
?>
</body>

</html>
