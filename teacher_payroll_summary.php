<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_teachers = "select teacher from teacher where active = 'Y' or active is NULL or active = '' order by teacher;";
$teachers = mysql_query($query_teachers, $promusic) or die(mysql_error());
$row_teachers = mysql_fetch_assoc($teachers);
$totalRows_teachers = mysql_num_rows($teachers);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Teacher's Payroll Summary</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style9 {font-size: 16px}
.style10 {font-size: 14px}
.style13 {font-size: 14px; font-weight: bold; }
.style14 {color: #0033FF}
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
    <td width="60">&nbsp;</td>
    <td width="688" valign="middle"><div align="center"><span class="style2">Monthly Teaching Hours Summary </span></div></td>
    <td width="67">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="formprocess1.php">
  <div align="left">
    <table width="731" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="131">&nbsp;</td>
          <td width="554" valign="middle"><div align="left">Tearcher's Name:&nbsp;
              <select name="teacher" class="dropdowntext" id="teacher">
                <?php
do {  
?>
                <option value="<?php echo $row_teachers['teacher']?>"><?php echo $row_teachers['teacher']?></option>
                <?php
} while ($row_teachers = mysql_fetch_assoc($teachers));
  $rows = mysql_num_rows($teachers);
  if($rows > 0) {
      mysql_data_seek($teachers, 0);
	  $row_teachers = mysql_fetch_assoc($teachers);
  }
?>
              </select>
            Month (YYYY-MM): 
            <input name="month" type="text" id="month" size="8" maxlength="7" />            
            <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value=" Search"/>          
            </div></td>
        </tr>
    </table>
    <br />
    <table width="740" border="0" align="left" cellpadding="1" cellspacing="1">
      <tr>
        <td width="117">&nbsp;</td>
        <td width="172" bgcolor="#FFFFD7" class="style9 style2"><div align="left" class="style10"><strong>Name</strong></div></td>
        <td width="128" bgcolor="#FFFFD7" class="style10 style2"><strong>Course</strong></td>
        <td width="149" bgcolor="#FFFFD7" class="style2 style10"><strong>Grade</strong></td>
        <td width="158" bgcolor="#FFFFD7" class="style9 style2"><div align="left" class="style13">Lesson Minutes </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="18" bgcolor="#E1E1FF"><div align="left"><a href="formprocess1.php">Kristy Choy </a></div></td>
        <td bgcolor="#E1E1FF">Piano</td>
        <td bgcolor="#E1E1FF">7</td>
        <td bgcolor="#E1E1FF"><div align="left">300 </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="18" bgcolor="#FFFFD7"><div align="left"><a href="formprocess1.php">Vania Wu </a></div></td>
        <td bgcolor="#FFFFD7">Piano</td>
        <td bgcolor="#FFFFD7"><p>0 </p>
        </td>
        <td bgcolor="#FFFFD7"><div align="left">240</div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="18">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="18" bgcolor="#FFB76F">&nbsp;</td>
        <td bgcolor="#FFB76F">&nbsp;</td>
        <td bgcolor="#FFB76F"><div align="right" class="style14">Total Lesson minutes:&nbsp;&nbsp;</div></td>
        <td bgcolor="#FFB76F"><span class="style14">540</span></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
<?php
mysql_free_result($teachers);
?>
