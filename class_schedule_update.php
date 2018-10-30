<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_teacher = "select teacher from teacher where active = 'Y' or active is NULL or active = '' order by teacher;";
$teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacher);
$totalRows_teacher = mysql_num_rows($teacher);

/* Explode original arrays first */
$startdate = $_POST['start_date'];
$enddate = $_POST['end_date'];
$arr_fullName = explode('|', $_POST['fullName']);
$arr_teacherName = explode('|', $_POST['teacherName']);
$arr_courseID = explode('|', $_POST['courseID']);
$arr_courseName = explode('|', $_POST['courseName']);
$arr_grade = explode('|', $_POST['grade']);
$arr_classDate = explode('|', $_POST['classDate']);
$arr_classTime = explode('|', $_POST['classTime']);
$arr_duration = explode('|', $_POST['duration']);
$arr_cancelReason = explode('|', $_POST['cancelReason']);
$arr_cancelTime = explode('|', $_POST['cancelTime']);
$arr_extRate = explode('|', $_POST['extRate']);
$arr_studentID = explode('|', $_POST['studentID']);
$arr_teacherID = explode('|', $_POST['teacherID']);
$arr_remarks = explode('|', $_POST['remarks']);
$arr_classID = explode('|', $_POST['classID']);
$arr_dow = explode('|', $_POST['dow']);
$arr_rescheduledFrom = explode('|', $_POST['rescheduledFrom']);
$arr_internalCost = explode('|', $_POST['internalCost']);
$arr_classType = explode('|', $_POST['classType']);
$arr_costType = explode('|', $_POST['costType']);
$arr_fromStudentCreditID = explode('|', $_POST['fromStudentCreditID']);
$arr_toStudentCreditID = explode('|', $_POST['toStudentCreditID']);
$arr_minuteBalance = explode('|', $_POST['minuteBalance']);
$arr_userID = explode('|', $_POST['userID']);
$arr_userName = explode('|', $_POST['userName']);
$arr_timestamp = explode('|', $_POST['timestamp']);

