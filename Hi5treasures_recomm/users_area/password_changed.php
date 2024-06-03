<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
include('../functions/common_functions.php');
include('../include_aboutus.php');

if (isset($_POST['password_update'])) {
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $new_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $conf_new_password = mysqli_real_escape_string($con, $_POST['conf_new_password']);
    $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
    $token = mysqli_real_escape_string($con, $_POST['password_token']);

   

    $select_query = "Select * from user_table where verify_token='$token'";
    $result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_assoc($result);
    $row_count = mysqli_num_rows($result);
    

    //cart item

    if (!empty($token)) {
        
            if (!empty($user_email) && !empty($new_password) && !empty($conf_new_password)) {
                if($row_count ==1 ){
                    if($new_password==$conf_new_password){
                        $update_password="update user_table set user_password='$hash_password' where verify_token='$token'";
                        $update_password_run=mysqli_query($con,$update_password);
                        if($update_password_run){
                            $new_token=md5(rand(),"hi5");
                            $update_to_new_token="update user_table set verify_token='$new_token' where verify_token='$token'";

                            $update_to_new_token_run=mysqli_query($con,$update_to_new_token);
                            
                            $_SESSION['status'] = "New password updated successfuly!";
                            echo "<script>window.open('user_login.php','_self')</script>";
                            exit(0);

                        }
                        else{
                            $_SESSION['status'] = "Didn't update password. Something went wrong.!";
                            echo "<script>window.open('password_change.php?token=$token&user_email=$user_email','_self')</script>";
                            exit(0);
                        }
                    }
                    else{
                        $_SESSION['status'] = "Password and Confirm Password doesnot match";
                        echo "<script>window.open('password_change.php?token=$token&user_email=$user_email','_self')</script>";
                        exit(0);
                    }
                }
                else{
                    $_SESSION['status'] = "Invalid token";
                    echo "<script>window.open('password_change.php?token=$token&user_email=$user_email','_self')</script>";
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "All fields are mandatory";
                echo "<script>window.open('password_change.php?token=$token&user_email=$user_email','_self')</script>";
                exit(0);
            }
        
           
                 
            } else {
                $_SESSION['status'] = "No token available!!";
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
    <title>Password Change Update</title>
    <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
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
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 border shadow">

                        <h1 class="text-center py-3">CHANGE <span class="px-4"> PASSWORD </span></h1><br>

                        <form action="" method="post">
                        <div class="form-outline mb-4 w-50 m-auto">
                                
                                <input type="hidden" name="password_token" id="user_email" class="form-control" value="<?php if(isset($_GET['token']))
                                {
                                    echo $_GET['token'];
                                }?>" required="required">
                            </div>


                            <!-- username field-->
                            <div class="form-outline mb-4 w-50 m-auto">
                                <label for="user_email" class="form-label">Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control" value="<?php if(isset($_GET['user_email']))
                                {
                                    echo $_GET['user_email'];
                                }?>" placeholder="Enter your email" required="required">
                            </div>

                            <!-- password field -->
                            <div class="form-outline mb-4 w-50 m-auto">
                                <label for="user_password" class="form-label">New Password</label>
                                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" required="required" autocomplete="off">
                            </div>

                            <!--confirm password field -->
                            <div class="form-outline mb-4 w-50 m-auto">
                                <label for="conf_new_password" class="form-label">Confirm New Password</label>
                                <input type="password" name="conf_new_password" id="conf_new_password" class="form-control" placeholder="Confirm your new password" required="required" autocomplete="off">
                            </div>

                            <!-- Submit -->
                            <div class="mb-4 w-50 m-auto">
                                <input type="submit" name="password_update" class="mbtn5 m-auto mb-3" value="Update"><br>
                               

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

<?php mysqli_close($con); ?>