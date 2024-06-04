<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];


if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_GET['edit_faq'])) {
    $f_id=$_GET['edit_faq'];
    $select = "Select * from faq where f_id='$f_id'";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($result);
    $question = $row['question'];
    $answers=$row['answers'];
    
}

if (isset($_POST['update_faq'])) {
    $edit_question=$_POST['edit_question'];
    $edit_answers=$_POST['edit_answers'];

    
        test($edit_question);
        test($edit_answers);
        
        $update_faq= "UPDATE faq set question='$edit_question',answers='$edit_answers' where f_id='$f_id'";

    $result_update = mysqli_query($con, $update_faq);
    if ($result_update) {
        echo "<script>alert('FAQ updated successfully')</script>";
        echo "<script>window.open('index.php?list_faq','_self')</script>";
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
    <title>Edit About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center my-5">EDIT <span class="px-4">ABOUT US</span></h2>
        <form action="" method="post" enctype="multipart/form-data">
            
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="edit_question" class="form-label fs-4">Question</label>
            <textarea name="edit_question" id="edit_question" class="form-control h-auto m-auto mySummernote"  required="required"><?php echo $question; ?></textarea>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="edit_answers" class="form-label fs-4">Answer</label>
            <textarea name="edit_answers" id="edit_answers"class="form-control h-auto m-auto mySummernote" required="required"><?php echo $answers; ?></textarea>
        </div>


            <div class="text-center">
                <input type="submit" name="update_faq" class="mbtn1 mb-3" value="Update">
            </div>
        </form>
    </div>

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

</body>

</html>