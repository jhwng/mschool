<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_course_names = "SELECT course_name FROM course ORDER BY course_name asc";
$course_names = mysql_query($query_course_names, $promusic) or die(mysql_error());
$row_course_names = mysql_fetch_assoc($course_names);
$totalRows_course_names = mysql_num_rows($course_names);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cheque Deposit</title>


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

<body onLoad='document.form1.date.focus()'>


<?php
/*
action = 1 - Retrieve cheque records
actuin = 2 - update cheque records
*/
$action = $_GET['action'];
$submit = $_POST['submit1'];
$date = $_POST['date'];
$delete = $_POST['delete'];

include 'banner1.php';

?>
<table width="815" height="30" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Cheque Deposit</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="cheque_deposit.php?action=1">
  <table width="750" border="0" cellspacing="0" cellpadding="0">
    
    <tr>
      <td width="59">&nbsp;</td>
      <td width="664">To Date : 
        <input name="date" type="text" id="date" size="10" maxlength="10" onChange='checkDateFormat(form, this)' value="<?php echo $date; ?>">
        &nbsp;
<input name="button" type="submit" class="btn" id="button" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Retrieve Records"/>&nbsp;&nbsp;&nbsp;
<input name="button3" type="button" class="btn" id="button3" onclick='newWindow=window.open("cheque_deposit.csv","newWindow","status,resizable=yes,scrollbars,toolbar,menubar,HEIGHT=500,WIDTH=800"); newWindow.focus();' onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="View Deposit List"/>
&nbsp;&nbsp;&nbsp;

<input name="deletefile" type="password" id="deletefile" size="10" maxlength="10" />&nbsp;&nbsp;

<input name="button2" type="button" class="btn" id="button2" onclick='if ( document.form1.deletefile.value != "deletecsv" ) alert("Invalid Pass Phrase"); else { document.form1.deletefile.value=""; newWindow2=window.open("delete_csv.php","newWindow2","HEIGHT=150,WIDTH=500"); newWindow2.focus();}' onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Erase File Content"/></td>
      
      <td width="27">&nbsp;</td>
    </tr>
  </table>
</form>
<?php

if ( $action == 1 )   // Retrieve Teacher info
{
  if ( !(isset($date)) || $date == "" ) {
	echo '<script>alert("Please enter a date for the cheques to be processed up to")</script>'; 
	$error = 1;
  }
  else    // else id 1
  {
    require ('cheque_deposit_header.php');
	$j = 0;
	
	$query = "select scheduled_payment_id, full_name, parents_names, home_tel, mother_cell_tel, father_cell_tel, course_name, cheque_date, cheque_num, cheque_name, amount, status from student_scheduled_payments, student, account, course where student_scheduled_payments.student_id = student.student_id and student.account_id = account.account_id and student_scheduled_payments.course_id = course.course_id and ( student_scheduled_payments.status = 'R' OR student_scheduled_payments.status = 'L' ) and cheque_date <= \"$date\" order by full_name limit 10";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
	if ( $numRows > 0 ) {
      while ( list ( $paymentID, $sname, $pnames, $homeTel, $mCellTel, $fCellTel, $course, $chqDate, $chqNum, $chqName, $amount, $status ) = mysql_fetch_row($result) ) {
         $cellTels = $mCellTel;
		 if ( $fCellTel <> "" ) $cellTels .= " / " . $fCellTel;
		 require ('cheque_deposit_row_entry.php');
	     $j += 1;
	  }  // End while
	}  // end if numRows > 0
    
	 
  }  // end else id 1
}  // end action = 1


if ( $action == 2 ) {
  $myFile = "cheque_deposit.csv";
  $fh = fopen($myFile, 'a') or die("can't open file");

  $classEntries = 0;
  $numEntries = $_POST['num_entries'];
  $numRows = $numEntries;
  $j = 0;
  require ('cheque_deposit_header.php');

  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( $j <= $numEntries -1 ) {
    $dep = "deposit" . $j;
    $deposit = $_POST["$dep"];
    $cName = "course" . $j;
    $course = $_POST["$cName"];
    $name = "sname" . $j;
    $sname = $_POST["$name"];
    $cDate = "chqDate" . $j;
    $chqDate = $_POST["$cDate"];
    $cNum = "chqNum" . $j;
    $chqNum = $_POST["$cNum"];
    $amt = "amount" . $j;
    $amount = $_POST["$amt"];
    $cqName = "chqName" . $j;
    $chqName = $_POST["$cqName"];
    $sttus = "status" . $j;
    $status = $_POST["$sttus"];
    $rateid = "teacher_rate_id" . $j;
    $pID = "payment_id" . $j;
    $paymentID = $_POST["$pID"];
	$date = $_POST['date'];

    if ( $deposit == "yes" ) {
      if ( $status == "R" ) {
        $query = "UPDATE student_scheduled_payments SET status = \"D\", user_id = $thisUserID ";
	  }
      if ( $status == "L" ) {
        $query = "UPDATE student_scheduled_payments SET status = \"LD\", user_id = $thisUserID ";
	  }
	  $query .= "WHERE scheduled_payment_id = $paymentID ";
	  // echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
      
	  // write to cheque deposit list 
	  $stringData = "\"$chqDate\",\"$sname\",\"$chqNum\",$amount,\"$chqName\"" . "\n";
      fwrite($fh, $stringData);
	}
	
    $j += 1;
  } // end while
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  fclose($fh);
  echo "<script>document.form1.submit()</script>";
     
}  /* end if action = 2 */

if ($action <> "") require ('cheque_deposit_trailer.php');
?>

</body>
</html>
