<?php session_start();
  include 'includes/sqli-connection.php';
  function changeUser(&$mysqli) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $company = filter_var($_POST['company'], FILTER_SANITIZE_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $middleini = filter_var($_POST['middleini'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);

    $_SESSION['email'] = $email;
    $_SESSION['company'] = $company;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['middleini'] = $middleini;
    $_SESSION['lastname'] = $lastname;

    if (empty($email) || empty($firstname) || empty($lastname)) {
      return ['all fields required', false];
    }

    if (empty($company)) {
      $company = '';
    }
    if (empty($middleini)) {
      $middleini = '';
    }
    $userEmail = $_SESSION['email'];
    $q = "update users set email = '$email', company_title = '$company', first_name = '$firstname', middle_initial = '$middleini', last_name = '$lastname' where email = '$userEmail'";

    $result = $mysqli->query($q);

    if ($result) {
      return ['user updated successfully', true];
    } else {
      return [$mysqli->error, false];
    }
  }

  list($msg, $success) = changeUser($mysqli);
  $_SESSION['msg'] = $msg;

  $location = $success ? 'userPage.php' : 'changeAccountInfo.php';
  header("Location: $location");
