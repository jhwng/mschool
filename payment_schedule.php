<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);

$versionNum = "1.00.01";

// 1.00.01 - adds hint box for status column

// action = 1 - retrieve payment schedule via POST
// action = 2 - update payment schedule
// action = 3 - get course list only
// action = 4 - retrieve payment schedule via GET
//echo "$thisUserID<br>";

//Bjng
$startdate = "";
$fullname = "";
$course_id = "";
$courseName = "";
$student_id = "";
$numRows = 0;
$numRows_schedule = 0;
//Ejng

$action=isset($_GET['action']) ? $_GET['action'] : "";
if ( $action <> "" ) {
  if ( $action <> 4 ) {
    $fullname=$_POST['full_name'];
    $courseName=isset($_POST['course_name']) ? $_POST['course_name'] : "";
    $schyear=isset($_POST['school_year']) ? $_POST['school_year'] : "";
    $startdate=$_POST['start_date'];
    $enddate=$_POST['end_date'];
    $time=isset($_POST['time']) ? $_POST['time'] : "";
    $duration=isset($_POST['duration']) ? $_POST['duration'] : "";
    $teacher=isset($_POST['teacher']) ? $_POST['teacher'] : "";
    $student_id=$_POST['student_id'];
    $dow=isset($_POST['dow']) ? $_POST['dow'] : "";
    $course_id=$_POST['course_id'];
    $delete=isset($_POST['delete']) ? $_POST['delete'] : "";
  }
  else {
    $fullname=$_GET['full_name'];
    $startdate=$_GET['start_date'];
    $enddate=$_GET['end_date'];
    $student_id=$_GET['student_id'];
	$courseName=$_GET['course_name'];
  }

  if ( $courseName <> "0" && $courseName <> "" ) {
  $query = "SELECT course_id FROM course WHERE course_name=\"$courseName\";";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  }
}


if ( $startdate == "" ) {
   $curMth = date("m");
   $curYear = date("Y");
   if ( $curMth >= 7 && $curMth <= 12 ) {
     
     $startdate = $curYear . "-07-01";
	 $enddate = $curYear + 1;
	 $enddate .= "-06-30";
   }
   else {
     $startdate = $curYear - 1;
	 $startdate .= "-07-01";
	 $enddate = $curYear . "-06-30";

   }
}

list($yyyy, $mm, $dd) = split('[/.-]', $enddate);
if ( $mm >= 7 && $mm <= 12 ) {
  $fromYear = $yyyy;
  $toYear = $yyyy + 1;
}
else {
  $fromYear = $yyyy - 1;
  $toYear = $yyyy;
}
$schYear = $fromYear . "-" . $toYear;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Payment Schedule</title>

