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

<body>

<?php
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
/*
action = 1 - Create new student, new account and new course
action = 2 - Only create a new course for the student
*/
$action = $_GET['action'];
$submit = $_POST['submit'];
$newaccount = isset($_POST['newaccount']) ? $_POST['newaccount'] : ""; //jng
$parents_names = $_POST['parents_names'];
$addr1 = $_POST['addr1'];
$addr2 = $_POST['addr2'];
$city = $_POST['city'];
$province = $_POST['province'];
$postal_code = $_POST['postal_code'];
$home_tel = $_POST['home_tel'];
$mother_work_tel = $_POST['mother_work_tel'];
$mother_cell_tel = $_POST['mother_cell_tel'];
$father_work_tel = $_POST['father_work_tel'];
$father_cell_tel = $_POST['father_cell_tel'];
$parents_email = $_POST['parents_email'];
$full_name = $_POST['full_name'];
$name_tie_breaker = $_POST['name_tie_breaker'];
$birthdate = $_POST['birthdate'];
$sex = $_POST['sex'];
$language = $_POST['language'];
$student_email = $_POST['student_email'];
$enrollment_date= $_POST['enrollment_date'];
$discount= $_POST['discount'];
$discount_expiry_date = $_POST['discount_expiry_date'];
$related_friends = $_POST['related_friends'];
/*if (isset($_POST['related_friends'])) {
  $related_friends_str = urlencode("$related_friends");
}
*/
if (isset($_POST['group_lessons'])) {
  $group_lessons_str = implode(";", $_POST['group_lessons']);
}
$course_name = $_POST['course_name'];
$grade = $_POST['grade'];
$selected_teacher = $_POST['teacher'];
$time = $_POST['time'];
$duration = $_POST['duration'];
$ext_rate = $_POST['ext_rate'];
$internal_cost = $_POST['internal_cost'];
$internal_cost_override = $_POST['internal_cost_override']; //jng
$cost_type = $_POST['cost_type'];
$cost_type_override = $_POST['cost_type_override']; //jng
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$cheque_no = $_POST['cheque_no'];
$cheque_holders = $_POST['cheque_holders'];
$submit = $_POST['submit'];
$holidayList = ""; //jng

require('student_create_form.php'); //jng - why running this form again?

$error=0;

mysql_select_db($database_promusic, $promusic);

// validate start_date and end_date range
list($yyyy, $mm, $dd) = split('[/.-]', $start_date);
if ( $mm >= 7 && $mm <= 12 ) {
  $startYear = $yyyy;
}
else {
  $startYear = $yyyy - 1;
}

list($yyyy, $mm, $dd) = split('[/.-]', $end_date);
if ( $mm >= 7 && $mm <= 12 ) {
  $endYear = $yyyy;
}
else {
  $endYear = $yyyy - 1;
}

if ( $startYear <> $endYear ) {
  $error = 1;
  echo "<script>alert ('Start Date and End Date CANNOT span across 2 school years');document.form1.start_date.select()</script>";
}

