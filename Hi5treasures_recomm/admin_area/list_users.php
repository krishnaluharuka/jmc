<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// include('get_message.php');
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
        .notification-badge {
            position: relative;
            display: inline-block;
        }
        .notification-badge .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <h3 class="text-center my-3">ALL <span class="px-4">USERS</span></h3>
    <table id="myTable" class="table table-bordered">
        <thead class="bg">
            <?php
            $get_users = "Select * from user_table";
            $result = mysqli_query($con, $get_users);
            $row_count = mysqli_num_rows($result);
            if ($row_count == 0) {
                echo "<h2 class='text-danger text-center mt-5'>No users yet</h2>";
            } 
            else {
                echo "<tr>
                <th>S.No</th>
                <th>Username</th>
                <th>User email</th>
                <th>User Image</th>
                <th>User Address</th>
                <th>User Mobile</th>
                <th>Messages</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody>";
                $number = 0;
                while ($row_data = mysqli_fetch_assoc($result)) {
                    $user_id = $row_data['user_id'];
                    $username = $row_data['username'];
                    $user_email = $row_data['user_email'];
                    $user_image = $row_data['user_image'];
                    $user_address = $row_data['user_address'];
                    $user_mobile = $row_data['user_mobile'];
                    $user_type = $row_data['user_type'];
                    $number++;
                    if ($user_type == 'Admin') {
                        continue;
                    }
                    $message_query = "SELECT COUNT(*) AS unread_count FROM chat WHERE username= '$username' AND is_read = 0";
                    $message_result = mysqli_query($con, $message_query);
                    $unread_count = 0;
                    if ($message_result) {
                        $message_data = mysqli_fetch_assoc($message_result);
                        $unread_count = $message_data['unread_count'];
                    }
                    echo "<tr>
                    <td>$number</td>
                    <td>$username</td>
                    <td>$user_email</td>
                    <td><img src='../users_area/user_images/$user_image' alt='$username' width='100px' height='100px'></td>
                    <td>$user_address</td>
                    <td>$user_mobile</td>
                    <td>
                        <a href='index.php?get_message=$user_id' type='button' 
                           class='text-dark'>
                            <i class='bi bi-chat-dots pe-2 fs-3'>";
                            if($unread_count==0){
                                echo "<sup class='text-danger fs-6'>0</sup>
                                </i>";
                            }
                           else if ($unread_count > 0) {
                                echo "<sup class='text-danger'>$unread_count</sup>
                                </i>";
                            }
                          echo "  
                        </a>
                    </td>

                    <td>
                        <a href='index.php?delete_user=$user_id' type='button' 
                           class='text-dark' data-bs-toggle='modal' data-bs-target='#Modal_$user_id'>
                            <i class='bi bi-trash fs-3'></i>
                        </a>
                    </td>
                </tr>";
                    echo "<div class='modal fade' id='Modal_$user_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete this?</h5>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='mbtn1' data-bs-dismiss='modal'><a href='./index.php?list_users' class='text-light text-decoration-none'>No</a></button>
                        <button type='button' class='mbtn1'><a href='index.php?delete_user=$user_id' class='text-light text-decoration-none'>Yes</a></button>
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
