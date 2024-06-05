<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}

if (isset($_GET['view_details'])) {
    $view_details = $_GET['view_details'];
}


?>
    <h3 class="text-center my-5">RECEIVER <span class="px-4">DETAILS</span></h3>
    <table class="table table-bordered border border-dark mt-5 m-auto">
        <thead class="bg">
            <tr>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Email</th>
                <th>Delivery Address</th>
                <th>Delivery Date</th>
                <th>Receiver Contact</th>
                <th>Important Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_details = "Select * from receiver_details where order_id='$view_details'";
            $result = mysqli_query($con, $select_details);
            // $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $sender = $row['sender'];
                $receiver = $row['receiver'];
                $delivery_address=$row['delivery_address'];
                $delivery_date=$row['delivery_date'];
                $contact=$row['contact'];
                $message=$row['message'];
                $email=$row['email'];
                // $number++;
                echo "<tr>
                <td>$sender</td>
                <td>$receiver</td>
                <td>$email</td>
                <td>$delivery_address</td>
                <td>$delivery_date</td>
                <td>$contact</td>
                <td>$message</td>
            </tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal -->


