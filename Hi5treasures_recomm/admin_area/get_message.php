<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
$admin_user = $_SESSION['admin_name'];

if (!isset($admin_user)) {
    echo "<script>window.open('../users_area/user_login.php','_self')</script>";
}

if (isset($_GET['get_message'])) {
    $user_id = $_GET['get_message'];
    $select_query = mysqli_query($con, "SELECT * FROM user_table where user_id=$user_id");
    $result = mysqli_fetch_assoc($select_query);
    $username = htmlspecialchars($result['username']);
    $user_image = htmlspecialchars($result['user_image']);

    $result = mysqli_query($con, "SELECT * FROM chat where username='$username' ORDER BY message_time ASC");
    $new_messages = mysqli_num_rows($result);

    $messages = array();
    while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}
}

if (isset($_POST['reply'])) {
    $message_id = $_POST['message_id'];
    $admin_reply = htmlspecialchars($_POST['message_reply']);
    $reply_time = 'NOW()';

    $stmt = $con->prepare("UPDATE chat SET reply =?, reply_time=NOW(), is_read = 1 WHERE id = ? and is_read = 0");
    $stmt->bind_param("si", $admin_reply, $message_id);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <title>Notification</title>
    <style>
        .chat-window {
            height: 550px;
            padding: 10px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .chat-message {
            margin-bottom: 10px;
        }

        .chat-bubble {
            padding: 10px;
            border-radius: 10px;
            background-color: #f1f1f1;
        }

        .bg {
            background-color: antiquewhite;
        }

        .mbtn5 {
            height: 50px;
            width: 25%;
            outline: none;
            border: none;
            padding: 0px;
            margin-top: 0%;
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
    <h3 class="text-center">Messages</h3>
    <div class="container">
        <div class="card border shadow rounded mx-auto my-3">
            <div class="card-title d-flex justify-content-between align-items-center px-3 pt-2">
                <div class="d-flex align-items-center">
                    <img src="../users_area/user_images/<?php echo htmlspecialchars($user_image); ?>" width="50" height="50" class="me-3">
                    <h5 class="mb-0"><?php echo htmlspecialchars($username); ?></h5>
                </div>
                <a href="index.php"><i class="bi bi-x-lg"></i></a>
            </div>

            <div class="card-body">
                <div class="chat-window" id="chatWindow">
                <!-- <?php if ($new_messages==0){
                echo "<script>window.open('list_users.php','_self')</script>";
                }
                ?> -->

       
    
                    <?php foreach ($messages as $message) : ?>
                        <div class="chat-message">
                            <div class="chat-bubble">
                                <p class="text-start mb-0"><strong><?php echo htmlspecialchars($username); ?></strong></p>
                                <p class="text-start mb-0"><?php echo htmlspecialchars($message['message']); ?></p>
                                <p class="text-start mb-1"><small>Sent on: <?php echo htmlspecialchars($message['message_time']); ?></small></p>
                                <?php if (!empty($message['reply'])) : ?>
                                    <p class="text-end mb-0"><strong><?php echo $_SESSION['admin_name']; ?></strong></p>
                                    <p class="text-end mb-0"> <?php echo htmlspecialchars($message['reply']); ?></p>
                                    <p class="text-end mb-1"><small>Replied on: <?php echo htmlspecialchars($message['reply_time']); ?></small></p>
                                <?php else : ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                        <textarea name="message_reply" placeholder=" Reply to this message..." rows="2" cols="53" class=" mt-3  mb-1 d-flex"></textarea>
                                        <button type="submit" class="mbtn5 mt-0" name="reply">Reply</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chatInput = document.querySelector('.chat-input');
            var chatWindow = document.getElementById('chatWindow');
            
            document.getElementById('chatForm').onsubmit = function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                var message = chatInput.value.trim();
                if (message === '') return false; // Prevent empty message submission

                // Perform further actions like sending message via AJAX, updating UI, etc.
                console.log('Message to send:', message);

                // Clear input field after submission
                chatInput.value = '';

                return false; // Prevent form submission
            };
        });
    document.querySelector('.chat-window').scrollTop = document.querySelector('.chat-window').scrollHeight;
    </script>
</body>
</html>


 