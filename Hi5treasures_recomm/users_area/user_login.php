<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
include('navbar1.php');
include('../include_aboutus.php');

if (isset($_POST['user_login'])) {
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $captcha = $_POST['captcha'];
    $confirm_captcha = $_POST['confirm_captcha'];

    $select_query = "Select * from user_table where user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_assoc($result);
    $row_count = mysqli_num_rows($result);
    $user_ip = getIPAddress();
    $user_id = $row_data['user_id'];

    //cart item

    if ($row_count == 1) {
        if ($row_data['user_type'] == 'Admin') {
            if (password_verify($user_password, $row_data['user_password']) and $captcha == $confirm_captcha and $row_data['verify_status'] == '1') {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['admin_email'] = $user_email;
                $_SESSION['admin_name'] = $row_data['username'];
                $_SESSION['admin_id'] = $user_id;
                // echo "<script>alert('Login Successfully')</script>";
                $_SESSION['status'] = "Login Successfully";
                echo "<script>window.open('../admin_area/index.php','_self')</script>";
            } else {
                // echo "<script>alert('Have you verified your email? if yes then, please enter the correct credentials')</script>";
                $_SESSION['status'] = "Have you verified your email? if yes then, please enter the correct credentials";
            }
        } else if ($row_data['user_type'] == 'User') {
            if (password_verify($user_password, $row_data['user_password']) and $captcha == $confirm_captcha and $row_data['verify_status'] == '1') {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['username'] = $row_data['username'];
                $_SESSION['user_id'] = $user_id;
                $user_id = $_SESSION['user_id'];
                $select_query_cart = "Select * from cart_details where ip_address='$user_ip'";
                $select_cart = mysqli_query($con, $select_query_cart);
                $row_count_cart = mysqli_num_rows($select_cart);

                if ($row_count_cart == 0) {
                    // echo "<script>alert('Login Successfully')</script>";
                    $_SESSION['status'] = "Login Successfully";
                    echo "<script>window.open('profile.php','_self')</script>";
                } else {
                    while ($row_cart = mysqli_fetch_array($select_cart)) {
                        $product_id = $row_cart['product_id'];
                        $quantity = $row_cart['quantity'];
                        $update_cart = "UPDATE cart_details SET user_id={$_SESSION['user_id']} WHERE ip_address='$user_ip' AND product_id=$product_id AND quantity=$quantity";
                        mysqli_query($con, $update_cart);
                    }
                    // echo "<script>alert('Login Successfully')</script>";
                    $_SESSION['status'] = "Login Successfully";
                    echo "<script>window.open('payment.php','_self')</script>";
                }
            } else {
                // echo "<script>alert('Have you verified your email? if yes then, please enter the correct credentials.')</script>";
                $_SESSION['status'] = "Have you verified your email? if yes then, please enter the correct credentials";
            }
        }
    } else {
        // echo "<script>alert('Invalid Credentials')</script>";
        $_SESSION['status'] = "Invalid Credentials";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="../images/logo.jpg" rel="icon" type="image/icon">
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

        /* .back{
            background-image: url(../images/bg3.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        } */
    </style>
</head>

<body class="bg-light">
    <section class="">
        <div class="container-fluid back">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="text-center">
                        <h1><?php echo $company_name; ?></h1>
                        <img src="../admin_area/admin_images/<?php echo $logo; ?>" alt="Logo" class="img-fluid m-auto" width="350px" height="350px">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 my-3">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border shadow my-1">
                        <h5 class="px-3 py-3"><?php if (isset($_SESSION['status'])) {
                                                    echo $_SESSION['status'];
                                                 ?></h5>
                    </div>
                    <?php unset($_SESSION['status']);} ?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 topic border shadow">

                        <h1 class="text-center py-3">USER <span class="px-4"> LOGIN </span></h1><br>

                        <form action="" method="post">
                            <!-- username field-->
                            <div class="form-outline mb-4 w-75 m-auto">
                                <label for="user_email" class="form-label">Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Enter your email" required="required">
                            </div>

                            <!-- password field -->
                            <div class="form-outline mb-4 w-75 m-auto">
                                <label for="user_password" class="form-label">Password</label>
                                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" required="required" autocomplete="off">
                            </div>

                            <!-- captcha -->



                            <div class="form-outline mb-4 w-75 m-auto">
                                <label for="confirm_captcha" class="form-label">Captcha</label>
                                <input type="text" name="confirm_captcha" placeholder="Enter Captcha" class="form-control m-0" required="required" autocomplete="off">
                            </div>



                            <div class="form-outline mb-4 w-75 m-auto">
                                <label for="captcha" class="form-label">Captcha Code</label>
                                <input type="text" name="captcha" id="captcha" class="form-control captcha" value=<?php echo substr(uniqid(), 5); ?> required="required" autocomplete="off">
                            </div>




                            <!-- Submit -->
                            <div class="mb-4 w-75 m-auto">
                                <input type="submit" name="user_login" class="mbtn5 m-auto mb-3" value="Login"><br><a href="password_reset.php" class="text-primary fs-6 my-3">Forgot your password?</a><hr>
                                <!-- <p class="small my-2 py-1 fs-6 ">Don't have an account?
                                    <a href="user_registration.php" class="text-primary">Register</a>
                                </p> -->
                                <p class="small my-2 py-1 fs-6 ">Didn't receive your verification email ?
                                    <a href="resend_email_verification.php" class="text-primary">Resend</a>
                                </p>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<footer class="inserting">
    <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php mysqli_close($con); ?>