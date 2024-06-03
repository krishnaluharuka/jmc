<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('includes/connect.php');
include('navbar.php');
include('include_aboutus.php');


// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    echo "<script>window.open('users_area/user_login.php','_self')</script>";
    exit;
}

$msg = ''; // Initialize $msg variable

// Handle message sending
if (isset($_POST['send'])) {
    $username = htmlspecialchars($_SESSION['username']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare the insert statement
    $stmt = $con->prepare("INSERT INTO chat (username, message, message_time,is_seen) VALUES (?, ?, NOW(),1)");

    if ($stmt === false) {
        die('MySQL prepare error: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("ss", $username, $message);

    if ($stmt->execute()) {
        // Message inserted successfully
        $msg = "Message sent successfully";
    } else {
        // Handle the case where execution failed
        $msg = "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}
$username = $_SESSION['username'];
// Fetch messages from the database
$result = mysqli_query($con, "SELECT username, message, message_time, reply, reply_time FROM chat where username='$username' ORDER BY message_time ASC");
$messages = [];

while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

// Close the database connection

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <title>Chat Interface</title>
    <style>
        body {
            overflow-x: hidden;
            background-image: url(images/bg2.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
        }

        .card-title {
            padding: 10px;
            border-radius: 10px;
        }

        .chat-window {
            height: 450px;
            padding: 10px;
            overflow-y: scroll;
            overflow-x: wordwrap;
        }

        .chat-message {
            margin-bottom: 10px;
        }

        .chat-bubble {
            padding: 10px;
            border-radius: 10px;
            background-color: #f1f1f1;;
            border: 1px solid antiquewhite;
        }

        .bg {
            background-color: antiquewhite;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
                <div class="card border shadow rounded w-100 mx-auto my-3">
                    <div class="row col-xl-12 col-md-12 col-lg-12 col-sm-12 col-12">

                        <div class="card-title d-flex justify-content-between align-items-center mx-3 me-1 mt-1 mb-1">
                            <div class="d-flex align-items-center">
                                <img src="admin_area/admin_images/<?php echo htmlspecialchars($logo); ?>" width="10%" height="10%" class="me-1 ms-3">

                                <p style="font-size:20px;" class=" text-start my-auto"><?php echo htmlspecialchars($company_name); ?></p>
                            </div>
                            <a href="contact.php"><i class="bi bi-x-lg pe-4 fs-3"></i></a>

                        </div>


                        <div class="card-body">
                            <div class="chat-window" id="chatWindow">
                                <div class="card mb-1">
                                    <div class="card-title">
                                        <p class="text-start mb-0 ps-2">How can we help you?</p>
                                    </div>
                                </div>
                                <?php foreach ($messages as $message) : ?>
                                    <div class="chat-message">
                                        <div class="chat-bubble">
                                            <p class="text-end mb-0"><strong><?php echo htmlspecialchars($message['username']) . ":"; ?></strong></p>
                                            <p class="text-end mb-0"><?php echo htmlspecialchars($message['message']); ?></p>
                                            <p class="text-end mb-2"><small>Sent on: <?php echo htmlspecialchars($message['message_time']); ?></small></p>
                                            <?php if (!empty($message['reply'])) : ?>
                                                <div class="reply">
                                                    <p class="text-start mb-0"><strong><?php echo $company_name; ?></strong></p>
                                                    <p class="text-start mb-0"><?php echo htmlspecialchars($message['reply']); ?></p>
                                                    <p class="text-start mb-0"><small>Replied at: <?php echo htmlspecialchars($message['reply_time']); ?></small></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php echo $msg; ?> <!-- Display message status -->
                            </div>
                            <form method="POST" action="">
                                <div class="input-group mt-3">
                                    <input type="text" class="form-control chat-input" placeholder="Type your message here..." name="message">
                                    <button type="submit" class="mbtn1" name="send">Send</button>
                                </div>
                                <div class="text-end my-5 ">
                                    Is your product customized? 
                                <a href="users_area/checkout.php" class="text-end mbtn2 text-decoration-none p-3 mt-5 ms-3 rounded-0">Check Out</a>
                                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Janapriya Multiple Campus | All Rights Reserved</a></p>
            </footer>

            <script>
                // JavaScript for handling chat input and scrolling
                document.addEventListener('DOMContentLoaded', function() {
                    var chatInput = document.querySelector('.chat-input');
                    var chatWindow = document.getElementById('chatWindow');

                    document.querySelector('form').onsubmit = function() {
                        var message = chatInput.value.trim();
                        if (message === '') return false; // Prevent empty message submission
                    };
                });
                document.querySelector('.chat-window').scrollTop = document.querySelector('.chat-window').scrollHeight;
            </script>

</body>

</html>
