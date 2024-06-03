<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
include('../include_aboutus.php');
include('navbar1.php');
$user_name = $_SESSION['username'];

if (!isset($user_name)) {
    echo "<script>window.open('user_login.php','_self')</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body{
            overflow-x: hidden;
            background-image: url('../images/bg8.avif');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
        }
        .bg {
            background-color: antiquewhite;
        }

        .full-height {
            height: 100vh;
        }
        div.card{
            opacity: 0.8;
        }

        div.card:hover{
            opacity: 1;
        }
    </style>
</head>

<body>
    <?php
    //    $ip_address=getIPAddress();
    $username = $_SESSION['username'];
    $get_user = "Select * from user_table where username='$username'";
    $result = mysqli_query($con, $get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];

    ?>
    <div class="container full-height d-flex justify-content-center align-items-center">
        <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="text-center w-100">
                <a href="../contact.php" class="text-decoration-none text-dark">
                    <div class='card bg border shadow rounded'>
                        <div class='card-body'>
                            <h5 class='card-title'>
                                <h1>Customize Product</h1>
                                </a>

                            </h5>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="text-center w-100">
                <a href="order.php?user_id=<?php echo $user_id ?>" class="text-decoration-none text-dark">
                    <div class='card bg border shadow rounded'>
                        <div class='card-body'>
                            <h5 class='card-title'>
                                <i class="bi bi-currency-rupee d-block fs-1 mb-3"></i>
                                    <h1>Pay offline</h1>
                                </a>

                            </h5>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
<?php mysqli_close($con); ?>