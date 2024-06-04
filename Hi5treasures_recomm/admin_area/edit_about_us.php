<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_user = $_SESSION['admin_name'] ?? null;;

if (!$admin_user) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
    exit();
}

if (isset($_GET['edit_about_us'])) {
    $get_about_us = "Select * from about_us";
    $result = mysqli_query($con, $get_about_us);
    $row = mysqli_fetch_assoc($result);
    $about_id = $row['about_id'];
    $company_name = $row['company_name'];
    $logo = $row['company_logo'];
    $contact = $row['phone'];
    $address = $row['location'];
    $email = $row['email'];
    $fb_link = $row['fb_link'];
    $whatsapp_link = $row['whatsapp_link'];
    $viber_link = $row['viber_link'];
    $insta_link = $row['insta_link'];
    $about_us = $row['about_us'];
    $extra_info = $row['extra_info'];
    $motto = $row['motto'];
}
$emailErr = $contactErr = "";

if (isset($_POST['update_about_us']))
{
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
    $about_us = $_POST['about_us'];
    $extra_info = $_POST['extra_info'];
    $motto = $_POST['motto'];

    // Validation
    // if (!preg_match("/^[a-zA-Z-' ]*$/", $company_name)) {
    //     $nameErr = "Invalid company name. Only letters, spaces, and hyphens are allowed.";
    // }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
    }
    if(!preg_match("/^\d{10}$/",$contact))
    {
        $contactErr= "Invalid contact number.Must be 10 digits.";
    }

    // move_uploaded_file($temp_logo, "admin_images/$company_logo");
    if (empty($emailErr) && empty($contactErr)) {
        if (!empty($company_logo)) {
            move_uploaded_file($temp_logo, "admin_images/$company_logo");
        } else {
            $company_logo = $logo;  // Retain existing logo if a new one is not uploaded
        }

    $update_home_page = "UPDATE about_us set company_name='$company_name',company_logo='$company_logo', phone='$contact', location='$address', email='$email', fb_link='$fb_link', whatsapp_link='$whatsapp_link', viber_link='$viber_link', insta_link='$insta_link', about_us='$about_us',extra_info='$extra_info',motto='$motto'
     WHERE about_id='$about_id'";

    $result_update = mysqli_query($con, $update_home_page);
    if ($result_update) {
        echo "<script>alert('Home Page updated successfully')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
    else {
        echo "<script>alert('Error updating Home Page')</script>";
    }
}
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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" id="company_name" name="company_name" value="<?php echo $company_name; ?>" class="form-control my-3" required="required">
               
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="company_logo" class="form-label">Company Logo</label>
                <div class="d-flex">
                    <input type="file" id="company_logo" name="company_logo" class="form-control my-3 w-90 m-auto" required="required">
                    <img src="./admin_images/<?php echo $logo; ?>" alt="" width="100px" height="80px">
                </div>
            </div>

            <div class="form-outline w-50 m-auto mb-4">
                <label for="motto" class="form-label">Company Motto</label>
                <input type="text" id="motto" name="motto" value="<?php echo $motto; ?>" class="form-control my-3" required="required">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="about_us" class="form-label">About us</label>
                <textarea name="about_us" id="about_us" class="form-control my-3 mySummernote" rows="5" required="required"><?php echo $about_us; ?></textarea>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="extra_info" class="form-label">Extra About us</label>
                <!-- <textarea name="description" required class="form-control mySummernote" rows="3"></textarea> -->
                <textarea name="extra_info" id="extra_info" class="form-control mySummernote" rows="3" required="required"><?php echo $extra_info; ?></textarea>
                <!-- <textarea name="extra_info" id="extra_info" class="form-control mySummernote" rows="3" required></textarea> -->
            </div>

            <!-- Address -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" name="contact" id="contact" class="form-control my-3" value="<?php echo $contact; ?>" required="required" autocomplete="off">
                <?php echo $contactErr; ?>
            </div>

            <!-- Location -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="address" class="form-label">Location</label>
                <input type="text" name="address" id="address" class="form-control my-3" value="<?php echo $address; ?>" required="required" autocomplete="off">
            </div>

            <!-- Email -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control my-3" value="<?php echo $email; ?>" required="required" autocomplete="off">
                <?php echo $emailErr; ?>
            </div>

            <!-- fb-link -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="fb_link" class="form-label">Facebook Link</label>
                <input type="url" name="fb_link" id="fb_link" class="form-control my-3" value="<?php echo $fb_link; ?>">
            </div>

            <!-- whatsapp-link -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="whatsapp_link" class="form-label">Whatsapp Link</label>
                <input type="url" name="whatsapp_link" id="whatsapp_link" class="form-control my-3" value="<?php echo $whatsapp_link; ?>">
            </div>

            <!-- viber-link -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="viber_link" class="form-label">Viber Link</label>
                <input type="url" name="viber_link" id="viber_link" class="form-control my-3" value="<?php echo $viber_link; ?>">
            </div>

            <!-- Insta-link -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="insta_link" class="form-label">Instagram Link</label>
                <input type="url" name="insta_link" id="insta_link" class="form-control my-3" value="<?php echo $insta_link; ?>">
            </div>


            <div class="text-center">
                <input type="submit" name="update_about_us" class="mbtn1 mb-3" value="Update">
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
    <!-- //Summernote JS - CDN Link -->
    </body>
</html>