<?php
session_start();

if ( isset($_SESSION['logged']) && $_SESSION['logged'] == 1 ) {
  // User already logged in 
  $thisUserID = $_SESSION['user_id'];
  $thisUserType = $_SESSION['user_type'];

  //jng - 1=normal user (employee); 2= manager; 3=admin/owner; 4=unchanged; 999=unchanged
  $UserIsManager = false;
  if ($thisUserType >= 2) {
      $UserIsManager = true;
      //echo "User is a manager";
  }

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
