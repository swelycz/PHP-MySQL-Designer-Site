<?php session_start();
  include 'includes/sqli-connection.php';
  function createUser(&$mysqli) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $company = filter_var($_POST['company'], FILTER_SANITIZE_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $middleini = filter_var($_POST['middleini'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_SPECIAL_CHARS);
    $conf = filter_var($_POST['confirmPass'], FILTER_SANITIZE_SPECIAL_CHARS);

    $_SESSION['email'] = $email;
    $_SESSION['company'] = $company;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['middleini'] = $middleini;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['pass'] = $pass;
    $_SESSION['conf'] = $conf;

    if (empty($email) || empty($firstname) || empty($lastname) || empty($pass) || empty($conf)) {
      return ['all fields required', false];
    }
    if ($pass !== $conf) {
      return ['passwords must match', false];
    }

    $q = "select * from users where email = '$email'";
    $result = $mysqli->query($q);

    if (!$result) {
      return [$mysqli->error, false];
    } elseif ($result->num_rows > 0) {
      return ['email already taken', false];
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $q = "insert users (email,company_title,first_name,middle_initial,last_name,pass)
      values('$email','$company','$firstname','$middleini','$lastname','$hash')";

    $result = $mysqli->query($q);

    if ($result) {
      return ['user created successfully', true];
    } else {
      return [$mysqli->error, false];
    }
  }

  list($msg, $success) = createUser($mysqli);
  $_SESSION['msg'] = $msg;

  $location = $success ? 'index.php' : 'signup.php';
  header("Location: $location");
