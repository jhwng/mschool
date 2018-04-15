<?php
session_start();
if ( isset($_SESSION['logged']) && $_SESSION['logged'] == 1 ) {
  // User already logged in 
  $thisUserID = $_SESSION['user_id'];
  $thisUserType = $_SESSION['user_type'];
}
else {
  $redirect = $_SERVER['PHP_SELF'];
  header("Refresh: 0; URL=login.php?redirect=$redirect");
  // echo "You are being redirected to the login page...<br>";
  die();
}
?>

