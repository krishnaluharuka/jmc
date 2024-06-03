<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
$username = $_SESSION['admin_name'];

if (!isset($username)) {
    echo "<script>window.open('./users_area/user_login.php','_self')</script>";
}
if (isset($_POST['submit_about_us'])) {
    $company_name = $_POST['company_name'];

    $company_logo = $_FILES['company_logo']['name'];
    $temp_logo = $_FILES['company_logo']['tmp_name'];

    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $fb_link = $_POST['fb_link'];
    $whatsapp_link = $_POST['whatsapp_link'];
    $viber_link = $_POST['viber_link'];
    $insta_link = $_POST['insta_link'];
    $about_us = $_POST['enter_about_us'];


    move_uploaded_file($temp_logo, "admin_images/$company_logo");

    // insert query
    $insert_about_us = "insert into about_us (company_name,company_logo,about_us,location,
        email,phone,insta_link,fb_link,viber_link,whatsapp_link) values  ('$company_name','$company_logo','$about_us','$address','$email','$contact','$insta_link','$fb_link','$viber_link','$whatsapp_link')";
    $result_query = mysqli_query($con, $insert_about_us);
    if ($result_query) {
        echo "<script>alert('Successfully  inserted about_us')</script>";
    } else {
        echo "<script>alert('Failed to submit about_us')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <h1 class="text-center">INSERT<span class="px-4"> ABOUT US</span></h1>

    <form action="" method="post" class="mt-5" enctype="multipart/form-data">
        <!-- title -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="company_name" class="form-label">Comapany Name</label>
            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter your company name" required="required">
        </div>

        <!-- company logo -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="company_logo" class="form-label">Company Logo</label>
            <input type="file" name="company_logo" id="company_logo" class="form-control" required="required">
        </div>

        <!-- Contact -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter contact" required="required" autocomplete="off">
        </div>

        <!-- Location -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="address" class="form-label">Location</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Enter location" required="required" autocomplete="off">
        </div>

        <!-- Email -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required="required" autocomplete="off">
        </div>

        <!-- fb-link -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="fb_link" class="form-label">Facebook Link</label>
            <input type="url" name="fb_link" id="fb_link" class="form-control" placeholder="Enter facebook link">
        </div>

        <!-- whatsapp-link -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="whatsapp_link" class="form-label">Whatsapp Link</label>
            <input type="url" name="whatsapp_link" id="whatsapp_link" class="form-control" placeholder="Enter whatsapp link">
        </div>

        <!-- viber-link -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="viber_link" class="form-label">Viber Link</label>
            <input type="url" name="viber_link" id="viber_link" class="form-control" placeholder="Enter viber link">
        </div>

        <!-- Insta-link -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="insta_link" class="form-label">Instagram Link</label>
            <input type="url" name="insta_link" id="insta_link" class="form-control" placeholder="Enter instagram link">
        </div>

        <!-- about us -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="enter_about_us" class="form-label">Enter about us</label>
            <textarea name="enter_about_us" id="enter_about_us" class="form-control" placeholder="Enter about_us" rows="5" required="required" autocomplete="off"></textarea>
        </div>

        <!-- Submit -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="submit_about_us" class="mbtn2 m-auto" value="Insert">
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php mysqli_close($con); ?>