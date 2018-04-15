<?php require_once('Connections/promusic.php'); ?>
<?php

mysql_select_db($database_promusic, $promusic);

$full_name = $_GET['fullname'];
$name_tie_breaker = $_GET['tiebreaker'];
$parents_names = $_GET['pnames'];
$home_tel = $_GET['hometel'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Related Friends of <?php echo "$fullname"; ?></title>


<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style10 {font-size: 12px; color: #000000;}
.style7 {color: #FFFFFF}
.style9 {color: #000000}
body {
	background-color: #F8F8EF;
}
-->
</style>
</head>

<body>
<h4 align="center">
<p><span class="banner_text">Potential Name Conflicts for <?php echo $full_name; ?></span>
  </h3>
</p>
<form action="" method="post" name="form0" id="form0">
  <table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
   <tr>
      <td width="136" height="22" bgcolor="#FFCF9F" class="style9">Student Name </td>
      <td width="95" bgcolor="#FFCF9F" class="style9">Tie Breaker </td>
      <td width="104" bgcolor="#FFCF9F" class="style9">Parents Names </td>
      <td width="97" bgcolor="#FFCF9F" class="style9">Home Phone </td>
    </tr>
<?php
$query_check_student = "SELECT student.full_name, student.name_tie_breaker, account.parents_names, account.home_tel FROM student INNER JOIN account ON student.account_id = account.account_id
WHERE (((student.full_name)=\"$full_name\") AND ((account.parents_names)=\"$parents_names\") AND ((account.home_tel)=\"$home_tel\"))";

$check_student = mysql_query($query_check_student, $promusic) or die(mysql_error());
$totalRows_student = mysql_num_rows($check_student);

while (list($sname, $tb, $pnames, $home) = mysql_fetch_row($check_student)) {
    echo " <tr>\n" .
          "  <td>$sname</td>\n" .
		  " <td>$tb&nbsp;</td>\n" .
		  " <td>$pnames</td>\n" .
		  " <td>$home&nbsp;</td>\n" .
          " </tr>\n";
}


?>
  </table>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center" class="bluetext">Check the names as show above and make corrections to the names and home phone,  if necessary</div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center">
        <input name="Button" type="button" class="btn" id="submit" onclick="window.close()"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Close Window"/>
      </div></td>
    </tr>
  </table>
</form>
<p class="banner_text">&nbsp;</p>
</body>
</html>
