<?php require_once('Connections/promusic.php'); ?>
<?php

mysql_select_db($database_promusic, $promusic);

$sname = $_GET['name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Teacher Name Search  for <?php echo "$fullname"; ?></title>


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

<script  language="javascript">

function postParentFormValues(tID, tName) {
     self.opener.document.form1.teacher.value = tName.replace(/--=--/,"'"); 
     self.opener.document.form1.teacher_id.value=tID; 
     self.opener.document.form1.submit(); 
  window.close();
  return;
}
</script>

</head>

<body>
<h4 align="center">
<p><span class="banner_text">Teacher Name Search for <?php echo $sname; ?></span>
  </h3>
</p>
<form action="" method="post" name="form0" id="form0">
  <table width="700" border="1" align="center" cellpadding="3" cellspacing="0">
   <tr>
      <td width="195" height="22" bgcolor="#FFCF9F" class="style9">Teacher Name </td>
      <td width="130" bgcolor="#FFCF9F" class="style9">Home Phone </td>
      <td width="130" bgcolor="#FFCF9F" class="style9">Cell Phone </td>
      <td width="130" bgcolor="#FFCF9F" class="style9">Other Phone</td>
    </tr>
<?php

$query = "SELECT teacher_id, teacher, home_tel, cell_tel, other_tel, active FROM teacher " .
         "WHERE teacher like \"%$sname%\" " .
		 "order by teacher";

// echo "$query<br>";

$result = mysql_query($query, $promusic) or die(mysql_error());
$numRows = mysql_num_rows($result);

if ( $numRows == 1 ) {
  list($tID, $teacherName, $homeTel, $cellTel, $otherTel, $active) = mysql_fetch_row($result);
  $tName = str_replace("'", "--=--", $teacherName);
  echo "<script>postParentFormValues($tID, \"$tName\")</script>";
}
else  {
  while ( list($tID, $teacherName, $homeTel, $cellTel, $otherTel, $active) = mysql_fetch_row($result)) {
    $tName = str_replace("'", "--=--", $teacherName);
	echo " <tr height=\"18\">\n" .
		  " <td><a href='javascript:postParentFormValues($tID, \"$tName\")'>$teacherName</a>";
	if ( $active == "N" ) { echo "  (*** Inactive ***)"; }
	echo "</td>\n" .
          "  <td>$homeTel&nbsp;</td>\n" .
		  " <td>$cellTel&nbsp;</td>\n" .
		  " <td>$otherTel&nbsp;</td>\n" .
          " </tr>\n";
  }  // end while
}  // end else of numRows = 1

?>
  </table>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center" class="bluetext">click on a name to select a teacher</div></td>
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
