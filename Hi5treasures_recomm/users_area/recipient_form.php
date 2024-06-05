<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('../includes/connect.php');
include('navbar1.php');
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  echo "<script>window.open('user_login.php','_self')</script>";
}

$err_contact=$err_date='';
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
}
if(isset($_POST['submit']))
{
    $order_id1=$_POST['order_id'];
    $receiver=$_POST['receiver'];
    $sender=$_POST['sender'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $date=$_POST['date'];
    $address=$_POST['address'];
    $imp_message=$_POST['imp_message'];
    $currentDate = date('Y-m-d');

    if(!preg_match("/^\d{10}$/",$contact))
    {
        $err_contact= "Invalid contact number.Must be 10 digits.";
    }
    if ($date <= $currentDate) {
        $err_date = "Please select a date on or after " . $currentDate . ".";
    } 
    
    if($err_contact=='' && $err_date==''){
        test($receiver);
        test($sender);
        test($email);
        test($contact);
        test($date);
        test($address);
        test($imp_message);

    $insert=mysqli_query($con,"Insert into receiver_details(user_id,order_id,sender,receiver,delivery_date,email,contact,delivery_address,message) values ('$user_id','$order_id1','$sender','$receiver','$date','$email','$contact','$address','$imp_message')");
    echo "<script>alert('Receiver details submitted successfully')</script>";
    echo "<script>window.open('profile.php?user_orders','_self')</script>";
    }

    


}
    function test($data)
    {
        $data=htmlspecialchars($data);
        $data=stripslashes($data);
        $data=trim($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username']; ?></title>
  <!-- <link href="../images/logo.jpg" rel="icon" type="image/icon"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 border shadow my-4 ">
            <div class="card border shadow my-2 p-3">
    <h1 class="text-center mt-3">RECIPIENT <span class="px-4">DETAILS</span></h1>
    <div class="d-flex justify-content-center mt-3">
<form class="row g-3" action="" method="post">
    <input type="hidden" class="form-control" id="order_id" name="order_id" value="<?php echo $order_id ?>">
<div class="col-md-6">

    <label for="sender" class="form-label">Sender Name</label>
    <input type="text" class="form-control" id="sender" name="sender" required>
  </div>
  <div class="col-md-6">
    <label for="receiver" class="form-label">Receiver Name</label>
    <input type="text" class="form-control" id="receiver" name="receiver" required>
  </div>
  <div class="col-12">
    <label for="email" class="form-label">Your Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div> 
  <div class="col-md-6">
    <label for="contact" class="form-label">Receiver Contact</label>
    <input type="text" class="form-control" id="contact" name="contact" required>
    <p class='text-danger'><?php echo "$err_contact";  ?></p>
  </div> 
  <div class="col-md-6">
    <label for="date" class="form-label">Delivery Date</label>
    <input type="date" class="form-control" id="date" name="date" required>
    <p class='text-danger'><?php echo "$err_date";  ?></p>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" name="address" id="inputAddress" placeholder="Enter the delivery address" required>
  </div>
  <div class="col-12">
    <label for="imp_message" class="form-label">Important Message</label>
    <textarea class="form-control h-auto mySummernote" id="imp_message" name="imp_message" required>Enter the message you want to convey with your gift.</textarea>
  </div> 

  
  <!-- <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div> -->
  <div class="col-12">
    <input type="submit" class="mbtn1" name="submit" value="Submit">
  </div>
</form>
    </div>
            </div></div></div></div>

<footer class="contact">
    <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <script>
        $(document).ready(function() {
            $(".mySummernote").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
    </body>
</html>