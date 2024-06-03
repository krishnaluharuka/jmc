<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
include('../functions/common_functions.php');
include('../include_aboutus.php');

if (isset($_POST['password_reset_link'])) {
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $token=md5(rand());

    $select_query = "Select * from user_table where user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_assoc($result);
    $row_count = mysqli_num_rows($result);
    $user_ip = getIPAddress();
    $user_id = $row_data['user_id'];

    //cart item

    if ($row_count == 1) {
        
            $name = $row_data['username'];
            $email = $row_data['user_email'];
            $update_token="Update user_table set verify_token='$token' where user_email='$email'";
            $update_token_run=mysqli_query($con,$update_token);
            if($update_token_run){
                send_password_reset($name,$email,$token);
                $_SESSION['status']="We emailed you a password reset link";
                echo "<script>window.open('password_reset.php','_self')</script>";
                exit(0);
            } else {
                // echo "<script>alert('Email already verified. Please Login')</script>";
                $_SESSION['status']="Something went wrong";
                echo "<script>window.open('password_reset.php','_self')</script>";
                exit(0);
            }
        
        
    }

 else {
    $_SESSION['status']="No Email found";
    echo "<script>window.open('password_reset.php','_self')</script>";
    exit(0);
}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        * {
            user-select: none;
        }

        input.captcha {
            pointer-events: none;
        }

        .mbtn5 {
            height: 50px;
            width: 50%;
            outline: none;
            border: none;
            padding: 5px;
            margin: auto;
            color: white;
            background: rgb(197, 12, 99);
            border-radius: 50px;
            transition: all 0.4s;
        }

        .mbtn5:hover {
            background-color: antiquewhite;
            color: black;
            border: 1px solid black;
        }
    </style>
</head>

<body class="bg-light">
    <section class="inserting">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center py-5">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="text-center">
                        <h1><?php echo $company_name; ?></h1>
                        <img src="../admin_area/admin_images/<?php echo $logo; ?>" alt="Logo" class="img-fluid m-auto mb-3" width="350px" height="350px">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border shadow">
                    <h5 class="px-3 py-3"><?php if(isset($_SESSION['status'])){
                        echo $_SESSION['status'];
                      ?></h5>
                    </div>
                    <?php unset($_SESSION['status']);} ?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border shadow">

                    <h1 class="text-center py-3">RESET <span class="px-4">PASSWORD </span></h1><br>

                    <form action="" method="post">
                        <!-- username field-->
                        <div class="form-outline mb-4 w-50 m-auto">
                            <label for="user_email" class="form-label">Email Address</label>
                            <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter your email" required="required">
                        </div>

                        <!-- Submit -->
                        <div class="mb-4 w-50 m-auto">
                            <input type="submit" name="password_reset_link" class="mbtn5 m-auto" value="Reset">
                        </div>
                    </form>
                </div>
                    </div>
            </div>
        </div>
    </section>
</body>

</html>
<footer class="bg-light">
    <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>