<?php
	session_start();
	include 'includes/sqli-connection.php';

	function checkPass(&$mysqli) {
		$currPass = filter_var($_POST['curr_pass'], FILTER_SANITIZE_SPECIAL_CHARS);
		$newPass = filter_var($_POST['new_pass'], FILTER_SANITIZE_SPECIAL_CHARS);
		$rePass = filter_var($_POST['re_pass'], FILTER_SANITIZE_SPECIAL_CHARS);
		$email = $_SESSION['email'];

		$passQuery = "select pass from users where email = '$email'";
		$result = $mysqli->query($passQuery);
		$emailacc = $result->fetch_object();

		if (empty($currPass) || empty($newPass) || empty($rePass)) {
    		return ['all fields required', false];
  		}

		if (!password_verify($currPass, $emailacc->pass)) {
			return ['current password is incorrect', false];
		}

		if ($newPass !== $rePass) {
			return ['new password and retyped new password do not match', false];
		}

  		$hash = password_hash($newPass, PASSWORD_DEFAULT);
		  $changeQuery = "update users set pass = '$hash'";
  		$result = $mysqli->query($changeQuery);

  		if ($result) {
    		return ['Password changed', true];
  		} else {
    		return [$mysqli->error, false];
  		}
	}
		list($msg, $success) = checkPass($mysqli);
		$_SESSION['msg'] = $msg;

		$location = $success ? 'userPage.php' : 'changepass.php';
		header("Location: $location");


?>
