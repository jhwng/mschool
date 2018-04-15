<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_course_names = "SELECT course_name FROM course ORDER BY course_name asc";
$course_names = mysql_query($query_course_names, $promusic) or die(mysql_error());
$row_course_names = mysql_fetch_assoc($course_names);
$totalRows_course_names = mysql_num_rows($course_names);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Teacher Rates</title>


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
/*
action = 1 - Retrieve teacher rates
actuin = 2 - update teacher rates
*/
$action = $_GET['action'];
$submit = $_POST['submit1'];
$teacher_id = $_POST['teacher_id'];
$teacher = $_POST['teacher'];

include 'banner1.php';

?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Create / Edit Teacher Rate Table</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="teacher_rates.php?action=1">
  <table width="750" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="243">&nbsp;</td>
      <td width="442">&nbsp;</td>
      <td width="65">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Teacher: 
      <input name="teacher" type="text" id="teacher" size="45" maxlength="60" value="<?php echo $teacher; ?>">&nbsp;&nbsp;
      <input name="button" type="button" class="btn" id="button" onclick="teacherNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Search"/></td>
      <td><input name="teacher_id" type="hidden" id="teacher_id" value="<?php echo $teacher_id; ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php

if ( $action == 1 )   // Retrieve Teacher info
{
  if ( !(isset($teacher)) || $teacher == "" ) {
	echo '<script>alert("You need to select a teacher first by using the Search button")</script>'; 
	$error = 1;
  }
  else    // else id 1
  {
    require ('teacher_rates_header.php');
	$j = 0;
	
	$query = "SELECT teacher_rate_id, teacher_rate.course_id, course.course_name, external_rate, split, fixed_cost, rate_category, cost_type, grades_applied FROM teacher_rate, course WHERE teacher_rate.course_id = course.course_id AND teacher_id = $teacher_id";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
	if ( $numRows > 0 ) {
      while ( list ( $teacher_rate_id, $course_id, $course_name, $external_rate, $split, $fixed_cost, $rate_category, $cost_type, $grades_applied ) = mysql_fetch_row($result) ) {
         if ( $cost_type == "S" ) { $internal_cost = $split; } else { $internal_cost = $fixed_cost; }
		 require ('teacher_rates_row_entry.php');
	     $j += 1;
	  }  // End while
	}  // end if numRows > 0
    
    // Display 5 blank form lines for adding new entry
    $teacher_rate_id = -1;
    $course_id = -1;
	$course = "";
	$external_rate = 0;
	$internal_cost = 0;
	$rate_category = "";
	$cost_type = "S";
	$grades_applied = "";
	$apply_date = "";
	require ('teacher_rates_row_entry.php');
	$j += 1;
	require ('teacher_rates_row_entry.php');
	$j += 1;
	require ('teacher_rates_row_entry.php');
	$j += 1;
	require ('teacher_rates_row_entry.php');
	$j += 1;
	require ('teacher_rates_row_entry.php');
	 
  }  // end else id 1
}  // end action = 1


if ( $action == 2 ) {
  if ( !(isset($teacher_id)) || $teacher_id == "" ) {
	echo '<script>alert("You need to select a teacher first by using the Search button")</script>'; 
	$error = 1;
  }
  else   // else id 2
  {
  $classEntries = 0;
  $numEntries = $_POST['num_entries'];
  $numRows = $numEntries;
  $j = 0;
  require ('teacher_rates_header.php');

  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( $j <= $numEntries + 5 ) {
    $del = "delete" . $j;
    $delete = $_POST["$del"];
    $cName = "course_name" . $j;
    $course_name = $_POST["$cName"];
    $rc = "rate_category" . $j;
    $rate_category = $_POST["$rc"];
    $exR = "ext_rate" . $j;
    $external_rate = $_POST["$exR"];
    $ic = "cost" . $j;
    $internal_cost = $_POST["$ic"];
    $ct = "cost_type" . $j;
    $cost_type = $_POST["$ct"];
    $rateid = "teacher_rate_id" . $j;
    $teacher_rate_id = $_POST["$rateid"];
    $grdapp = "grades_applied" . $j;
    $grades_applied = $_POST["$grdapp"];
    $sdate = "start_date" . $j;
    $start_date = $_POST["$sdate"];
    $edate = "end_date" . $j;
    $end_date = $_POST["$edate"];
  
	if ( $cost_type == "S" ) {
       $split = $internal_cost;
	   $fixedCost = 0;
	}
	else {
	   $split = 0;
	   $fixedCost = $internal_cost;
	}
		
    if ( $j <= $numEntries - 1 ) {
      if ( $delete == "delete" ) {
        $query = "DELETE FROM teacher_rate " .
		   "WHERE teacher_rate_id = $teacher_rate_id;";
		//echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	  else {
	    $query = "SELECT course_id from course WHERE course_name = \"$course_name\"";
		$result = mysql_query($query, $promusic) or die(mysql_error());
        $row = mysql_fetch_array($result);
        extract($row);
		
		$query = "UPDATE teacher_rate SET " .
           "course_id = $course_id,  " .
		   "rate_category=\"$rate_category\",  " .
		   "external_rate=$external_rate, " .
		   "cost_type=\"$cost_type\",  " .
		   "split=$split, fixed_cost=$fixedCost, " .
		   "grades_applied=\"$grades_applied\" ".
		   "WHERE teacher_rate_id = $teacher_rate_id;";
        //echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
		
		// apply new rate to class_schedule entries
		if ( $start_date <> "" && $end_date <> "" && $grades_applied <> "" ) {
		  $query = "SELECT count(date) as classCnt FROM class_schedule " .
			"WHERE course_id=$course_id AND teacher_id=$teacher_id AND " .
			"date BETWEEN \"$start_date\" AND \"$end_date\" " .
			"AND grade REGEXP '$grades_applied'";
          // echo "$query<br>";
          $result = mysql_query($query, $promusic) or die(mysql_error());
          $row = mysql_fetch_array($result);
          extract($row);
		  $classEntries += $classCnt;
 
		  $query = "UPDATE class_schedule SET " .
		    "external_rate=$external_rate, cost_type=\"$cost_type\", internal_cost=$internal_cost " .
			"WHERE course_id=$course_id AND teacher_id=$teacher_id AND ".
			"date BETWEEN \"$start_date\" AND \"$end_date\" " .
			"AND grade REGEXP '$grades_applied'";
          // echo "$query<br>";
    	  $result = mysql_query($query, $promusic) or die(mysql_error());
		}  
	  }
	}
	else {   // Insert new record for the last 5 new entries
      if ( $rate_category <> "" ) {
	    $query = "SELECT course_id from course WHERE course_name = \"$course_name\"";
		$result = mysql_query($query, $promusic) or die(mysql_error());
        $row = mysql_fetch_array($result);
        extract($row);
		
	    $query = "INSERT INTO teacher_rate " .
		     "(teacher_id, course_id, rate_category, external_rate, split, fixed_cost, cost_type ) VALUES " .
			 "($teacher_id, $course_id, \"$rate_category\", $external_rate, $split, $fixedCost, \"$cost_type\" );";
        //echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	}  
    // require ('teacher_rates_row_entry.php');
    $j += 1;
  } // end while
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  echo "<script>alert ('$classEntries class entries have been updated from these rate changes'); document.form1.submit()</script>";
     
  }  // end else id 2
}  /* end if action = 2 */

if ($action <> "") require ('teacher_rates_trailer.php');
?>

</body>
</html>
