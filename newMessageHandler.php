<?php session_start();
  include 'includes/sqli-connection.php';
  require_once('resources\PHPMailer\class.phpmailer.php');

  function uploadMsg() {

    try {
      include 'includes/sqli-connection.php';
      $tmpName = $_FILES['upload']['tmp_name'];
      $name = $_FILES['upload']['name'];
      $type = $_FILES['upload']['type'];
      $size = $_FILES['upload']['size'];
      $userEmail = $_SESSION['email'];
      $useridq = $mysqli->query("select * from users where email = '$userEmail'");
      $userid = $useridq->fetch_object();
      $subject = filter_var($_POST['msgTitle'], FILTER_SANITIZE_SPECIAL_CHARS);
      $body = filter_var($_POST['msgBody'], FILTER_SANITIZE_SPECIAL_CHARS);
      $emailMsg = isset($_POST['emailMsg']) ? 1 : 0;

      //var_dump($_FILES['upload']);

      if (isset($tmpNameTest)) {
        if (empty($subject) || empty($body)) {
          throw new Exception('Type a subject and body to your message');
        }

        // make sure the file really is the type it says
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if ($type !== $finfo->file($tmpName)) {
          throw new Exception('bad file type');
        }

        // open file at temp location
        $stream = fopen($tmpName, 'r');
        // read binary data
        $data = fread($stream, $size);
        // close file
        fclose($stream);

        if (isset($data) && strlen($data) > 0) {
          $q = "insert messages (user_id, title, message, emailmsg) values ($userid->user_id, '$subject', '$body', $emailMsg)";
          $result = $mysqli->query($q);
          if (!$result) {
            throw new Exception("failed inserting into messages: " . $mysqli->error);
          }
          $q = "set @message_id = LAST_INSERT_ID()";
          $result = $mysqli->query($q);
          if (!$result) {
            throw new Exception("failed setting message_id to variable: " . $mysqli->error);
          }
          $q = $mysqli->prepare('insert image (file_name, file_type, file_data, user_id) values (?, ?, ?, ?)');
          $q->bind_param('sssi', $name, $type, $data, $userid->user_id);
          if (!$q->execute()) {
            throw new Exception("Failed uploading image. Try a smaller image file");
          }
          $q = "set @img_id = LAST_INSERT_ID()";
          $result = $mysqli->query($q);
          if (!$result) {
            throw new Exception("failed setting img_id to variable: " . $mysqli->error);
          }
          $q = "insert msgimg (message_id, img_id) values (@message_id, @img_id)";
          $result = $mysqli->query($q);
          if (!$result) {
            throw new Exception("failed inserting into msgimg: " . $mysqli->error);
          }
        }
        return ["uploaded message and image successfully", true];
      } else {

        if (empty($subject) || empty($body)) {
          throw new Exception('Type a subject and body to your message');
        }

        $q = "insert messages (user_id, title, message) values ($userid->user_id, '$subject', '$body')";

        $result = $mysqli->query($q);

        if (!$result) {
          throw new Exception($mysqli->error);
        }
        return ["uploaded message successfully", true];
      }
    } catch (Throwable $ex) {
      return [$ex->getMessage(), false];
    }
  }

  function emailMsg() {
    include 'includes/sqli-connection.php';

    $userEmail = $_SESSION['email'];
    $userq = $mysqli->query("select * from users where email = '$userEmail'");
    $user = $userq->fetch_object();
    $subject = filter_var($_POST['msgTitle'], FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_var($_POST['msgBody'], FILTER_SANITIZE_SPECIAL_CHARS);
    $tmpName = $_FILES['upload']['tmp_name'];

    $email = new PHPMailer();
    $email->From      = $user->email;
    $email->FromName  = $user->first_name . " " . $user->last_name;
    $email->Subject   = $subject;
    $email->Body      = $body;
    $email->AddAddress( 'swelyczkowsky@student.cscc.edu' );

    if (file_exists($tmpName)) {
      $msgidq = $mysqli->query("select * from messages where message = '$body'");
      $msgid = $msgidq->fetch_object();
      $imgidq = $mysqli->query("select * from msgimg where message_id = $msgid->message_id");
      $imgid = $imgidq->fetch_object();
      $imgq = $mysqli->query("select * from image where img_id = $imgid->img_id");
      $img = $imgq->fetch_object();

      $file_to_attach = "$img->file_data";

      $email->AddAttachment( $file_to_attach , "$img->file_name" );
    }
    $email->Send();
    return ["successfully emailed message", true];
  }

  list($msg, $success) = uploadMsg($mysqli);
  $_SESSION['msg'] = $msg;
  // if uploading worked, check if user wanted to email, then send email
  if ($success && isset($_POST['emailMsg'])) {
    list($msg, $success) = emailMsg($mysqli);
    $_SESSION['msg'] = $msg;
  }

  echo $_SESSION['msg'];
  $location = $success ? 'userPage.php' : 'newMessage.php';
  header("Location: $location");
