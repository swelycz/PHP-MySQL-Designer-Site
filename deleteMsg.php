<?php session_start();

  include 'includes/sqli-connection.php';

  $id = isset($_GET['id']) ? $_GET['id'] : 0;

  $imgidq = $mysqli->query("select * from msgimg where message_id = $id");
  $imgid = $imgidq->fetch_object();
  if (isset($imgid)) {
    $deleteImg = $mysqli->query("delete from image where img_id = $img->img_id");
    $deleteMsgImg = $mysqli->query("delete from msgimg where message_id = $id");
  }
  $deleteMsg = $mysqli->query("delete from messages where message_id = $id");

  //echo($mysqli->error);
  header("Location: messages.php");
?>
