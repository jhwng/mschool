<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>School Holiday List</title>


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
action = 2 - update holiday list
*/

//Bjng
$delete = "";

$action = isset($_GET['action']) ? $_GET['action'] : "";
$submit = isset($_POST['submit1']) ? $_POST['submit1'] : "";
//Ejng

include 'banner1.php';

?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">School Holiday List </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<?php
if ( $action <> 2 ) {
    require ('holiday_header.php');
	$j = 0;
	$changed = 0;
	
	$query = "SELECT holiday_id, date, description FROM school_holidays ORDER by date desc";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRows = mysql_num_rows($result);
	if ( $numRows > 0 ) {
      while ( list ( $holiday_id, $date, $desc ) = mysql_fetch_row($result) ) {
		 require ('holiday_row_entry.php');
	     $j += 1;
	  }  // End while
	}  // end if numRows > 0
    
    // Display 5 blank form lines for adding new entry
    $holiday_id = 0;
	$date = "";
	$desc = "";
	$delete="N";
	require ('holiday_row_entry.php');
	$j += 1;
	require ('holiday_row_entry.php');
	$j += 1;
	require ('holiday_row_entry.php');
	$j += 1;
	require ('holiday_row_entry.php');
	$j += 1;
	require ('holiday_row_entry.php');
    require ('holiday_trailer.php');
	 
}  // end action <> 2

if ( $action == 2 ) {
  $numEntries = $_POST['num_entries'];
  $numRows = $numEntries;
  $j = 0;
  require ('holiday_header.php');
  $errorDates = "";

  /* Start SQL transaction */
  $query = "START TRANSACTION;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  while ( $j <= $numEntries + 4 ) {
    $del = "delete" . $j;
    $delete = $_POST["$del"];
    $datetemp = "date" . $j;
    $date = $_POST["$datetemp"];
    $descrip = "desc" . $j;
    $desc = $_POST["$descrip"];
    $hld = "holiday_id" . $j;
    $holiday_id = $_POST["$hld"];
    $chg = "changed" . $j;
    $changed = $_POST["$chg"];
		
    if ( $j <= $numEntries - 1 ) {
		if ( $delete == "Y" ) {
		  $query = "DELETE FROM school_holidays WHERE holiday_id=$holiday_id ";
		  // echo "$query<br>";
		  $result = mysql_query($query, $promusic) or die(mysql_error());
		}
		else {
		  if ( $changed == "1" ) {
		    $query = "UPDATE school_holidays SET " .
		       "date=\"$date\", " .
		       "description=\"$desc\" " .
		       "WHERE holiday_id=$holiday_id ";
            // echo "$query<br>";
		    $result = mysql_query($query, $promusic) or die(mysql_error());
		  }  // end changed = 1
		}
	}
	else {   // Insert new record for the last 5 new entries
      if ( $date <> "" && $changed == "1" ) {
	    $query = "SELECT date from school_holidays WHERE date = \"$date\" ";
	    $result = mysql_query($query, $promusic) or die(mysql_error());
        $numRows2 = mysql_num_rows($result);
	    if ( $numRows2 > 0 ) {
		  $errorDates .= "$date, ";
		}
		else {
		  $query = "INSERT INTO school_holidays " .
		     "( date, description ) VALUES " .
			 "( \"$date\", \"$desc\" );";
          // echo "$query<br>";
		  $result = mysql_query($query, $promusic) or die(mysql_error());
		}
	  }
	}  
    require ('holiday_row_entry.php');
    $j += 1;
  } // end while
	  
  /* Commit Transactions  */
  $query = "COMMIT;";
  $result = mysql_query($query, $promusic) or die(mysql_error());
  
  if ( $errorDates <> "" ) {
    echo "<script>alert (\"$errorDates already existed in Holiday List\")</script>";
  }
  else {
     echo "<script>document.form2.submit()</script>";
  }
  require ('holiday_trailer.php');
     
}  /* end if action = 2 */

?>

</body>
</html>
