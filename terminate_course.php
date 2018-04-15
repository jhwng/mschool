<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_teacher = "SELECT teacher FROM teacher where active = 'Y' or active is NULL or active = '' ORDER BY teacher";
$teacherList = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacherList);
$totalRows_teacher = mysql_num_rows($teacherList);

// action = 1 - retrieve via POST
// action = 2 - terminate course
// action = 3 - get course list only
// action = 4 - retrieve  via GET

$action=$_GET['action'];
if ( $action <> "" ) {
  if ( $action <> 4 ) {
    $fullname=$_POST['full_name'];
    $courseName=$_POST['course_name'];
    $startdate=$_POST['start_date'];
    $enddate=$_POST['end_date'];
	$grade=$_POST['grade'];
	$external_rate=$_POST['ext_rate'];
	$internal_cost=$_POST['internal_cost'];
	$cost_type=$_POST['cost_type'];
    $time=$_POST['time'];
    $duration=$_POST['duration'];
    $student_id=$_POST['student_id'];
    $course_id=$_POST['course_id'];
	$lastDate=$_POST['last_date'];
	$remarks=$_POST['remarks'];
	$teacher=$_POST['teacher'];
	$dow=$_POST['dow'];
	$status=$_POST['status'];
  }
  else {
    $fullname=$_GET['full_name'];
    $startdate=$_GET['start_date'];
    $enddate=$_GET['end_date'];
    $student_id=$_GET['student_id'];
	$courseName=$_GET['course_name'];
  }

  // echo "courseName = $courseName<br>";
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

if ( $action == 1 || $action == 4 ) {
  $query = "SELECT teacher.teacher as teacher, student_registered_classes.grade, " .
           "student_registered_classes.duration, student_registered_classes.time, " .
		   "student_registered_classes.external_rate, student_registered_classes.dow, " .
		   "student_registered_classes.internal_cost, student_registered_classes.cost_type, " .
		   "student_registered_classes.start_date as fromDate, student_registered_classes.end_date as toDate, " .
		   "student_registered_classes.status,  " .
		   "student_registered_classes.start_date as startdate, student_registered_classes.end_date as enddate " .
           "FROM teacher, student_registered_classes " . 
		   "WHERE student_registered_classes.teacher_id=teacher.teacher_id " .
		   "AND student_registered_classes.student_id=$student_id " .
		   "AND student_registered_classes.course_id=$course_id " .
		   "AND student_registered_classes.school_year=\"$schYear\";";
  // echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Course Termination</title>

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
    <td width="606" valign="middle"><div align="center"><span class="style2">Course Termination</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<table width="815" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="815"><div align="center">
      <form id="form1" name="form1" method="post" action="terminate_course.php">
        <div align="center">
          <table width="772" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="772" height="25" valign="middle"><div align="center"> Student Full Name:
                <input name="full_name" type="text" id="full_name" size="30" maxlength="60"
		  <?php if ($fullname <> "") echo "VALUE=\"" . $fullname . "\";" ?> />
                &nbsp;&nbsp;
                <input name="submit2" type="button" class="btn" id="submit2" onclick="studentNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Name Search"/>
                &nbsp;&nbsp;&nbsp;Course:
                <select name="course_name" class="dropdowntext" id="course_name" onChange='document.form1.retrieve.click()' >
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
              </div></td>
            </tr>
            <tr>
              <td height="25" valign="middle"><div align="center">
                  <input name="student_id" type="hidden" id="student_id" 
		  <?php if ( $student_id <> "" ) { echo "VALUE=\"$student_id\""; } ?> />
                  <input name="course_id" type="hidden" id="course_id" 
		  <?php if ( $course_id <> "" ) { echo "VALUE=\"$course_id\""; } ?> />
                Start Date:
                <input name="start_date" type="text" id="start_date" size="12" maxlength="12" <?php if ($startdate <> "") echo "VALUE=\"" . $startdate . "\""; ?> onchange='checkDateFormat(form, this)' />
                &nbsp;&nbsp;&nbsp;End Date:
                <input name="end_date" type="text" id="end_date" size="12" maxlength="12" <?php if ($enddate <> "") echo "VALUE=\"" . $enddate . "\""; ?> onchange='checkDateFormat(form, this)' />
                &nbsp;&nbsp;&nbsp;
                <input name="getlist" type="submit" class="btn" id="getlist" 
   onclick='document.form1.action="terminate_course.php?action=3"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Get Course List"/>
&nbsp;&nbsp;&nbsp;
<input name="retrieve" type="submit" class="btn" id="retrieve" 
   onclick='document.form1.action="terminate_course.php?action=1"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Retrieve Course Details"/>
              </div></td>
            </tr>
            <tr>
              <td height="25" valign="middle">&nbsp;</td>
            </tr>
          </table>
        </div>

<?php
// if student only have 1 course registered, retrieve course details right away
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

if ( $action <> 3 && $action <> "" ) {
   require ('terminate_course_form.php');
   echo "<script>document.courseform.course_name.value=\"$courseName\"; " .
       "document.courseform.course_id.value=\"$course_id\"; " .
	   "document.courseform.student_id.value=\"$student_id\"; " .
	   "document.courseform.full_name.value=\"$fullname\"; " .
	   "document.courseform.start_date.value=\"$startdate\"; " .
	   "document.courseform.end_date.value=\"$enddate\"; " .
       "</script>";
}

$error = 0;
if ( $action == 2 ) {
 if ( $lastDate == "" ) {
  $error = 1;
  echo "<script>alert ('Please specify Last Date');</script>";
 }
 else {
  list($yyyy, $mm, $dd) = split('[/.-]', $lastDate);
  if ( $mm >= 7 && $mm <= 12 ) {
    $fromYear = $yyyy;
    $toYear = $yyyy + 1;
  }
  else {
    $fromYear = $yyyy - 1;
    $toYear = $yyyy;
  }
  $schYear1 = $fromYear . "-" . $toYear;
  if ( $schYear <> $schYear1 ) {
    echo "<script>alert ('Last Date is not within the School Year');</script>";
	$error = 1;
  }
 }
 
 if ( $error == 0 ) {
  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
	  
  // get teacher_id
  $query = "SELECT teacher_id FROM teacher " .
           "WHERE teacher = \"$teacher\";";
  // echo $query . "<br>"; 
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  
  // reverse minute_balance of MT and MW classes from LastDay + 1
  list ($yyyy, $mm, $dd) = split('[/.-]', $lastDate);
  $timeStamp1 = mktime(12,0,0,$mm,$dd,$yyyy);
  $eDateTS = mktime(12, 0, 0, date("m", $timeStamp1), date("d", $timeStamp1)+1, date("Y", $timeStamp1));;
  $eDate = date ('Y-m-d', $eDateTS);
  
  $query = "SELECT class_id, duration, class_type, from_student_credit_id FROM class_schedule " .
    "WHERE student_id=$student_id AND course_id=$course_id AND " .
	"(class_type = 'MW' OR class_type = 'MT' ) AND " .
	"date BETWEEN \"$eDate\" AND \"$enddate\" ";
  // echo "$query<br>";
  $resultList = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( list ($classID, $cDuration, $classType, $fromStudentCreditID) = mysql_fetch_row($resultList)) {
    $query = "SELECT minute_balance FROM student_credit_minutes " .
	   "WHERE student_credit_id = $fromStudentCreditID";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $row = mysql_fetch_array($result);
    extract($row);
	//echo "bal=$minute_balance, duration=$cDuration<br>";
	
	$minute_balance += $cDuration;
	$query = "UPDATE student_credit_minutes SET " .
	  "minute_balance=$minute_balance WHERE student_credit_id=$fromStudentCreditID";
    //echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
  }  // end while
  	
  // For W and T classes beyond lastday+1, set minute_balance = 0 in
  // corresponding student_credit_minutes entries
  $query = "SELECT to_student_credit_id FROM class_schedule " .
       "WHERE student_id=$student_id AND course_id=$course_id AND " .
	   "to_student_credit_id > 0 AND " .
	   "date BETWEEN \"$eDate\" AND \"$enddate\" ";
  // echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);

  if ( $numRows > 0 ) {
	while ( list ($toStudentCreditID) = mysql_fetch_row($result)) {
      $query = "UPDATE student_credit_minutes SET " .
	     "minute_balance=0, remarks='terminated' " .
	     "WHERE student_credit_id = $toStudentCreditID";
      echo "$query<br>";
	  $result1 = mysql_query($query, $promusic) or die(mysql_error());
		 
    }  // end while
  }  // end if numRows > 0
  
  // delete all class_scedule entries beyond LastDay + 1
  $query = "DELETE FROM class_schedule " .
       "WHERE student_id=$student_id AND course_id=$course_id AND " .
	   "date BETWEEN \"$eDate\" AND \"$enddate\" ";
  //echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());

  $query = "UPDATE student_registered_classes SET " .
    "end_date=\"$lastDate\", " .
	// "dow=$dow, time=\"$time\", duration=\"$duration\", grade=\"$grade\", " .
	// "external_rate=$external_rate, internal_cost=$internal_cost, cost_type=\"$cost_type\", " .
	"status=\"*** TERMINATED ***\", remarks=\"$remarks\" " .
	"WHERE student_id=$student_id AND course_id=$course_id AND school_year=\"$schYear\" ";
  //echo "$query<br>";
  $result = mysql_query($query, $promusic) or die(mysql_error());
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  echo "<script>alert ('Course terminated, check class schedule to verify');</script>";

 }  // end error = 0
}   // end action = 2

?>
    </body>
</html>