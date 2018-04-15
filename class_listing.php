<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);

// action = 1 - retrieve payment schedule via POST
// action = 2 - update payment schedule
// action = 3 - get course list only
// action =4 - retrieve payment schedule via GET

$action=$_GET['action'];
$studentID=$_GET['student_id'];
$studentID_orig=$studentID;
$startDate=$_GET['start_date'];
$endDate=$_GET['end_date'];
$courseName=$_GET['course_name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Student Class Schedule Listing</title>
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
$toDay=date("Y-m-d");

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

list ($yyyy, $mm, $dd) = split('[/.-]', $startDate);
$startYear = $yyyy;
$startMth = $yyyy . "-" . $mm;
$listMth = $startMth;
$firstDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm"), 1, $yyyy));
$lastDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")+1, 0, $yyyy));


list($yyyy, $mm1, $dd) = split('[/.-]', $endDate);
$endMth = $yyyy . "-" . $mm1;
if ( $mm1 >= 7 && $mm1 <= 12 ) {
  $fromYear = $yyyy;
  $toYear = $yyyy + 1;
}
else {
  $fromYear = $yyyy - 1;
  $toYear = $yyyy;
}
$schYear = $fromYear . "-" . $toYear;


$query = "SELECT course_id as courseID FROM course WHERE course_name=\"$courseName\";";
$result = mysql_query($query, $promusic) or die(mysql_error());
$row = mysql_fetch_array($result);
extract($row);

$queryStudent = "SELECT full_name as fullName from student where student_id = $studentID";
//echo "$query<br>";
$resultStudent = mysql_query($queryStudent, $promusic) or die(mysql_error());
$rowStudent = mysql_fetch_array($resultStudent);
extract($rowStudent);

$queryBD = "SELECT teacher, start_date as date1, end_date as date2, dow, time, duration from student_registered_classes, course, teacher where student_registered_classes.course_id = course.course_id and student_registered_classes.teacher_id = teacher.teacher_id and school_year = \"$schYear\" and student_id = $studentID and student_registered_classes.course_id = $courseID";

// echo "$queryBD<br>";
$resultClass = mysql_query($queryBD, $promusic) or die(mysql_error());
$rowClass = mysql_fetch_array($resultClass);
extract($rowClass);

include 'class_listing_header.php';

while ( "$listMth" <= "$endMth" ) {   // while loop 1
  $query = "SELECT date, dow, time, duration, remarks FROM class_schedule " .
           "WHERE student_id = $studentID and course_id = $courseID " .
		   "AND date between \"$firstDayOfMth\" AND \"$lastDayOfMth\" " .
	       "AND ( (cancelled <> 'W' and cancelled <> 'T' and cancelled <> 'CXL' ) " .
	       "OR cancelled is NULL  or cancelled = \"\" )" .
		   "ORDER BY date, time ";
  $resultClasses = mysql_query($query, $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($resultClasses);

  if ( $numRows > 0 ) {  
  echo '<table width="700" border="0" cellspacing="0" cellpadding="1"><br>';
  echo '<tr>';
  echo '  <td width="30">&nbsp;</td>';
  echo '  <td>';

  include 'class_listing_row_header.php';  
  while ( list ($date, $dow, $time, $duration, $remarks ) = mysql_fetch_row($resultClasses)) { 
    include 'class_listing_row_entries.php';
  }  
  
  echo "</table><br>";
  echo "</td></tr></table>";
  
  }  // end if nowRows > 0
  $mm += 1;
  
  $firstDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")  , 1, $startYear));
  $lastDayOfMth = date ("Y-m-d", mktime(0, 0, 0, date("$mm")+1  , 0, $startYear));
  list($yyyy1, $mm1, $dd1) = split('[/.-]', $firstDayOfMth);
  $listMth = $yyyy1 . "-" . $mm1;

}  // end while loop 1

?>
</body>
</html>
