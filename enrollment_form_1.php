<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);

// action = 1 - retrieve payment schedule via POST
// action = 2 - update payment schedule
// action = 3 - get course list only
// action =4 - retrieve payment schedule via GET

$action=$_GET['action'];
$studentID=$_GET['student_id'];
$startDate=$_GET['start_date'];
$endDate=$_GET['end_date'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Enrollment Form</title>
<script type="text/javascript" src="checkform.js"> </script>

<link href="enrollment_form.css" rel="stylesheet" type="text/css" />
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
div.break {page-break-before: always}
</style>

</head>

<body>
<?php
	$dayOfWeek[0] = "Sun";
	$dayOfWeek[1] = "Mon";
	$dayOfWeek[2] = "Tue";
	$dayOfWeek[3] = "Wed";
	$dayOfWeek[4] = "Thu";
	$dayOfWeek[5] = "Fri";
    $dayOfWeek[6] = "Sat";

if ( $startDate == "" ) {
   $curMth = date("m");
   $curYear = date("Y");
   if ( $curMth >= 7 && $curMth <= 12 ) {
     
     $startDate = $curYear . "-07-01";
	 $endDate = $curYear + 1;
	 $endDate .= "-06-30";
   }
   else {
     $startDate = $curYear - 1;
	 $startDate .= "-07-01";
	 $endDate = $curYear . "-06-30";

   }
}

list($yyyy, $mm, $dd) = split('[/.-]', $startDate);
if ( $mm >= 7 && $mm <= 12 ) {
  $fromYear = $yyyy;
  $toYear = $yyyy + 1;
}
else {
  $fromYear = $yyyy - 1;
  $toYear = $yyyy;
}
$schYear = $fromYear . "-" . $toYear;

$sectionCnt = 1;
include 'enrollment_form_header.php';

// get student's account_id
$query = "SELECT account_id from student where student_id = $studentID";
//echo "$query<br>";
$result = mysql_query($query, $promusic) or die(mysql_error());
$row = mysql_fetch_array($result);
extract($row);

$queryStudents = "SELECT student_id, full_name from student where account_id = $account_id";
//echo "$query<br>";
$resultStudents = mysql_query($queryStudents, $promusic) or die(mysql_error());
$numStudents = mysql_num_rows($resultStudents);
while ( list ($studentID, $fullName) = mysql_fetch_row($resultStudents)) {
   $queryBD = "select student_registered_classes.course_id, course_name, teacher, start_date as date1, end_date as date2, dow, time, duration, external_rate from student_registered_classes, course, teacher where student_registered_classes.course_id = course.course_id and student_registered_classes.teacher_id = teacher.teacher_id and school_year = \"$schYear\" and student_id = $studentID";
   // echo "$queryBD<br>";
   $resultClass = mysql_query($queryBD, $promusic) or die(mysql_error());

   while ( list ($courseID, $courseName, $teacher, $date1, $date2, $dow, $time, $duration, $extRate ) = mysql_fetch_row($resultClass)) {
      $fee = $extRate * $duration / 15;
	  
	list($yyyy, $mm, $dd) = split('[/.-]', $startDate);
	$mm = 7;
    $firstDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm"), 1, $fromYear));
	$lastDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")+1, 0, $fromYear));
	$ttlSchPayment = 0;
	$ttlLessons = 0;
	$ttlAdHoc = 0;
	$ttlMiscAmt = 0;
	$$ttlUsage = 0;

	$i = 1;
	while ( $i <= 12 ) {
	  // Get Payment Schedule Info
      list($yyyy1, $mm1, $dd1) = split('[/.-]', $firstDayOfMth);
	  $month1 = $yyyy1 . "-" . $mm1;
	  $month = $month1;
	  
	  $query = "SELECT sum(amount) as monthlyPDchqAmount, count(amount) as numPayments " .
	     "FROM student_scheduled_payments " .
	     "WHERE student_id=$studentID AND course_id=$courseID " .
		 "AND ( status = \"R\" OR status = \"D\" OR status = \"H\" ) " .
	     "AND cheque_date BETWEEN \"$firstDayOfMth\" AND \"$lastDayOfMth\"; ";
      // echo "$query<br>";
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
	  $amtReceived[$i] = $monthlyPDchqAmount;
	  $paymentMethod[$i] = "";
	  if ( $numPayments > 1 ) {
	    $paymentMethod[$i] = "Mulitple";
	  }
	  else {
	    if ( $numPayments == 1 ) {
		  $query = "select cheque_num as chqNum, payment_method from student_scheduled_payments " .
	        "WHERE student_id=$studentID AND course_id=$courseID " .
		    "AND ( status = \"R\" OR status = \"D\" OR status = \"H\" ) " .
	        "AND cheque_date BETWEEN \"$firstDayOfMth\" AND \"$lastDayOfMth\"; ";
          //echo "$query<br>";
	      $result = mysql_query($query, $promusic) or die(mysql_error());
          $row = mysql_fetch_array($result);
          extract($row);
		  if ( $chqNum <> "" && $payment_method <> "" ) {
		    $paymentMethod[$i] = $chqNum . "<br>" . $payment_method;
		  }
		  if ( $chqNum == "" && $payment_method <> "" ) {
			   $paymentMethod[$i] = $payment_method;
		  }
		  if ( $payment_method == "" ) {
		    $paymentMethod[$i] = $chqNum;
		  }
		}
	  }
   
      /* $query = "SELECT month, number_of_lessons FROM student_scheduled_payments " .
	       "WHERE student_id=$studentID AND course_id=$courseID " .
	       "AND month = \"$month1\"; ";  */
	  $query = "SELECT count(date) as number_of_lessons from class_schedule " .
               "where student_id=$studentID and course_id=$courseID " .
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
	  $lessons[$i] = $number_of_lessons;

      $query = "select sum(duration * external_rate /15) as usageAmt from class_schedule " .
           "where student_id=$studentID and course_id=$courseID " .
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
	  $usage[$i] = $usageAmt;
	  
	  $query = "SELECT sum(amount) as adHocPayment from adhoc_payments " .
	     "where student_id=$studentID and course_id=$courseID and " .
		 "date between \"$firstDayOfMth\" and \"$lastDayOfMth\"";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $adHocPayment == "" ) {
	    $adHocPayment = 0;
	  }  // end if numRows = null
	  else {
	    $query = "SELECT payment_method as adHocPM from adhoc_payments " .
	       "where student_id=$studentID and course_id=$courseID and " .
		   "date between \"$firstDayOfMth\" and \"$lastDayOfMth\"";
	    $result = mysql_query($query, $promusic) or die(mysql_error());
        $numRows = mysql_num_rows($result);
		if ( $numRows == 1 ) {
          $row = mysql_fetch_array($result);
          extract($row);
		  if ( $monthlyPDchqAmount == 0 ) {
		    $paymentMethod[$i] = $adHocPM;
		  }
		  else {
		    $paymentMethod[$i] = "Multiple";
		  }
		}  // end numRows = 1
		if ( $numRows > 1) {
		  $paymentMethod[$i] = "Multiple";
		}
	  }
	  
	  $ttlAdHoc += $adHocPayment;
	  $amtReceived[$i] += $adHocPayment;
	  
	  $query = "SELECT sum(amount) as miscAmt from misc_items " .
	     "where student_id=$studentID and course_id=$courseID and " .
		 "date between \"$firstDayOfMth\" and \"$lastDayOfMth\"";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $miscAmt == "" ) {
	    $miscAmt = 0;
	  }  // end if numRows = null
	  $ttlMiscAmt += $miscAmt;
	  $usage[$i] += $miscAmt;
	  
	  $balance[$i] = $balance[$i-1] - $amtReceived[$i] + $usage[$i];
	  $ttlFee[$i] += $miscAmt + $usageAmt;
	  $ttlReceived[$i] += $monthlyPDchqAmount + $adHocPayment;
	  $ttlBalance[$i] += $balance[$i];
	  
	  $mm += 1;
	  $firstDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")  , 1, $fromYear));
	  $lastDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")+1  , 0, $fromYear));
	  $i += 1;
	}  // end while
	
	  include 'enrollment_form_breakdown.php';
      $sectionCnt += 1;
   }  // end while 2

}  // end while 1

include 'enrollment_form_terms.php';
$sectionCnt += 1;
if ( $sectionCnt > 3 ) {
include 'enrollment_form_summary.php';
}
?>
</body>
</html>