function rowHeader() {
$entryHeader =<<<EOD
    <tr bgcolor="#E2D8F3">
      <td height="16" colspan="5" nowrap="nowrap"><div align="center" class="style3 style9 style11">Original Class
</div></td>
      <td colspan="7"  bgcolor="#FFBA75"><div align="center" class="style9">Rescheduled Class </div></td>
    </tr>
    <tr bgcolor="#FFFFD7">
      <td width="64" nowrap="nowrap" class="style6 style8"><div align="left">Date/Cancel</div></td>
      <td width="55" class="style6 style8"><div align="left">Time/Type</div></td>
      <td width="47" nowrap="nowrap" class="style6 style8"><div align="left">Duration</div></td>
      <td width="77" class="style6 style8"><div align="left">Teacher/Course</div></td>
      <td width="26" class="style6 style8"><div align="left">Rate</div></td>
      <td width="80" class="style6 style8"><div align="left">Cancel</div></td>
      <td width="110" nowrap="nowrap" class="style6 style8"><div align="left">Reschedule Date</div></td>
      <td width="30" class="style6 style8"><div align="left">Time</div></td>
      <td width="50" class="style6 style8"><div align="left">Duration</div></td>
      <td width="45" class="style6 style8"><div align="left">Teacher</div></td>
      <td width="100" nowrap="nowrap" class="style6 style8"><div align="left">Grd/Rate/Cost/Type</div></td>
      <td width="100" class="style6 style8"><div align="left">Remarks</div></td>
    </tr>
EOD;
echo "$entryHeader";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Class Schedule Update</title>
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

<script type="text/javascript" src="checkform.js"> </script>

</head>

<body>
<?php 
include 'banner1.php';
?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Class Schedule Update Summary</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<form name="form1" method="post" action="">
  <table width="760">
    <tr><td>
    <div align="center">
	<input name="class_schedule" type="button" class="btn" id="class_schedule"
	<?php 
	  $student_id = $arr_studentID[0];
	  $fullname = $arr_fullName[0];
	  $courseName = $arr_courseName[0];
	  $url = "class_schedule.php?action=newcourse&student_id=$student_id&fullname=" . urlencode($fullname) . "&coursename=" . urlencode($courseName) . "&startdate=$startdate&enddate=$enddate"; ?>
    onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Back to Class Schedule"/>
    </div>
  </td></tr></table>
</form>

<?php
echo ' <form action="class_schedule_update.php" method="post" name="form2" id="form2">';
echo '  <table width="1000" border="1" cellspacing="0" cellpadding="1">';

$i = 1;   /* $i is used to count entries to see if a header is needed */
$j = 0; 
$k = 0; 

/*jng: Difference between "R*" value and "arr_*" values? (eg, RextRate vs arr_extRate)
       As far as I can tell, the arr_* values are base (current) values in the _DB_,
       whereas the R* values are from the form.*/
foreach ( $arr_classID as $classID ) {
  $change = 0;
  $rs = "reschedule_class" . $j;
  $rescheduleClass = isset($_POST["$rs"]) ? $_POST["$rs"] : ""; //jng
  $rd = "Rdate" . $j;
  $Rdate = $_POST["$rd"];
  $rt = "Rtime" . $j;
  $Rtime = $_POST["$rt"];
  $rdur = "Rduration" . $j;
  $Rduration = $_POST["$rdur"];
  $rt = "Rteacher" . $j;
  $Rteacher = $_POST["$rt"];
  $rex = "Rext_rate" . $j;
  $RextRate = $_POST["$rex"];

  $rc= "Rcost" . $j;
  $Rcost = $_POST["$rc"];

  $rco= "Rcost_override" . $j;     //jng
  $RcostOverride = $_POST["$rco"]; //jng

  $rct= "Rcost_type" . $j;
  $RcostType = $_POST["$rct"];

  $rcto= "Rcost_type_override" . $j;    //jng
  $RcostTypeOverride = $_POST["$rcto"]; //jng

  $rr = "Rremarks" . $j;
  $Rremarks = $_POST["$rr"];
  $grd = "Rgrade" . $j;
  $Rgrade = $_POST["$grd"];

  //Bjng
  $old_Rcost=$Rcost; // save old Rcost for debugging
  if ($RcostOverride != "" && is_numeric($RcostOverride)) {
    $Rcost=$RcostOverride;
  }

  $old_RcostType=$RcostType; // save old RcostType for debugging
  if ($RcostTypeOverride == "S" || $RcostTypeOverride == "F") {
    $RcostType=$RcostTypeOverride;
  }
  //Ejng

  if ( $rescheduleClass == "Y" ) {
    $change = 1;

	// get teacher_id for for the teacher name
	$query = "SELECT teacher_id FROM teacher WHERE teacher = \"$Rteacher\";";
    $result = mysql_query($query, $promusic) or die(mysql_error());
	$row = mysql_fetch_array($result);
    extract($row);
	
	// get dow for the class date
    list($yyyy, $mm, $dd) = split('[/.-]', $Rdate);
    $dow = date("w", mktime(0,0,0,$mm,$dd,$yyyy));

    $oldCancelReason = $arr_cancelReason[$j];
    $classType = $arr_classType[$j];
    $minute_balance = $arr_minuteBalance[$j];
	
    // Start SQL transaction 
	$query = "START TRANSACTION;";
	$result = mysql_query($query, $promusic) or die(mysql_error());

	// check if this is a delete request
	if ( "$Rremarks" == "del" && "$oldCancelReason" == "" && "$classType" == "" ) {
      $query_delete = "delete from class_schedule where class_id = $classID";
      $result = mysql_query($query_delete, $promusic) or die(mysql_error());
	} 
    else {
      // if reschedule class is not a cancelled class, just update the class entry
	  if ( $oldCancelReason == "" ) {
	    $query = "UPDATE class_schedule SET " .
	         "date=\"$Rdate\", time=\"$Rtime\", dow=\"$dow\", duration=$Rduration, " .
			 "teacher_id=$teacher_id, grade=\"$Rgrade\", " .
			 "external_rate=$RextRate, internal_cost=$Rcost, cost_type=\"$RcostType\", " .
			 "remarks=\"$Rremarks\", user_id=$thisUserID " .
	         "WHERE class_id = $classID";
	    // echo "$query<br>";
        $result = mysql_query($query, $promusic) or die(mysql_error());
      } // end oldCancelReason == ""
	
      // if rescheduled class is a W or T class, need to delelte the credit entry
      if ( $oldCancelReason == "W" || $oldCancelReason == "T" ) {
        $makeup = "";
        if ( $oldCancelReason == "W" ) { $makeup = "MW"; }
        if ( $oldCancelReason == "T" ) { $makeup = "MT"; }
        // if W or T class minute_balance is the same as original minute and the rescheduled date is the same as original, just delete credit entry
        // otherwise update credit entry minute_balance = 0
        if ( $minute_balance == $arr_duration[$j] ) {
          if ( $Rdate == $arr_classDate[$j] ) {
            if ( $Rduration == $minute_balance ) {
              $query = "DELETE from student_credit_minutes " .
                       "WHERE student_credit_id = $arr_toStudentCreditID[$j]";
              // echo $query;
              $result = mysql_query($query, $promusic) or die(mysql_error());
              $query = "UPDATE class_schedule SET " .
                       "date=\"$Rdate\", time=\"$Rtime\", dow=\"$dow\", duration=$Rduration, " .
                       "teacher_id=$teacher_id, grade=\"$Rgrade\",  " .
                       "external_rate=$RextRate, internal_cost=$Rcost, cost_type=\"$RcostType\", " .
                       "remarks=\"$Rremarks\", cancelled=\"\", user_id=$thisUserID " .
                       "WHERE class_id = $classID";
              // echo $query;
              $result = mysql_query($query, $promusic) or die(mysql_error());
			}
			// if Rduration < minute_balance, update credit entry instead of delete it
	        if ( $Rduration < $minute_balance ) {  
	          $minute_balance1 = $minute_balance - $Rduration;
			  $query = "UPDATE student_credit_minutes SET " .
		              "minute_balance=$minute_balance1 " .
					  "WHERE student_credit_id = $arr_toStudentCreditID[$j];";
	          // echo $query;
              $result = mysql_query($query, $promusic) or die(mysql_error());
		      $query = "INSERT INTO class_schedule
	  (student_id, course_id, grade, date, time, duration, teacher_id, dow, internal_cost, cost_type, external_rate, remarks, class_type, from_student_credit_id, user_id)
	  VALUES ($arr_studentID[$j], $arr_courseID[$j], \"$arr_grade[$j]\", \"$Rdate\", \"$Rtime\", $Rduration, $teacher_id, $dow, $Rcost, \"$RcostType\", $RextRate, \"$Rremarks\", \"$makeup\", $arr_toStudentCreditID[$j], $thisUserID)";
	          // echo $query;
		      $result = mysql_query($query, $promusic) or die(mysql_error());
            }
          }

          // Rdate <> original date, update minute_balance in credit entry
          if ( $Rdate <> $arr_classDate[$j] ) {
            $minute_balance1 = $minute_balance - $Rduration;
            $query = "UPDATE student_credit_minutes SET " .
                     "minute_balance=$minute_balance1 " .
                     "WHERE student_credit_id = $arr_toStudentCreditID[$j];";
            // echo $query;
            $result = mysql_query($query, $promusic) or die(mysql_error());
            $query = "INSERT INTO class_schedule
                      (student_id, course_id, grade, date, time, duration, teacher_id, dow, internal_cost, cost_type, external_rate, remarks, class_type, from_student_credit_id, user_id)
                      VALUES ($arr_studentID[$j], $arr_courseID[$j], \"$arr_grade[$j]\", \"$Rdate\", \"$Rtime\", $Rduration, $teacher_id, $dow, $Rcost, \"$RcostType\", $RextRate, \"$Rremarks\", \"$makeup\", $arr_toStudentCreditID[$j], $thisUserID)";
            // echo $query;
            $result = mysql_query($query, $promusic) or die(mysql_error());
          }
        }
        else { // this is a partial W or T class, ie minute_balance less than original class duration
          $minute_balance1 = $minute_balance - $Rduration;
          $query = "UPDATE student_credit_minutes SET " .
                   "minute_balance=$minute_balance1 " .
                   "WHERE student_credit_id = $arr_toStudentCreditID[$j];";
          //echo $query;
          $result = mysql_query($query, $promusic) or die(mysql_error());
		
          $query = "INSERT INTO class_schedule
                    (student_id, course_id, grade, date, time, duration, teacher_id, dow, internal_cost, cost_type, external_rate, remarks, class_type, from_student_credit_id, user_id )
                    VALUES (\"$arr_studentID[$j]\", \"$arr_courseID[$j]\", \"$arr_grade[$j]\", \"$Rdate\", \"$Rtime\", $Rduration, \"$teacher_id\",\"$dow\", $Rcost, \"$RcostType\", $RextRate, \"$Rremarks\", \"$makeup\", $arr_toStudentCreditID[$j], $thisUserID)";
          // echo $query;
          $result = mysql_query($query, $promusic) or die(mysql_error());
        }
      } // end if rescheduled class is W or T

      // if rescheduled class is not "" or W or T, e.g. WO, CXL, WOT, etc
      if ( $oldCancelReason == "WO" || $oldCancelReason == "WOT" || $oldCancelReason == "CXL" ) {
        $query = "UPDATE class_schedule SET " .
                 "date=\"$Rdate\", time=\"$Rtime\", dow=\"$dow\", duration=$Rduration, " .
                 "teacher_id=$teacher_id, grade=\"$Rgrade\", " .
                 "external_rate=$RextRate, internal_cost=$Rcost, cost_type=\"$RcostType\", " .
                 "remarks=\"$Rremarks\", cancelled=\"\", user_id=$thisUserID " .
                 "WHERE class_id = $classID";
        // echo $query;
        $result = mysql_query($query, $promusic) or die(mysql_error());
      }
    }  // end else for delete request
	
    // Commit Transactions
    $query = "COMMIT;";
    $result = mysql_query($query, $promusic) or die(mysql_error());
  }   /* end if for rescheduling a class */
  
  // user cancels a class
  $cc = "cancel_class" . $j;
  $cancelClass = isset($_POST["$cc"]) ? $_POST["$cc"] : ""; //jng
  $cr = "cancel_reason" . $j;
  $cancelReason = $_POST["$cr"];
  $oldCancelReason = $arr_cancelReason[$j];
  $minute_balance = $arr_minuteBalance[$j];

  if ( $cancelClass == "Y" ) {
    $change = 1;
    //  echo "=================== new entry sql transactions ==================<br>";
    if ( $cancelReason == "WO"  || $cancelReason == "WOT" || $cancelReason == "CXL" || $cancelReason == "" ) {
      // if the class to be cancelled is not a W or T, just need to change
      // the cancelReason and remarks in the class entry
      if ( $oldCancelReason <> "W" && $oldCancelReason <> "T" ) {
        // mark class to be changed as cancelled
        $rr = "Rremarks" . $j;
        $Rremarks = $_POST["$rr"];
        $query = "UPDATE class_schedule SET " .
                 "cancelled=\"$cancelReason\", remarks=\"$Rremarks\", class_type=\"\",  user_id=$thisUserID " .
                 "WHERE class_id = $classID";
        $result = mysql_query($query, $promusic) or die(mysql_error());
        // echo "$query<br>";
      } /* end if $oldCancelReason == "", WO, WOT, or CXL  */
      else {
        // if class to be cancelled is a W or T,
        //delete the credit entry, update cancelReason and remove to_student_credit_id reference

        // Start SQL transaction
        $query = "START TRANSACTION;";
        $result = mysql_query($query, $promusic) or die(mysql_error());

        $query = "DELETE from student_credit_minutes " .
                 "WHERE student_credit_id = $arr_toStudentCreditID[$j]";
        $result = mysql_query($query, $promusic) or die(mysql_error());
        // echo "$query<br>";

        $query = "UPDATE class_schedule SET " .
        "cancelled=\"$cancelReason\", to_student_credit_id=NULL, remarks=\"$Rremarks\", " .
        "class_type=\"\", user_id=$thisUserID WHERE class_id = $classID";
        $result = mysql_query($query, $promusic) or die(mysql_error());
        // echo "$query<br>";

        // Commit Transactions
        $query = "COMMIT;";
        $result = mysql_query($query, $promusic) or die(mysql_error());
      } /* end if $oldCancelReason == W or T  */
    } /* end if $cancelReason = WO, WOT, CXL */

    if ( $cancelReason == "W"  || $cancelReason == "T" ) {
      // $change = $curCancelReason . "To" . $cancelReason;

      // if the class to be cancelled is not a W or T class, just need to create a new credit entry
      if ( $oldCancelReason == "" || $oldCancelReason == "WO" || $oldCancelReason == "WOT" || $oldCancelReason == "CXL" ) {
        // Start SQL transaction
        $query = "START TRANSACTION;";
        $result = mysql_query($query, $promusic) or die(mysql_error());

        //TODO-jng - find out why the query below uses arr_* values instead of R* values.
        // create a new record for the credit
        $rr = "Rremarks" . $j;
        $Rremarks = $_POST["$rr"];
        $query = "INSERT INTO student_credit_minutes " .
                 "(student_id, course_id, minutes, class_id, credit_type, remarks, minute_balance, " .
                 "external_rate, internal_cost, cost_type, date) " .
                 "VALUES ($arr_studentID[$j], $arr_courseID[$j], $arr_duration[$j], $arr_classID[$j], " .
                 "\"$cancelReason\", \"$Rremarks\", $arr_duration[$j], $arr_extRate[$j], " .
                 "$arr_internalCost[$j], \"$arr_costType[$j]\", \"$arr_classDate[$j]\" )";

        // echo "$query<br>";
        $result = mysql_query($query, $promusic) or die(mysql_error());

        // get student_credit_id for this new credit entry
        $query = "SELECT student_credit_id from student_credit_minutes " .
                 "WHERE class_id = $arr_classID[$j] AND credit_type = \"$cancelReason\" AND " .
                 "student_id = $arr_studentID[$j]";
        // echo "$query<br>";
        $result = mysql_query($query, $promusic) or die(mysql_error());
        $row = mysql_fetch_array($result);
        extract($row);

        // mark class to be changed as cancelled, update to_student_credit_id
        $query = "UPDATE class_schedule SET " .
                 "cancelled=\"$cancelReason\", to_student_credit_id=$student_credit_id, " .
                 "remarks=\"$Rremarks\", class_type=\"\", user_id=$thisUserID WHERE class_id = $classID";
        // echo "$query<br>";
        $result = mysql_query($query, $promusic) or die(mysql_error());

        // Commit Transactions
        $query = "COMMIT;";
        $result = mysql_query($query, $promusic) or die(mysql_error());
      } /* end if $oldCancelReason == ""  */
      else {
        // if class to be cancelled is already a W or T,
        //change current credit entry to the new credit type
	  
        // Start SQL transaction
        $query = "START TRANSACTION;";
        $result = mysql_query($query, $promusic) or die(mysql_error());

        $query = "UPDATE student_credit_minutes " .
                 "SET credit_type=\"$cancelReason\", remarks=\"$Rremarks\" " .
                 "WHERE student_credit_id = $arr_toStudentCreditID[$j]";
        $result = mysql_query($query, $promusic) or die(mysql_error());
        // echo "$query<br>";

        $query = "UPDATE class_schedule SET " .
                 "cancelled=\"$cancelReason\", remarks=\"$Rremarks\", class_type=\"\", user_id=$thisUserID " .
                 "WHERE class_id = $classID";
        $result = mysql_query($query, $promusic) or die(mysql_error());
        // echo "$query<br>";

        // Commit Transactions
        $query = "COMMIT;";
        $result = mysql_query($query, $promusic) or die(mysql_error());
      } /* end if $oldCancelReason == W or T  */
    } /* end if $cancelReason = W or T */
  } /* end if $cancelClass = Y */

  if ( $change == 1 ) {
    $classDate = $arr_classDate[$j];
    $RcancelReason = $cancelReason;
    $cancelReason = $arr_cancelReason[$j];
    $duration = $arr_duration[$j];
    $classTime = $arr_classTime[$j];
    $classType = $arr_classType[$j];
    $teacherName = $arr_teacherName[$j];
    $cname = $arr_courseName[$j];
    $extRate = $arr_extRate[$j];
	
    // print rowHeader first
    if ( $i == 1 ) rowHeader();

    require ('class_schedule_update_row_entry.php');
    $k += 1;
    if ( $i == 5 ) {
      $bottom =<<<EOD
      <tr bgcolor="#FFFFD7">
        <td height="15" colspan="12" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
EOD;
      echo "$bottom";
	  $i = 1;
    } else { $i += 1; }

    // create array to be pass back to this page for further edit if user clicks submit
  }  /* End if change = 1 */

  $j += 1;
}  /* end for loop */
?>

</table>
</form>
<?php
if ( $k == 0 ) {
  echo '<script>alert ("NO change performed on any class entry\n\nMake sure you check the required Check Boxes"); history.go(-1)</script>';
}
?>
</body>
</html>