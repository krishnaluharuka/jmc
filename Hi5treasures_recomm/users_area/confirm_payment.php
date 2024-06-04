<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
include('setting.php');
include('navbar1.php');
include('../include_aboutus.php');

$user_name = $_SESSION['username'];

if (!isset($user_name)) {
    echo "<script>window.open('user_login.php','_self')</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    <link href="../admin_area/admin_images/<?php echo $logo; ?>" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        .full-height {
            height: 80vh;
        }
        .mbtn5 {
            height: 50px;
            width: 100%;
            outline: none;
            border: none;
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
<body>
    <div>
    <div class="container full-height d-flex justify-content-center align-items-center">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="confirm_payment1.php" method="POST">
                        <div class="text-center">
                        <input value="<?php echo $order_id ?>" name="order_id" type="hidden">
                        <input value="Pay offline" type="submit" name="submit" class="mbtn5 px-2 my-3">
                        </div>
                     </form>
                    </div>
                
        <form action=<?php echo $epay_url ?> method="POST">
            <input value="<?php echo $actualamount; ?>" name="tAmt" type="hidden">
            <input value="<?php echo $amount_due; ?>" name="amt" type="hidden">
            <input value="0" name="txAmt" type="hidden">
            <input value="0" name="psc" type="hidden">
            <input value="<?php echo $damt; ?>" name="pdc" type="hidden">
            <input value=<?php echo $merchant_code ?> name="scd" type="hidden">
            <input value="<?php echo $order_id ?>" name="pid" type="hidden">
            <input value=<?php echo $successurl ?> type="hidden" name="su">
            <input value=<?php echo $failedurl ?> type="hidden" name="fu">
            
            
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-center">
                            <input value="Pay with Esewa" type="submit" class="mbtn5 px-2">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
    <footer class="contact">
        <p class="text-center py-3">
            <a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark">
                By Janapriya Multiple Campus | All Rights Reserved
            </a>
        </p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php mysqli_close($con); ?>

