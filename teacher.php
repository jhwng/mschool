<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_group_lessons = "select group_lesson from group_lesson order by group_lesson;";
$group_lessons = mysql_query($query_group_lessons, $promusic) or die(mysql_error());
$row_group_lessons = mysql_fetch_assoc($group_lessons);
$totalRows_group_lessons = mysql_num_rows($group_lessons);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Teacher Profile</title>


<script type="text/javascript" src="checkform.js"> </script>

<script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>

<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style7 {font-size: 14px}
body {
	background-image: url();
}
-->
</style>
</head>

<body onLoad='document.form1.teacher.focus()'>

<?php
include 'banner1.php';

?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Create / Edit Teacher Profile</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<?php
/*
action = 1 - Create New Teacher
action = 3 - Retrieve teacher profile
action = 4 - Update teacher profile
*/

//Bjng
$action = isset($_GET['action']) ? $_GET['action'] : "";
$submit = isset($_POST['submit1']) ? $_POST['submit1'] : "";
$teacher_id = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : "";
$teacher = isset($_POST['teacher']) ? $_POST['teacher'] : "";
$addr1 = isset($_POST['addr1']) ? $_POST['addr1'] : "";
$addr2 = isset($_POST['addr2']) ? $_POST['addr2'] : "";
$city = isset($_POST['city']) ? $_POST['city'] : "";
$province = isset($_POST['province']) ? $_POST['province'] : "";
$postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
$home_tel = isset($_POST['home_tel']) ? $_POST['home_tel'] : "";
$cell_tel = isset($_POST['cell_tel']) ? $_POST['cell_tel'] : "";
$other_tel = isset($_POST['other_tel']) ? $_POST['other_tel'] : "";
$sin = isset($_POST['sin']) ? $_POST['sin'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$teacher_since = isset($_POST['teacher_since']) ? $_POST['teacher_since'] : "";
$profile = isset($_POST['profile']) ? $_POST['profile'] : "";
$active = isset($_POST['active']) ? $_POST['active'] : "";
//Ejng

//Bjng
$unauthorized_msg = "\nTHIS USER IS NOT AUTHORIZED TO VIEW PROFILE DETAILS.";

$profile_override=isset($_POST['profile_override']) ? $_POST['profile_override'] : $profile;

$real_profile=$profile;
if ($profile_override != "" && (strcmp(trim($profile_override), trim($unauthorized_msg)) != 0)) {
    $real_profile = $profile_override;
}
//Ejng

if ( $action == 1 )   // Create Teacher
{
  $error = 0;
  if ( $teacher == "" ) { 
    echo "<script>alert('Teacher name cannot be blank')</script>"; 
	$error = 1;
  }
  
  if ( $error == 0 ) {

    // first check if teacher already exists
    $query = "SELECT teacher_id from teacher where teacher=\"$teacher\" ";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
    if ( $numRows > 0 ) {
	  echo "<script>alert('Teacher already exists')</script>";
    }
    else {

      $query = "INSERT INTO teacher " .
	   "(teacher, addr1, addr2, city, province, postal_code, home_tel, " .
	   "cell_tel, other_tel, email, sin, profile, teacher_since, active ) " .
	   "VALUES ( \"$teacher\", \"$addr1\", \"$addr2\", \"$city\", \"$province\", " .
	   "\"$postal_code\", \"$home_tel\", \"$cell_tel\", \"$other_tel\", " .
	   "\"$email\", \"$sin\", \"$real_profile\", \"$teacher_since\", \"$active\" )";
	  // echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
	  echo '<script>alert("Teacher entry has been created")</script>'; 
    }	    
  }  // end error = 0
}  // end if action = 1


if ( $action == 3 )   // Retrieve Teacher info
{
  if ( !(isset($teacher_id)) || $teacher_id == "" ) {
	echo '<script>alert("You need to select a teacher first by using the Search button")</script>'; 
	$error = 1;
  }
  else
  {
    $query = "SELECT teacher, addr1, addr2, city, province, postal_code, home_tel, cell_tel, other_tel, email, sin, profile, teacher_since, active FROM teacher WHERE teacher_id = $teacher_id";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
	if ( $numRows == 0 ) {
	  echo "</script>alert('Teacher does not exist, use the Search button to select a teacher')</script>";
	}
	else {
      $row = mysql_fetch_array($result);
      extract($row);

      // Bjng - initialize profile_override from query result.
      if ($UserIsManager) {
        $profile_override = $profile;
      } else {
        $profile_override = $unauthorized_msg;
      } //Ejng
	}
  }
}  // end action = 3


if ( $action == 4 ) {
  if ( !(isset($teacher_id)) || $teacher_id == "" ) {
	echo '<script>alert("You need to select a teacher first by using the Search button")</script>'; 
	$error = 1;
  }
  else
  {

    $query = "UPDATE teacher SET " .
	   "addr1=\"$addr1\", addr2=\"$addr2\", city=\"$city\", province=\"$province\", " .
	   "postal_code=\"$postal_code\", teacher=\"$teacher\", sin=\"$sin\", " .
	   "home_tel=\"$home_tel\", cell_tel=\"$cell_tel\", other_tel=\"$other_tel\", " .
	   "email=\"$email\", teacher_since=\"$teacher_since\", profile=\"$real_profile\", " .
	   "active=\"$active\" " .
	   "WHERE teacher_id = $teacher_id ";
    // echo "$query<br>";
    $result = mysql_query($query, $promusic) or die(mysql_error());

    echo "<script>alert ('Teacher profile has been updated')</script>";
  }
}  /* end if action = 4 */

require('teacher_form.php');
echo "<script>document.form1.teacher_id.value=\"$teacher_id\"</script>";

?>
</body>
</html>
