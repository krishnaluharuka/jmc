<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
$username = $_SESSION['username'];

if (!isset($username)) {
    echo "<script>window.open('user_login.php','_self')</script>";
}
if (isset($_POST['submit_feedback'])) {
    $username = $_SESSION['username'];
    $feedback = $_POST['enter_feedback'];

    $get_user = "Select * from user_table where username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];

    // insert query
    $insert_feedback = "insert into feedback (feedback,user_id,date) values  ('$feedback','$user_id',NOW())";
    $result_query = mysqli_query($con, $insert_feedback);
    if ($result_query) {
        echo "<script>alert('Successfully submitted the feedback')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    } else {
        echo "<script>alert('Failed to submit the feedback')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="text-center p-4 mt-5">PROVIDE<span class="px-4"> FEEDBACK</span></h1>

    <form action="" method="post" class="mt-5">
        <!-- title -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="enter_feedback" class="form-label fs-4">Enter Feedback</label>
            <textarea name="enter_feedback" id="enter_feedback" class="form-control h-auto m-auto mySummernote" placeholder="Enter your feedback"  required="required"></textarea>
        </div>

        <!-- Submit -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="submit_feedback" class="mbtn2 m-auto" value="Submit">
        </div>
    </form>




    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote JS - CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".mySummernote").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <!-- //Summernote JS - CDN Link -->
</body>

</html>
<?php mysqli_close($con); ?>