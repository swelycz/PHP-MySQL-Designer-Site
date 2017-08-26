<?php
  include 'includes/sqli-connection.php';
  include 'includes/header.php';
  if (!$_SESSION['loggedin']) {
    header("Location: index.php");
  }
 ?>

<div class = "changepassContainer"><p>Change Password</p>
  <form action="changepassHandler.php" method="POST">
		<input type='password' name='curr_pass' placeholder="Current Password">
		<input type='password' name='new_pass' placeholder="New Password">
		<input type='password' name='re_pass' placeholder="Re-type Password">
		<button type='submit' name ='change_pass'>Change</button>
	</form>
</div>

 <?php include 'includes/footer.php' ?>
