<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_teacher = "select teacher from teacher where active = 'Y' or active is NULL or active = '' order by teacher;";
$teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacher);
$totalRows_teacher = mysql_num_rows($teacher);

/*
mysql_select_db($database_promusic, $promusic);
$query_course_names = "SELECT course_name FROM course ORDER BY course_name asc";
$course_names = mysql_query($query_course_names, $promusic) or die(mysql_error());
$row_course_names = mysql_fetch_assoc($course_names);
$totalRows_course_names = mysql_num_rows($course_names);
*/

$action=$_GET['action'];
if ( $action == "newcourse" ) {
  $student_id=$_GET['student_id'];
//  echo "student_id = $student_id (from GET)<br>";
  $home_tel=$_GET['home_tel'];
  $fullname=$_GET['fullname'];
  $coursename=$_GET['coursename'];
  $startdate=$_GET['startdate'];
  $enddate=$_GET['enddate'];
  $chequeno=$_GET['chequeno'];
  $chequeholder=$_GET['chequeholder'];
}
if ( $action == "searchclasses" || $action == "getcourse" ) {
  $fullname=$_POST['full_name'];
  $coursename=$_POST['course_name'];
  $startdate=$_POST['start_date'];
  $enddate=$_POST['end_date'];
  $cancelmakeup=$_POST['cancel_makeup'];
  $cancelonly=$_POST['cancel_only'];
  $nocancel=$_POST['no_cancel'];
  $home_tel=$_POST['home_tel'];
  $student_id=$_POST['student_id'];
  $name_tie_breaker=$_POST['name_tie_breaker'];
/*  $course=$_POST['course_name']; */
}
// setup arrary to display dow
	$dayOfWeek[0] = "Sun";
	$dayOfWeek[1] = "Mon";
	$dayOfWeek[2] = "Tue";
	$dayOfWeek[3] = "Wed";
	$dayOfWeek[4] = "Thu";
	$dayOfWeek[5] = "Fri";
	$dayOfWeek[6] = "Sat";
	

$listMth = "";   // listMth is the month for the entries being listed

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

