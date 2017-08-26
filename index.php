<?php
  include 'includes/sqli-connection.php';
  include 'includes/header.php';
  if (!$_SESSION['loggedin']) {include 'includes/loginBox.php';}
?>

<div class = "homeContainer">
    <h1>Experience Home Decoration</h1>
    <div class = "homePictureContainer">
      <div class = "homePicture1">
        <a href = "underConstruction.php">
          <span class = "link-spanner"></span>
        </a>
      </div>
      <div class = "homePicture2">
        <a href = "underConstruction.php">
          <span class = "link-spanner"></span>
        </a>
      </div>
      <div class = "homePicture3">
        <a href = "underConstruction.php">
          <span class = "link-spanner"></span>
        </a>
      </div>
      <div class = "homePicture4">
        <a href = "underConstruction.php">
          <span class = "link-spanner"></span>
        </a>
      </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
