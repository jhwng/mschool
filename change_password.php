<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<script type="text/javascript" src="checkform.js"> </script>
<?php
mysql_select_db($database_promusic, $promusic);
$userName = $_POST['username'];
$passWord = $_POST['password'];
$passWord2 = $_POST['password2'];



if ( isset($_POST['Submit'])) {  // user submit password
  $query = "SELECT user_id, password as passwordDB FROM user WHERE user_name = \"$userName\"; ";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);
  if ( $numRows == 1 ) {
    $row = mysql_fetch_array($result);
    extract($row);
  }	
  else {
    $passwordDB = "not valid kdieodkeie";
  }
  
  echo "$user_type<br>";
  if ( $passWord == $passwordDB || $thisUserType >= 2 ) {
	$status = "Password Changed";
	$query = "UPDATE user SET password = \"$passWord2\" WHERE user_id = $user_id";
	// echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
  }
  else {  
    $status = "Password Invalid, Please renter your current password";
  }
?>

<html>
<head>
<title>Password Change</title>
<link href="main.css" rel="stylesheet" type="text/css">
</head>
<body onLoad='document.form1.password.focus();'>
<?php include "banner1.php"; ?>
<p>
	<form id="form1" name="form1" actin="login.php" method="post" >
	  <table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <td width="230">&nbsp;</td>
	  <td><span class="banner_text"><?php echo $status; ?></span><br>
	    <br>
<input type="hidden" name="redirect" value="<?php echo $_POST['redirect']; ?>">
	  Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="username" value="<?php echo $_POST['username']; ?>"><br>
	  Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password"><br>
	  New Password: <input type="password2" name="password2" value="<?php echo $_POST['password2']; ?>"><br>
	  <p>
	<input name="Submit" type="submit" class="btn" id="Submit"
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Change Password"/>
      </td>
	  </table>
    </form>
</p>
<?php
}
else {
?>
    <html>
	<head>
	<title>User Login</title>
	<link href="main.css" rel="stylesheet" type="text/css">
    </head>
    <body onLoad='document.form1.username.focus();'>
    <?php include "banner1.php"; ?>
	<p>
	<?php
	if (isset($_GET['redirect'])) {
	  $redirect = $_GET['redirect'];
	}
	else {
	  $redirect = "index.php";
	}
	?>
	<form id="form1" name="form1" actin="login.php" method="post" >
	  <table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <td width="230">&nbsp;</td>
	  <td><span class="style2">Password Change</span><br>
	    <br>
<input type="hidden" name="redirect" value="<?php echo $_POST['redirect']; ?>">
	  Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="username" value="<?php echo $thisUserName; ?>"><br>
	  Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password"><br>
	  New Password: <input type="password2" name="password2" value="<?php echo $_POST['password2']; ?>"><br>
	  <p>
	<input name="Submit" type="submit" class="btn" id="Submit"
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Change Password"/>
      </td>
	  </table>
    </form>
  </p>
  <?php
  }
  ?>
  </body>
  </html>
	  
	
  