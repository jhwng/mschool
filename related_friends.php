<?php require_once('Connections/promusic.php'); ?>
<?php
$friends = $_GET['friends'];
$farray = explode(";", $friends);
$fullname = $_GET['fullname'];

mysql_select_db($database_promusic, $promusic);

/* $row_teacher_rate = mysql_fetch_assoc($teacher_rates); */
/* $totalRows_friends = mysql_num_rows($related_friends); */

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
<p><span class="banner_text">Related Friends of <?php echo $fullname; ?></span>
  </h3>
</p>
<form action="" method="post" name="form0" id="form0">
  <table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
   <tr>
      <td width="195" height="22" bgcolor="#FFCF9F" class="style9">Student Name </td>
      <td width="130" bgcolor="#FFCF9F" class="style9">Home Phone </td>
      <td width="130" bgcolor="#FFCF9F" class="style9">Parents Names</td>
      <td width="130" bgcolor="#FFCF9F" class="style9">Name Tie Breaker</td>
    </tr>
<?php
foreach ( $farray as $val ) {
  // trim all character after "|" of the name
  $pos = strpos($val, '|');
  if ( !($pos === false) ) { $val1 = trim(substr($val, 0, $pos)); } else { $val1 = trim($val); } 

  /* $query_friends = "SELECT DISTINCT student.full_name, student.name_tie_breaker, account.home_tel, account.home_tel
FROM (((account INNER JOIN student ON student.account_id = account.account_id) INNER JOIN student_registered_classes ON student.student_id = student_registered_classes.student_id) INNER JOIN teacher ON student_registered_classes.teacher_id = teacher.teacher_id) INNER JOIN course ON student_registered_classes.course_id = course.course_id WHERE ( student.full_name like '%$val1%' ) ORDER BY student.full_name;" ;  */
  $query_friends = "SELECT DISTINCT student.full_name, account.home_tel, " .
       "account.parents_names, student.name_tie_breaker " .
	   "FROM student, account " .
	   "WHERE student.account_id = account.account_id ".
	   "AND student.full_name like '%$val1%' " .
	   "ORDER BY student.full_name";
 //echo $query_friends . "<br>";
  $related_friends = mysql_query($query_friends, $promusic)  or die(mysql_error());
  while (list($name, $home_tel, $pnames, $tb) = mysql_fetch_row($related_friends)) {
    echo  " <tr>\n" .
          //"  <td><a href=\"student.edit.php?name=" . urlencode($name) . "\">$name</a></td>\n" .
		  "  <td>$name</a></td>\n" .
		  " <td>$home_tel</td>\n" .
		  " <td>$pnames</td>\n" .
		  " <td>$tb&nbsp;</td>\n" .
          " </tr>\n";
  }
}

?>
  </table>
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
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
