<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Course List</title>


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
/*
actuin = 2 - update course list
*/
$action = $_GET['action'];
$submit = $_POST['submit1'];

include 'banner1.php';

?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Course List </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<?php
if ( $action <> 2 ) {
    require ('course_list_header.php');
	$j = 0;
	
	$query = "SELECT course_id, course_name, current FROM course ORDER by course_name";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
	if ( $numRows > 0 ) {
      while ( list ( $courseID, $courseName, $current ) = mysql_fetch_row($result) ) {
		 require ('course_list_row_entry.php');
	     $j += 1;
	  }  // End while
	}  // end if numRows > 0
    
    // Display 5 blank form lines for adding new entry
    $courseID = -1;
	$courseName = "";
	$current="Y";
	require ('course_list_row_entry.php');
	$j += 1;
	require ('course_list_row_entry.php');
	$j += 1;
	require ('course_list_row_entry.php');
	$j += 1;
	require ('course_list_row_entry.php');
	$j += 1;
	require ('course_list_row_entry.php');
    require ('course_list_trailer.php');
	 
}  // end action <> 2

if ( $action == 2 ) {
  $numEntries = $_POST['num_entries'];
  $numRows = $numEntries;
  $j = 0;
  require ('course_list_header.php');
  $errorNames = "";

  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( $j <= $numEntries + 4 ) {
    $cur = "current" . $j;
    $current = $_POST["$cur"];
    $cName = "course_name" . $j;
    $courseName = $_POST["$cName"];
    $cid = "course_id" . $j;
    $courseID = $_POST["$cid"];
		
    if ( $j <= $numEntries - 1 ) {
		if ( $current <> "Y" ) $current = "N";
		$query = "UPDATE course SET " .
		   "course_name=\"$courseName\", " .
		   "current=\"$current\" " .
		   "WHERE course_id = $courseID;";
        // echo "$query<br>";
		$result = mysql_query($query, $promusic) or die(mysql_error());
	}
	else {   // Insert new record for the last 5 new entries
      if ( $courseName <> "" ) {
	    $query = "SELECT course_id from course WHERE course_name = \"$courseName\" ";
	    $result = mysql_query($query, $promusic) or die(mysql_error());
        $numRows2 = mysql_num_rows($result);
	    if ( $numRows2 > 0 ) {
		  $errorNames .= "$courseName, ";
		}
		else {
		  $query = "INSERT INTO course " .
		     "( course_name, current ) VALUES " .
			 "( \"$courseName\", \"$current\" );";
          // echo "$query<br>";
		  $result = mysql_query($query, $promusic) or die(mysql_error());
		}
	  }
	}  
    require ('course_list_row_entry.php');
    $j += 1;
  } // end while
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  if ( $errorNames <> "" ) {
    echo "<script>alert (\"$errorNames already existed in Course List\")</script>";
  }
  else {
    echo "<script>document.form2.submit()</script>";
  }
  require ('course_list_trailer.php');
     
}  /* end if action = 2 */

?>

</body>
</html>
