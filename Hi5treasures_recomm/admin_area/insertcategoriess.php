<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['category_title'];

    // validation for empty condition
    if ($category_title == '') {
        echo "<script>alert('please fill all the available fields')</script>";
        exit();
    } else {

        // insert query
        $insert_categoriess = "insert into `categories` (category_title) values ('$category_title')";
        $result_query = mysqli_query($con, $insert_categoriess);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the categoriess')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert categoriess</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        .input-group-text {
            background-color: antiquewhite;
        }
    </style>
</head>

<body>
    <h1 class="text-center mt-5">Insert categories</h1><br>

    <form action="" method="post" enctype="multipart/form-data" class="mb-2">
        <div class="input-group mb-3 w-50 m-auto">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-receipt"></i></span>
            <input type="text" class="form-control" name="category_title" placeholder="Insert Categories" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <!-- Submit -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="insert_cat" class="mbtn2 m-auto p-3" value="Insert category">
        </div>


    </form>
    </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php mysqli_close($con); ?>