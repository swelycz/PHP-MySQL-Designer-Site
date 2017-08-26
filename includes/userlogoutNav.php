<div id = "logSignContainer">
  <div id = "signupContainer">
    <?= $_SESSION['email'] == 'admin' ? "<a href = 'adminpage.php'>Admin Page" : "<a href = 'userPage.php'>User Page" ?>
      <span class = "link-spanner"></span>
    </a>
  </div>
  <div id = "signupContainer">
    <a href = "signoutHandler.php">Sign Out
      <span class = "link-spanner"></span>
    </a>
  </div>
</div>
