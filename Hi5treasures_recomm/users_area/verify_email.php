<?php
include('../includes/connect.php');
if(isset($_GET['token'])){
    $token=$_GET['token'];
    $verify_query="Select verify_token,verify_status from user_table where verify_token='$token' LIMIT 1";
    $verify_query_num=mysqli_query($con,$verify_query);
    if(mysqli_num_rows($verify_query_num)>0){
        $row=mysqli_fetch_array($verify_query_num);
        //echo $row['verify_token'];
        if($row['verify_status']=="0"){
            $clicked_token=$row['verify_token'];
            $update_query="Update user_table set verify_status='1' where verify_token='$clicked_token' LIMIT 1";
            $update_query_run=mysqli_query($con,$update_query);
            if($update_query_run){
                // echo "<script>alert('Your account has been verified Successfully!');</script>";
                $_SESSION['status']="Your account has been verified Successfully!";
        echo "<script>window.open('user_login.php','_self')</script>";
        exit(0);

            }
            else{
                // echo "<script>alert('Verification Failed');</script>";
                $_SESSION['status']="Verification Failed!";
                echo "<script>window.open('user_login.php','_self')</script>";
        exit(0);
            }
        }
        else{
            // echo "<script>alert('Email already verified.Please Login');</script>";
            $_SESSION['status']="Email already verified. Please Login";
        echo "<script>window.open('user_login.php','_self')</script>";
        exit(0);

        }

    }
    else{
        // echo "<script>alert('This token doesnot exist');</script>";
        $_SESSION['status']="This token doesnot exist";
        echo "<script>window.open('user_login.php','_self')</script>";

    }

}
else{
    // echo "<script>alert('Not allowed');</script>";
    $_SESSION['status']="Not allowed";
    echo "<script>window.open('user_login.php','_self')</script>";

}

?>