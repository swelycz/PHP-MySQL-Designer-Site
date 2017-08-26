<?php
session_start();
include 'includes/sqli-connection.php';

function loginUser(&$mysqli) {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
  $pass = filter_var($_POST['pass'], FILTER_SANITIZE_SPECIAL_CHARS);

  if (empty($email) || empty($pass)) {
    return ['all fields required', false];
  }

  $q = "select * from users where email = '$email'";
  $result = $mysqli->query($q);

  if (!$result) {
    return [$mysqli->error, false];
  } elseif ($result->num_rows !== 1) {
    return ['problem logging in', false];
  } else {
    $email = $result->fetch_object();
  }

  if (password_verify($pass, $email->pass)) {

    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email->email;
    return [null, true];
  } else {
    return ['passwords do not match', false];
  }
}

list($msg, $success) = loginUser($mysqli);
$_SESSION['msg'] = $msg;
$_SESSION['email'] = $_POST['email'];

if ($success) {
  if ($_SESSION['email'] == 'admin') {
    $location = 'adminpage.php';
  } else {
    $location = 'userPage.php';
  }
} else {
  $location = 'index.php';
}

header("Location: $location");
