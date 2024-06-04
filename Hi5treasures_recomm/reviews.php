<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('includes/connect.php');
include('navbar.php');
if (isset($_POST['submit_feedback'])) {
  if (!isset($_SESSION['username'])) {
    echo "<script>window.open('users_area/user_login.php','_self')</script>";
  }
  $username = $_SESSION['username'];
  echo $username;
  $feedback = $_POST['enter_feedback'];
  echo $feedback;

  $get_user = "Select * from user_table where username='$username'";
  $result = mysqli_query($con, $get_user);
  $row_fetch = mysqli_fetch_assoc($result);
  $user_id = $row_fetch['user_id'];

  // insert query
  $insert_feedback = "insert into feedback (feedback,user_id,date) values  ('$feedback','$user_id',NOW())";
  $result_query = mysqli_query($con, $insert_feedback);
  if ($result_query) {
    echo "<script>alert('Successfully submitted the feedback')</script>";
    echo "<script>window.open('reviews.php','_self')</script>";
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
  <title>Reviews</title>
  <link href="images/logo.jpg" rel="icon" type="image/icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

  <link href="css/style.css" rel="stylesheet">
  <style>
    .mbtn5 {
      height: 50px;
      outline: none;
      border: none;
      padding-right: 25px;
      padding-left: 25px;
      margin: auto;
      color: white;
      background: rgb(197, 12, 99);
      border-radius: 50px;
      transition: all 0.4s;
    }

    .mbtn5:hover {
      background-color: antiquewhite;
      color: black;
      border: 1px solid black;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body>

  <div class="container mt-5">
    <?php

    $select_query = "Select * from feedback ORDER BY feedback_id DESC";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
      $feedback_id = $row['feedback_id'];
      $feedback = $row['feedback'];
      $user_id = $row['user_id'];
      $date = $row['date'];
      $datetime = explode(" ", $date);
      $dateonly = $datetime[0];
      $time = $datetime[1];


      $get_user = "Select * from user_table where user_id='$user_id'";
      $result = mysqli_query($con, $get_user);
      $row_fetch = mysqli_fetch_assoc($result);
      $username = $row_fetch['username'];
      $image = $row_fetch['user_image'];

    //   if (isset($_GET['search_data_product'])) {
            
    //     // Sanitize the input
    //     $search = test($_GET['search_data']);
    
    //     // Check for script tags after sanitization
    //     // if (preg_match('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', $search)) {
    //     //     die('Invalid input. Scripts are not allowed.');
    //     // }
        
    //     // Proceed with search functionality
    //     // echo "Search term: " . $search;
        
    // }
    // function test($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }

      echo "<div class='mb-3'>
                <div class='row g-0'>
                  <div class='col-md-2 text-center'>
                    <img src='./users_area/user_images/$image' class='img-fluid rounded-start' width='100' height='100' alt='...'>
                  </div>
                  <div class='col-md-10'>
                    <div class='body'>
                      <h5 class='title'>$username</h5>
                      <p class='text'>$feedback</p>
                      <p class='text'><small class='text-muted'>$dateonly at $time</small></p>
                      </div>
                    </div>
                  </div>
                </div>";
    }
    ?>
    <div class='mb-3'>
      <div class='row g-0'>
        <div class='col-md-12'>
          <div class='body'>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-5">
            <p class='text'>
            <div class="form-outline mb-4 w-90 m-auto">
              <textarea name="enter_feedback" id="enter_feedback" class="form-control h-auto m-auto  mySummernote" placeholder="Enter your feedback" required="required"></textarea>
            </div>

            <!-- Submit -->
            <div class="form-outline mb-4 w-10 m-auto">
              <input type="submit" name="submit_feedback" class="mbtn5 m-auto" value="Submit">
            </div>
            </p>
          </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php
  include('footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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