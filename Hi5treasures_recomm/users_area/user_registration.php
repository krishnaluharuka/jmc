<?php
session_start();
include('../includes/connect.php');
include('navbar1.php');
include('../include_aboutus.php');
if (isset($_POST['user_register']) && isset($_POST['user_email'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();
    $user_type = $_POST['user_type'];
    $verify_token=md5(rand());

    // sendemail_verify("$user_username","$user_email","$verify_token");
    // echo "Sent or not";

    //email exist or not


    //select query
    $select_query = "select * from user_table where username='$user_username' or user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    if ($rows_count > 0) {
        // echo "<script>alert('Username and Email already exist')</script>";
        $_SESSION['status']="Username and Email already exist!!";
    } else if ($user_password != $conf_user_password) {
        // echo "<script>alert('Password donot match')</script>";
        $_SESSION['status']="Password donot match!!";
    } else {
        //insert query
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "insert into user_table(username,user_email,user_password,user_image,user_ip,
        user_address,user_mobile,user_type,verify_token) values ('$user_username','$user_email','$hash_password',
        '$user_image','$user_ip','$user_address','$user_contact','$user_type','$verify_token')";
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            if ($user_type == 'Admin') {
                sendemail_verify("$user_username","$user_email","$verify_token");
                // echo "<script>alert('Registration successfull! Please verify your Email Address.')</script>";
                $_SESSION['status']="Registration successful ! Please verify your email address";
                // echo "<script>window.open('user_login.php','_self')</script>";
            } else {
                sendemail_verify("$user_username","$user_email","$verify_token");
                // echo "<script>alert('Registration successfull! Please verify your Email Address.')</script>";
                $_SESSION['status']="Registration successful ! Please verify your email address";
                //echo "<script>window.open('user_login.php','_self')</script>";
            }
        } else {
            // echo "<script>alert('Registration failed. Please try again.')</script>";
            $_SESSION['status']="Registration failed. Please try again";
        }
    }
 }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="../images/logo.jpg" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <style>
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="text-center mt-3">
                    <h1><?php echo $company_name; ?></h1>
                    <img src="../admin_area/admin_images/<?php echo $logo; ?>" alt="" class="img-fluid mt-3" width="350px" height="350px" class="text-center">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-3 my-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border shadow">
                    <h5 class="px-3 py-3"><?php if(isset($_SESSION['status'])){
                        echo $_SESSION['status'];
                      ?></h5>
                    </div>
                    <?php unset($_SESSION['status']);} ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border shadow p-3 mb-3 mt-1">
                <h1 class="text-center py-3">NEW <span class="px-4">REGISTRATION</span></h1><br>

                <form action="" method="post" enctype="multipart/form-data">
                    <!-- username field-->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required">
                    </div>

                    <!-- email field -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">User Email</label>
                        <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required">
                    </div>

                    <!-- image field -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" name="user_image" id="user_image" class="form-control" required="required">
                    </div>


                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" required="required" autocomplete="off">
                    </div>

                    <!-- confirm password field -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" name="conf_user_password" id="conf_user_password" class="form-control" placeholder="Confirm password" required="required" autocomplete="off">
                    </div>

                    <!-- address field-->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Enter your address" required="required">
                    </div>

                    <!-- contact field-->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" name="user_contact" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required">
                    </div>

                    <!-- user type field-->
                    <div class="form-outline mb-4">
                        <?php $get_user_type = mysqli_query($con, "Select user_type from user_table where user_type='Admin'");
                        if (mysqli_num_rows($get_user_type) > 0) {
                            echo "
                    <input type='hidden' name='user_type' value='User' >";
                        } else {
                        ?>
                            <label for="user_type" class="form-label">User Type</label>
                            <select class="form-select" aria-label="Default select example" name="user_type">


                            <?php
                            echo "
                        <option value='User'>User</option>
                        <option value='Admin'>Admin</option>";
                        }
                            ?>
                            </select>
                    </div>

                    <!-- Submit -->
                    <div class="mb-4">
                        <input type="submit" name="user_register" class="mbtn1 m-auto p-3" value="Register">
                        <p class="small fw-bold my-2 py-1 ">Already have an account ?<br>
                            <a href="user_login.php" class="text-danger">User Login</a><br>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
                    </div>
    <footer class="inserting">
        <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>







<?php mysqli_close($con); ?>