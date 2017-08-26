<?php

function uploadFile() {
  include 'includes/sqli-connection.php';
  try {
    if (!isset($_FILES['upload'])) {
      throw new Exception('no file uploaded');
    }

    $tmpName = $_FILES['upload']['tmp_name'];
    $name = $_FILES['upload']['name'];
    $type = $_FILES['upload']['type'];
    $size = $_FILES['upload']['size'];

    if (!file_exists($tmpName)) {
      throw new Exception('no temp file found');
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

    //var_dump($data);
    if (isset($data) && strlen($data) > 0) {
      // $stmt = mysqli_prepare($dbc, ...);
      $stmt = $mysqli->prepare('insert image (file_name, file_type, file_data) values (?, ?, ?)');
      // mysqli_stmt_bind_param($stmt, ...)
      $stmt->bind_param('sss', $name, $type,
        $data);
      if (!$stmt->execute()) {
        throw new Exception($stmt->error);
      };
    }
  } catch (Throwable $ex) {
    echo $ex->getMessage();
  }
}

uploadFile();