function rowHeader($j, $mmm, $student_id, $fullname, $startdate, $enddate, $courseName) {
   require ('class_schedule_header.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Class Rescheduling</title>

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
    <td width="606" valign="middle"><div align="center"><span class="style2">Class Schedule Management </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<table width="815" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="815"><div align="center">
      <form id="form1" name="form1" method="post" action="class_schedule.php?action=searchclasses">
        <div align="center">
          <table width="750" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20"><div align="center">Student Full Name:
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
			   "and school_year = \"$schYear\" " .
			   "order by course.course_name;";
      // echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $numRows = mysql_num_rows($result);
	  while ( list ($courseID, $courseName1) = mysql_fetch_row($result)) {
	     echo "<option value=\"$courseName1\" ";
		 if ( $action <> "" ) {
		    if ($coursename == "$courseName1") 
		    { 
		      echo 'selected="selected"'; 
		      echo " >$courseName1</option>";
			}
			else {
              echo " >$courseName1</option>";
			}
   		 }
      }
	}

	  ?>
  </select>
            </div></td>
          </tr>
          <tr>
            <td height="30"><div align="center"> Name Tie Breaker :
                <input name="name_tie_breaker" type="text" id="name_tie_breaker" size="25" maxlength="45" 
		  <?php if ( $name_tie_breaker <> "" ) { echo "VALUE=\"$name_tie_breaker\""; } ?> />
&nbsp;&nbsp;&nbsp;Home Phone.:
<input name="home_tel" type="text" id="home_tel" size="15" maxlength="30" 
		  <?php if ( $home_tel <> "" ) { echo "VALUE=\"$home_tel\""; } ?> />
&nbsp;&nbsp;&nbsp;
<! <input name="student_id" type="text" id="student_id" size="8" maxlength="12"  ->
<input name="student_id" type="hidden" id="student_id" 
		  <?php if ( $student_id <> "" ) { echo "VALUE=\"$student_id\""; } ?> />
</div></td>
          </tr>
          <tr>
            <td><div align="center">Period Between:
                <input name="start_date" type="text" id="start_date" size="10" maxlength="14"
		  <?php if ($startdate <> "") echo "VALUE=\"" . $startdate . "\""; ?> 
		  onChange='checkDateFormat(form, this)' />
and
<input name="end_date" type="text" id="end_date" size="10" maxlength="14"
		  <?php if ($enddate <> "") echo "VALUE=\"" . $enddate . "\""; ?>
		  onChange='checkDateFormat(form, this)' />
&nbsp; 
<input name="getlist" type="submit" class="btn" id="getlist" 
   onclick='document.form1.action="class_schedule.php?action=getcourse"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Get List"/>
&nbsp;
<input name="cancel_only" type="checkbox" id="cancel_only" value="yes"
   onChange='if (this.checked) { document.form1.cancel_makeup.checked=0; document.form1.no_cancel.checked=0 }'
		   <?php if ($cancelonly == 'yes' ) echo "checked=1"; ?> />
W/T Only&nbsp;&nbsp;
<input name="cancel_makeup" type="checkbox" id="cancel_makeup" value="yes"
   onChange='if (this.checked) { document.form1.cancel_only.checked=0; document.form1.no_cancel.checked=0 }'
		   <?php if ($cancelmakeup == 'yes' ) echo "checked=1"; ?> />
Cancel & Makeup&nbsp;&nbsp;
<input name="no_cancel" type="checkbox" id="no_cancel" value="yes" 
   onChange='if (this.checked) { document.form1.cancel_makeup.checked=0; document.form1.cancel_only.checked=0 }'
		   <?php if ($nocancel == 'yes' ) echo "checked=1"; ?> />
No Cancel 
&nbsp;&nbsp;
<input name="retrieve" type="submit" class="btn" id="retrieve"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Retrieve"/>

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
if ( $numRows == 1 && $action == "getcourse" ) { 
  echo "<script>document.form1.retrieve.click()</script>"; 
}
if ( $numRows > 1 && $action == "getcourse" ) { 
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

if ( $numRows == 0 && $action == "getcourse" ) {
    echo "<table width='815' height='40' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='83'>&nbsp;</td>
    <td width='606' valign='middle'><div align='center'><span class='style2'>NO Registered Class Found </span></div></td>
    <td width='61'>&nbsp;</td>
  </tr>
  <tr>
    <td width='83'>&nbsp;</td>
    <td width='606' valign='middle'><div align='center'>Enter a new Student Name and click Search Name again</div></td>
    <td width='61'>&nbsp;</td>
  </tr>
</table>";

    echo "<script>document.form1.full_name.focus();document.form1.full_name.select();</script>";
}  /* End of #rows = 0 */


if ( $action == "searchclasses" || $action == "newcourse") {
// Get course_id first from course name 
  if ( $coursename <> "All" && $coursename <> "" ) {
//     $course_id = $coursename;
//  }
    $query_courseid = "select course_id from course where course_name = \"$coursename\";"; 
    $result = mysql_query($query_courseid, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);

    if ( $numRows == 0 ) {
      echo "<table width='815' height='40' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td width='83'>&nbsp;</td>
      <td width='606' valign='middle'><div align='center'><span class='style2'>NO Registered Class Found </span></div></td>
      <td width='61'>&nbsp;</td>
    </tr>
    <tr>
      <td width='83'>&nbsp;</td>
      <td width='606' valign='middle'><div align='center'>Enter a new Student Name and click Search Name again</div></td>
      <td width='61'>&nbsp;</td>
    </tr>
  </table>";

      echo "<script>document.form1.full_name.focus();document.form1.full_name.select();</script>";
	  exit();
    }  /* End of #rows = 0 */
    else {
      $row_courseid = mysql_fetch_array($result);
      extract($row_courseid);
	}
  }


/* Get student_id  
    $query = "select student_id from student where full_name = \"$fullname\";"; 
    $result = mysql_query($query, $promusic) or die(mysql_error());
    list ($student_id, $home_tel) = mysql_fetch_row($result);
*/	

  $query_classes = "SELECT student.full_name, teacher.teacher, class_schedule.course_id, (select course_name from course where course.course_id = class_schedule.course_id) as cname, class_schedule.grade, class_schedule.date, class_schedule.time, class_schedule.duration, class_schedule.cancelled, class_schedule.cancelled_time, class_schedule.external_rate, class_schedule.student_id, class_schedule.teacher_id, class_schedule.remarks, class_schedule.class_id, class_schedule.dow, class_schedule.rescheduled_from, class_schedule.internal_cost, class_schedule.class_type, class_schedule.cost_type, class_schedule.from_student_credit_id, class_schedule.to_student_credit_id, class_schedule.user_id, DATE_FORMAT(class_schedule.timestamp,'%Y-%m-%d %H:%i') 
FROM (class_schedule INNER JOIN student ON class_schedule.student_id = student.student_id) INNER JOIN teacher ON class_schedule.teacher_id = teacher.teacher_id
WHERE (student.student_id=\"$student_id\")";

  if ( $coursename <> "All" && $coursename <> "" ) 
    $query_classes .= " and (class_schedule.course_id = $course_id)";
  if ( $startdate == "" ) $startdate = "1990-01-01";
  if ( $enddate == ""   ) $enddate = "2050-12-31";
  $query_classes .= " and (class_schedule.date between \"$startdate\" and \"$enddate\")";
  if (  $cancelmakeup == "yes" ) 
    $query_classes .= " and ( (class_schedule.cancelled <> '' AND class_schedule.cancelled is NOT NULL) OR (class_schedule.class_type <> '' AND class_schedule.class_type is NOT NULL) )";
  if (  $cancelonly == "yes" ) 
    $query_classes .= " and (class_schedule.cancelled = 'W' OR class_schedule.cancelled = 'T' )";
  if (  $nocancel == "yes" ) 
    $query_classes .= " and (class_schedule.cancelled = '' or class_schedule.cancelled is NULL)";
  $query_classes .= " ORDER BY date, class_schedule.time;";
  // echo "$query_classes<br>";
  $classes = mysql_query($query_classes, $promusic) or die(mysql_error());
  $totalRows_classes = mysql_num_rows($classes);
  
  if ( $totalRows_classes == 0 ) { 
    echo "<table width='815' height='40' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='83'>&nbsp;</td>
    <td width='606' valign='middle'><div align='center'><span class='style2'>NO Registered Class Found </span></div></td>
    <td width='61'>&nbsp;</td>
  </tr>
  <tr>
    <td width='83'>&nbsp;</td>
    <td width='606' valign='middle'><div align='center'>Enter a new Student Name and click Search Name again</div></td>
    <td width='61'>&nbsp;</td>
  </tr>
</table>";

    echo "<script>document.form1.full_name.focus();document.form1.full_name.select();</script>";
  }  /* End of #rows = 0 */

  // Display W and T credit summary for the course selected
  $today=date("Y-m-d");
  $tomorrow  = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
  $curMonth=date("m");
  if ( $curMonth >= 7 and $curMonth <= 12 ) {
    $startYear = date ("Y-m-d", mktime(0, 0, 0, 7, 1, date("Y")));
    $startYearMth = date ("Y-m", mktime(0, 0, 0, 7, 1, date("Y")));
	$endYear = date ("Y-m-d", mktime(0, 0, 0, 6, 30, date("Y")+1));
	$endYearMth = date ("Y-m", mktime(0, 0, 0, 6, 30, date("Y")+1));
  }
  else {
    $startYear = date ("Y-m-d", mktime(0, 0, 0, 7, 1, date("Y")-1));
    $startYearMth = date ("Y-m", mktime(0, 0, 0, 7, 1, date("Y")-1));
	$endYear = date ("Y-m-d", mktime(0, 0, 0, 6, 30, date("Y")));
	$endYearMth = date ("Y-m", mktime(0, 0, 0, 6, 30, date("Y")));
  }
  
  list($yyyy, $mm, $dd) = split('[/.-]', $today);
  if ( $mm >= 7 && $mm <= 12 ) {
    $fromYear1 = $yyyy;
    $toYear1 = $yyyy + 1;
  }
  else {
    $fromYear1 = $yyyy - 1;
    $toYear1 = $yyyy;
  }
  $summarySchYear = $fromYear1 . "-" . $toYear1;
  
  if ( $coursename <> "All" && $coursename <> "" && $totalRows_classes > 0 && $schYear == $summarySchYear ) 
  {
  $query = "SELECT sum(minute_balance) as wMinutesYTD  from student_credit_minutes " .
           "WHERE student_id=$student_id and ( date between \"$startYear\" and  \"$today\" ) and course_id=$course_id and credit_type='W'";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  
  $query = "SELECT sum(minute_balance) as tMinutesYTD from student_credit_minutes " .
           "WHERE student_id=$student_id and ( date between \"$startYear\" and  \"$today\" ) and course_id=$course_id and credit_type='T'";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  
   $query = "SELECT sum(minute_balance) as wMinutesFuture  from student_credit_minutes " .
           "WHERE student_id=$student_id and ( date between \"$tomorrow\" and \"$endYear\" ) and course_id=$course_id and credit_type='W'";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  
  $query = "SELECT sum(minute_balance) as tMinutesFuture from student_credit_minutes " .
           "WHERE student_id=$student_id and ( date between \"$tomorrow\" and \"$endYear\" ) and course_id=$course_id and credit_type='T'";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  
  if ( $wMinutesYTD == NULL || $wMinutesYTD == "" )  $wMinutesYTD = 0; 
  if ( $tMinutesYTD == NULL || $tMinutesYTD == "" )  $tMinutesYTD = 0; 
  if ( $wMinutesFuture == NULL || $wMinutesFuture == "" )  $wMinutesFuture = 0; 
  if ( $tMinutesFuture == NULL || $tMinutesFuture == "" )  $tMinutesFuture = 0; 
  
    
  // Calculate projected balance
  $query = "SELECT sum(amount) as monthlyPDchqAmount FROM student_scheduled_payments " .
         "WHERE student_id=$student_id AND course_id=$course_id " .
		 "AND ( status = \"R\" OR status = \"D\" OR status = \"S\" ) " .
	     "AND school_year = \"$summarySchYear\" ";
		 // "AND cheque_date BETWEEN \"$startYear\" AND \"$endYear\"; ";
  //echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);
  $row = mysql_fetch_array($result);
  extract($row);
  if ( $monthlyPDchqAmount == "" ) {
    $monthlyPDchqAmount = 0;
  }  // end if numRows = null
  
  $query = "select sum(duration * external_rate /15) as usageAmt from class_schedule " .
           "where student_id=$student_id and course_id=$course_id " .
		   // "and ( class_type = '' or class_type is NULL )" .
		   " and ( date between \"$startYear\" and \"$endYear\" ) " .
		   " and ( (cancelled <> 'W' and cancelled <> 'T' and cancelled <> 'CXL' ) " .
		   " or cancelled is NULL  or cancelled = \"\" )";
  //echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  if ( $usageAmt == "" ) {
    $usageAmt = 0;
  }  // end if numRows = null
	  
  $query = "SELECT sum(amount) as adHocPayment from adhoc_payments " .
	     "where student_id=$student_id and course_id=$course_id and " .
	     "school_year = \"$summarySchYear\" ";
		 // "date between \"$startYear\" and \"$endYear\"";
  //echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  if ( $adHocPayment == "" ) {
    $adHocPayment = 0;
  }  // end if numRows = null
	  
  $query = "SELECT sum(amount) as miscAmt from misc_items " .
	     "where student_id=$student_id and course_id=$course_id and " .
	     "school_year = \"$summarySchYear\" ";
		 // "date between \"$startYear\" and \"$endYear\"";
  //echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  if ( $miscAmt == "" ) {
    $miscAmt = 0;
  }  // end if numRows = null
	  
  $balance = $monthlyPDchqAmount + $adHocPayment - $miscAmt - $usageAmt;
  
/*
  echo "<span class='style6 style8'>YTD W and T credit Summary: W-minutes = $wMinutesYTD, T-minutes = $tMinutesYTD</span><br>";
  echo "<span class='style6 style8'>Projected W and T credit Summary: W-minutes = $wMinutesFuture, T-minutes = $tMinutesFuture</span><br>";
  
  // calculate extra mins between first day of current month and end of year: totalMins - requiredMins
  $firstDayCurMth  = date("Y-m-d", mktime(0, 0, 0, date("m")  , 1, date("Y")));
  $curYearMth = date ("Y-m", mktime(0,0,0,date("m"),1,date("Y")));
  
  $query = "select sum( number_of_lessons * duration) as requiredMins from student_scheduled_payments 
where student_id=\"$student_id\" and course_id=\"$course_id\" and ( month >= \"$startYearMth\" and month <= \"$endYearMth\" ) ";
  // echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  if ( $requiredMins == NULL || $requiredMins == "" ) { $requiredMins = 0; }  
  
  $query = "select sum(duration) as totalMins from class_schedule " .
           "where student_id=$student_id and course_id=$course_id " .
		   // "and ( class_type = '' or class_type is NULL )" .
		   " and ( date between \"$startYear\" and \"$endYear\" ) " .
		   " and ( (cancelled <> 'W' and cancelled <> 'T' and cancelled <> 'CXL' ) or cancelled is NULL  or cancelled = \"\" )";
  // echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  if ( $totalMins == NULL || $totalMins == "" ) { $totalMins = 0; }
  $extraMins = $totalMins - $requiredMins;
*/  

  }
  else
  {
  $wMinutesYTD = "N/A";
  $tMinutesYTD = "N/A";
  $wMinutesFuture = "N/A";
  $tMinutesFuture = "N/A";
  $balance = "N/A";
  }
  echo "<span class=bluetext>Summary for the Period between $startYear and $endYear</span><br>";
//  echo "<span class='style6 style8'>Projected Extra Minutes from first day of current month to Year End = $extraMins</span><br>";

echo '<table width="720" border="1"  cellspacing="0" cellpadding="0">
  <tr>
	<td width="20%" align="center" bgcolor="#FFDCB9">YTD W-minutes </td>
    <td width="20%" align="center" bgcolor="#FFDCB9">YTD T-minutes </td>
    <td width="20%" align="center" bgcolor="#FFDCB9">Projected W-minutes</td>
    <td width="20%" align="center" bgcolor="#FFDCB9">Projected T-minutes</td>
    <td width="20%" align="center" bgcolor="#FFDCB9">Projected Balance</td>
  </tr>';

	echo "  <tr>\n";
    echo "  <td align='center' bgcolor='#FFFFF2'>$wMinutesYTD</td>\n";
    echo "  <td align='center' bgcolor='#FFFFF2'>$tMinutesYTD</td>\n";
    echo "  <td align='center' bgcolor='#FFFFF2'>$wMinutesFuture</td>\n";
    echo "  <td align='center' bgcolor='#FFFFF2'>$tMinutesFuture</td>\n";
    echo "  <td align='center' ";
	if ( $balance >= 0 ) echo "bgcolor='#FFFFF2'"; else echo "bgcolor='#FC9494'";
	echo ">";
	if ( $balance == "N/A" ) {
	  echo "$balance";
	}
	else 
	{
	  echo number_format($balance, 2);
	}
	echo "</td>\n";

    echo "  </tr>\n";
    echo "</table>\n";

  
  // }	   

/* Now create the form for all class entries */

echo ' <form action="class_schedule_update.php" onSubmit="return check_class_schedule_form(this);" method="post" name="form2" id="form2">';
echo '  <table width="1100" border="1" cellspacing="0" cellpadding="1">';

  
//  echo "Number of Classes = " . $totalRows_classes . "<p>"; } 

/*  $tt = time() + time () + rand() + rand();
  $fileName = "/tmp/php" . $tt . ".tmp"; 
  if ( file_exists($fileName) ) unlink($fileName);
*/
  $i = 1;
  $j = 0;   /*  $j is the entry count for indexing the row variables */
  $classCnt = 0;  // number of classes in each month
  
  while ( list ( $fullName, $teacherName, $courseID, $cname, $grade, $classDate, $classTime, $duration, $cancelReason, $cancelTime, $extRate, $studentID, $teacherID, $remarks, $classID, $dow, $rescheduledFrom, $internalCost, $classType, $costType, $from_studentCreditID, $to_studentCreditID, $userID, $timestamp ) = mysql_fetch_row($classes)) {
    $queryUser = "SELECT user_name as userName FROM user WHERE user_id = $userID";
    $resultUser = mysql_query($queryUser, $promusic) or die(mysql_error());
    $rowUser = mysql_fetch_array($resultUser);
    extract($rowUser);
	
	$arr_fullName[] = $fullName;
    $arr_teacherName[] = $teacherName;
    $arr_courseID[] = $courseID;
	$arr_courseName[] = $cname;
    $arr_grade[] = $grade;
    $arr_classDate[] = $classDate;
    $arr_classTime[] = $classTime;
    $arr_duration[] = $duration;
    $arr_cancelReason[] = $cancelReason;
    $arr_cancelTime[] = $cancelTime;
    $arr_extRate[] = $extRate;
    $arr_studentID[] = $studentID;
	$arr_teacherID[] = $teacherID;
    $arr_remarks[] = $remarks;
    $arr_classID[] = $classID;
    $arr_dow[] = $dow;
    $arr_rescheduledFrom[] = $rescheduledFrom;
    $arr_internalCost[] = $internalCost;
    $arr_classType[] = $classType;
    $arr_costType[] = $costType;
	$arr_fromStudentCreditID[] = $from_studentCreditID;
	$arr_toStudentCreditID[] = $to_studentCreditID;
    $arr_userID[] = $userID;
	$arr_userName[] = $userName;
	$arr_timestamp[] = $timestamp;
	
	list($yyyy, $mm, $dd) = split('[/.-]', $classDate);
    $thisEntryMth  = date("m", mktime(0, 0, 0, $mm ,$dd, $yyyy));

//    $classDateTS = mktime(0,0,0,$mm,$dd,$yyyy));
//    $todayTS = mktime(0,0,0,date("m"), date("d"), date("Y"));
		
	// if to_student_id is not null, this is either a W or T entry, get remaining minutes
	$minute_balance = 0;
	if ( $cancelReason == "W" || $cancelReason == "T" ) {
	  $query = "SELECT minute_balance from student_credit_minutes " .
	           "WHERE student_credit_id = $to_studentCreditID";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
	}
    $arr_minuteBalance[] = $minute_balance;

    $headerMth = $yyyy . "-" . $mm;
	if ( $listMth == "" ) {
	   rowHeader($j, $headerMth, $student_id, $fullname, $startdate, $enddate, $cname);
	   $listMth = $thisEntryMth;
	}
	if ( $listMth <> $thisEntryMth ) {
      $bottom =<<<EOD
      <tr bgcolor="#FFFFD7">
        <td height="15" colspan="12" nowrap="nowrap" bgcolor="#FFFFFF">No. of lessons: $classCnt</td>
      </tr>
EOD;
      echo "$bottom";
	  $classCnt = 0;
	  rowHeader ($j, $headerMth, $student_id, $fullname, $startdate, $enddate, $cname);
	  $listMth = $thisEntryMth;
	} 
	require ('class_schedule_row_entry.php');
	$j += 1;

	//jng -- bug in cancelReason <> "CXL" !! -- missing '$' in front of cancelReason
	if ( $cancelReason <> "W" && $cancelReason <> "T" && $cancelReason <> "CXL" ) $classCnt += 1;  // only count not cancelled entries
  }

// display lesson count for the last month
$bottom =<<<EOD
      <tr bgcolor="#FFFFD7">
        <td height="15" colspan="12" nowrap="nowrap" bgcolor="#FFFFFF">No. of lessons: $classCnt</td>
      </tr>
EOD;
      echo "$bottom";

}
?>
  </table>

