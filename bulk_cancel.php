<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_course_names = "SELECT course_name FROM course ORDER BY course_name asc";
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
<title>Bulk Cancellation</title>


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

<?php
// action = 1 - user clicked bulk cancel button
// action = 2 - user clicked confirm cancel

$action = $_GET['action'];
if ( $action <> "" ) {
$fromDate = $_POST['from_date'];
$toDate = $_POST['to_date'];
$fromTime = $_POST['from_time'];
$toTime = $_POST['to_time'];
$teacherName = $_POST['teacher'];
$cancelReason = $_POST['cancel_reason'];
$numRows = $_POST['num_rows'];
$remarks = $_POST['remarks'];
$byTeacher = $_POST['by_teacher'];
}
?>
</head>

<body onLoad='document.form1.from_date.focus()'>
<?php
include 'banner1.php';
?>
<table width="765" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr height="30">
    <td width="80">&nbsp;</td>
    <td width="662" valign="middle"><div align="center"><span class="style2">Bulk Cancellation</span></div></td>
    <td width="23">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php
require ('bulk_cancel_top_form.php');

$error = 0;
if ( $action == "1" ) {
  if ( $teacherName <> "All" && $teacherName <> "0" ) {
    $query2 = "SELECT teacher_id from teacher where teacher = \"$teacherName\"";
	$result = mysql_query($query2, $promusic) or die(mysql_error());
    $row = mysql_fetch_array($result);
    extract($row);
  }

  $query = "SELECT student.full_name, account.home_tel, teacher.teacher, class_schedule.course_id, course.course_name,  class_schedule.grade, class_schedule.date, class_schedule.time, class_schedule.duration, class_schedule.external_rate, class_schedule.student_id, class_schedule.teacher_id, class_schedule.class_id, class_schedule.dow, class_schedule.rescheduled_from, class_schedule.internal_cost, class_schedule.class_type, class_schedule.cost_type, class_schedule.from_student_credit_id, class_schedule.to_student_credit_id " .
           "FROM class_schedule, course, student, teacher, account " .
		   "WHERE class_schedule.course_id = course.course_id " .
		   "AND class_schedule.student_id = student.student_id " .
		   "AND class_schedule.teacher_id = teacher.teacher_id " .
		   "AND student.account_id = account.account_id " .
		   "AND ( date BETWEEN \"$fromDate\" AND \"$toDate\" ) " .
		   "AND ( class_schedule.cancelled = '' OR class_schedule.cancelled IS NULL ) ";
		   
		   
  if ( $teacherName <> "All" && $teacherName <> "0" ) {
	$query .= "AND class_schedule.teacher_id = $teacher_id ";
  }
  
  if ( $byTeacher == "Y" ) {
    $query .= " ORDER BY teacher.teacher, class_schedule.date, class_schedule.time ";
  }
  else {
    $query .= " ORDER BY class_schedule.date, class_schedule.time ";
  }
  
  // echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);
  
  if ( $numRows == 0 ) { 
    $error = 1;
    echo "<table width='800' height='40' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle'><div align='center'><span class='style2'>NO Class Found </span></div></td>
  </tr>
  <tr>
    <td valign='middle'><div align='center'>Enter new criteria and try again</div></td>
  </tr>
</table>";

  }  /* End of #rows = 0 */
  
  if ( $error == 0 ) {
    if ( $fromTime <> "" ) $fromTime24 = date("H:i", strtotime($fromTime));
    if ( $toTime <> "" ) $toTime24 = date("H:i", strtotime($toTime));
	
	echo '<table width="800" align="left" border="0"  cellpadding="0" cellspacing="0">' .
	     '<tr><td width="50">&nbsp;</td>';

$headerRow =<<<EOD
<td>
<form id="form2" name="form2" method="post" action="bulk_cancel.php">

<table width="700" align="left" border="1"  cellpadding="0" cellspacing="0">
    <tr height="25" bgcolor="#E2D8F3">
      <td colspan="8" bgcolor="#FFBA75"><div align="center" class="style9">
          <input name="submit" type="submit" class="btn" id="submit"
          onClick='document.form2.action = "bulk_cancel.php?action=2"; return true'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Confirm Bulk Cancel"/>
          <input name="submit" type="submit" class="btn" id="submit"
          onClick='document.form2.action = "bulk_cancel.php"; return true'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
	  </div></td>
    </tr>
    <tr bgcolor="#FFFFD7">
      <td width="50"><div align="center" class="style9">Skip Cancel</div></td>
      <td width="100"><div align="center" class="style9">Date</div></td>
      <td width="80"><div align="center" class="style9">Time</div></td>
      <td width="160" ><div align="center" class="style9">Student Name</div></td>
      <td width="120" ><div align="center" class="style9">Home Tel</div></td>
      <td width="160"><div align="center" class="style9">Teacher</div></td>
      <td width="100"><div align="center" class="style9">Course</div></td>
      <td width="70"><div align="center" class="style9">Duration</div></td>
    </tr>
EOD;
    echo $headerRow;
	$j = 0;
	while ( list ( $fullName, $homeTel, $teacherName1, $courseID, $courseName, $grade, $date, $time, $duration, $extRate, $studentID, $teacherID, $classID, $dow, $rescheduledFrom, $internalCost, $classType, $costType, $from_studentCreditID, $to_studentCreditID ) = mysql_fetch_row($result)) {
      $classTime24 = date("H:i", strtotime($time));
	  if ( $classTime24 >= $fromTime24 && $classTime24 <= $toTime24 ) {
	    require ('bulk_cancel_row_entry.php');
        $j += 1;
      }
    } // end while

     require ('bulk_cancel_trailer.php');
  } // end if error = 0
  
} // end if action = 1

