<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .bg {
            background-color: antiquewhite;
        }
    </style>
</head>

<body>
    <h3 class="text-center my-5">VIEW <span class="px-3">FAQ</span></h3>
    <table class="table table-bordered border border-dark mt-5">
        <thead class="bg">
            <tr>
                <th>S.N</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $get_faq = "Select * from faq";
            $result = mysqli_query($con, $get_faq);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $f_id=$row['f_id'];
                $question=$row['question'];
                $answers=$row['answers'];
                $number++;
                echo "<tr>
                <td>$number</td>
                <td>$question</td>
                <td>$answers</td>
                <td><a href='index.php?edit_faq=$f_id' class='text-dark'>
                    <i class='bi bi-box-arrow-in-down-left'></i></a>
                </td>
                <td>
                <a href='index.php?delete_faq=$f_id' type='button' 
                class='text-dark' data-bs-toggle='modal' data-bs-target='#Modal_$f_id'>
                        <i class='bi bi-trash'></i></a>
                </td>
            </tr>";
                echo "<div class='modal fade' id='Modal_$f_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
    
                    </div>
                    <div class='modal-body'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete this?</h5>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='mbtn1' data-bs-dismiss='modal'><a href='./index.php?list_faq' class='text-light text-decoration-none'>No</a></button>
                        <button type='button' class='mbtn1'><a href='index.php?delete_faq=$f_id' class='text-light text-decoration-none'>Yes</a></button>
                    </div>
                </div>
            </div>
        </div>";
            }


            ?>

        </tbody>
    </table>
</body>

</html>