<?php
include('../includes/connect.php');

if (isset($_POST['reply'])) {
    $message_id = $_POST['message_id'];
    $admin_reply = htmlspecialchars($_POST['message_reply']);

    $stmt = $con->prepare("UPDATE chat SET reply = ? WHERE id = ?");
    $stmt->bind_param("si", $admin_reply, $message_id);
    $stmt->execute();
    $stmt->close();
}

$result = mysqli_query($con, "SELECT id, username, message,message_time, reply, reply_time FROM chat ORDER BY message_time DESC");

$messages = array();

while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
</head>
<body>
    <h3>Messages</h3>
    <?php foreach ($messages as $message): ?>
        <div class="message">
            <p><strong>From: <?php echo htmlspecialchars($message['username']); ?></strong></p>
            <p><?php echo htmlspecialchars($message['message']); ?></p>
            <?php if (!empty($message['reply'])): ?>
                <p><strong>Admin Reply:</strong> <?php echo htmlspecialchars($message['reply']); ?></p>
            <?php else: ?>
                <form method="POST" action="">
                    <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                    <textarea name="message_reply" placeholder="Reply to this message..."></textarea><br><br>
                    <button type="submit" name="reply">Reply</button>
                </form>
            <?php endif; ?>
            <small>Sent on: <?php echo htmlspecialchars($message['reply_time']); ?></small>
        </div>
    <?php endforeach; ?>
</body>
</html>
<?php mysqli_close($con); ?>
