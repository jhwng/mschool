<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);

// action = 1 - retrieve payment schedule via POST
// action = 2 - update payment schedule (from adhoc_payments_trailer's form submit "Update Ad-hoc Payments" button)
// action = 3 - get course list only
// action = 4 - retrieve payment schedule via GET

//Bjng
$startdate = "";
$fullname = "";
$course_id = "";
$courseName = "";
$student_id = "";
$numRows = 0;
$numRows_schedule = 0;
$getNextOrPrevYearAct=0;

$paymentID = 0;
$userID = "";
$userName = "";
$timestamp = "";

//Ejng

//Bjng
if ( isset($_REQUEST['getNextYear']) || isset($_REQUEST['getPrevYear']) ){
  $startdate = $_POST['start_date'];
  $enddate=$_POST['end_date'];
  //echo "start: $startdate ";
  //echo "end: $enddate ";

  $startdate_array=date_parse($startdate);
  $enddate_array=date_parse($enddate);

  //if ($action == "next_year") {
  if (isset($_REQUEST['getNextYear'])) {
    //echo "getNextYear ";
    $startYear = $startdate_array['year'] + 1;
    $endYear = $enddate_array['year'] + 1;
  }
  else { // prev_year
    //echo "getPrevYear ";
    $startYear = $startdate_array['year'] - 1;
    $endYear = $enddate_array['year'] - 1;
  }

  $start_month_day=strstr($startdate, '-');
  $end_month_day=strstr($enddate, '-');

  /* Just need to set $startdate and $enddate here. The other vars like
   * $fullname, $courseName, etc are set in the logic below since $action
   * is still "searchclasses".
   */
  $startdate = $startYear . $start_month_day;
  $enddate = $endYear . $end_month_day;

  //echo "start: $startdate ";
  //echo "end: $enddate ";

  $getNextOrPrevYearAct = 1;
}
//Ejng

$action=isset($_GET['action']) ? $_GET['action'] : "";

