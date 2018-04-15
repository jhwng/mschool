<?php
session_start();
$_SESSION['logged'] = 0;

require_once('Connections/promusic.php'); 
mysql_select_db($database_promusic, $promusic);
$userName = $_POST['username'];
$passWord = $_POST['password'];

if ( isset($_POST['Submit'])) {
  $query = "SELECT user_id, user_type, password as passwordDB FROM user WHERE user_name = \"$userName\"; ";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);
  if ( $numRows == 1 ) {
    $row = mysql_fetch_array($result);
    extract($row);
  }	
  else {
    $passwordDB = "not valid kdieodkeie";
  }
  
  if ( $passWord == $passwordDB && $user_type < 20 ) {
      $_SESSION['logged'] = 1;
	  $_SESSION['user_id'] = $user_id;
	  $_SESSION['user_type'] = $user_type;
	  header ("Refresh: 0; URL=" . $_POST['redirect'] . "" );
	  exit(0);
  }
  else {   // else id=1
?>

<html>
<head>
<title>User Login</title>
<link href="main.css" rel="stylesheet" type="text/css">
</head>
<body onLoad='document.form1.password.focus();'>
<?php include "banner1.php"; ?>
<p>
	<form id="form1" name="form1" actin="login.php" method="post" >
	  <table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <td width="230">&nbsp;</td>
	  <td><span class="banner_text">Invalid Username and/or Password</span><br>
	    <br>
<input type="hidden" name="redirect" value="<?php echo $_POST['redirect']; ?>">
	  Username: <input type="text" name="username" value="<?php echo $_POST['username']; ?>"><br>
	  Password:&nbsp; <input type="password" name="password"><p>
	<input name="Submit" type="submit" class="btn" id="Submit"
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Login"/>
      </td>
	  </table>
    </form>
</p>
<?php
  }  // end else id=1
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
	  <td><span class="style2">Please Enter Username and Password</span><br>
	    <br>
<input type="hidden" name="redirect" value="<?php echo $_GET['redirect']; ?>">
	  Username: <input type="text" name="username"><br>
	  Password: &nbsp;<input type="password" name="password"><p>
	<input name="Submit" type="submit" class="btn" id="Submit"
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Login"/>
      </td>
	  </table>
    </form>
  </p>
  <?php
  }
  ?>
  </body>
  </html>
	  
	
  
