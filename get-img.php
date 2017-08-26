<?php
include 'includes/sqli-connection.php';

$id = $_GET['id'];
$stmt = $mysqli->prepare('select * from image
  where img_id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$img = $result->fetch_object();

header('Content-type: ' . $img->file_type);
echo $img->file_data;
