<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
$versionNum = "1.02.00";

// Version 1.01.00 Print remarks from group_lesson_payments records
//                 Widen the Remarks and shorten payment method column in payment record

// Version 1.02.00 Remove teacher's split columns 2014-04-25

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
<title>Teacher Payroll</title>


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
.redtext {color: red}
body {
	background-image: url();
}
-->
</style>
</head>

<body onLoad='document.form1.month.focus()'>


<?php
/*
action = 1 - Retrieve teacher rates
actuin = 2 - update teacher rates
*/
$action = $_GET['action'];
$submit = $_POST['submit1'];
$teacher_id = $_POST['teacher_id'];
$teacher = $_POST['teacher'];
$month = $_POST['month'];
//echo "$month<br>";

include 'banner1.php';

if ( $month == "" ) $month = date("Y-m"); 

?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Teacher Payroll </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="teacher_payroll.php?action=1">
  <table width="750" border="0" cellspacing="0" cellpadding="0">
    
    <tr>
      <td width="115">&nbsp;</td>
      <td width="570">Month: 
        <input name="month" type="text" id="month" size="7" maxlength="7" value="<?php echo $month; ?>" />
        <span class="bluetext">(YYYY-MM)</span>&nbsp;&nbsp;&nbsp;&nbsp;Teacher: 
        <input name="teacher" type="text" id="teacher" size="45" maxlength="60" value="<?php echo $teacher; ?>">&nbsp;&nbsp;
      <input name="button" type="button" class="btn" id="button" onclick="teacherNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Search"/></td>
      <td width="65"><input name="teacher_id" type="hidden" id="teacher_id" value="<?php echo $teacher_id; ?>"/></td>
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
  $month = $_POST['month'];
  if ( !(isset($teacher)) || $teacher == "" ) {
	echo '<script>alert("Please specify a month and a teacher for the payroll report")</script>'; 
	$error = 1;
  }
  else    // else id 1
  {
    require ('teacher_payroll_header.php');
	$j = 0;
	
	$startDate = $month . "-01";
	list ($yyyy, $mm) = split('[/.-]', $month);
	$endDate = date('Y-m-d', mktime(0,0,0,$mm+1, 0, $yyyy));
	;
	$query = "select course_name, full_name, grade, internal_cost, cost_type, external_rate, count(date) as numLessons, sum(duration) as minutes, sum(external_rate * duration / 15 ) as total from class_schedule, student, course where class_schedule.student_id = student.student_id and class_schedule.course_id = course.course_id and date between \"$startDate\" and \"$endDate\" and class_schedule.teacher_id = $teacher_id and ( (cancelled <> 'W' and cancelled <> 'T' and cancelled <> 'CXL' and cancelled <> 'WOT') or cancelled is NULL or cancelled = '' ) group by course_name, full_name, grade, internal_cost, cost_type, external_rate order by course.course_name, full_name";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows1 = mysql_num_rows($result);
	if ( $numRows1 > 0 ) {
	  $teachingTotal = 0;
      while ( list ( $courseName, $fullName, $grade, $cost, $costType, $extRate, $numLessons, $minutes, $fee ) = mysql_fetch_row($result) ) {
		 if ( $costType == "S" ) {
		   $netPay = $fee * $cost / 100;
		 }
		 else {
		   $netPay = $minutes * $cost / 15;
		 }
		 $teachingTotal += $netPay;
		 require ('teacher_payroll_row_entry.php');
	     $j += 1;
	  }  // End while
	  
	  $totalDesc = "Teaching Sub-total ";
	  $totalAmt = $teachingTotal;
	  $strong = 1;
 	  require ('teacher_payroll_total_lines.php');
	}  // end if nowRows > 0
	  
    $netPay = $totalAmt;
	// display group lesson payments
	$strong = 0;
	$query = "select group_lesson, date, amount, group_lesson_payments.remarks as gl_remarks from group_lesson_payments,  group_lesson where group_lesson_payments.group_lesson_id = group_lesson.group_lesson_id and teacher_id = $teacher_id and date between \"$startDate\" and \"$endDate\" order by group_lesson";
    // echo "$query<br>";
  	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
	if ( $numRows > 0 ) {
      while ( list ( $groupLesson, $date, $amount, $glRemarks ) = mysql_fetch_row($result) ) {
	    $totalDesc = "Group Lesson/Other Income: $groupLesson";
		if ( $glRemarks <> "" ) $totalDesc .= " ( $glRemarks )";
		$totalAmt = $amount;
		$netPay += $amount;
 	    require ('teacher_payroll_total_lines.php');
	  } // end while for group lesson
	}  // end if numRows > 0
    $payrollAmount = $netPay;
	
	$totalDesc = "Payroll Total ";
	$totalAmt = $payrollAmount;
	$strong = 1;
	require ('teacher_payroll_total_lines.php');
	
	// display teacher advanced payments
	$strong = 0;
	$query = "SELECT date, amount, cheque_num, payment_method, remarks as advPM FROM adhoc_payments WHERE  teacher_id = $teacher_id AND date BETWEEN \"$startDate\" AND \"$endDate\" ";
    // echo "$query<br>";
  	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
	if ( $numRows > 0 ) {
      while ( list ( $date, $amount, $cheque_num, $advPM, $advRemarks ) = mysql_fetch_row($result) ) {
	    $totalDesc = "Advanced Payment: $date";
		if ( $cheque_num <> "" ) $totalDesc .= ", Cheque No.: $cheque_num";
		if ( $advPM <> "" ) $totalDesc .= ", Payment Method: $advPM";
		if ( $advRemarks <> "" ) $totalDesc .= " ( $advRemarks )";
		$amount = $amount * (-1);
 		$totalAmt = $amount;
		$netPay += $amount;
 	    require ('teacher_payroll_total_lines.php');
	  } // end while for group lesson
	}  // end if numRows > 0
	
	// Display NetPay bottom line
	$totalDesc = "Net Pay ";
	$totalAmt = $netPay;
	$strong = 1;
    require ('teacher_payroll_total_lines.php');
	
  }  // end else id 1
}  // end action = 1


