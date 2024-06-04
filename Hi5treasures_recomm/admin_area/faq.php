<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
$username = $_SESSION['admin_name'];

if (!isset($username)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_POST['submit_faq'])) {
    $question=$_POST['enter_question'];
    $answers = $_POST['enter_answers'];
    // insert query
    $insert_faq = "insert into faq (question,answers) values  ('$question','$answers')";
    $result_query = mysqli_query($con, $insert_faq);
    if ($result_query) {
        echo "<script>alert('Successfully submitted faq')</script>";
    } else {
        echo "<script>alert('Failed to submit the faq')</script>";
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
    <h1 class="text-center p-4 mt-5">INSERT<span class="px-4"> FAQ</span></h1>

    <form action="" method="post" class="mt-5">
        <!-- title -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="enter_question" class="form-label fs-4">Enter Questions</label>
            <textarea name="enter_question" id="enter_question" class="form-control h-auto m-auto mySummernote" placeholder="Enter your question"  required="required"></textarea>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="enter_answers" class="form-label fs-4">Enter Answers</label>
            <textarea name="enter_answers" id="enter_answers" class="form-control h-auto m-auto mySummernote" placeholder="Enter your answers"  required="required"></textarea>
        </div>

        <!-- Submit -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="submit_faq" class="mbtn2 m-auto" value="Submit">
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