<?php
  include 'includes/sqli-connection.php';
  include 'includes/header.php';
  if (!$_SESSION['loggedin']) {
    header("Location: index.php");
  }
 ?>
<div class = "userpageContainer">
  <div class = "userSection changeinfo">
    <div class = "userSectionOverlay">
      <p class = "userSectionTitle">CHANGE INFORMATION</p>
      <div class = "userSectionOptionsContainer">
        <div class = "userSectionOption">
          <p class = "userSectionOptionText">Account Information</p>
          <a href = "changeAccountInfo.php">
            <span class = "link-spanner"></span>
          </a>
        </div>
        <div class = "userSectionOption">
          <p class = "userSectionOptionText">Password</p>
          <a href = "changepass.php">
            <span class = "link-spanner"></span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class = "userSection messages">
    <div class = "userSectionOverlay">
      <p class = "userSectionTitle">MESSAGES</p>
      <div class = "userSectionOptionsContainer">
        <div class = "userSectionOption">
          <p class = "userSectionOptionText">View Messages</p>
          <a href = "messages.php">
            <span class = "link-spanner"></span>
          </a>
        </div>
        <div class = "userSectionOption">
          <p class = "userSectionOptionText">Create New Message</p>
          <a href = "newMessage.php">
            <span class = "link-spanner"></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php' ?>
