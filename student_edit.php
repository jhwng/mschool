<?php include "auth_inc.php"; ?>
<?php require_once('Connections/promusic.php'); ?>
<?php

$versionNum = "1.00.01";

// 1.00.01 - adds hint box for parents/guardian

mysql_select_db($database_promusic, $promusic);
$query_group_lessons = "select group_lesson from group_lesson order by group_lesson;";
$group_lessons = mysql_query($query_group_lessons, $promusic) or die(mysql_error());
$row_group_lessons = mysql_fetch_assoc($group_lessons);
$totalRows_group_lessons = mysql_num_rows($group_lessons);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pro-Music School Administration System</title>


<script type="text/javascript" src="checkform.js"> </script>
<script type="text/javascript" src="form_hints.js"> </script>

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

<body onLoad='document.form1.full_name.focus()' vlink="black">

<?php
include 'banner1.php';

?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Edit Student Profile
	</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<?php
/*
action = 1 - Create new student, new account and new course
action = 2 - Only creat a new course for the student
action = 3 - Retrieve student profile
actuin = 4 - Commit Edit student profile
*/
$action = $_GET['action'];
$submit = $_POST['submit1'];
$student_id = $_POST['student_id'];
$account_id = $_POST['account_id'];
$old_account_id = $_POST['old_account_id'];
$parents_names = $_POST['parents_names'];
$newaccount = $_POST['newaccount'];
$addr1 = $_POST['addr1'];
$addr2 = $_POST['addr2'];
$city = $_POST['city'];
$province = $_POST['province'];
$postal_code = $_POST['postal_code'];
$home_tel = $_POST['home_tel'];
$mother_work_tel = $_POST['mother_work_tel'];
$mother_cell_tel = $_POST['mother_cell_tel'];
$father_work_tel = $_POST['father_work_tel'];
$father_cell_tel = $_POST['father_cell_tel'];
$parents_email = $_POST['parents_email'];
$full_name = $_POST['full_name'];
$name_tie_breaker = $_POST['name_tie_breaker'];
$birthdate = $_POST['birthdate'];
$sex = $_POST['sex'];
$language = $_POST['language'];
$student_email = $_POST['student_email'];
$enrollment_date= $_POST['enrollment_date'];
$discount= $_POST['discount'];
$discount_expiry_date = $_POST['discount_expiry_date'];
$related_friends = $_POST['related_friends'];
/* if (isset($_POST['related_friends'])) {
  $related_friends_str = urlencode("$related_friends");
}
*/
if (isset($_POST['group_lessons'])) {
  $group_lessons_str = implode(";", $_POST['group_lessons']);
}
/*
$course_name = $_POST['course_name'];
$grade = $_POST['grade'];
$selected_teacher = $_POST['teacher'];
$time = $_POST['time'];
$duration = $_POST['duration'];
$ext_rate = $_POST['ext_rate'];
$internal_cost = $_POST['internal_cost'];
$cost_type = $_POST['cost_type'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$cheque_no = $_POST['cheque_no'];
$cheque_holders = $_POST['cheque_holders'];
*/

if ( $action == 3 ) 
{
  if ( !(isset($student_id)) || $student_id == "" ) {
	echo '<script>alert("You need to select a Student Name by using the Search button\n\n Student profile not retrieved")</script>'; 
	$error = 1;
  }
  else
  {
    // get student profile data from student and account tables
    // if $account_id is set, either by a name search on fullname or parents names
    //if ( isset($account_id) ) {
    $query = "SELECT addr1, addr2, city, province, postal_code, father_work_tel, father_cell_tel, mother_work_tel, mother_cell_tel, home_tel, province, parents_email, parents_names FROM account WHERE account_id = $account_id";
    //echo "$query<br>";
    $old_account_id = $account_id;
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $row = mysql_fetch_array($result);
    extract($row);
	
	$query = "SELECT sex, language, discount, discount_expiry_date, student_email, enrollment_date, related_friends, last_name, given_name, enrollment_date, birthdate, name_tie_breaker, full_name, group_lessons as group_lessons_str FROM student WHERE student_id = $student_id";
    //echo "$query<br>";
    //echo "acctID = $account_id<br>";
    $result = mysql_query($query, $promusic) or die(mysql_error());
    $row = mysql_fetch_array($result);
    extract($row);
    // $related_friends = urldecode ($related_friends_enc);
  }
}


