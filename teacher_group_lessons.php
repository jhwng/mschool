<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_teacher = "select teacher from teacher where active = 'Y' or active is NULL or active = '' order by teacher;";
$teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacher);
$totalRows_teacher = mysql_num_rows($teacher);

$query_group = "select group_lesson from group_lesson order by group_lesson;";
$group_lessons = mysql_query($query_group, $promusic) or die(mysql_error());
$row_gl = mysql_fetch_assoc($group_lessons);
$totalRows_gl = mysql_num_rows($group_lessons);

// action = 1 - retrieve group_lessons via POST
// action = 2 - update group_lessons
// action = 3 - Display
// action =4 - retrieve group_lessons via GET

$action=$_GET['action'];
if ( $action <> "" ) {
  if ( $action <> 4 ) {
    $teacherForm1=$_POST['teacher'];
    $startdate=$_POST['start_date'];
    $enddate=$_POST['end_date'];
    $teacher_id=$_POST['teacher_id'];
	$delete=$_POST['delete'];
  }
  else {
    $teacherForm1=$_GET['teacher'];
    $startdate=$_GET['start_date'];
    $enddate=$_GET['end_date'];
    $teacher_id=$_GET['teacher_id'];
  }

}

    $firstDayOfYear = date ("Y-m-d", mktime(0, 0, 0, 7, 1, $fromYear));
    $lastDayOfYear = date ("Y-m-d", mktime(0, 0, 0, 6, 30, $toYear));

if ( $startdate == "" ) {
   $curMth = date("m");
   $curYear = date("Y");
   $startdate = $curYear . "-" . $curMth . "-01";
   $enddate = date ("Y-m-d", mktime(0, 0, 0, $curMth+1, 0, $curYear));
   
}

list($yyyy, $mm, $dd) = split('[/.-]', $startdate);
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
<title>Teacher Group Lesson Payments</title>

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

<body onLoad='document.form1.teacher.focus()'>
<a name="top"></a>
<!-- Display the top search form -->
<?php include 'banner1.php'; ?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Group Lessons and Other Income </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<table width="815" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="815"><div align="center">
      <form id="form1" name="form1" method="post" action="teacher_group_lessons.php?action=1">
        <div align="center">
          <table width="772" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="772" height="20"><div align="center">Teacher Name:
                <input name="teacher" type="text" id="teacher" size="49" maxlength="60"
		  <?php if ($teacherForm1 <> "") echo "VALUE=\"" . $teacherForm1 . "\";" ?> />
  &nbsp;&nbsp;
  <input name="submit2" type="button" class="btn" id="submit2" onclick="teacherNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Name Search"/>
  &nbsp;&nbsp;
            <input name="teacher_id" type="hidden" id="teacher_id" 
		  <?php if ( $teacher_id <> "" ) { echo "VALUE=\"$teacher_id\""; } ?> />
            </div></td>
          </tr>
          <tr>
            <td height="30"><div align="center"> 
              
              Start Date:
                <input name="start_date" type="text" id="start_date" size="12" maxlength="12" <?php if ($startdate <> "") echo "VALUE=\"" . $startdate . "\""; ?> onChange='checkDateFormat(form, this)' />
&nbsp;&nbsp;&nbsp;End Date:
<input name="end_date" type="text" id="end_date" size="12" maxlength="12" <?php if ($enddate <> "") echo "VALUE=\"" . $enddate . "\""; ?> onChange='checkDateFormat(form, this)' />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="retrieve" type="submit" class="btn" id="retrieve"
   onclick='document.form1.action="teacher_group_lessons.php?action=1"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Retrieve Payments"/>
            </div></td>
          </tr>
        </table>
          </div>
      </form>
    </div></td>
  </tr>
</table>

<?php

require ('teacher_group_lessons_header_row.php');
$numRows_payment = 0;
$j = 0;

// Retrieve Group Lesson entries
$error = 0;
if ( $action == 4 ) { echo "<script>document.form1.getlist.click(); document.form1.retrieve.click()</script>"; }
if ( $action == 1 ) {

  if ( $error == 0 ) {
    list($yyyy, $mm, $dd) = split('[/.-]', $startdate);
	if ( $mm >= 7 && $mm <= 12 ) {
	    $fromYear = $yyyy;
		$toYear = $yyyy + 1;
	}
	else {
	    $fromYear = $yyyy - 1;
		$toYear = $yyyy;
	}
	$schYear = $fromYear . "-" . $toYear;
	 
	// now retrieve teacher_group_lessons entries
	list ($sYYYY, $sMth, $dd ) = split ('-', $startdate);
	$startMonth = $sYYYY . "-" . $sMth;
	list ($eYYYY, $eMth, $dd ) = split ('-', $enddate);
	$endMonth = $eYYYY . "-" . $eMth;
    $firstDayOfYear = date ("Y-m-d", mktime(0, 0, 0, 7, 1, $fromYear));
    $lastDayOfYear = date ("Y-m-d", mktime(0, 0, 0, 6, 30, $toYear));
	
	$query = "SELECT payment_id, teacher.teacher_id, teacher.teacher, date, amount, " .
	         "remarks, group_lesson_id FROM group_lesson_payments, teacher " .
			 "WHERE group_lesson_payments.teacher_id = teacher.teacher_id " . 
			 "AND date BETWEEN \"$startdate\" AND \"$enddate\" ";
	if ( $teacher_id > 0 && $teacherForm1 <> "" ) {
	  $query .=  "AND group_lesson_payments.teacher_id=$teacher_id ";
	}
	$query .= "ORDER BY date desc;";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows_payment = mysql_num_rows($result);
	
	$j = 0;
    while ( list ($paymentID, $teacherID, $teacherName, $date, $amount, $remarks, $groupLessonID) = mysql_fetch_row($result)) {
	   $query = "SELECT group_lesson as groupLesson FROM group_lesson WHERE group_lesson_id = $groupLessonID";
	   // echo "$query<br>";
	   $result2 = mysql_query($query, $promusic) or die(mysql_error());
       $row = mysql_fetch_array($result2);
       extract($row);
       require ('teacher_group_lessons_row_entry.php');
	   $j += 1;
	}  // End while
    
	// Display a blank form line for adding new entry
	$date = '';
	$amount = 0;
	$remarks = "";
	$teacherName="";
	$teacherID=0;
	$groupLessonID=0;
	$groupLesson="";
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
    require ('teacher_group_lessons_row_entry.php');
  }
    
}  // End if action = 1

