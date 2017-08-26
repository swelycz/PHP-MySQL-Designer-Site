<?php
  include 'includes/sqli-connection.php';
  include 'includes/header.php';
  if (!$_SESSION['loggedin']) {
    header("Location: index.php");
  }
  $useremail = $_SESSION['email'];
  $userq = $mysqli->query("select * from users where email = '$useremail'");
  $user = $userq->fetch_object();
  $messages = $mysqli->query("select * from messages where user_id = $user->user_id");
  $imgq = $mysqli->query("select * from image where user_id = $user->user_id");
  $img = $imgq->fetch_object();
?>

<div class = "messagesWrapper">
    <h1>Messages</h1>
    <?php while ($msg = $messages->fetch_object()): ?>
      <div class = "messageContainer">
        <div class = "subjectContainer"><?= ucwords($msg->title) ?></div>
        <div class = "bodyContainer"><?= $msg->message ?></div>
        <p><?= $msg->date_created ?></p>
        <div class = "linkContainer">
          <?php
            $imgidq = $mysqli->query("select * from msgimg where message_id = $msg->message_id");
            $imgid = $imgidq->fetch_object();
          ?>
          <?php if (isset($imgid)): ?>
            <?php
              $imgq = $mysqli->query("select * from image where img_id = $imgid->img_id");
              $img = $imgq->fetch_object();
            ?>
            <a class = "msglink" href = "get-img.php?id=<?= $img->img_id ?>"><?= $img->file_name ?></a>
          <?php endif; ?>
          <a class = "msglink" href = "deleteMsg.php?id=<?= $msg->message_id ?>">Delete</a>
        </div>
      </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php' ?>