if ( $action == 4 ) {
  //echo "old=$old_account_id,  new=$account_id<br>";
  $error = 0;

/*
  if ( $old_account_id <> $account_id && $newaccount <> "yes" ) {
    echo '<script>alert ("You have selected new parents for the Account\n\nClick the Retrieve Profile Button before Commit Changes\n in order to retrieve new Account information and\n avoid incorrect Account data")</script>';
	$error = 1;
  }	
*/

  if ( $newaccount == "yes" ) {
    // Make sure account does not exist
	$query_check_account = "SELECT account_id from account " .
      "WHERE parents_names = \"$parents_names\" and home_tel = \"$home_tel\"";
	//  echo "$query_check_account<br>";
    $check_account = mysql_query($query_check_account, $promusic) or die(mysql_error());
    $totalRows_account = mysql_num_rows($check_account);

    /* User said create new account */
    if ( ($_POST['newaccount'] == "yes" ) && $totalRows_account > 0 ) {
      $error=1;
  	  echo "<script>alert('Account Already Exist - Parents Names and Home Phone already exist in database')</script>";
    }
  } /* end if newaccount = yes */
  
  /* User said Don't create account 
  if ( (!ISSET($_POST['newaccount']) ) && $totalRows_account == 0 ) {
    $error = 1;
    echo "<script>alert('Parents Names and Home Phone do NOT exist, New Account?'); window.document.form1.parents_names.select();</script>";
  }
*/

  if ( $error == 0 ) {
    // Start SQL transaction 
    $query = "START TRANSACTION;";
    $result = mysql_query($query, $promusic) or die(mysql_error());
  }

  /* Create Account */
  if ( $error == 0 && $_POST['newaccount'] == "yes" ) {
	 $query_account = "INSERT INTO account
     (parents_names, addr1, addr2, city, province, postal_code, home_tel,
     mother_work_tel, mother_cell_tel, father_work_tel, father_cell_tel, parents_email)
	 VALUES ( \"$parents_names\", \"$addr1\", \"$addr2\",
	 \"$city\", \"$province\", \"$postal_code\", \"$home_tel\", \"$mother_work_tel\",
	 \"$mother_cell_tel\", \"$father_work_tel\", \"$father_cell_tel\", \"$parents_email\" )";

	//echo "$query_account<br>";
    $insert_account = mysql_query($query_account, $promusic) or die(mysql_error());
	echo "<script>alert('Account created, will create Student next...');</script>";
	
    /* get account_id for student */
    $query_aid = "SELECT account_id FROM account WHERE parents_names = \"$parents_names\" and home_tel = \"$home_tel\"";
    $account = mysql_query($query_aid, $promusic) or die(mysql_error());
    $row_account = mysql_fetch_array($account);
    extract($row_account);
  }

  if ( $error == 0 ) {
    $pos = strpos($full_name, ",");
    $last_name=substr($full_name,0,$pos);
    $given_name=ltrim(substr($full_name, $pos+1));
	
	if ( $newaccount <> "yes" ) {
	  /* Update account entry */
	  $query = "UPDATE account SET " . 
	   "parents_names=\"$parents_names\",  " .
	   "addr1=\"$addr1\", addr2=\"$addr2\", city=\"$city\", province=\"$province\", " .
	   "postal_code=\"$postal_code\", " .
	   "home_tel=\"$home_tel\", mother_work_tel=\"$mother_work_tel\", " .
	   "mother_cell_tel=\"$mother_cell_tel\", father_work_tel=\"$father_work_tel\", " .
	   "father_cell_tel=\"$father_cell_tel\", parents_email=\"$parents_email\" " .
	   "WHERE account_id=$account_id;";
	  //echo "$query<br>";
	  $result = mysql_query($query, $promusic) or die(mysql_error());
	}

    /* Update Student entry */
    $query = "UPDATE student SET " .
     "full_name=\"$full_name\", account_id=$account_id, " .
	 "name_tie_breaker=\"$name_tie_breaker\", birthdate=\"$birthdate\", sex=\"$sex\", " .
	 "language=\"$language\", student_email=\"$student_email\", enrollment_date=\"$enrollment_date\", " .
	 "related_friends=\"$related_friends\", group_lessons=\"$group_lessons_str\", " .
	 "discount=\"$discount\", discount_expiry_date=\"$discount_expiry_date\", " .
	 "given_name=\"$given_name\", last_name=\"$last_name\", account_id=$account_id " .
	 "WHERE student_id=$student_id;";
    //echo "$query<br>";
    $result = mysql_query($query, $promusic) or die(mysql_error());
	
    // Commit Transactions 
	$query = "COMMIT;";
	$result = mysql_query($query, $promusic) or die(mysql_error());
	  
    echo "<script>alert('Student and Account record updated');</script>";
  }
  

}  /* end if action = 4 */

require('student_edit_form.php');
echo "<script>document.form1.student_id.value=\"$student_id\"</script>";
echo "<script>document.form1.account_id.value=\"$account_id\"</script>";
echo "<script>document.form1.old_account_id.value=\"$old_account_id\"</script>";

?>
</body>
</html>
