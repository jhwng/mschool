<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>


</head>

<body>
<?
/*
There is no header information for this script. You can change everything. You can distribute the script or even sell it.
However, I would appreciate a link to http://www.bannerlessfreewebhosting.com/bobs-scripts/
*/

if ($_POST['submit'] == 'Compute') { $compute = $_POST['compute']; echo "compute = " . $compute;
	$day = $_POST['day'];
	if ($_POST['compute'] == 'sub') { 
		$day = $day - $days;
	} elseif ($compute == 'add') {
		$day = $day + $days;
	}
    echo "\$echo = " . $_POST['month'] . $day . $_POST['year'] . "</br>";
	$echo = date($output, mktime (0,0,0,$_POST['month'],$day,$_POST['year'])); //This is the computed date
	echo "title = " . $echo;
}
echo "
<form action=\"\" method=post>
<table border=0 cellspacing=1 cellpadding=2 bgcolor=blue width=300>
<tr>
<td bgcolor=blue><font color=white face=arial><B>Compute date"; if (!empty($echo)) {echo " - Result: $echo";} echo "</B></font></td>
</tr>
<tr>
<td bgcolor=white>
	<table border=0 cellpadding=3 cellspacing=0>
	<tr>
		<td aligin=left><font color=blue face=arial>Chose date:  </font></td><td aligin=left><select name=month>";
		getoption(1, 12, date("m"));
		echo "</select><select name=day>";
		getoption(1, 31, date("d"));
		echo "</select><select name=year>";
		getoption(1970, 2020, date("Y"));
		echo "</select></td>
	</tr>
	<tr>
		<td aligin=left><font color=blue face=arial>Add/substract  </font></td><td aligin=left><select name=compute><option value=add>+<option value=sub>-</select>
	<input type=text name=days size=4 maxlength=4><font color=blue face=arial> day(s)</font></td>
	</tr>
	<tr>
		<td aligin=left><font color=blue face=arial>Output format:  </font></td><td aligin=left><select name=output><option value=\"m-d-Y\">mm-dd-YYYY<option value=\"l, M d Y\">weekday, mm dd yyyyy</select></td>
	</tr>
	 
	<tr>
		<td aligin=left colspan=2><input type=submit name=submit value=Compute></td>
	</tr>
	 </table>
	
	
</td></tr></table></form>";





function getoption($start, $end, $if) {
	for ($i=$start;$i<=$end;$i++) {
		echo "<option value=$i"; if ($i == $if) { echo " selected";} echo ">$i";
	}
}

?>

</body>
</html>
