<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}
if (isset($_GET['edit_category'])) {
    $edit_category = $_GET['edit_category'];
    $select = "Select * from categories where category_id=$edit_category";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($result);
    $category_title = $row['category_title'];
}
if (isset($_POST['edit_category'])) {
    $cat_title = $_POST['category_title'];
    $edit = "Update categories set category_title='$cat_title' where category_id=$edit_category";
    $run = mysqli_query($con, $edit);
    if ($run) {
        echo "<script>alert('Category is updated successfully');</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }
}



?>



<div class="container">
    <h3 class="text-center my-5">EDIT <span class="px-4">CATEGORY</span></h3>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" name="category_title" id="category_title" class="form-control my-3" value="<?php echo $category_title; ?>" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_category" class="mbtn1 mb-3" value="Update category">
        </div>
    </form>
</div>