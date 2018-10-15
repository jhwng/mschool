<?php include "auth_inc.php"; 
// Version 1.01 - added user validation at line 46
?>
<?php require_once('Connections/promusic.php'); ?>

<?php require "user_manager_check.php"; ?>

<script type="text/javascript" src="checkform.js"> </script>
<?php
mysql_select_db($database_promusic, $promusic);

//jng
$userName = isset($_POST['username']) ? $_POST['username'] : "";
$passWord = isset($_POST['password']) ? $_POST['password'] : "";
$uType = isset($_POST['utype']) ? $_POST['utype'] : "";
$button = isset($_POST['Submit']) ? $_POST['Submit'] : "";

$error = 0;
if ( $button == "Change User" || $button == "Delete User" ) { 
  $query = "SELECT user_id, password as passwordDB FROM user WHERE user_name = \"$userName\"; ";
  // echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);
  if ( $numRows == 1 ) {
    $row = mysql_fetch_array($result);
    extract($row);
  }	
  else {
    $error = 1;
	$status = "User does not exist! Please check the user name";
  }
}

if ( $button == "Change User" && $error == 0 ) {  // if change password
  $status = "User Changed";
  $query = "UPDATE user SET user_type = \"$uType\"";
  if ( $passWord <> "" ) $query .= ", password = \"$passWord\"";
  $query .= " WHERE user_id = $user_id";
  $result = mysql_query($query, $promusic) or die(mysql_error());
} // end change password

if ( $button == "Delete User" && $error == 0 ) {  // if delete user
  $status = "User Deleted";
  $query = "UPDATE user SET user_type = 999, password = 'deletedbyadmin' WHERE user_id = $user_id";
  $result = mysql_query($query, $promusic) or die(mysql_error());
} // end delete user

if ( $button == "Add User" ) {
  $query = "SELECT user_id, user_type FROM user WHERE user_name = \"$userName\"; ";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);
  $row = mysql_fetch_array($result);
  if ( $numRows > 0 ) extract($row);
  if ( $numRows == 1 && $user_type <> 999 ) {
    $error = 1;
	$status = "User your want to add already existed. Please check user name";
  }	
  else {
    if ( $numRows == 0 ) {
      $status = "New User Added";
      $query = "INSERT INTO user ( user_name, user_type, password ) " .
           "VALUES ( \"$userName\", $uType, \"$passWord\" )";
      $result = mysql_query($query, $promusic) or die(mysql_error());
	}
	else {  // user was deleted before, so just update the record instead of create a new one
	  $status = "New User Added";
      $query = "UPDATE user SET user_type = $uType, password = \"$passWord\" WHERE user_id = $user_id";
      // echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
    } // end delete user
	  
  }
} // end Add User

if ( isset($_POST['Submit']) ) {
?>

<html>
<head>
<title>User Admin</title>
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
	  Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="username" value="<?php echo $userName ?>"><br>
	  Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="password" VALUE=<?php echo "$passWord"; ?> ><br>
	  User Type (1 or 2 ):&nbsp;<input type="utype" name="utype" value="<?php echo $_POST['utype']; ?>">&nbsp;&nbsp;<span class="bluetext">( 1 for normal user; 2 for administrator )</span><br>
	  <p>
	<input name="Submit" type="submit" class="btn" id="Submit"
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Change User"/>
 &nbsp;&nbsp;<input name="Submit" type="submit" class="btn" id="Submit"
 onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Add User"/>
 &nbsp;&nbsp;<input name="Submit" type="submit" class="btn" id="Submit"
 onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Delete User"/>
      </td>
	  </tr>
	  </table>
    </form>
  </p>&nbsp;
  <table width="430" border="0" cellspacing="0" cellpadding="0">
    <tr height="20">
    <td width="230">&nbsp;</td>
	<td>
	  <table width="200" border="1" cellspacing="0" cellpadding="0">
	   <tr height="20">
	     <td width="100" bgcolor="#FFBA75" align="center">Current Users</td>
	     <td width="100" bgcolor="#FFBA75" align="center">User Type</td>
	   </tr>
<?php
// Display current users
  $query = "SELECT user_name as curUsers, user_type as curType from user " .
           "WHERE user_type < 20 ORDER BY curUsers";
  $result3 = mysql_query($query, $promusic) or die(mysql_error());
  // $numRows = mysql_num_rows($result);
  while ( list ($curUsers, $curType) = mysql_fetch_row($result3)) {
    if ( $curUsers <> "unknown" && $curUsers <> "wkkc" ) {
	  echo "<tr height='20'><td align='center'>$curUsers</td><td align='center'>$curType</td></tr>";
	}
  }
?>	
  </td></tr>
  </table>
<?php
}

if (!( isset($_POST['Submit']))) {  
  if ( $thisUserType < 2 ) { 
    echo "<html><head></head><body>";
	echo "<script>alert ('You DO NOT have the permission to administer users' )</script>";
	echo "<script>location.href='class_schedule.php'</script>";
	echo "</body></html>";
  }
?>
    <html>
	<head>
	<title>User Admin</title>
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
	<form id="form1" name="form1" action="login.php" method="post" >
	  <table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <td width="230">&nbsp;</td>
	  <td><span class="style2">User Administration</span><br>
	    <br>
<input type="hidden" name="redirect" value="<?php echo isset($_POST['redirect']) ? $_POST['redirect'] : ""; ?>">
	  Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="username" /><br>
	  Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="password" /><br>
	  User Type (1 or 2):&nbsp;<input type="utype" name="utype" value="1"
	  onChange='if ( this.value != "1" && this.value != "2" ) { this.value = "1"; alert ("User Type can only be 1 or 2") }' />
          <span class="bluetext">( 1 = Regular Employee; 2 = Store Admin)</span><br>
	  <p>
 <input name="Submit" type="submit" class="btn" id="Submit"
 onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Change User"/>
 &nbsp;&nbsp;<input name="Submit" type="submit" class="btn" id="Submit"
 onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Add User"/>
 &nbsp;&nbsp;<input name="Submit" type="submit" class="btn" id="Submit"
 onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Delete User"/>
      </td>
	  </tr>
    </table>
    </form>
  </p>&nbsp;
  <table width="430" border="0" cellspacing="0" cellpadding="0">
    <tr height="20">
    <td width="230">&nbsp;</td>
	<td>
	  <table width="200" border="1" cellspacing="0" cellpadding="0">
	   <tr height="20">
	     <td width="100" bgcolor="#FFBA75" align="center">Current Users</td>
	     <td width="100" bgcolor="#FFBA75" align="center">User Type</td>
	   </tr>
<?php
// Display current users
  $query = "SELECT user_name as curUsers, user_type as curType from user " .
           "WHERE user_type < 20 ORDER BY curUsers";
  $result3 = mysql_query($query, $promusic) or die(mysql_error());
  // $numRows = mysql_num_rows($result);
  while ( list ($curUsers, $curType) = mysql_fetch_row($result3)) {
    if ( $curUsers <> "unknown" && $curUsers <> "wkkc" && $curType < 3) {
	  echo "<tr height='20'><td align='center'>$curUsers</td><td align='center'>$curType</td></tr>";
	}
  }
?>	
  </td></tr>
  </table>

  <?php
  }
  ?>
  </body>
  </html>
	  
	
  