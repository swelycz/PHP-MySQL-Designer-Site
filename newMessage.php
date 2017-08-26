<?php
  include 'includes/sqli-connection.php';
  include 'includes/header.php';
  if (!$_SESSION['loggedin']) {
    header("Location: signup.php");
  }
  $images = $mysqli->query('select * from image');
 ?>
 <div class = "newMessageContainer">
   <p>New Message</p>
   <form method = "post" action = "newMessageHandler.php" enctype="multipart/form-data">
     <a><?= $_SESSION['msg']=="Failed uploading image. Try a smaller image file" ? $_SESSION['msg'] : '' ?></a>
     <input type="file" name="upload">
     <input class = "msgTitle" type = "text" name = "msgTitle" maxlength="40" placeholder="Message Title" required autofocus/><br />
     <textarea class = "msgBody" type = "text" name = "msgBody" maxlength="1000" rows = "4" cols="50" placeholder="Your message here..." required></textarea><br />
     Email to Designer: <input type="checkbox" name="emailMsg">
     <button type = "submit">Send</button>
   </form>
 </div>

<?php include 'includes/footer.php';
