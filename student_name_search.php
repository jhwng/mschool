<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php

mysql_select_db($database_promusic, $promusic);

$sname = $_GET['name'];

$_SESSION['getPrevOrNextYearSessionCourse'] = ""; //xxxjng

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Student Name Check for <?php echo "$fullname"; ?></title>


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

function postParentFormValues(acctID, sname, pnames, hometel, tb, sid, addr1, addr2, city, province) {
  if (window.opener.location.toString().indexOf("student.php") != -1 || window.opener.location.toString().indexOf("student_create2.php") != -1) { 
     // opener is student.php
     self.opener.document.form1.full_name.value = sname.replace(/--=--/,"'"); 
	 self.opener.document.form1.name_tie_breaker.value=tb.replace(/--=--/,"'"); 
	 self.opener.document.form1.parents_names.value=pnames.replace(/--=--/,"'"); 
	 self.opener.document.form1.home_tel.value=hometel;
     self.opener.document.form1.student_id.value=sid; 
	 self.opener.document.form1.addr1.value=addr1.replace(/--=--/,"'");
     self.opener.document.form1.addr2.value=addr2.replace(/--=--/,"'"); 
	 self.opener.document.form1.city.value=city.replace(/--=--/,"'");
     self.opener.document.form1.province.value=province; 
  } 

  if (window.opener.location.toString().indexOf("class_schedule.php") != -1) {  
     // opener is class_schedule.php
     self.opener.document.form1.full_name.value = sname.replace(/--=--/,"'"); 
	 self.opener.document.form1.home_tel.value=hometel;
     self.opener.document.form1.name_tie_breaker.value=tb.replace(/--=--/,"'"); 
     self.opener.document.form1.student_id.value=sid; 
	 self.opener.document.form1.course_name.options.length = 0;
 	 self.opener.document.form1.getlist.click();
  } 

  if ( (window.opener.location.toString().indexOf("payment_schedule.php") != -1) || 
       (window.opener.location.toString().indexOf("adhoc_payments.php") != -1) ||
       (window.opener.location.toString().indexOf("misc_items.php") != -1) ||
       (window.opener.location.toString().indexOf("balance_report.php") != -1) ) {  
     // opener is class_schedule.php
     self.opener.document.form1.full_name.value = sname.replace(/--=--/,"'"); 
     self.opener.document.form1.student_id.value=sid; 
	 self.opener.document.form1.course_name.options.length = 0;
	 self.opener.document.form1.course_name.options.length++;
	 self.opener.document.form1.course_name.options[0].text="Select One";
	 self.opener.document.form1.course_name.options[0].value="0";
 	 self.opener.document.form1.getlist.click();
  } 

  if ( (window.opener.location.toString().indexOf("add_classes.php") != -1) ||  
       (window.opener.location.toString().indexOf("course_details.php") != -1) ||
       (window.opener.location.toString().indexOf("terminate_course.php") != -1) ||
       (window.opener.location.toString().indexOf("bulk_changes.php") != -1) ) {  
     self.opener.document.form1.full_name.value = sname.replace(/--=--/,"'"); 
     self.opener.document.form1.student_id.value=sid; 
	 self.opener.document.form1.course_name.options.length = 0;
	 self.opener.document.form1.course_name.options.length++;
	 self.opener.document.form1.course_name.options[0].text="Select One";
	 self.opener.document.form1.course_name.options[0].value="0";
 	 self.opener.document.form1.getlist.click();
  } 

  if (window.opener.location.toString().indexOf("student_edit.php") != -1) { 
     self.opener.document.form1.full_name.value = sname.replace(/--=--/,"'"); 
	 self.opener.document.form1.name_tie_breaker.value=tb.replace(/--=--/,"'"); 
	 self.opener.document.form1.parents_names.value=pnames.replace(/--=--/,"'"); 
	 self.opener.document.form1.home_tel.value=hometel;
     self.opener.document.form1.student_id.value=sid; 
	 self.opener.document.form1.addr1.value=addr1;
     self.opener.document.form1.addr2.value=addr2; 
	 self.opener.document.form1.city.value=city;
     self.opener.document.form1.province.value=province; 
     self.opener.document.form1.account_id.value=acctID; 
     self.opener.document.form1.submit(); 
  }
  window.close();
  return;
}
</script>

</head>

<body>
<h4 align="center">
<p><span class="banner_text">Student Name Search for <?php echo $sname; ?></span>
  </h3>
</p>
<form action="" method="post" name="form0" id="form0">
  <table width="700" border="1" align="center" cellpadding="3" cellspacing="0">
   <tr>
      <td width="195" height="22" bgcolor="#FFCF9F" class="style9">Student Name </td>
      <td width="200" bgcolor="#FFCF9F" class="style9">Parents' Names </td>
      <td width="120" bgcolor="#FFCF9F" class="style9">Home Phone </td>
      <td width="157" bgcolor="#FFCF9F" class="style9">Name Tie Breaker </td>
    </tr>
<?php

$query = "SELECT student.student_id, student.account_id, student.full_name , student.name_tie_breaker, account.parents_names, account.home_tel, account.addr1, account.addr2, account.city, account.province
FROM student INNER JOIN account ON student.account_id = account.account_id
WHERE student.full_name like \"%$sname%\" order by student.full_name";

// echo "$query<br>";

$result = mysql_query($query, $promusic) or die(mysql_error());
$numRows = mysql_num_rows($result);

if ( $numRows == 1 ) {
  list($sid, $acctID, $sname, $tb, $pnames, $home, $addr1, $addr2, $city, $province) = mysql_fetch_row($result);
    $tb1 = str_replace("'", "--=--", $tb);
    $sname1 = str_replace("'", "--=--", $sname);
    $pnames1 = str_replace("'", "--=--", $pnames);
    $addr1R = str_replace("'", "--=--", $addr1);
    $addr2R = str_replace("'", "--=--", $addr2);
    $cityR = str_replace("'", "--=--", $city);
    $provinceR = str_replace("'", "--=--", $province);
    echo "<script>postParentFormValues($acctID, \"$sname1\", \"$pnames1\", \"$home\", \"$tb1\", \"$sid\", \"$addr1R\", \"$addr2R\", \"$cityR\", \"$provinceR\")</script>";
}
else {
  while (list($sid, $acctID, $sname, $tb, $pnames, $home, $addr1, $addr2, $city, $province) = mysql_fetch_row($result)) {
    $tb1 = str_replace("'", "--=--", $tb);
    $sname1 = str_replace("'", "--=--", $sname);
    $pnames1 = str_replace("'", "--=--", $pnames);
    $addr1R = str_replace("'", "--=--", $addr1);
    $addr2R = str_replace("'", "--=--", $addr2);
    $cityR = str_replace("'", "--=--", $city);
    $provinceR = str_replace("'", "--=--", $province);
    //	$tb1 = urlencode($tb);
	echo " <tr height=\"18\">\n" .
		  " <td><a href='javascript:postParentFormValues($acctID, \"$sname1\", \"$pnames1\", \"$home\", \"$tb1\", \"$sid\", \"$addr1R\", \"$addr2R\", \"$cityR\", \"$provinceR\")'>$sname</td>\n" .
          "  <td>$pnames</td>\n" .
		  " <td>$home&nbsp;</td>\n" .
		  " <td>$tb&nbsp;</td>\n" .
          " </tr>\n";
  }  // end while
}  // end else of nuwRows = 1

?>
  </table>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center" class="bluetext">You can click on a name to copy student's name</div></td>
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
