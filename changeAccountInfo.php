<?php
  include 'includes/sqli-connection.php';
  include 'includes/header.php';
  if (!$_SESSION['loggedin']) {
    header("Location: index.php");
  }
  $email = $_SESSION['email'];
  $userq = $mysqli->query("select * from users where email = '$email'");
  $user = $userq->fetch_object();
 ?>

<div class = "changeAccountInfoContainer"><p>Change Account Information</p>
  <form action="changeAccInfoHandler.php" method="post">
    <input type="textbox" name="email" placeholder="example@host.com" value="<?= $user->email ?>" required /><br />
    <input type="textbox" name="company" placeholder="Example Inc" value="<?= isset($user->company_title) ? $user->company_title : "" ?>" /><br />
    <input type="textbox" name="firstname" placeholder="John" value="<?= $user->first_name ?>" required /><br />
    <input type="textbox" name="middleini"  placeholder="M" value="<?= isset($user->middle_initial) ? $user->middle_initial : "" ?>" /><br />
    <input type="textbox" name="lastname" placeholder="Smith" value="<?= $user->last_name ?>" required /><br />
    <button type="submit">Change Information</button>
  </form>
</div>

 <?php include 'includes/footer.php' ?>