<script type="text/javascript" src="checkform.js"> </script>
<script type="text/javascript" src="form_hints.js"></script>
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
.style8 {font-size: 12px}
.style9 {font-size: 14px}
.style11 {color: #000000}
body {
	background-image: url();
}
.style12 {font-size: 10px}
-->
</style>
</head>

<body onLoad='document.form1.full_name.focus()' vlink="black">
<a name="top"></a>
<!-- Display the top search form -->
<?php include 'banner1.php'; ?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Post Dated Cheques </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<table width="815" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="815"><div align="center">
      <form id="form1" name="form1" method="post" action="payment_schedule.php">
        <div align="center">
          <table width="772" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="772" height="20"><div align="center">Student Full Name:
              <input name="full_name" type="text" id="full_name" size="30" maxlength="60"
		  <?php if ($fullname <> "") echo "VALUE=\"" . $fullname . "\";" ?> />
  &nbsp;&nbsp;
  <input name="submit2" type="button" class="btn" id="submit2" onclick="studentNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Name Search"/>
  &nbsp;&nbsp;&nbsp;Course: 
  <select name="course_name" class="dropdowntext" id="course_name" onChange='document.form1.retrieve.click()'>
    <?php
	if ( isset($student_id) && $student_id <> "" ) {
	  $query = "select distinct student_registered_classes.course_id, course.course_name " .
	           "from student_registered_classes, course where " .
			   "student_registered_classes.course_id = course.course_id and student_id=$student_id " .
			   "and student_registered_classes.school_year = \"$schYear\" " .
			   "order by course.course_name;";
      // echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $numRows = mysql_num_rows($result);
	  while ( list ($courseID1, $courseName1) = mysql_fetch_row($result)) {
	     echo "<option value=\"$courseName1\" ";
		 if ( $courseName == $courseName1 || $action == 3 ) { echo 'selected="selected"'; }
		 echo " >$courseName1</option>";
      }
	}
	?>
  </select>
  <input name="course_id" type="hidden" id="course_id" 
		  <?php if ( $course_id <> "" ) { echo "VALUE=\"$course_id\""; } ?> />
            <input name="student_id" type="hidden" id="student_id" 
		  <?php if ( $student_id <> "" ) { echo "VALUE=\"$student_id\""; } ?> />
            </div></td>
          </tr>
          <tr>
            <td height="30"><div align="center"> 
              
              Start Date:
                <input name="start_date" type="text" id="start_date" size="12" maxlength="12" <?php if ($startdate <> "") echo "VALUE=\"" . $startdate . "\""; ?> onChange='checkDateFormat(form, this)' />
&nbsp;&nbsp;&nbsp;End Date:
<input name="end_date" type="text" id="end_date" size="12" maxlength="12" <?php if ($enddate <> "") echo "VALUE=\"" . $enddate . "\""; ?> onChange='checkDateFormat(form, this)' />
&nbsp;&nbsp;&nbsp;
<input name="getlist" type="submit" class="btn" id="getlist" 
   onclick='document.form1.action="payment_schedule.php?action=3"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Get Course List"/>
&nbsp;&nbsp;&nbsp;<input name="retrieve" type="submit" class="btn" id="retrieve"
   onclick='document.form1.action="payment_schedule.php?action=1"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Retrieve  Schedule"/>
            </div></td>
          </tr>
        </table>
          </div>
      </form>
    </div></td>
  </tr>
</table>

<?php
// if student only have 1 course registered, retrieve payment schedule right away
if ( $numRows == 1 && $action == 3 ) { echo "<script>document.form1.retrieve.click()</script>"; }
if ( $numRows > 1 && $action == 3 ) { 
    echo "<table width='815' height='40' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='83'>&nbsp;</td>
    <td width='606' valign='middle'><div align='center'><span class='style2'>Student has registered more than 1 course</span></div></td>
    <td width='61'>&nbsp;</td>
  </tr>
  <tr>
    <td width='83'>&nbsp;</td>
    <td width='606' valign='middle'><div align='center'>Select a course and click the Retrieve button</div></td>
    <td width='61'>&nbsp;</td>
  </tr>
</table>";
}

// Retrieve Payment Schedule
$error = 0;
if ( $action == 4 ) { echo "<script>document.form1.getlist.click(); document.form1.retrieve.click()</script>"; }
if ( $action == 1 ) {
  if ( $student_id == "" || $course_id < 1 ) {
    echo "<script>alert ('You need to select a student and course for the Payment Schedule listing')</script>";
	$error = 1;
  }
  
  if ( $error == 0 ) {
    list($yyyy, $mm, $dd) = split('[/.-]', $enddate);
	if ( $mm >= 7 && $mm <= 12 ) {
	    $fromYear = $yyyy;
		$toYear = $yyyy + 1;
	}
	else {
	    $fromYear = $yyyy - 1;
		$toYear = $yyyy;
	}
	$schYear = $fromYear . "-" . $toYear;
	// echo "$schYear<br>";

    $query = "SELECT student_registered_classes.start_date, student_registered_classes.end_date, " .
	         "student_registered_classes.time, student_registered_classes.duration, " .
			 "student_registered_classes.external_rate, student_registered_classes.dow, teacher.teacher " .
			 "FROM student_registered_classes, teacher " .
			 "WHERE student_registered_classes.teacher_id = teacher.teacher_id AND " .
			 "student_registered_classes.student_id=$student_id AND " .
			 "student_registered_classes.course_id=$course_id AND " .
			 "student_registered_classes.school_year=\"$schYear\";";
    $result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
    if ( $numRows == 0 ) {
	  echo "<div align='center'><p><pre>No registered course found. Please check you search criteria and try again.             </pre></p></div>";
	}
	else {
      $row = mysql_fetch_array($result);
      extract($row);
		 
	  // now retrieve student_scheduled_payments entries, from 7/1 to 6/30
	  list ($sYYYY, $sMth, $dd ) = split ('-', $startdate);
	  $startMonth = $sYYYY . "-" . $sMth;
	  list ($eYYYY, $eMth, $dd ) = split ('-', $enddate);
	  $endMonth = $eYYYY . "-" . $eMth;
      $firstDayOfYear = date ("Y-m-d", mktime(0, 0, 0, 7, 1, $fromYear));
	  $lastDayOfYear = date ("Y-m-d", mktime(0, 0, 0, 6, 30, $toYear));
	  
      // setup arrary to display dow
	  $dayOfWeek[0] = "Sun";
	  $dayOfWeek[1] = "Mon";
	  $dayOfWeek[2] = "Tue";
	  $dayOfWeek[3] = "Wed";
	  $dayOfWeek[4] = "Thu";
	  $dayOfWeek[5] = "Fri";
      $dayOfWeek[6] = "Sat";
	  
	  $query = "SELECT scheduled_payment_id, month, cheque_date, number_of_lessons, amount, cheque_num, cheque_name, " .
	         "status, payment_method, remarks, student_scheduled_payments.user_id, user_name, DATE_FORMAT(student_scheduled_payments.timestamp,'%Y-%m-%d %H:%i') " .
			 "FROM student_scheduled_payments, user " .
			 "WHERE student_scheduled_payments.user_id = user.user_id " . 
			 "AND student_id=$student_id AND course_id=$course_id " .
			 // "AND month >= \"$startMonth\" AND month <= \"$endMonth\" " .
			 "AND school_year = \"$schYear\" AND ( (status <> 'L' AND status <> 'LD' AND status <> 'LB' AND status <> 'LH') OR status is NULL ) " .
			 // "AND cheque_date BETWEEN \"$firstDayOfYear\" AND \"$enddate\" " .
			 // "AND cheque_date >= \"$firstDayOfYear\" " .
			 // "AND cheque_date BETWEEN \"$startdate\" AND \"$enddate\" " .
			 "ORDER BY cheque_date, month desc;";
      // echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $numRows_schedule = mysql_num_rows($result);
	
    require ('payment_schedule_header_row.php');
	
	$j = 0;
    while ( list ($paymentID, $month, $chqDate, $numLessons, $amount, $chqNum, $chqName, $status, $paymentMethod, $remarks, $userID, $userName, $timestamp) = mysql_fetch_row($result)) {
       $usageAmt = 0;
	    if ( "$month" <> "" ) {
	     list($yyyy, $mm) = split('[/.-]', $month);
         $firstDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm"), 1, $yyyy));
	     $lastDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")+1, 0, $yyyy));
         $query = "select sum(duration * external_rate /15) as usageAmt from class_schedule " .
           "where student_id=$student_id and course_id=$course_id " .
		   // "and ( class_type = '' or class_type is NULL )" .
		   " and ( date between \"$firstDayOfMth\" and \"$lastDayOfMth\" ) " .
		   " and ( (cancelled <> 'W' and cancelled <> 'T' and cancelled <> 'CXL' ) " .
		   " or cancelled is NULL  or cancelled = \"\" )";
         //echo "$query<br>";
         $result1 = mysql_query($query, $promusic) or die(mysql_error());
         $row = mysql_fetch_array($result1);
         extract($row);
         if ( $usageAmt == "" ) {
	       $usageAmt = 0;
	     }  // end if numRows = null
	   } 
	   require ('payment_schedule_row_entry.php');
	   $j += 1;
	}  // End while
    
	// Now retrieve 'L' entries
	$usageAmt = 0;
	$query = "SELECT scheduled_payment_id, month, cheque_date, number_of_lessons, amount, cheque_num, cheque_name, " .
	         "status, payment_method, remarks, student_scheduled_payments.user_id, user_name, DATE_FORMAT(student_scheduled_payments.timestamp,'%Y-%m-%d %H:%i') " .
			 "FROM student_scheduled_payments, user " .
			 "WHERE student_scheduled_payments.user_id = user.user_id " . 
			 "AND student_id=$student_id AND course_id=$course_id " .
			 // "AND month >= \"$startMonth\" AND month <= \"$endMonth\" " .
			 "AND school_year = \"$schYear\" AND ( status = 'L' OR status = 'LD' OR status = 'LH' OR status = 'LB' ) " .
			 // "AND cheque_date BETWEEN \"$firstDayOfYear\" AND \"$enddate\" " .
			 // "AND cheque_date >= \"$firstDayOfYear\" " .
			 // "AND cheque_date BETWEEN \"$startdate\" AND \"$enddate\" " .
			 "ORDER BY cheque_date;";
    // echo "$query<br>";
	$result2 = mysql_query($query, $promusic) or die(mysql_error());
    $numRows_scheduleL = mysql_num_rows($result2);
	$numRows_schedule += $numRows_scheduleL;
	
    while ( list ($paymentID, $month, $chqDate, $numLessons, $amount, $chqNum, $chqName, $status, $paymentMethod, $remarks, $userID, $userName, $timestamp) = mysql_fetch_row($result2)) {
	   require ('payment_schedule_row_entry.php');
	   $j += 1;
	}  // End while
    
	// Display 5 blank form line for adding new entry
	$month = "";
	$chqDate = "";
	$numLessons = 0;
	$amount = 0;
	$chqNum = "";
	$chqName = "";
	$status = "";
	$paymentMethod = "";
	$remarks = "";
	$userName="&nbsp;";
	$timestamp="&nbsp;";
	$i = 1;
	while ( $i <= 5 ) {
      require ('payment_schedule_row_entry.php');
	  $i += 1;
	  $j += 1;
	}  // end while
	}  // end if numRows = 0
  }  // end if error = 0

    
}  // End if action = 1

if ( $action == 2 ) {
  $numRows_schedule = $_POST['num_entries'];
  $j = 0;
  require ('payment_schedule_header_row.php');

  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( $j <= $numRows_schedule + 4 ) {
    $del = "delete" . $j;
    $delete = $_POST["$del"];
    $payID = "payment_id" . $j;
    $paymentID = $_POST["$payID"];
    $cDate = "date" . $j;
    $chqDate = $_POST["$cDate"];
    $amt = "amount" . $j;
    $amount = $_POST["$amt"];
    $cNum = "chq_num" . $j;
    $chqNum = $_POST["$cNum"];
    $cName = "chq_name" . $j;
    $chqName = $_POST["$cName"];
    $st = "status" . $j;
    $status = $_POST["$st"];
    $pMethod = "payment_method" . $j;
    $paymentMethod = $_POST["$pMethod"];
    $rmk = "remarks" . $j;
    $remarks = $_POST["$rmk"];
    $mth = "month" . $j;
    $month = $_POST["$mth"];
    $uID = "userID" . $j;
    $userID = $_POST["$uID"];
    $$uName = "userName" . $j;
    $userName = $_POST["$uName"];
    $ts = "timestamp" . $j;
    $timestamp = $_POST["$ts"];
    $upd = "update" . $j;
    $update = $_POST["$upd"];
 
    if ( $j <= $numRows_schedule - 1 ) {
	 if ( $update == 1 ) {  // if update=1
      if ( $delete == "delete" ) {
        $query = "DELETE FROM student_scheduled_payments " .
		   "WHERE scheduled_payment_id = $paymentID;";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	  else {
	    $query = "UPDATE student_scheduled_payments SET " .
           "cheque_date=\"$chqDate\", user_id = $thisUserID, " .
		   "amount=$amount, month=\"$month\", cheque_num=\"$chqNum\", cheque_name=\"$chqName\", " .
		   "status=\"$status\", payment_method=\"$paymentMethod\", remarks=\"$remarks\" " .
		   "WHERE scheduled_payment_id = $paymentID;";
        // echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	 }  // end if update = 1
	}
	else {   // Insert new record for the last entry
      if ( $chqDate <> "" ) {
	    $query = "INSERT INTO student_scheduled_payments " .
		     "(student_id, course_id, month, cheque_date, amount, " .
			 "cheque_num, cheque_name, status, payment_method, remarks, school_year, user_id ) VALUES " .
			 "($student_id, $course_id, \"$month\", \"$chqDate\", $amount, " .
 			 "\"$chqNum\", \"$chqName\", \"$status\", \"$paymentMethod\", \"$remarks\", \"$schYear\", $thisUserID);";	
        // echo "$query<br>";
	    $result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	}  
    require ('payment_schedule_row_entry.php');
    $j += 1;
  } // end while
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  echo "<script>document.form1.retrieve.click()</script>";
     
}  // End action = 2
       
if ( $student_id > 0 ) {
   require ('payment_schedule_trailer.php');
}
?>
<input name="num_entries" value="<?php echo $numRows_schedule; ?>" type="hidden" id="num_entries" />
<input name="full_name" value="<?php echo $fullname; ?>" type="hidden" id="full_name" />
<input name="course_name" value="<?php echo $courseName; ?>" type="hidden" id="course_name" />
<input name="start_date" value="<?php echo $startdate; ?>" type="hidden" id="start_date" />
<input name="end_date" value="<?php echo $enddate; ?>" type="hidden" id="end_date" />
<input name="student_id" value="<?php echo $student_id; ?>" type="hidden" id="student_id" />
<input name="course_id" value="<?php echo $course_id; ?>" type="hidden" id="course_id" />

</form>


</body>
</html>
<?php
//mysql_free_result($teacher);
?>
