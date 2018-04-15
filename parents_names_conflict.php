<?php require_once('Connections/promusic.php'); ?>
<?php

mysql_select_db($database_promusic, $promusic);

$pnames = $_GET['pnames'];
if ( isset($_GET['hometel'] )) {$home_tel = $_GET['hometel']; }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Parents Name Check</title>


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

function postParentFormValues(acctID, pnames, hometel, tb, addr1, addr2, city, province) {
  self.opener.document.form1.parents_names.value = pnames.replace(/--=--/,"'");
  self.opener.document.form1.name_tie_breaker.value = tb.replace(/--=--/,"'");
  self.opener.document.form1.home_tel.value = hometel;
  self.opener.document.form1.addr1.value=addr1.replace(/--=--/,"'");
  self.opener.document.form1.addr2.value=addr2.replace(/--=--/,"'"); 
  self.opener.document.form1.city.value=city.replace(/--=--/,"'");
  self.opener.document.form1.province.value=province.replace(/--=--/,"'"); 
  if (window.opener.location.toString().indexOf("student_edit") != -1) { 
     self.opener.document.form1.account_id.value=acctID;
     self.opener.document.form1.submit(); 
  }
  window.close()
  return;
}
</script>


</head>

<body>
<h4 align="center">
<p><span class="banner_text">Parents Name Check for <?php echo $pnames; ?></span>
  </h3>
</p>
<form action="" method="post" name="form0" id="form0">
  <table width="700" border="1" align="center" cellpadding="3" cellspacing="0">
   <tr>
      <td width="195" height="22" bgcolor="#FFCF9F" class="style9">Parents Names </td>
      <td width="146" bgcolor="#FFCF9F" class="style9">Home Phone </td>
      <td width="192" bgcolor="#FFCF9F" class="style9">Student Name </td>
      <td width="157" bgcolor="#FFCF9F" class="style9">Tie Breaker </td>
    </tr>
<?php

$query_parents = "SELECT account.account_id, account.parents_names, account.home_tel, student.full_name, student.name_tie_breaker, account.addr1, account.addr2, account.city, account.province
FROM account LEFT OUTER JOIN student ON account.account_id = student.account_id
WHERE (soundex(account.parents_names)=soundex(\"$pnames\") or (account.parents_names like \"%$pnames%\"))";

if ( isset($hometel) ) { $query_parents .= " AND ((account.home_tel)=\"$hometel\")"; }
$query_parents .= " ORDER by parents_names";
// echo $query_parents;

$check_parents = mysql_query($query_parents, $promusic) or die(mysql_error());
$totalRows_parents = mysql_num_rows($check_parents);

while (list($acctID, $pnames, $home, $sname, $tb, $addr1, $addr2, $city, $province) = mysql_fetch_row($check_parents)) {
    $pnames1 = str_replace("'", "--=--", $pnames);
	$tb1 = str_replace("'", "--=--", $tb);
	$adr1 = str_replace("'", "--=--", $addr1);
	$adr2 = str_replace("'", "--=--", $addr2);
	$city1 = str_replace("'", "--=--", $city);
	$prov1 = str_replace("'", "--=--", $province);
	echo " <tr height=\"18\">\n" .
		  " <td><a href='javascript:postParentFormValues($acctID, \"$pnames1\", \"$home\", \"$tb1\", \"$adr1\", \"$adr2\", \"$city1\", \"$prov1\")'>$pnames</td>\n" .
		  " <td>$home&nbsp;</td>\n" .
          "  <td>$sname&nbsp;</td>\n" .
		  " <td>$tb&nbsp;</td>\n" .
          " </tr>\n";
}

?>
  </table>
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center" class="bluetext">You can click on a name to copy parents' names and home phone to the Create Student screen </div></td>
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
