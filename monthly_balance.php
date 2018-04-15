<?php 
require_once('Connections/promusic.php'); 
mysql_select_db($database_promusic, $promusic);
$query_course_names = "SELECT course_name FROM course ORDER BY course_name asc";
$course_names = mysql_query($query_course_names, $promusic) or die(mysql_error());
$row_course_names = mysql_fetch_assoc($course_names);
$totalRows_course_names = mysql_num_rows($course_names);

$action=$_GET['action'];
$fullname=$_POST['full_name'];
$coursename=$_POST['course_name'];
$year=$_POST['year'];
$home_tel=$_POST['home_tel'];
$student_id=$_POST['student_id'];
$name_tie_breaker=$_POST['name_tie_breaker'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Projected Monthly Balance</title>

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
    <td width="606" valign="middle"><div align="center"><span class="style2">Projected Monthly Balance	</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<table width="815" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="815"><div align="center">
      <form id="form1" name="form1" method="post" action="monthly_balance.php?action=1">
        <div align="center">
          <table width="750" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20"><div align="center">Student Full Name:
              <input name="full_name" type="text" id="full_name" size="30" maxlength="60"
		  <?php if ($fullname <> "") echo "VALUE=\"" . $fullname . "\";" ?> />
  &nbsp;&nbsp;
  <input name="submit2" type="button" class="btn" id="submit2" onclick="studentNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Name Search"/>
  &nbsp;&nbsp;&nbsp;Course:
  <select name="course_name" class="dropdowntext" id="course_name">
    <?php
do {  
?>
    <option value="<?php echo $row_course_names['course_name']?>"><?php echo $row_course_names['course_name']?></option>
    <?php
} while ($row_course_names = mysql_fetch_assoc($course_names));
  $rows = mysql_num_rows($course_names);
  if($rows > 0) {
      mysql_data_seek($course_names, 0);
	  $row_course_names = mysql_fetch_assoc($course_names);
  }
?>
  </select>
            &nbsp;&nbsp;&nbsp;Year: 
            <input name="year" type="text" id="year" size="4" maxlength="4" 
			<?php if ( $year <> "" ) { echo "VALUE=\"$year\""; } ?>/>
            </div></td>
          </tr>
          <tr>
            <td height="30"><div align="center"> Name Tie Breaker :
                <input name="name_tie_breaker" type="text" id="name_tie_breaker" size="25" maxlength="45" 
		  <?php if ( $name_tie_breaker <> "" ) { echo "VALUE=\"$name_tie_breaker\""; } ?> />
&nbsp;&nbsp;&nbsp;Home Phone.:
<input name="home_tel" type="text" id="home_tel" size="15" maxlength="30" 
		  <?php if ( $home_tel <> "" ) { echo "VALUE=\"$home_tel\""; } ?> />
&nbsp;&nbsp;&nbsp;
<! <input name="student_id" type="text" id="student_id" size="8" maxlength="12"  ->
<input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Search Classes"/>
            <input name="student_id" type="hidden" id="student_id" 
		  <?php if ( $student_id <> "" ) { echo "VALUE=\"$student_id\""; } ?> />
            </div></td>
          </tr>
        </table>
        </div>
      </form>
    </div></td>
  </tr>
</table>

<?php
if ( $action == 1 ) {
  // user clicked Generate Report button
  
$form_header =<<< EOD
<form id="form1" name="form1" method="post" action="">
  <table width="1000" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#FFBA75">
      <td width="55">Month</td>
      <td width="55">No. Class</td>
      <td width="55">Total Mins </td>
      <td width="55">Ext Mins</td>
      <td width="55">Net Fee </td>
      <td width="55">PD Chq </td>
      <td width="55">Wmins this mth </td>
      <td width="55">Wamt this mth </td>
      <td width="55">Cur Yr Wmins </td>
      <td width="55">Cur Yr Wamt </td>
      <td width="55">Wmins used </td>
      <td width="55">Cur Yr Tmins </td>
      <td width="55">Cur Yr Tamt </td>
      <td width="55">Tmins used </td>
      <td width="55">Cash</td>
      <td width="55">Cash used </td>
      <td width="55">Misc items </td>
      <td width="55"><p>Bal</p>
      </td>
    </tr>
EOD;
    echo $form_header;
  
  // get start and end month for reporting
  $smonth = $year * 100 + 7;
  $emonth = ( $year + 1 ) * 100 + 6;
  
  // get course_id
  $query = "SELECT course_id FROM course WHERE course_name = $coursename";
  $result = mysql_query($query $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
  
  // display month-end records first starting from $smonth
  $query = "SELECT month, num_lessons, total_mins, extra_mins, total_fee, PD_cheque, wmins_this_month, tmins_this_month, cur_year_wmins, cur_year_wamt, wmins_used_this_month, wamts_used_this_month, wcredit_this_month, cur_year_tmins, cur_year_tamt, tmins_used_this_month, tamts_used_this_month, tcredits_this_month, cash_balance, cash_used_this_month, adhoc_payments, misc_items, balance FROM month_end WHERE student_id = $student_id AND course_id = $course_id AND month >= $smonth;";
  $result = mysql_query($query $promusic) or die(mysql_error());
  $numRows = mysql_num_rows($result);
  
  if ( $numRows > 0 ) {
	while ( list ( $month, $num_lessons, $total_mins, $extra_mins, $total_fee, $PD_cheque, $wmins_this_month, $tmins_this_month, $cur_year_wmins, $cur_year_wamt, $wmins_used_this_month, $wamts_used_this_month, $wcredit_this_month, $cur_year_tmins, $cur_year_tamt, $tmins_used_this_month, $tamts_used_this_month, $tcredits_this_month, $cash_balance, $cash_used_this_month, $adhoc_payments, $misc_items, $balance )   = mysql_fetch_row($teacher_rates) ) {
	  
	  require ('month_end_form.php');

	
	}  // end while
	
	
  }   // End if nowRows > 0	

/*
	  // get info from student_scheduled_payments
	  $query = "SELECT number_of_lessons, amount FROM student_scheduled_payments " .
	           "WHERE student_id = $student_id AND course_id = $course_id"
*/
}  /* end if action =1 */
?>

</table>
</form>
<!
select cancelled, external_rate, sum(duration) as WMins, (sum(minute_balance) * external_rate) as WTotal  from student_credit_minutes
where student_id=901 and course_id=1 and (date between "$smonth" and "$emonth" ) 
and cancelled="T"
group by  external_rate order by external_rate
->

</body>
</html>
