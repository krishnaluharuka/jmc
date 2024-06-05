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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <style>
        .bg {
            background-color: antiquewhite;
        }
    </style>
</head>

<body>
    <h3 class="text-center my-5">ALL <span class="px-4">REVIEWS</span></h3>
    <table id="myTable" class="table table-bordered border border-dark w-50 mt-5 m-auto">
        <thead class="bg">
            <tr>
                <th>S.No</th>
                <th>Username</th>
                <th>Stars</th>
                <th>Feedback</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_rev = "Select * from feedback";
            $result = mysqli_query($con, $select_rev);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $feedback_id = $row['feedback_id'];
                $feedback_userid = $row['user_id'];
                $select_name= mysqli_query($con, "select *from user_table where user_id= $feedback_userid");

                $select_fetch=mysqli_fetch_assoc($select_name);
                $username=$select_fetch['username'];
                $feedback_rating = $row['rating'];
                $feedback = $row['feedback'];
                $number++;
                echo "<tr>
                <td>$number</td>
                <td>$username</td>
                <td>$feedback_rating</td>
                <td>$feedback</td>
                <td>
                <a href='index.php?delete_review=$feedback_id' type='button' 
                class='text-dark' data-bs-toggle='modal' data-bs-target='#Modal_$feedback_id'>
                        <i class='bi bi-trash'></i></a>
                </td>
            </tr>";
                echo "<div class='modal fade' id='Modal_$feedback_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
    
                    </div>
                    <div class='modal-body'>
                        <h5 class='modal-title' id='exampleModalLabel'>Are you sure you want to delete this?</h5>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='mbtn1' data-bs-dismiss='modal'><a href='./index.php?list_reviews' class='text-light text-decoration-none'>No</a></button>
                        <button type='button' class='mbtn1'><a href='index.php?delete_review=$feedback_id' class='text-light text-decoration-none'>Yes</a></button>
                    </div>
                </div>
            </div>
        </div>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>
</body>

</html>
