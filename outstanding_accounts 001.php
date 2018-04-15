<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Outstanding Accounts</title>


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

<body onLoad='document.form1.end_date.focus()'>


<?php
/*
actuin = 1 - Display list
*/
$action = $_GET['action'];
$submit = $_POST['submit1'];
$endDate = $_POST['end_date'];

include 'banner1.php';

?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Outstanding Accounts</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>

<form id="form1" name="form1" method="post" action="outstanding_accounts.php?action=1">
  <table width="750" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center">Outstanding Account as of: 
          <input name="end_date" type="text" id="end_date" onChange='checkDateFormat(form, this)' value="<?php echo $endDate; ?>" size="10" maxlength="10" />
          &nbsp;&nbsp;&nbsp;&nbsp;
        <input name="submit2" type="submit" class="btn" id="submit" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Display List"/>
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php
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

  require ('outstanding_accounts_header.php');
  $query = "SELECT dow, time, full_name, course_name, parents_names, home_tel, student_registered_classes.student_id, student_registered_classes.course_id FROM student_registered_classes, student, account, course WHERE student_registered_classes.student_id = student.student_id AND student_registered_classes.course_id = course.course_id AND student.account_id = account.account_id AND school_year = \"$schYear\" ORDER by dow, time, full_name, course_name";
  //echo "$query<br>";
  $result_list = mysql_query($query, $promusic) or die(mysql_error());
  $numRows_list = mysql_num_rows($result_list);
  
  $j = 1;
  while ( list ( $dow, $time, $fullName, $courseName, $pNames, $homeTel, $studentID, $courseID ) = mysql_fetch_row($result_list) ) {
	  $query = "SELECT sum(amount) as monthlyPDchqAmount FROM student_scheduled_payments " .
	     "WHERE student_id=$studentID AND course_id=$courseID " .
		 "AND ( status = \"R\" OR status = \"D\" OR status = \"H\" ) " .
	     "AND cheque_date BETWEEN \"$startDate\" AND \"$endDate\"; ";
      //echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      $numRows = mysql_num_rows($result);
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $monthlyPDchqAmount == "" ) {
	    $monthlyPDchqAmount = 0;
	  }

      $query = "select sum(duration * external_rate /15) as usageAmt from class_schedule " .
           "where student_id=$studentID and course_id=$courseID " .
		   // "and ( class_type = '' or class_type is NULL )" .
		   " and ( date between \"$startDate\" and \"$endDate\" ) " .
		   " and ( (cancelled <> 'W' and cancelled <> 'T' and cancelled <> 'CXL' ) " .
		   " or cancelled is NULL  or cancelled = \"\" )";
      //echo "$query<br>";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $usageAmt == "" ) {
	    $usageAmt = 0;
	  }  
	  
	  $query = "SELECT sum(amount) as adHocPayment from adhoc_payments " .
	     "where student_id=$studentID and course_id=$courseID and " .
		 "date between \"$startDate\" and \"$endDate\"";
      //echo "$query<br>";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $adHocPayment == "" ) {
	    $adHocPayment = 0;
	  }  
	  
	  $query = "SELECT sum(amount) as miscAmt from misc_items " .
	     "where student_id=$studentID and course_id=$courseID and " .
		 "date between \"$startDate\" and \"$endDate\"";
      //echo "$query<br>";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);
      extract($row);
      if ( $miscAmt == "" ) {
	    $miscAmt = 0;
	  }  // end if numRows = null
	  	  
	  $balance = $monthlyPDchqAmount + $adHocPayment - $miscAmt - $usageAmt;
	  if ( $balance < 0 ) {
	    require ('outstanding_accounts_row_entry.php');
	    $j +=1;  
	  }   
  }  // End while
  require ('outstanding_accounts_trailer.php');
    
	 
}  // end action = 1


?>

</body>
</html>
