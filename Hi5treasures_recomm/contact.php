<?php
include('includes/connect.php');
include('navbar.php');
include('include_aboutus.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link href="images/logo.jpg" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
            background-image: url(images/bg2.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            /* background-blend-mode:inherit; */
        }

        .bg {
            background-color: antiquewhite;
        }
    </style>
</head>

<body>
    <section>
        <div class="container mt-5 mb-2">
            <div class="card border shadow rounded mx-auto">
                <div class="row py-3 my-3 d-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12 py-3">
                        <div class="card-body">
                            <h1 class="px-3">Tell us about your query</h1>
                            <div class="subject px-3">
                                <?php echo htmlspecialchars($company_name); ?> values its customers. Connect with us and we will reach out to you in your celebrations..<br><br>
                            </div>
                            <div class="card border shadow col-10 mx-auto">
                                <div class="row d-flex align-items-center">
                                    <div class="col-10">
                                        <a href="chatbox.php" class="text-decoration-none">
                                            <div class="card-body d-flex align-items-center text-dark">
                                                Hello! Tap here if you need any help<i class="bi bi-emoji-smile-fill text-warning ms-2"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <a href="chatbox.php" class="text-decoration-none">
                                            <i class="bi bi-chat-left-text-fill text-dark p-3"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-2">
            <div class="card border shadow rounded mx-auto">
                <div class="row d-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card-body">
                            <div class="subject px-3">
                                <label><i class="bi bi-telephone-fill"></i> Call Us: </label><b><?php echo  $contact; ?></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-2">
            <div class="card border shadow rounded mx-auto">
                <div class="row d-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card-body">
                            <div class="subject px-3">
                                <label><i class="bi bi-envelope-fill"></i> Email: </label><b><?php echo $email; ?></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="card border shadow rounded mx-auto">
                <div class="row d-flex">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card-body">
                            <div class="subject px-3 text-center">
                                <label>Call & Email Support: </label><b> 6:00AM - 9:00 PM</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <footer>
        <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php mysqli_close($con); ?>