If ( $error == 0 ) {
/* Check if account already existed in database */

$query_check_account = "SELECT parents_names, home_tel from account " .
  "WHERE home_tel = \"$home_tel\" AND parents_names = \"$parents_names\"";
//echo $home_tel . "<br>";
//echo $parents_names . "<br>";
//echo $query_check_account . "<br>";
//echo "row = $totalRows_account <br>";

$check_account = mysql_query($query_check_account, $promusic) or die(mysql_error());
$totalRows_account = mysql_num_rows($check_account);
/* User said create new account */
//jng - if ( ($_POST['newaccount'] == "yes" ) && $totalRows_account > 0 ) {
if ( ($newaccount == "yes" ) && $totalRows_account > 0 ) {
    $error=1;
	echo "<script>alert('Account Already Exist - Parents Names and Home Phone already exist in database');window.document.form1.parents_names.select(); </script>";
}

/* User said Don't create account, or add course only */
if ( (!ISSET($_POST['newaccount']) || $action == 2 ) && $totalRows_account == 0 ) {
  $error = 1;
  echo "<script>alert('Parents Names and Home Phone do NOT exist, New Account?'); window.document.form1.parents_names.select();</script>";
}

/* Check if Student already existed in account. Student should NOT exist in db */
if ( !ISSET($_POST['newaccount']) && $totalRows_account > 0  && $action <> 2 ) {
  $query_check_student = "SELECT student.full_name, student.name_tie_breaker, account.parents_names, account.home_tel FROM student INNER JOIN account ON student.account_id = account.account_id
WHERE (((student.full_name)=\"$full_name\") AND ((student.name_tie_breaker)=\"$name_tie_breaker\") AND ((account.parents_names)=\"$parents_names\") AND ((account.home_tel)=\"$home_tel\"))";
  $check_student = mysql_query($query_check_student, $promusic) or die(mysql_error());
  $totalRows_student = mysql_num_rows($check_student);
  if ( $totalRows_student > 0 ) {
    $error = 1;
/*
	$urlname=urlencode("$full_name");
	$urltie=urlencode("$name_tie_breaker");
	$urlpnames=urlencode("$parents_names");
	$urlphone=urlencode("$home_tel");
	echo "<script>studentNameConflict(\"$urlname\",\"$urltie\",\"$urlpnames\",\"$urlphone\");</script>";
*/
	echo "<script>window.document.form1.full_name.select(); alert('The student name you want to create is already existed')</script>";
  }
}
}  // end if error = 0

/* Create Account */
//jng - if ( $error == 0 && $_POST['newaccount'] == "yes" ) {
if ( $error == 0 && $newaccount == "yes" ) {
	 $query_account = "INSERT INTO account
     (parents_names, addr1, addr2, city, province, postal_code, home_tel,
     mother_work_tel, mother_cell_tel, father_work_tel, father_cell_tel, parents_email)
	 VALUES ( \"$parents_names\", \"$addr1\", \"$addr2\",
	 \"$city\", \"$province\", \"$postal_code\", \"$home_tel\", \"$mother_work_tel\",
	 \"$mother_cell_tel\", \"$father_work_tel\", \"$father_cell_tel\", \"$parents_email\" )";

    $insert_account = mysql_query($query_account, $promusic) or die(mysql_error());
	echo "<script>alert('Account created, will create Student next...');</script>";
}

if ( $error == 0 ) {
  $pos = strpos($full_name, ",");
  $last_name=substr($full_name,0,$pos);
  $given_name=ltrim(substr($full_name, $pos+1));
//  $enrollment_date = date("Y-m-d", mktime());

/* get account_id for student */
  $query_aid = "SELECT account_id FROM account WHERE parents_names = \"$parents_names\" and home_tel = \"$home_tel\"";
  $account = mysql_query($query_aid, $promusic) or die(mysql_error());
  $row_account = mysql_fetch_array($account);
  extract($row_account);

/* Do not create student if action = 2 */
  if ( $action == 1 ) {
    $query_student = "INSERT INTO student
  (full_name, account_id, name_tie_breaker, birthdate, sex, language, student_email, related_friends, group_lessons, discount, discount_expiry_date, given_name, Last_name, enrollment_date)
  VALUES (\"$full_name\", \"$account_id\", \"$name_tie_breaker\", \"$birthdate\", \"$sex\", \"$language\", \"$student_email\", \"$related_friends\", \"$group_lessons_str\", $discount, \"$discount_expiry_date\", \"$given_name\", \"$last_name\", \"$enrollment_date\")";

	  $insert_student = mysql_query($query_student, $promusic) or die(mysql_error());
  	  echo "<script>alert('Student record created');</script>";
  }


/* Now create student_registered_classes and class_schedule  */
	if ( $course_name <> "None" ) {
      /* find out DOW for startdate */
      list($yyyy, $mm, $dd) = split('[/.-]', $start_date);
      $dow = date("w", mktime(12,0,0,$mm,$dd,$yyyy));
	  
	  /* get school holidays and keep it in a an array */
	  $query = "SELECT date from school_holidays order by date;";
      $holidays = mysql_query($query, $promusic) or die(mysql_error());
      $totalRows_holidays = mysql_num_rows($holidays);
      while ($row = mysql_fetch_assoc ($holidays)) {
        foreach ($row as $val) {
          $holidayList .= $val . "|";
        }
      }

      /* find student_id, discount and discount expiry date */
      $query_studentid = "select student_id, discount, discount_expiry_date from student where full_name = \"$full_name\" and account_id = \"$account_id\";";
	  $result = mysql_query($query_studentid, $promusic) or die(mysql_error());
	  list ( $student_id, $discount, $discount_expiry_date ) = mysql_fetch_row($result);

      /* find teacher_id */
      $query_teacherid = "select teacher_id from teacher where teacher = \"$selected_teacher\";";
	  $result = mysql_query($query_teacherid, $promusic) or die(mysql_error());
	  $row_teacherid = mysql_fetch_array($result);
      extract($row_teacherid);

      /* find course_id */
      $query_courseid = "select course_id from course where course_name = \"$course_name\";";
      $result = mysql_query($query_courseid, $promusic) or die(mysql_error());
      $row_courseid = mysql_fetch_array($result);
      extract($row_courseid);
	  
	  // make sure student has not registered this course with the same school year
	  list($yyyy, $mm, $dd) = split('[/.-]', $start_date);
	  if ( $mm >= 7 && $mm <= 12 ) {
	    $fromYear = $yyyy;
		$toYear = $yyyy + 1;
	  }
	  else {
	    $fromYear = $yyyy - 1;
		$toYear = $yyyy;
	  }
	  $schYear = $fromYear . "-" . $toYear;
	  $query = "SELECT school_year from student_registered_classes " .
	           "where student_id=$student_id and course_id=$course_id and school_year=\"$schYear\"; ";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      $numRows = mysql_num_rows($result);
	  
	  if ( $numRows > 0 ) {
	    echo "<script>alert('Student has already registered this course before')</script>";
	  }
	  else
	  {

      /* calculate discount timestamp */
	  if ( $discount > 0 ) {
    	list($yyyy, $mm, $dd) = split('[/.-]', $discount_expiry_date);
	    $discountTimeStamp = mktime(12,0,0,$mm,$dd,$yyyy);
	  }

	  //Bjng
	  $real_internal_cost=$internal_cost;
      if ($internal_cost_override != "" && is_numeric($internal_cost_override)) {
        $real_internal_cost=$internal_cost_override;
      }

      $real_cost_type=$cost_type;
      if ($cost_type_override == "S" || $cost_type_override == "F") {
        $real_cost_type=$cost_type_override;
      }
	  //Ejng

	  /* Start SQL transaction */
	  $query = "START TRANSACTION;";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
	  
	  /* Create sutdent_registered_classes */
      //jng
      /*$query = "INSERT INTO student_registered_classes
      ( student_id, course_id, grade, teacher_id, start_date, end_date, dow, school_year, time, duration, external_rate, internal_cost, cost_type) VALUES
      ( $student_id, $course_id, \"$grade\", $teacher_id, \"$start_date\", \"$end_date\", \"$dow\", \"$schYear\", \"$time\", \"$duration\", $ext_rate, $internal_cost, \"$cost_type\" ); "; */
      $query = "INSERT INTO student_registered_classes
      ( student_id, course_id, grade, teacher_id, start_date, end_date, dow, school_year, time, duration, external_rate, internal_cost, cost_type) VALUES
      ( $student_id, $course_id, \"$grade\", $teacher_id, \"$start_date\", \"$end_date\", \"$dow\", \"$schYear\", \"$time\", \"$duration\", $ext_rate, $real_internal_cost, \"$real_cost_type\" ); ";
	  //echo "$query<br>"; //jng - looks like it's for debugging only?
	  $result = mysql_query($query, $promusic) or die(mysql_error());
	  
      /* insert class_schedule and student_scheduled_payments entries, do not create entry if the day is a holiday */
	  list($yyyy, $mm, $dd) = split('[/.-]', $start_date);
	  $cTimeStamp = mktime(12,0,0,$mm,$dd,$yyyy);
	  $cDate = $start_date;
	  
	  // prepare variables for inserting scheduled payment entries
	  $lessonCnt = 0;
	  $monthlyFee = 0;
	  $curMth = $yyyy . "-" . $mm;
	  
	  list($yyyy, $mm, $dd) = split('[/.-]', $end_date);
	  $eTimeStamp = mktime(12,0,0,$mm,$dd,$yyyy);
	  $sevendays = (7 * 24 * 60 * 60);

	  while ( $cTimeStamp <= $eTimeStamp ) {
	   if(strstr($holidayList, $cDate) == "" ) { $isHoliday = 0; } else { $isHoliday = 1; }
	    if  ( $cTimeStamp <= $discountTimeStamp ) {
		  $rate = $ext_rate * ( 100 - $discount) / 100;
		}
		else {
		  $rate = $ext_rate;
		}
	  
    	if ( $isHoliday == 0 ) {
	      //jng
		  /*$query_class = "INSERT INTO class_schedule " .
		     "(student_id, course_id, grade, date, time, duration, teacher_id, " .
			 "dow, internal_cost, cost_type, external_rate, user_Id) " .
			 "VALUES (\"$student_id\", \"$course_id\", \"$grade\", \"$cDate\", \"$time\", " .
			 "$duration, \"$teacher_id\",\"$dow\", $internal_cost, \"$cost_type\", $rate, $thisUserID)";*/
		  $query_class = "INSERT INTO class_schedule " .
                "(student_id, course_id, grade, date, time, duration, teacher_id, " .
                "dow, internal_cost, cost_type, external_rate, user_Id) " .
                "VALUES (\"$student_id\", \"$course_id\", \"$grade\", \"$cDate\", \"$time\", " .
                "$duration, \"$teacher_id\",\"$dow\", $real_internal_cost, \"$real_cost_type\", $rate, $thisUserID)";
          // echo $query_class . "<br>";       */
		  $insert_class = mysql_query($query_class, $promusic) or die(mysql_error());
		  $lessonCnt += 1;
		  $monthlyFee = $monthlyFee + ( $rate * $duration / 15 );
		}

		$cTimeStamp = mktime(12, 0, 0, date("m", $cTimeStamp)  , date("d", $cTimeStamp)+7, date("Y", $cTimeStamp));;
		$cDate = date ('Y-m-d', $cTimeStamp);

        // insert scheduled_payment entry if next class entry is a new month
		$nextMth = date ('Y-m', $cTimeStamp);
		// echo "curMth = $curMth,  nextMth = $nextMth<br>";
		if ( $curMth <> $nextMth || $cTimeStamp > $eTimeStamp ) {
          //Bjng
          //$chq_date = $curMth . "-01";
          if (intval(date("m", strtotime($curMth))) != 1) {
              $chq_date_mth = date("Y", strtotime($curMth)) . "-" . strval(intval(date("m", strtotime($curMth)))-1);
          }
          else {
              $chq_date_mth = strval(intval(date("Y", strtotime($curMth)))-1) . "-12";
          }
          $chq_date = $chq_date_mth . "-15";
          //Ejng

	      $query = "INSERT INTO student_scheduled_payments " .
		     "(student_id, month, amount, number_of_lessons, duration, external_rate, " .
			 "course_id, cheque_date, school_year, user_id ) VALUES " .
			 "($student_id, \"$curMth\", $monthlyFee, $lessonCnt, $duration, $rate, " .
			 "$course_id, \"$chq_date\", \"$schYear\", $thisUserID );";
		  // echo "$query<br>";
		  $result = mysql_query($query, $promusic) or die(mysql_error());
		  $lessonCnt = 0;
		  $monthlyFee = 0;
		  $curMth = $nextMth;
	    }
	  }     /* end while */
	  
	  /* Commit Transactions  */
	  $query = "COMMIT;";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
	  
      $url =  "class_schedule.php?action=newcourse";
	  $url .= "&student_id=" . $student_id . "&home_tel=" . "$home_tel";
      $url .= "&fullname=" . urlencode($full_name) . "&coursename=" . urlencode($course_name);
      $url .= "&startdate=" . $start_date . "&enddate=" . $end_date;
      $url .= "&chequeno=" . $cheque_no . "&chequeholder=" . urlencode("$cheque_holders");
      echo '<script>window.location.href="' . $url . '";</script>';   
      } /* end else if student has already registered this course */
	}
}

?>
</body>
</html>
