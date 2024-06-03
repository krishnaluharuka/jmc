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
  <title>About Us</title>
  <link href="images/logo.jpg" rel="icon" type="image/icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
  <link href="css/style.css" rel="stylesheet">
  <style>
    body {
      overflow-x: hidden;
    }

    h1 {
      font-family: 'Tangerine', serif;
      font-size: 400%;
      text-shadow: 4px 4px 4px #aaa;
      font-weight: bold;
    }

    h4 {
      font-family: 'Tangerine', serif;
      font-size: 300%;
      text-shadow: 4px 4px 4px #aaa;
      font-weight: bolder;
    }

    bold {
      font-size: 100%;
      text-shadow: 4px 4px 4px #aaa;
      font-weight: normal;
    }

    .mbtn5 {
      height: 52px;
      outline: none;
      border: none;
      padding-right: 20px;
      padding-left: 20px;
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
</head>

<body>
  <div class="font-effect-shadow-multiple">
    <h1 class="text-center my-3"><?php echo $company_name; ?></h1>
    <hr class="w-50 text-center m-auto">
    <!-- <div class="text-center">
      <img src="images/line.jpg" height="25em" width="35%">
    </div> -->
  </div>
  <section class="main py-1 my-1" id="home">
    <div class="container">
      <div class="row py-3 my-1">
        <div class="col-lg-12 col-md-12 col-sm-12 py-1">

          <div class="line my-1">
            <p>
              <bold><?php echo $about_us; ?></bold>
            </p>
          </div>

          <?php
          if (isset($_POST['read_more'])) { ?>
            <section class="read_more">
              <div class="my-1">
                <p>
                  <?php
                  $hide = 2;
                  echo "<bold>" . $extra_info . "</bold>"; ?>
                </p>
              </div>
            </section>
          <?php
          }
          ?>

          <?php if (!isset($hide)) { ?>
            <form action='' method='POST'>
              <input type="submit" id="read_more" class="mbtn5 text-decoration-none" name="read_more" value="Read More">
              <a href='home.php' class='mbtn1 p-3 my-1 text-decoration-none'>Shop Now</a>
            </form>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </section>

  <div class="font-effect-shadow-multiple mb-5">
    <h4 class="text-center"><?php echo "'" . $motto . "..'"; ?></h3>
  </div>
  <div class="container d-flex justify-content-center align-items-center">
    <div class="embed-responsive embed-responsive-21by9">
      <iframe src="https://www.facebook.com/plugins/video.php?height=476&href=https%3A%2F%2Fwww.facebook.com%2Fhi5treasures%2Fvideos%2F1369584947214001%2F&show_text=false&width=267&t=0" width="267" height="476" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true" class="m-3"></iframe>

      <iframe src="https://www.facebook.com/plugins/video.php?height=476&href=https%3A%2F%2Fwww.facebook.com%2Fhi5treasures%2Fvideos%2F297976633014179%2F&show_text=false&width=267&t=0" width="267" height="476" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true" class="m-3"></iframe>
      <iframe src="https://www.facebook.com/plugins/video.php?height=476&href=https%3A%2F%2Fwww.facebook.com%2Fhi5treasures%2Fvideos%2F967537624155735%2F&show_text=false&width=380&t=0" width="380" height="476" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true" class="m-3"></iframe>
    </div>
  </div>

  <?php
  include('footer.php');
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php mysqli_close($con); ?>