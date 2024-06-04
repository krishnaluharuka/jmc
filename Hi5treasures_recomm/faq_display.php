<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include('includes/connect.php');
include('navbar.php');


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
    </style>
</head>

<body>

 
  <div class="container mt-5">
  <h3 class="text-center mb-5"><span class="px-4"> FAQ</span></h3>
    <?php
    
    $select_query = "Select * from faq";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
      $question = $row['question'];
      $answers = $row['answers'];

      echo "<div class='mb-3'>
                <div class='row g-0'>
                  <div class='col-md-12'>
                    <div class='card-body border shadow'>
                      <h5 class='card-title'>$question</h5>
                      <p class='card-text'>$answers</p>
                      </div>
                    </div>
                  </div>
                </div>";
    }
    ?>
  </div>

  <?php
  include('footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php mysqli_close($con); ?>