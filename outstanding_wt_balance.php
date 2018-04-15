<?php require_once('Connections/promusic.php'); ?>
<?php
$versionNum = "1.00.01";

// version 1.00.01 - allow user to select one or All teacher

mysql_select_db($database_promusic, $promusic);
$query_teacher = "SELECT teacher FROM teacher where active = 'Y' or active is NULL or active = '' ORDER BY teacher";
$teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacher);
$totalRows_teacher = mysql_num_rows($teacher);

// action = 1 - retrieve payment schedule via POST
// action = 2 - update payment schedule
// action = 3 - get course list only
// action =4 - retrieve payment schedule via GET

$action=$_GET['action'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Outstanding W &amp; T Balance</title>
<script type="text/javascript" src="checkform.js"> </script>

<style type="text/css">
<!--

.style7 {font-size: 14px}
.style8 {font-weight: bold}
.style12 {
	font-size: 14px;
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
/*
actuin = 1 - Display list
*/
$action = $_GET['action'];
$submit = $_POST['submit1'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];
$byTeacherName = $_POST['by_teacher'];

include 'banner1.php';

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

require ('outstanding_wt_balance_top_form.php');
if ( $action == 1 ) {

  list($yyyy, $mm, $dd) = split('[/.-]', $endDate);
  if ( $mm >= 7 && $mm <= 12 ) {
    $fromYear = $yyyy;
    $toYear = $yyyy + 1;
  }
  else {
    $fromYear = $yyyy - 1;
    $toYear = $yyyy;
  }
  $schYear = $fromYear . "-" . $toYear;
  $startDate = $fromYear . "-07-01";

  $query = "SELECT student_credit_minutes.student_id as sID, full_name, student_credit_minutes.course_id as cID, course_name as course, credit_type, sum(minute_balance) as minutes FROM student_credit_minutes, student, course WHERE student_credit_minutes.student_id = student.student_id
AND student_credit_minutes.course_id = course.course_id AND date between \"$startDate\" and \"$endDate\" group by sID, full_name, cID, course, credit_type having minutes > 0 order by full_name";
  // echo "$query<br>";
  $result_list = mysql_query($query, $promusic) or die(mysql_error());
  $numRows_list = mysql_num_rows($result_list);
  
  $j = 0;
  while ( list ( $studentID, $fullName, $courseID, $courseName, $creditType, $minutes ) = mysql_fetch_row($result_list) ) {
    $query_teacher = "SELECT teacher FROM student_registered_classes, teacher WHERE student_registered_classes.teacher_id = teacher.teacher_id AND student_id = $studentID AND course_id = $courseID AND school_year = \"$schYear\" ";
    $result_teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
    $row_teacher = mysql_fetch_array($result_teacher);
    extract($row_teacher);
	
	// only select entries for the selected teacher
	if ( "$teacher" == "$byTeacherName" || "$byTeacherName" == "All" )
	{
	  $sField = $teacher . $courseName . $fullName;
      $outstanding_array[]=array($fullName, $courseName, $creditType, $minutes, $teacher, $studentID, $sField);
	  $j += 1;
	}  // end if 
	
  }  // End while

  $num_entries = $j;
  if ( $num_entries > 0 )
  {
  
  $sort_field = 6; // enter the number of field to sort 
  // compare function 
  function cmpi($a, $b) 
  { 
    global $sort_field; 
    return strcmp($a[$sort_field], $b[$sort_field]); 
  } 
  // do the array sorting 
  usort($outstanding_array, 'cmpi'); 
 
  $i = $j;  // $i = number of entries
  $j = 1;
  $k = 0;
  $teacherCnt = 0;
  $curTeacher = "";
    
  while ( $k < $i   ) {
	$fullName = $outstanding_array[$k][0];
	$courseName = $outstanding_array[$k][1];
	$creditType = $outstanding_array[$k][2];
	$minutes = $outstanding_array[$k][3];
	$teacher = $outstanding_array[$k][4];
	$studentID = $outstanding_array[$k][5];

    if ( "$curTeacher" <> "$teacher" ) 
	{
	  $j = 1;
	  $curTeacher = $teacher;
	  if ( $teacherCnt > 0 ) 
	  {
		 require ('outstanding_wt_balance_trailer.php');
	     echo '<div style="page-break-after:always">&nbsp;</div>'; 
	  }
      require ('outstanding_wt_balance_header.php');
	  $teacherCnt += 1;
	}   
	require ('outstanding_wt_balance_row_entry.php');
	$j += 1;
	$k += 1;
	
  }  // end while

  } // end if $num_entries > 0
  require ('outstanding_wt_balance_trailer.php');
    
	 
}  // end action = 1


?>

</body>
</html>

</body>
</html>
