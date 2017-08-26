<?php session_start();
if (!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = false;
}
?>
<!DOCTYPE html>
<html lang=us>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="resources/styles.css">
    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
  	<script src="resources/scripts.js"></script>
    <title>Presto Interiors</title>
  </head>
  <body>
    <header>
      <div id = "header">
        <div class = "titleContainer">PRESTO INTERIORS
          <a href = "index.php">
            <span class = "link-spanner"></span>
          </a>
        </div>
        <div class = "navContainer">
          <nav>
            <ul>About
              <li>
                <a href = "underConstruction.php">The Designer
                  <span class = "link-spanner"></span>
                </a>
              </li>
              <li>
                <a href = "underConstruction.php">Services
                  <span class = "link-spanner"></span>
                </a>
              </li>
              <li>
                <a href = "underConstruction.php">Pricing
                  <span class = "link-spanner"></span>
                </a>
              </li>
            </ul>
            <ul>
              <a href = "underConstruction.php">Gallery
                <span class = "link-spanner"></span>
              </a>
            </ul>
            <ul>Contact
              <li>
                <a href = "underConstruction.php">Contact Information
                  <span class = "link-spanner"></span>
                </a>
              </li>
              <li>
                <a href = "newMessage.php">Contact Us
                  <span class = "link-spanner"></span>
                </a>
              </li>
              <li>
                <a href = "underConstruction.php">Service Reviews
                  <span class = "link-spanner"></span>
                </a>
              </li>
            </ul>
          </nav>
          <?php if (!$_SESSION['loggedin']) {
            include 'includes/logsignNav.php';
          } else {
            include 'includes/userlogoutNav.php';
          }?>
        </div>
      </div>
    </header>
    <div class = "contentWrapper">
      <div class = "contentContainer">
        <div class="contentWrapper2">