if ( $action <> "" ) {
  if ( $action <> 4 ) {
    $fullname=$_POST['full_name'];
    $courseName=isset($_POST['course_name']) ? $_POST['course_name'] : "";
    $schyear=isset($_POST['school_year']) ? $_POST['school_year'] : "";

    if ($getNextOrPrevYearAct == 0 ) { //jng
      $startdate = $_POST['start_date'];
      $enddate = $_POST['end_date'];

      // Bjng
      // Set/initialize a "session" course for subsequent get-prev-year or get-next-year "session".
      // Note that the following cases trigger an "internal click" of the "Retrieve Payments" button,
      // which in turn triggers a form action=1:
      //  - action=2
      //  - action=3 (and student only has 1 registered class)
      //  - action=4
      //  - user selected an item from drop-down "Course" list
      // So handling "action=1" only is sufficient.
      if ($action == 1) {
        if ($courseName != "" && $courseName != "0") {
          $_SESSION['getPrevOrNextYearSessionCourse_adhocPay'] = $courseName;
        }
      }
    }
    else if (isset($_SESSION['getPrevOrNextYearSessionCourse_adhocPay'])){
      // If we're handling a get-prev-year or get-next-year flow and
      // no session course name is set yet because the previous page
      // (ie, either following or previous year) had > 1 courses, then
       // reset $courseName since it's POSTed from previuos page and
      // may not apply here. On the other hand, if the session course
      // is set let's set $courseName to that to continue the session.
      if ($_SESSION['getPrevOrNextYearSessionCourse_adhocPay'] == "") {
        $courseName = "";
      } else {
        $courseName = $_SESSION['getPrevOrNextYearSessionCourse_adhocPay'];
      }
    }

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
else { // jng
  // Reset per-year-session course name if no action is specified (ie, first landing on this page)
  $_SESSION['getPrevOrNextYearSessionCourse_adhocPay'] = "";
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
<title>Ad-hoc Payments</title>

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
    <td width="606" valign="middle"><div align="center"><span class="style2">Ad-hoc Payments</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<table width="815" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="815"><div align="center">
      <form id="form1" name="form1" method="post" action="adhoc_payments.php">
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
		 if ( $courseName == $courseName1 || $action == 3 ) {
		   echo 'selected="selected"';

           // Set the chosen course as the subsequent get-prev-year or
           // get-next-year session course name.
           $_SESSION['getPrevOrNextYearSessionCourse_adhocPay'] = $courseName1;
		 }
		 else {
           // Bjng
           // If we're doing get prev/next year but there's no course name set
           // (either because the previous page had no course or more than 1 course)
           // and this is the only course available, set it as get-year-session course name.
           if ($getNextOrPrevYearAct == 1 && $numRows == 1 && $courseName == "") {
             $courseName = $courseName1;
             $_SESSION['getPrevOrNextYearSessionCourse_adhocPay'] = $courseName1;
           }
           //Ejng
         }
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
   onclick='document.form1.action="adhoc_payments.php?action=3"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Get Course List"/>
&nbsp;&nbsp;&nbsp;<input name="retrieve" type="submit" class="btn" id="retrieve"
   onclick='document.form1.action="adhoc_payments.php?action=1"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Retrieve Payments"/>
            </div></td>
          </tr>
          <tr>
            <table width="772">
            <tr>
            <td width="50"></td>
            <td width="50"></td>
            <td><div align="left">
              <input name="getPrevYear" type="submit" class="btn" id="getPrevYear"
                onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Prev Year"
                onclick='document.form1.action="adhoc_payments.php?action=1"; return true;' />
              <input name="getNextYear" type="submit" class="btn" id="getNextYear"
                onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Next Year"
                onclick='document.form1.action="adhoc_payments.php?action=1"; return true;' />

              <!--input name="numCoursesInPrevPage" type="hidden" id="num_courses_prev_page" value="<?php /*echo $numRows;*/ ?>" /--> <!--//jng-->
            </div></td>
            </tr>
            </table>
          </tr>
        </table>
          </div>
      </form>
    </div></td>
  </tr>
</table>

<?php
// if student only have 1 course registered, retrieve ad-ho payment  right away
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
    $row = mysql_fetch_array($result);
    if ($row) { //jng
      extract($row);
    }
    else {
      if ($courseName === "") {
        $class_not_found_msg="No registered class found.";
      }
      else {
        $class_not_found_msg="No registered class found for <span class=\"red_blink\">$courseName</span>. &nbsp; Choose another course and click Retrieve.";
      }

      echo "
        <table width='815' height='40' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='83'>&nbsp;</td>
            <td width='606' valign='middle'><div align='center'><span class='style2'>$class_not_found_msg</span></div></td>
            <td width='61'>&nbsp;</td>
          </tr>
        </table>";

      echo "<br><br>";
    }

    // now retrieve adhoc_payments entries
    list ($sYYYY, $sMth, $dd) = split('-', $startdate);
    $startMonth = $sYYYY . "-" . $sMth;
    list ($eYYYY, $eMth, $dd) = split('-', $enddate);
    $endMonth = $eYYYY . "-" . $eMth;
    $firstDayOfYear = date("Y-m-d", mktime(0, 0, 0, 7, 1, $fromYear));
    $lastDayOfYear = date("Y-m-d", mktime(0, 0, 0, 6, 30, $toYear));

    // multiple reference by 1 so as to convert it from varChar to numeric for sorting purpose
    $query = "SELECT payment_id, date, amount, cheque_num, cheque_name, " .
            "payment_method, remarks, reference * 1 as monthAllocate, adhoc_payments.user_id, user_name, " .
            "DATE_FORMAT(adhoc_payments.timestamp,'%Y-%m-%d %H:%i') " .
            "FROM adhoc_payments, user " .
            "WHERE adhoc_payments.user_id = user.user_id " .
            "AND student_id=$student_id AND course_id=$course_id " .
            // "AND date BETWEEN \"$firstDayOfYear\" AND \"$lastDayOfYear\" " .
            // "AND date >= \"$firstDayOfYear\" " .
            // "AND date >= \"$startdate\" " .
            "AND school_year = \"$schYear\" " .
            "ORDER BY date, monthAllocate;";
    // echo "$query<br>";
    $result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows_schedule = mysql_num_rows($result);

    if ($numRows_schedule > 0) {
      // setup arrary to display dow
      $dayOfWeek[0] = "Sun";
      $dayOfWeek[1] = "Mon";
      $dayOfWeek[2] = "Tue";
      $dayOfWeek[3] = "Wed";
      $dayOfWeek[4] = "Thu";
      $dayOfWeek[5] = "Fri";
      $dayOfWeek[6] = "Sat";

      require('adhoc_payments_header_row.php');

      $j = 0;
      while (list ($paymentID, $date, $amount, $chqNum, $chqName, $paymentMethod, $remarks, $ref, $userID, $userName, $timestamp) = mysql_fetch_row($result)) {
        if ($ref == 0) $ref = "";
          require('adhoc_payments_row_entry.php');
        $j += 1;
      }  // End while
    } // if ($num_Rows_schedule > 0)

	// Display 10 blank form lines for adding new entry
	$date = "";
	$amount = 0;
	$chqNum = "";
	$chqName = "";
	$paymentMethod = "";
	$remarks = "";
	$ref = "";
	$userName="&nbsp;";
	$timestamp="&nbsp;";
	$i = 1;

    //Bjng
    if (!isset($j)) {
      // setup arrary to display dow
      $dayOfWeek[0] = "Sun";
      $dayOfWeek[1] = "Mon";
      $dayOfWeek[2] = "Tue";
      $dayOfWeek[3] = "Wed";
      $dayOfWeek[4] = "Thu";
      $dayOfWeek[5] = "Fri";
      $dayOfWeek[6] = "Sat";

      require('adhoc_payments_header_row.php');
      $j = 0;
    }
    //Ejng

    while ( $i <= 5 ) {
	  require ('adhoc_payments_row_entry.php');
	  $i += 1;
	  $j += 1;
	}
  }
}  // End if action = 1

if ( $action == 2 ) {
  $numRows_schedule = $_POST['num_entries'];
  $j = 0;
  require ('adhoc_payments_header_row.php');

  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( $j <= $numRows_schedule + 4 ) {
    $del = "delete" . $j;
    $delete = $_POST["$del"];
    $payID = "payment_id" . $j;
    $paymentID = $_POST["$payID"];
    $cDate = "date" . $j;
    $date = $_POST["$cDate"];
    $amt = "amount" . $j;
    $amount = $_POST["$amt"];
    $cNum = "chq_num" . $j;
    $chqNum = $_POST["$cNum"];
    $cName = "chq_name" . $j;
    $chqName = $_POST["$cName"];
    $pMethod = "payment_method" . $j;
    $paymentMethod = $_POST["$pMethod"];
    $rmk = "remarks" . $j;
    $remarks = $_POST["$rmk"];
    $refx = "ref" . $j;
    $ref = $_POST["$refx"];
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
      if ( $delete == "delete" && $paymentID > 0 ) {
        $query = "DELETE FROM adhoc_payments " .
		   "WHERE payment_id = $paymentID;";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	  else {
	    $query = "UPDATE adhoc_payments SET " .
           "date=\"$date\", reference=\"$ref\", " .
		   "amount=$amount, cheque_num=\"$chqNum\", cheque_name=\"$chqName\", " .
		   "payment_method=\"$paymentMethod\", remarks=\"$remarks\", user_id = $thisUserID " .
		   "WHERE payment_id = $paymentID;";
        echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	 } // end if update = 1
	}
	else {   // Insert new record for the last entry
      if ( $date <> "" ) {
	    $query = "INSERT INTO adhoc_payments " .
		     "(student_id, course_id, date, amount, " .
			 "cheque_num, cheque_name, payment_method, remarks, reference, school_year, user_id ) VALUES " .
			 "($student_id, $course_id, \"$date\", $amount, " .
 			 "\"$chqNum\", \"$chqName\", \"$paymentMethod\", \"$remarks\", \"$ref\", \"$schYear\", $thisUserID );";
        // echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	}  
    require ('adhoc_payments_row_entry.php');
    $j += 1;
  } // end while
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  echo "<script>document.form1.retrieve.click()</script>";
     
}  // End action = 2
       
if ( $numRows_schedule > 0 ) {
$aaa =<<<EOD
	  </table>
		</td>
			<td>&nbsp;</td>
	</tr>
	</table>
EOD;
echo $aaa;
}

if ($course_id <> "" ) require ('adhoc_payments_trailer.php');

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
