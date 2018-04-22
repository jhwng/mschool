<?php
session_start();

if ( isset($_SESSION['logged']) && $_SESSION['logged'] == 1 ) {
  // User already logged in 
  $thisUserID = $_SESSION['user_id'];
  $thisUserType = $_SESSION['user_type'];

  /*$x = $_SESSION["timeout"];
  echo "session time: $x";
  echo "resetting session timeout";*/
  $_SESSION['timeout'] = time(); // refresh session timer //jng
}
else {
  $redirect = $_SERVER['PHP_SELF'];
  header("Refresh: 0; URL=login.php?redirect=$redirect");
  // echo "You are being redirected to the login page...<br>";
  die();
}
?>

<script src="jquery-3.3.1.min.js">alert("loading jquery");</script>
<script type="text/javascript" src="auto_logout_check.js"></script>
