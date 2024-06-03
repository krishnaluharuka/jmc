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
    <h3 class="text-center my-5">ABOUT <span class="px-3">US</span></h3>
    <table class="table table-bordered border border-dark mt-5">
        <thead class="bg">
            <tr>
                <th>Company Name</th>
                <th>Company Logo</th>
                <th>About Us</th>
                <th>Location</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Instagram Link</th>
                <th>Viber Link</th>
                <th>Facebook Link</th>
                <th>Whatsapp Link</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $get_about_us = "Select * from about_us";
            $result = mysqli_query($con, $get_about_us);
            $number = 0;
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
            echo "<tr>
                    <td>$company_name</td>
                    <td><img src='./admin_images/$logo' alt='' width='100px'
                     height='80'></td>
                     <td>$about_us</td>
                    <td>$address</td>
                    <td>$email</td>
                    <td>$contact</td>
                    <td>$insta_link</td>
                    <td>$viber_link</td>
                    <td>$fb_link</td>
                    <td>$whatsapp_link</td>
                    
                    <td>
                        <a href='index.php?edit_about_us='$about_id' class='text-dark'>
                            <i class='bi bi-box-arrow-in-down-left'></i>
                        </a>
                    </td>
                    </tr>";


            ?>

        </tbody>
    </table>
</body>

</html>