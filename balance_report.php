<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);

// action = 1 - display balance report via POST
// action = 2 - NOT used
// action = 3 - get course list only
// action =4 - display balance report via GET

$action=$_GET['action'];
if ( $action <> "" ) {
  if ( $action <> 4 ) {
    $fullname=$_POST['full_name'];
    $courseName=$_POST['course_name'];
    $schyear=$_POST['school_year'];
    $startdate=$_POST['start_date'];
    $enddate=$_POST['end_date'];
    $time=$_POST['time'];
    $duration=$_POST['duration'];
    $teacher=$_POST['teacher'];
    $student_id=$_POST['student_id'];
    $dow=$_POST['dow'];
    $course_id=$_POST['course_id'];
	$delete=$_POST['delete'];
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
<title>Monthly Balance Report</title>

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
.style8 {font-size: 12px}
.style9 {font-size: 14px}
.style11 {color: #000000}
.redtext {color: red}
body {
	background-image: url();
}
.style12 {font-size: 10px}
-->
</style>
</head>

<body onLoad='document.form1.full_name.focus()'>
<a name="top"></a>
<!-- Display the top search form -->
<?php include 'banner1.php'; ?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Monthly Balance Report</span></div></td>
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
   onclick='document.form1.action="balance_report.php?action=3"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Get Course List"/>
&nbsp;&nbsp;&nbsp;<input name="retrieve" type="submit" class="btn" id="retrieve"
   onclick='document.form1.action="balance_report.php?action=1"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Balance Report"/>
            </div></td>
          </tr>
        </table>
          </div>
      </form>
    </div></td>
  </tr>
</table>

<?php
// if student only have 1 course registered, display balance report right away
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
    echo "<script>alert ('You need to select a student and course for the Monthly Balance listing')</script>";
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

	$yearStartDate = $fromYear . "-07-01";
	$yearEndDate = $toYear . "-06-30";
	$schYear = $fromYear . "-" . $toYear;

    // Get course information
	$query = "SELECT student_registered_classes.start_date, student_registered_classes.end_date, " .
	         "student_registered_classes.time, student_registered_classes.duration, " .
			 "student_registered_classes.external_rate, student_registered_classes.dow, " .
			 "teacher.teacher " .
			 "FROM student_registered_classes, teacher " .
			 "WHERE student_registered_classes.teacher_id = teacher.teacher_id AND " .
			 "student_registered_classes.student_id=$student_id AND " .
			 "student_registered_classes.course_id=$course_id AND " .
			 "student_registered_classes.school_year=\"$schYear\";";
	// echo "$query<br>";
    $result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
    if ( $numRows == 0 ) {
	  $error = 1;
	  echo "<div align='center'><p><pre>No registered course found. Please check you search criteria and try again.             </pre></p></div>";
	}
	else {
    $row = mysql_fetch_array($result);
    extract($row);
	
	// setup arrary to display dow
	$dayOfWeek[0] = "Sun";
	$dayOfWeek[1] = "Mon";
	$dayOfWeek[2] = "Tue";
	$dayOfWeek[3] = "Wed";
	$dayOfWeek[4] = "Thu";
	$dayOfWeek[5] = "Fri";
	$dayOfWeek[6] = "Sat";
	
    require ('balance_report_header.php');

	list($yyyy, $mm, $dd) = split('[/.-]', $yearStartDate);
	$mm = 7;
    $firstDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm"), 1, $fromYear));
	$lastDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")+1, 0, $fromYear));
	$ttlSchPayment = 0;
	$ttlLessons = 0;
	$ttlAdHoc = 0;
	$ttlMiscAmt = 0;
	$$ttlUsage = 0;
	$monthlyPDchqAmount = 0;
	$adHocPayment = 0;
	$miscAmt = 0;
	$usageAmt = 0;
    $number_of_lessons = 0;

	// now display prior to school year row
	  $month = "Before Year";

	  $query = "SELECT sum(amount) as monthlyPDchqAmount FROM student_scheduled_payments " .
	     "WHERE student_id=$student_id AND course_id=$course_id " .
		 "AND ( status = \"R\" OR status = \"D\" OR status = \"H\" OR status = \"S\" ) " .
	     "AND cheque_date < \"$yearStartDate\" and school_year = \"$schYear\"";
      // echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $numRows = mysql_num_rows($result);
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $monthlyPDchqAmount == "" ) {
	    $monthlyPDchqAmount = 0;
	  }
	  $ttlSchPayment += $monthlyPDchqAmount;

	  $query = "SELECT sum(amount) as adHocPayment from adhoc_payments " .
	     "where student_id=$student_id and course_id=$course_id and " .
		 "date < \"$yearStartDate\" and school_year = \"$schYear\"";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $adHocPayment == "" ) {
	    $adHocPayment = 0;
	  }  // end if numRows = null
	  $ttlAdHoc += $adHocPayment;

	  $query = "SELECT sum(amount) as miscAmt from misc_items " .
	     "where student_id=$student_id and course_id=$course_id and " .
		 "date  < \"$yearStartDate\" and school_year = \"$schYear\"";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $miscAmt == "" ) {
	    $miscAmt = 0;
	  }  // end if numRows = null
	  $ttlMiscAmt += $miscAmt;

	  $balance += $monthlyPDchqAmount + $adHocPayment - $miscAmt - $usageAmt;
      require ('balance_report_row_entry.php');
	
	$i = 1;
	while ( $i <= 12 ) {
	  // Get Payment Schedule Info
      list($yyyy1, $mm1, $dd1) = split('[/.-]', $firstDayOfMth);
	  $month1 = $yyyy1 . "-" . $mm1;
	  $month = $month1;
	  
/*
	  // only display cash balance for the current month entry, other months, display 0
	  $curMth = date ("Y-m");
	  if ( $month1 == $curMth ) {
	    $thisMth = 1; 
		$cash1 = $cash;
	  }
	  else {
	    $thisMth = 0;
		$cash1 = 0;
	  }
*/	  
	  $query = "SELECT sum(amount) as monthlyPDchqAmount FROM student_scheduled_payments " .
	     "WHERE student_id=$student_id AND course_id=$course_id " .
		 "AND ( status = \"R\" OR status = \"D\" OR status = \"H\"  OR status = \"S\" ) " .
	     "AND cheque_date BETWEEN \"$firstDayOfMth\" AND \"$lastDayOfMth\" AND school_year = \"$schYear\"; ";
      //echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $numRows = mysql_num_rows($result);
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $monthlyPDchqAmount == "" ) {
	    $monthlyPDchqAmount = 0;
		$month = $month1;
		$number_of_lessons = 0;
	  }
	  $ttlSchPayment += $monthlyPDchqAmount;

      /* $query = "SELECT month, number_of_lessons FROM student_scheduled_payments " .
	       "WHERE student_id=$student_id AND course_id=$course_id " .
	       "AND month = \"$month1\"; ";  */
	  $query = "SELECT count(date) as number_of_lessons from class_schedule " .
               "where student_id=$student_id and course_id=$course_id " .
		       // "and ( class_type = '' or class_type is NULL )" .
		       " and ( date between \"$firstDayOfMth\" and \"$lastDayOfMth\" ) " .
		       " and ( (cancelled <> 'W' and cancelled <> 'T' and cancelled <> 'CXL' ) " .
		       " or cancelled is NULL  or cancelled = \"\" )";
        //echo "$query<br>";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      // $numRows = mysql_num_rows($result);
      $row = mysql_fetch_array($result);
      extract($row);
	  if ( $number_of_lessons == "" ) {
	    $number_of_lessons = 0;
	  }  
	  $ttlLessons += $number_of_lessons;

      $query = "select sum(duration * external_rate /15) as usageAmt from class_schedule " .
           "where student_id=$student_id and course_id=$course_id " .
		   // "and ( class_type = '' or class_type is NULL )" .
		   " and ( date between \"$firstDayOfMth\" and \"$lastDayOfMth\" ) " .
		   " and ( (cancelled <> 'W' and cancelled <> 'T' and cancelled <> 'CXL' ) " .
		   " or cancelled is NULL  or cancelled = \"\" )";
      //echo "$query<br>";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $usageAmt == "" ) {
	    $usageAmt = 0;
	  }  // end if numRows = null
	  $ttlUsage += $usageAmt;
	  
	  $query = "SELECT sum(amount) as adHocPayment from adhoc_payments " .
	     "where student_id=$student_id and course_id=$course_id and " .
		 "date between \"$firstDayOfMth\" and \"$lastDayOfMth\" and school_year = \"$schYear\" ";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $adHocPayment == "" ) {
	    $adHocPayment = 0;
	  }  // end if numRows = null
	  $ttlAdHoc += $adHocPayment;
	  
	  $query = "SELECT sum(amount) as miscAmt from misc_items " .
	     "where student_id=$student_id and course_id=$course_id and " .
		 "date between \"$firstDayOfMth\" and \"$lastDayOfMth\" AND school_year = \"$schYear\"";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $miscAmt == "" ) {
	    $miscAmt = 0;
	  }  // end if numRows = null
	  $ttlMiscAmt += $miscAmt;
	  
	  
	  // Calculate monthly W and T credit equivalent amount
	  $query = "SELECT sum(minute_balance * external_rate / 15) as WmonthlyAmt  from student_credit_minutes " .
           "WHERE student_id=$student_id and credit_type = 'W' and ( date between \"$firstDayOfMth\" and  \"$lastDayOfMth\" ) and course_id=$course_id";
      // echo "$query<br>";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
  
      if ( $WmonthlyAmt == NULL || $WmonthlyAmt == "" ) { $WmonthlyAmt = 0; }
	  $WrunningTotal += $WmonthlyAmt;
	  
	  // Calculate monthly W and T credit equivalent amount
	  $query = "SELECT sum(minute_balance * external_rate / 15) as TmonthlyAmt  from student_credit_minutes " .
           "WHERE student_id=$student_id and credit_type = 'T' and ( date between \"$firstDayOfMth\" and  \"$lastDayOfMth\" ) and course_id=$course_id";
      // echo "$query<br>";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
  
      if ( $TmonthlyAmt == NULL || $TmonthlyAmt == "" ) { $TmonthlyAmt = 0; }
	  $TrunningTotal += $TmonthlyAmt;
	  
	  $balance += $monthlyPDchqAmount + $adHocPayment - $miscAmt - $usageAmt;
      require ('balance_report_row_entry.php');
	  $mm += 1;
	  $firstDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")  , 1, $fromYear));
	  $lastDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")+1  , 0, $fromYear));
	  $i += 1;
	}  // end while

	// now display after school year row
	$monthlyPDchqAmount = 0;
	$adHocPayment = 0;
	$miscAmt = 0;
	$usageAmt = 0;
    $number_of_lessons = 0;
	  $month = "After Year";
	  
	  $query = "SELECT sum(amount) as monthlyPDchqAmount FROM student_scheduled_payments " .
	     "WHERE student_id=$student_id AND course_id=$course_id " .
		 "AND ( status = \"R\" OR status = \"D\" OR status = \"H\"  OR status = \"S\" ) " .
	     "AND cheque_date > \"$yearEndDate\" and school_year = \"$schYear\"";
      //echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $numRows = mysql_num_rows($result);
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $monthlyPDchqAmount == "" ) {
	    $monthlyPDchqAmount = 0;
	  }
	  $ttlSchPayment += $monthlyPDchqAmount;
	  
	  $query = "SELECT sum(amount) as adHocPayment from adhoc_payments " .
	     "where student_id=$student_id and course_id=$course_id and " .
		 "date > \"$yearEndDate\" and school_year = \"$schYear\"";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $adHocPayment == "" ) {
	    $adHocPayment = 0;
	  }  // end if numRows = null
	  $ttlAdHoc += $adHocPayment;

	  $query = "SELECT sum(amount) as miscAmt from misc_items " .
	     "where student_id=$student_id and course_id=$course_id and " .
		 "date > \"$yearEndDate\" and school_year = \"$schYear\"";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $miscAmt == "" ) {
	    $miscAmt = 0;
	  }  // end if numRows = null
	  $ttlMiscAmt += $miscAmt;
	  
	  $balance += $monthlyPDchqAmount + $adHocPayment - $miscAmt - $usageAmt;
      require ('balance_report_row_entry.php');
	  $i += 1;
	
	
	// display bottomline totals
	$strong = 1;
	$month = "Totals";
	$number_of_lessons = $ttlLessons;
	$monthlyPDchqAmount = $ttlSchPayment;
	$adHocPayment = $ttlAdHoc;
	$miscAmt = $ttlMiscAmt;
	$usageAmt = $ttlUsage;
    require ('balance_report_row_entry.php');
	
  }  // end if no registered class founded  numRows = 0	
  }  // end if error = 0

}  // end if action = 1

if ( $error == 0 && $course_id <> "" ) require ('balance_report_trailer.php');
?>

</body>
</html>
<?php
//mysql_free_result($teacher);
?>
