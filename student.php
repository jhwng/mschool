<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_course_names = "SELECT course_name FROM course WHERE current = 'Y' ORDER BY course_name asc";
$course_names = mysql_query($query_course_names, $promusic) or die(mysql_error());
$row_course_names = mysql_fetch_assoc($course_names);
$totalRows_course_names = mysql_num_rows($course_names);

mysql_select_db($database_promusic, $promusic);
$query_teacher = "SELECT teacher FROM teacher where active = 'Y' or active is NULL or active = '' ORDER BY teacher";
$teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacher);
$totalRows_teacher = mysql_num_rows($teacher);

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
<title>Pro-Music School Administration System</title>


<script type="text/javascript" src="checkform.js"> </script>
<script type="text/javascript" src="form_hints.js"> </script>

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

<body onLoad='document.form1.full_name.focus()'>
<?php
$newaccount = "";
include 'banner1.php';
?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Create New Student / Add a Course
	</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>

<?php
$action = "";
$name_tie_breaker=""; 
$today = date ('Y-m-d');
    list($yyyy, $mm, $dd) = split('[/.-]', $today);
	if ( $mm >= 7 && $mm <= 12 ) {
	    $fromYear = $yyyy;
		$toYear = $yyyy + 1;
	}
	else {
	    $fromYear = $yyyy - 1;
		$toYear = $yyyy;
	}

	$start_date = $today;
	$end_date = $toYear . "-06-30";

require ('student_create_form.php');

?>

</body>
</html>
<?php
mysql_free_result($course_names);

mysql_free_result($teacher);

mysql_free_result($group_lessons);
?>