if ( $action == 2 ) {
  $numRows_payment = $_POST['num_entries'];
  $j = 0;
  // require ('teacher_group_lessons_header_row.php');

  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( $j <= $numRows_payment + 4 ) {
    $del = "delete" . $j;
    $delete = $_POST["$del"];
    $payID = "payment_id" . $j;
    $paymentID = $_POST["$payID"];
    $tID = "teacher_id" . $j;
    $teacherID = $_POST["$tID"];
    $teacherRow = "teacher" . $j;
    $teacherName = $_POST["$teacherRow"];
    $glRow = "group_lesson" . $j;
    $groupLesson = $_POST["$glRow"];
    $cDate = "date" . $j;
    $date = $_POST["$cDate"];
    $amt = "amount" . $j;
    $amount = $_POST["$amt"];
    $rmk = "remarks" . $j;
    $remarks = $_POST["$rmk"];
    $chg = "changed" . $j;
    $changed = $_POST["$chg"];
    $gID = "group_lesson_id" . $j;
    $groupLessonID = $_POST["$gID"];
  
    
	if ( $j <= $numRows_payment - 1 ) {
      if ( $delete == "delete" && $paymentID > 0 ) {
        $query = "DELETE FROM group_lesson_payments " .
		   "WHERE payment_id = $paymentID;";
		// echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	  }
	  else {
	    if ( $changed == "changed" ) {
		  $query = "UPDATE group_lesson_payments SET " .
             "date=\"$date\",  " .
		     "amount=$amount, " .
		     "remarks=\"$remarks\" " .
		     "WHERE payment_id = $paymentID;";
		   // echo "$query<br>";
          $result = mysql_query($query, $promusic) or die(mysql_error());
		}  // end if changed = 'changed'
	  }
	}
	else {   // Insert new record for the last 5 entries
      if ( $date <> "" && $amount <> 0 && $changed == "changed" ) {
	    $query = "SELECT teacher_id FROM teacher WHERE teacher = \"$teacherName\" ";
	    $result = mysql_query($query, $promusic) or die(mysql_error());
        $row = mysql_fetch_array($result);
        extract($row);
		
		$query = "SELECT group_lesson_id as groupLessonID FROM group_lesson WHERE group_lesson=\"$groupLesson\" ";
	    // echo "$query<br>";
	    $result = mysql_query($query, $promusic) or die(mysql_error());
        $row = mysql_fetch_array($result);
        extract($row);
		
	    $query = "INSERT INTO group_lesson_payments " .
		     "(teacher_id, date, amount, " .
			 "remarks, group_lesson_id ) VALUES " .
			 "($teacher_id, \"$date\", $amount, " .
 			 "\"$remarks\", $groupLessonID );";	        
	    // echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
		
	  }
	}  
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
  } // end while
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  echo "<script>document.form1.retrieve.click()</script>"; 
     
}  // End action = 2
       
if ( $action == "" ) {
	$date = '';
	$amount = 0;
	$chqNum = "";
	$paymentMethod = "";
	$remarks = "";
	$ref = "";
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
    require ('teacher_group_lessons_row_entry.php');
    $j += 1;
    require ('teacher_group_lessons_row_entry.php');
}

$aaa =<<<EOD
	  </table>
		</td>
			<td>&nbsp;</td>
	</tr>
	</table>
EOD;
echo $aaa;

require ('teacher_group_lessons_trailer.php');
?>

<input name="num_entries" value="<?php echo $numRows_payment; ?>" type="hidden" id="num_entries" />
<input name="teacher" value="<?php echo $teacherForm1; ?>" type="hidden" id="teacher" />
<input name="start_date" value="<?php echo $startdate; ?>" type="hidden" id="start_date" />
<input name="end_date" value="<?php echo $enddate; ?>" type="hidden" id="end_date" />
<input name="teacher_id" value="<?php echo $teacher_id; ?>" type="hidden" id="teacher_id" />

</form>


</body>
</html>
<?php
//mysql_free_result($teacher);
?>
