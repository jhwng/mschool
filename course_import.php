<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
require_once('Connections/promusic.php'); 

mysql_select_db($database_promusic, $promusic);
$row = 1;
$studentCnt = 1;

$handle = fopen("/tmp/courseimport1.csv", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;
$account_id=$data[0];
$full_name=$data[1];
$course_name=$data[2];
$grade=$data[3];
$selected_teacher=$data[4];
$ext_rate=$data[5];
$internal_cost=$data[6];
$cost_type=strtoupper($data[7]);
$time=$data[8];
$duration=$data[9];
$start_date=$data[10];
$end_date=$data[11];

/*
list($mm,$dd,$yyyy) = split('[/.-]', $start_date);
if ( strlen($mm) == 1 ) $mm = "0" . $mm;
if ( strlen($dd) == 1 ) $dd = "0" . $dd;
$start_date = $yyyy . "-" . $mm . "-" . $dd;

list($mm,$dd,$yyyy) = split('[/.-]', $end_date);
if ( strlen($mm) == 1 ) $mm = "0" . $mm;
if ( strlen($dd) == 1 ) $dd = "0" . $dd;
$end_date = $yyyy . "-" . $mm . "-" . $dd;
*/

/*
        echo "account=$account_id" . "<br />\n";
		echo "full_name=$full_name<br>";
		echo "course=$course_name<br>";
		echo "grade=$grade<br>";
		echo "teacher=$teacher<br>";
		echo "external_rate=$ext_rate<br>";
		echo "internal_cost=$internal_cost<br>";
		echo "cost_type=$cost_type<br>";
		echo "time=$time<br>";
		echo "duration=$duration<br>";
		echo "start_date=$start_date<br>";
		echo "end_date=$end_date<br>";
		echo "========================================<br>";
*/
		
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
	  echo "$query_teacherid<br>";
	  $result = mysql_query($query_teacherid, $promusic) or die(mysql_error());
	  $row_teacherid = mysql_fetch_array($result);
      extract($row_teacherid);

      /* find course_id */
      $query_courseid = "select course_id from course where course_name = \"$course_name\";";
	  echo "$query_courseid<br>";
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
	  echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      $numRows = mysql_num_rows($result);
	  
	  if ( $numRows > 0 ) {
	    echo "Student $full_name has already registered $course_name<br>";
	  }
	  else
	  {

      /* calculate discount timestamp */
	  if ( $discount > 0 ) {
    	list($yyyy, $mm, $dd) = split('[/.-]', $discount_expiry_date);
	    $discountTimeStamp = mktime(12,0,0,$mm,$dd,$yyyy);
	  }

	  /* Start SQL transaction */
	  $query = "START TRANSACTION;";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
	  
	  /* Create sutdent_registered_classes */
  	  $query = "INSERT INTO student_registered_classes
       ( student_id, course_id, grade, teacher_id, start_date, end_date, dow, school_year, time, duration, external_rate, internal_cost, cost_type) VALUES
  	   ( $student_id, $course_id, \"$grade\", $teacher_id, \"$start_date\", \"$end_date\", \"$dow\", \"$schYear\", \"$time\", \"$duration\", $ext_rate, $internal_cost, \"$cost_type\" ); ";
	  echo "$query<br>";
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
		  $query_class = "INSERT INTO class_schedule " .
		     "(student_id, course_id, grade, date, time, duration, teacher_id, " .
			 "dow, internal_cost, cost_type, external_rate) " .
			 "VALUES (\"$student_id\", \"$course_id\", \"$grade\", \"$cDate\", \"$time\", " .
			 "$duration, \"$teacher_id\",\"$dow\", $internal_cost, \"$cost_type\", $rate)";
          //echo $query_class . "<br>";      
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
		  $chq_date = $curMth . "-01";
	      $query = "INSERT INTO student_scheduled_payments " .
		     "(student_id, month, amount, number_of_lessons, duration, external_rate, " .
			 "course_id, cheque_date ) VALUES " .
			 "($student_id, \"$curMth\", $monthlyFee, $lessonCnt, $duration, $rate, " .
			 "$course_id, \"$chq_date\");";
		  echo "$query<br>";
		  $result = mysql_query($query, $promusic) or die(mysql_error());
		  $lessonCnt = 0;
		  $monthlyFee = 0;
		  $curMth = $nextMth;
	    }
	  }     /* end while */
	  
	  /* Commit Transactions  */
	  $query = "COMMIT;";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
	  echo "$studentCnt - $full_name registered in $course_name<br>";
	  echo "======================================================================<br>";
	  $studentCnt = $studentCnt + 1;
	  
      } /* end else if student has already registered this course */
	}

		
		
}
fclose($handle);


?> 

</body>
</html>
