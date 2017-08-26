<?php
  include 'includes/sqli-connection.php';
  include 'includes/header.php';
  if (!$_SESSION['loggedin'] or ($_SESSION['email'] !== 'admin')) {
    header("Location: index.php");
  }

 $useremail = $_SESSION['email'];
 $userq = $mysqli->query("select * from users where email = '$useremail'");
 $user = $userq->fetch_object();
 $messages = $mysqli->query("select * from messages");
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
           <a class = "msglink" href = "get-img.php?id=<?= $img->img_id ?>"><?= $img->file_name ?></a>
           <a class = "msglink" href = "deleteMsg.php?id=<?= $msg->message_id ?>">Delete</a>
         </div>
       </div>
     <?php endwhile; ?>
 </div>

 <?php include 'includes/footer.php' ?>