if ( $action == 2 ) {
  $numRowsPay = $_POST['num_entries'];
  $j = 0;
  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( $j <= $numRowsPay  ) {
    $del = "delete" . $j;
    $delete = $_POST["$del"];
    $payID = "payment_id" . $j;
    $paymentID = $_POST["$payID"];
    $cDate = "date" . $j;
    $payDate = $_POST["$cDate"];
    $amt = "amount" . $j;
    $amount = $_POST["$amt"];
    $cNum = "chq_num" . $j;
    $chqNum = $_POST["$cNum"];
    $cAmt = "chq_amount" . $j;
    $chqAmt = $_POST["$cAmt"];
    $pMethod = "payment_method" . $j;
    $paymentMethod = $_POST["$pMethod"];
    $rmk = "remarks" . $j;
    $remarks = $_POST["$rmk"];
    $uID = "userID" . $j;
    $userID = $_POST["$uID"];
    $$uName = "userName" . $j;
    $userName = $_POST["$uName"];
    $ts = "timestamp" . $j;
    $timestamp = $_POST["$ts"];
    $upd = "update" . $j;
    $update = $_POST["$upd"];
   
	if ( $j <= $numRowsPay - 1 ) {
	 if ( $update == 1 ) {  // if update=1
      if ( $delete == "delete" && $paymentID > 0 ) {
        $query = "DELETE FROM teacher_payroll " .
		   "WHERE payment_id = $paymentID;";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	  else {
	    $query = "UPDATE teacher_payroll SET " .
           "date=\"$payDate\", cheque_amount=$chqAmt, " .
		   "amount=$amount, cheque_num=\"$chqNum\",  " .
		   "payment_method=\"$paymentMethod\", remarks=\"$remarks\", user_id = $thisUserID " .
		   "WHERE payment_id = $paymentID;";
        // echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	 } // end if update = 1
	}
	else {   // Insert new record for the last entry
	  if ( $payDate <> "" && $amount <> 0 ) {
	  $query = "INSERT INTO teacher_payroll (teacher_id, month, date, amount, cheque_num,  cheque_amount, payment_method, remarks, user_id ) VALUES ( $teacher_id, \"$month\", \"$payDate\", $amount, \"$chqNum\", $chqAmt, \"$paymentMethod\", \"$remarks\", $thisUserID );";
        // echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	}  
    $j += 1;
  } // end while
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  echo "<script>alert ('Teacher Payroll records has been updated for $teacher')</script>";
  echo '<script>document.form1.button.click();</script>';
	 
}  // End action = 2


if ($action == 1 ) require ('teacher_payroll_trailer.php');
?>

</body>
</html>
