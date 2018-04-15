<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_teacher = "select teacher from teacher order by teacher;";
$teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacher);
$totalRows_teacher = mysql_num_rows($teacher);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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
-->
</style>
</head>

<body>
<?php include 'banner1.php'; ?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Class Schedule Management </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>

<?php
$tbl_header = <<<EOD
   <tr bgcolor="#FFFFD7">
      <td height="24" colspan="12" nowrap="nowrap"><div align="center">
        <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Submit"/>
        <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
      </div></td>
    </tr>
    <tr bgcolor="#FFBA75">
      <td height="24" colspan="6" nowrap="nowrap"><div align="center" class="style3 style9 style11">Registered Classes </div></td>
      <td colspan="6"><div align="center" class="style9">Reschedule Class </div></td>
    </tr>
    <tr bgcolor="#FFFFD7">
      <td width="69" nowrap="nowrap" class="style6 style8"><div align="center">Date</div></td>
      <td width="55" class="style6 style8"><div align="center">Time</div></td>
      <td width="57" nowrap="nowrap" class="style6 style8"><div align="center">Duration</div></td>
      <td width="100" nowrap="nowrap" class="style6 style8"><div align="center">Teacher</div></td>
      <td width="55" class="style6 style8"><div align="center">Rate</div></td>
      <td width="64" class="style6 style8"><div align="center">Cancel</div></td>
      <td width="139" nowrap="nowrap" class="style6 style8"><div align="center">Rechedule Date</div></td>
      <td width="35" class="style6 style8"><div align="center">Time</div></td>
      <td width="73" class="style6 style8"><div align="center">Duration</div></td>
      <td width="137" class="style6 style8"><div align="center">Teacher</div></td>
      <td width="36" class="style6 style8"><div align="center">Rate</div></td>
      <td width="129" class="style6 style8"><div align="center">Remarks</div></td>
    </tr>
EOD;
?>

<?php
$aaa =<<<EOD
  <tr valign="top">
      <td width="69" nowrap="nowrap"><div align="center">2007-12-31</div></td>
      <td width="55" nowrap="nowrap"><div align="center">12:66 am </div></td>
      <td><div align="center">30</div></td>
      <td>Michael Joseph Smith </td>
      <td nowrap="nowrap"><div align="center">25</div></td>
      <td><input name="cancel_class" type="checkbox" id="cancel_class" value="C" />
        <select name="cancel" class="dropdowntext" id="cancel">
        <option value="W" selected="selected">W</option>
        <option value="WO">WO</option>
        <option value="T">T</option>
        <option value="WOT">WOT</option>
      </select></td>
      <td nowrap="nowrap"><input type="checkbox" name="checkbox" value="checkbox" />
        <span class="bluetext">Check to reschedule</span> 
        <script>DateInput('start_date', true, 'YYYY-MM-DD')</script>      </td>
      <td><input name="time" type="text" id="time" size="6" maxlength="8" /></td>
      <td><select name="duration" class="dropdowntext" id="duration">
        <option value="30">30</option>
        <option value="45">45</option>
        <option value="60">60</option>
        <option value="75">75</option>
        <option value="90">90</option>
        <option value="120">120</option>
                              </select></td>
      <td>&nbsp;</td>
      <td><input name="rate" type="text" id="rate" size="6" maxlength="8" /></td>
      <td><input name="remarks" type="text" id="remarks" size="30" maxlength="100" /></td>
    </tr>
EOD;
?>


<form id="form1" name="form1" method="post" action="formprocess1.php">
  <table width="886" border="1" cellspacing="0" cellpadding="1">
    <tr bgcolor="#FFFFD7">
      <td height="24" colspan="12" nowrap="nowrap"><div align="center">
        <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Submit"/>
        <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
      </div></td>
    </tr>
    <tr bgcolor="#FFBA75">
      <td height="24" colspan="6" nowrap="nowrap"><div align="center" class="style3 style9 style11">Registered Classes </div></td>
      <td colspan="6"><div align="center" class="style9">Reschedule Class </div></td>
    </tr>
    <tr bgcolor="#FFFFD7">
      <td width="69" nowrap="nowrap" class="style6 style8"><div align="center">Date</div></td>
      <td width="55" class="style6 style8"><div align="center">Time</div></td>
      <td width="57" nowrap="nowrap" class="style6 style8"><div align="center">Duration</div></td>
      <td width="100" nowrap="nowrap" class="style6 style8"><div align="center">Teacher</div></td>
      <td width="55" class="style6 style8"><div align="center">Rate</div></td>
      <td width="64" class="style6 style8"><div align="center">Cancel</div></td>
      <td width="139" nowrap="nowrap" class="style6 style8"><div align="center">Rechedule Date</div></td>
      <td width="35" class="style6 style8"><div align="center">Time</div></td>
      <td width="73" class="style6 style8"><div align="center">Duration</div></td>
      <td width="137" class="style6 style8"><div align="center">Teacher</div></td>
      <td width="36" class="style6 style8"><div align="center">Rate</div></td>
      <td width="129" class="style6 style8"><div align="center">Remarks</div></td>
    </tr>
    <tr valign="top">
      <td width="69" nowrap="nowrap"><div align="center">2007-12-31</div></td>
      <td width="55" nowrap="nowrap"><div align="center">12:66 am </div></td>
      <td><div align="center">30</div></td>
      <td>Michael Joseph Smith </td>
      <td nowrap="nowrap"><div align="center">25</div></td>
      <td><input name="cancel_class" type="checkbox" id="cancel_class" value="C" />
        <select name="cancel" class="dropdowntext" id="cancel">
        <option value="W" selected="selected">W</option>
        <option value="WO">WO</option>
        <option value="T">T</option>
        <option value="WOT">WOT</option>
      </select></td>
      <td nowrap="nowrap"><input type="checkbox" name="checkbox" value="checkbox" />
        <span class="bluetext">Check to reschedule</span> 
        <script>DateInput('start_date', true, 'YYYY-MM-DD')</script>      </td>
      <td><input name="time" type="text" id="time" size="6" maxlength="8" /></td>
      <td><select name="duration" class="dropdowntext" id="duration">
        <option value="30">30</option>
        <option value="45">45</option>
        <option value="60">60</option>
        <option value="75">75</option>
        <option value="90">90</option>
        <option value="120">120</option>
                              </select></td>
      <td>&nbsp;</td>
      <td><input name="rate" type="text" id="rate" size="6" maxlength="8" /></td>
      <td><input name="remarks" type="text" id="remarks" size="30" maxlength="100" /></td>
    </tr>
    <tr bgcolor="#FFFFD7">
      <td height="24" colspan="12" nowrap="nowrap"><div align="center">
          <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Submit"/>
          <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
      </div></td>
    </tr>

<?php echo $aaa; ?>
<?php echo $aaa; ?>
<?php echo $aaa; ?>
<?php echo $aaa; ?>
<?php echo $aaa; ?>
<?php echo $tbl_header; ?>
<?php echo $aaa; ?>
<?php echo $aaa; ?>
<?php echo $aaa; ?>
<?php echo $aaa; ?>
<?php echo $aaa; ?>
<?php echo $aaa; ?>
	
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($teacher);
?>
