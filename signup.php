<?php
  include 'includes/sqli-connection.php';
  include 'includes/header.php';
  include 'includes/loginBox.php';
  if ($_SESSION['loggedin']) {
    header('Location: index.php');
  }
?>
<div class = "signupSpacer"></div>
<div class = "signupFormContainer">
  <p class = "signupTitle">SIGN UP</p><p class = "formNotification"><?= isset($_SESSION['msg']) ? $_SESSION['msg'] : "" ?></p>
  <form action="signupFormHandler.php" method="post">
    <div class = "signupInput">Email: <input type="textbox" name="email" placeholder="example@host.com" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : "" ?>" required /></div><br />
    <div class = "signupInput">Company Title: <input type="textbox" name="company" placeholder="Example Inc" value="<?= isset($_SESSION['company']) ? $_SESSION['company'] : "" ?>" /></div><br />
    <div class = "signupInput">First Name: <input type="textbox" name="firstname" placeholder="John" value="<?= isset($_SESSION['firstname']) ? $_SESSION['firstname'] : "" ?>" required /></div><br />
    <div class = "signupInput">Middle Initial: <input type="textbox" name="middleini"  placeholder="M" value="<?= isset($_SESSION['middleini']) ? $_SESSION['middleini'] : "" ?>" /></div><br />
    <div class = "signupInput">Last Name: <input type="textbox" name="lastname" placeholder="Smith" value="<?= isset($_SESSION['lastname']) ? $_SESSION['lastname'] : "" ?>" required /></div><br /><br />
    <div class = "signupInput">Password: <input type="password" name="pass" value="<?= isset($_SESSION['pass']) ? $_SESSION['pass'] : "" ?>" required /></div><br />
    <div class = "signupInput">Confirm Password: <input type="password" name="confirmPass" value="<?= isset($_SESSION['conf']) ? $_SESSION['conf'] : "" ?>" required /></div><br />
    <button type="submit">Sign Up</button>
  </form>
</div>

<?php include 'includes/footer.php' ?>
