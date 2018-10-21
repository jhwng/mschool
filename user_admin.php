<?php include "auth_inc.php"; 
// Version 1.01 - added user validation at line 46
?>
<?php require_once('Connections/promusic.php'); ?>

<?php require "user_manager_check.php"; ?>

<script type="text/javascript" src="checkform.js"> </script>
<?php
mysql_select_db($database_promusic, $promusic);

$error = 0;

// This user cannot see higher level user types.
$maxVisibleType = $thisUserType;

//jng
$targetUserName = isset($_POST['username']) ? $_POST['username'] : "";
$newPassword = isset($_POST['password']) ? $_POST['password'] : "";
$newUserType = isset($_POST['utype']) ? $_POST['utype'] : "";
$button = isset($_POST['Submit']) ? $_POST['Submit'] : "";

//jng - get submitter's user name
if ( $button == "Change User" || $button == "Delete User" || $button == "Add User") {
  $submitter_query = "SELECT user_name FROM user WHERE user_id = \"$thisUserID\"; ";
  // echo "$query<br>";
  $submitter_result = mysql_query($submitter_query, $promusic) or die(mysql_error());
  $submitter_row = mysql_fetch_array($submitter_result);
  $this_user_name = $submitter_row['user_name'];

  if ($this_user_name == "") {
    $error = 1;
  }
}

if ( $error == 0 && ($button == "Change User" || $button == "Delete User") ) {
  $query = "SELECT user_id as targetUserID, password as curPassword, user_type as curUserType FROM user WHERE user_name = \"$targetUserName\"; ";
  // echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);
  if ( $numRows == 1 ) {
    $row = mysql_fetch_array($result);
    extract($row);
  }	
  else {
    $error = 1;
	$status = "User \"$targetUserName\" does not exist! Please check the user name.";
  }
}

//jng - changing user_type must follow these rules:
//    1. type 2 (manager) user cannot change his or others' own type
//    2. type 2 user cannot change password for other type 2 users or type 3 users
//    3. type 2 user can change type 1 users and his own password
//    4. type 3 (owner) and up user can change anything
if ( $button == "Change User" && $error == 0 ) {  // if change user_type and/or password
  //Bjng
  //echo "thisUserType: $thisUserType ";
  //echo "target user_type: $curUserType ";
  //echo "target user id $targetUserName ";
  //echo "target user type: $newUserType ";
  if ($thisUserType < 3 && $curUserType != $newUserType) { // Rule #1
    $error = 1;
    $status = "User \"$this_user_name\" does not have permission to change user type.";
  }
  else if ($thisUserType < 3 && $curUserType >= 2 && // Rule #2
           $this_user_name != $targetUserName) {
           //$curPassword != $newPassword && $this_user_name != $targetUserName) { // Covered by Rule #1 already
    $error = 1;
    $status = "User \"$this_user_name\" does not have permission to change password for other Type 2 users.";
  }
  else {
    $status = "User \"$targetUserName\" changed.";
    $query = "UPDATE user SET user_type = \"$newUserType\"";
    if ($newPassword <> "") $query .= ", password = \"$newPassword\"";
    $query .= " WHERE user_id = $targetUserID";
    $result = mysql_query($query, $promusic) or die(mysql_error());
  } //Ejng
} // end change user_type and/or password

//jng - delete user rule:
//    1. Only user type >= 3 can delete a user
if ( $button == "Delete User" && $error == 0 ) {  // if delete user
  //Bjng
  if ($thisUserType < 3) {
    $error = 1;
    $status = "User \"$this_user_name\" does not have permission to delete a user.";
  }
  else {
    $status = "User \"$targetUserName\" deleted.";
    $query = "UPDATE user SET user_type = 999, password = 'deletedbyadmin' WHERE user_id = $targetUserID";
    $result = mysql_query($query, $promusic) or die(mysql_error());
  }
} // end delete user

//jng - Add user rules:
//    1. A type 2 user can only add type 1 users
//    2. A type 3 user can add any user types
if ( $button == "Add User" && $error == 0) {
  if ($thisUserType <= 2 && $newUserType > 1) {
    $status = "User \"$this_user_name\" does not have permission to add a Type 2 user.";
  }
  else {
    $query = "SELECT user_id as targetUserID, user_type as curUserType FROM user WHERE user_name = \"$targetUserName\"; ";
    $result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
    $row = mysql_fetch_array($result);
    if ( $numRows > 0 ) extract($row);
    if ( $numRows == 1 && $curUserType <> 999 ) { // type '999' means "deleted-by-admin" type
      $error = 1;
	  $status = "User \"$targetUserName\" already exists in the database. Cannot be added again.";
    }
    else {
      if ($numRows == 0) {
        $status = "New user \"$targetUserName\" added.";
        $query = "INSERT INTO user ( user_name, user_type, password ) " .
                 "VALUES ( \"$targetUserName\", $newUserType, \"$newPassword\" )";
        $result = mysql_query($query, $promusic) or die(mysql_error());
      } else {  // user was deleted before, so just update the record instead of create a new one
        $status = "New user \"$targetUserName\" added.";
        $query = "UPDATE user SET user_type = $newUserType, password = \"$newPassword\" WHERE user_id = $targetUserID";
        // echo "$query<br>";
        $result = mysql_query($query, $promusic) or die(mysql_error());
      }
    }
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
	<form id="form1" name="form1" action="user_admin.php" method="post" >
	  <table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <td width="230">&nbsp;</td>
	  <td><span class="banner_text"><?php echo $status; ?></span><br>
	    <br>
<input type="hidden" name="redirect" value="<?php echo $_POST['redirect']; ?>">
	  Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="username" value="<?php echo $targetUserName ?>"><br>
	  Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="password" VALUE=<?php echo "$newPassword"; ?> ><br>
	  User Type (1 or 2 ):&nbsp;<input type="utype" name="utype" value="<?php echo $_POST['utype']; ?>">&nbsp
          <span class="bluetext">(1 = Regular Employee; 2 = Store Admin)</span><br>
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
    if ( $curUsers <> "unknown" && $curUsers <> "wkkc" && $curType <= $maxVisibleType) {
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
	<form id="form1" name="form1" action="user_admin.php" method="post" >
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
          <span class="bluetext">(1 = Regular Employee; 2 = Store Admin)</span><br>
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
    if ( $curUsers <> "unknown" && $curUsers <> "wkkc" && $curType <= $maxVisibleType) {
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