if ( $action == 2 ) {
  $j = 0;
  while ( $j < $numRows ) {
    $skp = "skip" . $j;
    $skip = $_POST["$skp"];
    $clsID = "class_id" . $j;
    $classID = $_POST["$clsID"];
    $cID = "course_id" . $j;
    $courseID = $_POST["$cID"];
    $dur = "duration" . $j;
    $duration = $_POST["$dur"];
    $crdType = "credit_type" . $j;
    $creditType = $_POST["$crdType"];
    $exRate = "external_rate" . $j;
    $extRate = $_POST["$exRate"];
    $intCost = "internal_cost" . $j;
    $internalCost = $_POST["$intCost"];
    $cosType = "cost_type" . $j;
    $costType = $_POST["$cosType"];
    $clsDate = "date" . $j;
    $date = $_POST["$clsDate"];
    $sID = "student_id" . $j;
    $studentID = $_POST["$sID"];
	
	if ( $skip <> "Y" ) {
	      // Start SQL transaction 
	      $query = "START TRANSACTION;";
	      $result = mysql_query($query, $promusic) or die(mysql_error());
	  
    	  if ( $cancelReason == "T" ) {
		    //  create a new record for the credit
	        $query = "INSERT INTO student_credit_minutes " .
	        "(student_id, course_id, minutes, class_id, credit_type, remarks, minute_balance, " .
		    "external_rate, internal_cost, cost_type, date) " .
		    "VALUES ($studentID, $courseID, $duration, $classID, " .
		    "\"$cancelReason\", \"$remarks\", $duration, $extRate, " .
		    "$internalCost, \"$costType\", \"$date\" )";
            // echo "$query<br>";
            $result = mysql_query($query, $promusic) or die(mysql_error());
	  
	        // get student_credit_id for this new credit entry
	        $query = "SELECT student_credit_id from student_credit_minutes " .
	           "WHERE class_id = $classID AND credit_type = \"$cancelReason\" AND " .
			   "student_id = $studentID";
     	    // echo "$query<br>";
            $result = mysql_query($query, $promusic) or die(mysql_error());
            $row = mysql_fetch_array($result);
            extract($row);
	  
	        // mark class to be changed as cancelled, update to_student_credit_id
	        $query = "UPDATE class_schedule SET " .
	           "cancelled=\"$cancelReason\", to_student_credit_id=$student_credit_id, " .
			   "remarks=\"$remarks\", class_type=\"\", user_id=$thisUserID WHERE class_id = $classID";
      	    // echo "$query<br>========================================<br>";
            $result = mysql_query($query, $promusic) or die(mysql_error());
		  }
		  else {   // cancelReason = CXL
	        $query = "UPDATE class_schedule SET " .
	           "cancelled=\"$cancelReason\", " .
			   "remarks=\"$remarks\", class_type=\"\", user_id=$thisUserID WHERE class_id = $classID";
      	    // echo "$query<br>========================================<br>";
            $result = mysql_query($query, $promusic) or die(mysql_error());
		  }
	  
	      // Commit Transactions 
	      $query = "COMMIT;";
	      $result = mysql_query($query, $promusic) or die(mysql_error());
	}  // end if skip <> Y
	
	$j += 1;
  }  // end while
  
  echo "<script>alert ('Classes cancelled as requested')</script>";
  

} // end if action = 2
?>

</body>
</html>