<! create hidden form fields to store current class entry data -->
<input name="start_date" type="hidden" id="start_date" value="<?php echo "$startdate"; ?>" />  
<input name="end_date" type="hidden" id="end_date" value="<?php echo "$enddate"; ?>" />  
<input name="fullName" value="fullName" type="hidden" id="fullName" />  
<input name="teacherName" type="hidden" id="teacherName" />  
<input name="courseID" type="hidden" id="courseID" />
<input name="courseName" type="hidden" id="coursName" />  
<input name="grade" type="hidden" id="grade" />  
<input name="classDate" type="hidden" id="classDate" />  
<input name="classTime" type="hidden" id="classTime" />  
<input name="duration" type="hidden" id="duration" />  
<input name="cancelReason" type="hidden" id="cancelReason" />  
<input name="cancelTime" type="hidden" id="cancelTime" />  
<input name="extRate" type="hidden" id="extRate" />  
<input name="studentID" type="hidden" id="studentID" />  
<input name="teacherID" type="hidden" id="teacherID" />  
<input name="remarks" type="hidden" id="remarks" />  
<input name="classID" type="hidden" id="classID" />  
<input name="dow" type="hidden" id="dow" />  
<input name="rescheduledFrom" type="hidden" id="rescheduledFrom" />  
<input name="internalCost" type="hidden" id="internalCost" />  
<input name="classType" type="hidden" id="classType" />  
<input name="costType" type="hidden" id="costType" />  
<input name="fromStudentCreditID" type="hidden" id="fromStudentCreditID" />  
<input name="toStudentCreditID" type="hidden" id="toStudentCreditID" />  
<input name="chequeno" type="hidden" id="chequeno" />  
<input name="chequeholder" type="hidden" id="chequeholder" />  
<input name="minuteBalance" type="hidden" id="minuteBalnce" />  
<input name="userID" type="hidden" id="userID" />  
<input name="userName" type="hidden" id="userName" />  
<input name="timestamp" type="hidden" id="timestamp" />  

 
</form>
<?php
if ( $action <> "" && $totalRows_classes > 0 ) {
$impfullName = implode("|", $arr_fullName);
echo "<script>document.form2.fullName.value=\"$impfullName\"; </script>";
$impteacherName = implode("|", $arr_teacherName);
echo "<script>document.form2.teacherName.value=\"$impteacherName\"; </script>";
$impcourseID = implode("|", $arr_courseID);
echo "<script>document.form2.courseID.value=\"$impcourseID\"; </script>";
$impcourseName = implode("|", $arr_courseName);
echo "<script>document.form2.courseName.value=\"$impcourseName\"; </script>";
$impgrade = implode("|", $arr_grade);
echo "<script>document.form2.grade.value=\"$impgrade\"; </script>";
$impclassDate = implode("|", $arr_classDate);
echo "<script>document.form2.classDate.value=\"$impclassDate\"; </script>";
$impclassTime = implode("|", $arr_classTime);
echo "<script>document.form2.classTime.value=\"$impclassTime\"; </script>";
$impduration = implode("|", $arr_duration);
echo "<script>document.form2.duration.value=\"$impduration\"; </script>";
$impcancelReason = implode("|", $arr_cancelReason);
echo "<script>document.form2.cancelReason.value=\"$impcancelReason\"; </script>";
$impcancelTime = implode("|", $arr_cancelTime);
echo "<script>document.form2.cancelTime.value=\"$impcancelTime\"; </script>";
$impextRate = implode("|", $arr_extRate);
echo "<script>document.form2.extRate.value=\"$impextRate\"; </script>";
$impstudentID = implode("|", $arr_studentID);
echo "<script>document.form2.studentID.value=\"$impstudentID\"; </script>";
$impteacherID = implode("|", $arr_teacherID);
echo "<script>document.form2.teacherID.value=\"$impteacherID\"; </script>";
$impremarks = implode("|", $arr_remarks);
echo "<script>document.form2.remarks.value=\"$impremarks\"; </script>";
$impclassID = implode("|", $arr_classID);
echo "<script>document.form2.classID.value=\"$impclassID\"; </script>";
$impdow = implode("|", $arr_dow);
echo "<script>document.form2.dow.value=\"$impdow\"; </script>";
$imprescheduledFrom = implode("|", $arr_rescheduledFrom);
echo "<script>document.form2.rescheduledFrom.value=\"$imprescheduledFrom\"; </script>";
$impinternalCost = implode("|", $arr_internalCost);
echo "<script>document.form2.internalCost.value=\"$impinternalCost\"; </script>";
$impclassType = implode("|", $arr_classType);
echo "<script>document.form2.classType.value=\"$impclassType\"; </script>";
$impcostType = implode("|", $arr_costType);
echo "<script>document.form2.costType.value=\"$impcostType\"; </script>";
$impfromStudentCreditID = implode("|", $arr_fromStudentCreditID);
echo "<script>document.form2.fromStudentCreditID.value=\"$impfromStudentCreditID\"; </script>";
$imptoStudentCreditID = implode("|", $arr_toStudentCreditID);
echo "<script>document.form2.toStudentCreditID.value=\"$imptoStudentCreditID\"; </script>";
$impminuteBalance = implode("|", $arr_minuteBalance);
echo "<script>document.form2.minuteBalance.value=\"$impminuteBalance\"; </script>";
$impuserID = implode("|", $arr_userID);
echo "<script>document.form2.userID.value=\"$impuserID\"; </script>";
$impuserName = implode("|", $arr_userName);
echo "<script>document.form2.userName.value=\"$impuserName\"; </script>";
$imptimestamp = implode("|", $arr_timestamp);
echo "<script>document.form2.timestamp.value=\"$imptimestamp\"; </script>";
}
?>

</body>
</html>
<?php
mysql_free_result($teacher);
if ( $totalRows_classes > 0 ) mysql_free_result($classes);
// mysql_free_result($course_names);
?>
