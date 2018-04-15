<?php
session_start();
$_SESSION['logged'] = 0;
?>
    <html>
	<head>
	<title>User Logout</title>
	<link href="main.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <?php include "banner1.php"; ?>
	  <table width="750" border="0" cellspacing="0" cellpadding="0">
	  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
      <tr>
	  <td width="250">&nbsp;</td>
	  <td><span class="style2">You have logged out from the system</span><br>
      </td>
	  </table>
  </body>
  </html>
