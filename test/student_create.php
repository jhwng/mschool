<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_course_names = "SELECT course_name FROM course ORDER BY course_name asc";
$course_names = mysql_query($query_course_names, $promusic) or die(mysql_error());
$row_course_names = mysql_fetch_assoc($course_names);
$totalRows_course_names = mysql_num_rows($course_names);

mysql_select_db($database_promusic, $promusic);
$query_teacher = "SELECT teacher FROM teacher ORDER BY teacher";
$teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacher);
$totalRows_teacher = mysql_num_rows($teacher);

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
$newaccount = "";
include 'banner1.php';
?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">
	<?php if ($action <> 2) { echo "Create New Student"; } else echo "Edit Student Profile"; ?>
	</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>

<?php 
/* $first_name = "Vania"; 
$last_name = "Wu";
$parents_name = "Raymond Wu";
$birthdate = "";
$sex="M";
*/
?>
<form id="form1" name="form1" method="post" onSubmit="return check_student_form(this);" action="formprocess1.php">
  <table width="750" height="685" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    
    <tr>
      <td width="140" height="20" valign="middle">&nbsp;</td>
      <td width="166" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="4" valign="middle">
        <div align="right">
          <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Create"/>
          <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
        </div></td></tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle"><span class="style4">Personal Details</span></td>
      <td colspan="4" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Student Full Name: </td>
      <td colspan="4" valign="middle"><input name="full_name" type="text" id="full_name" size="45" maxlength="60" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Name Tie Breaker </td>
      <td colspan="4" valign="middle"><input name="name_tie_breaker" type="text" id="name_tie_breaker" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Parent/Guardian: </td>
      <td colspan="4" valign="middle"><input name="parents_names" type="text" id="parents_names" size="45" maxlength="60" />&nbsp;&nbsp;
      <input name="newaccount" type="checkbox" id="newaccount" value="yes" />
      Check if new account </td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Date of Birth: </td>
      <td valign="middle"><script>DateInput('birthdate', true, 'YYYY-MM-DD', '1900-01-01')</script></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Sex:</td>
      <td colspan="4" valign="middle"><select name="sex" class="dropdowntext" id="sex">
        <option value="M" selected="selected">M</option>
        <option value="F">F</option>
      </select></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Address:</td>
      <td colspan="4" valign="middle"><input name="addr1" type="text" id="addr1" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Address <br />
      (line2, optional): </td>
      <td colspan="4" valign="middle"><input name="addr2" type="text" id="addr2" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">City:</td>
      <td colspan="3" valign="middle"><input name="city" type="text" id="city" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Province:</td>
      <td colspan="3" valign="middle"><input name="province" type="text" id="province" value="Ontario" size="45" maxlength="45" /></td>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Postal Code: </td>
      <td colspan="3" valign="middle"><input name="postal_code" type="text" id="postal_code" size="6" maxlength="6" />
        <span class="bluetext">        (No Space) </span></td>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Home Phone: </td>
      <td colspan="3" valign="middle"><input name="home_tel" type="text" id="home_tel" size="20" maxlength="20" />
        <span class="bluetext">(e.g. 905-479-5800)</span></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Mom's Work Phone: </td>
      <td colspan="3" valign="middle"><input name="mother_work_tel" type="text" id="mother_work_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Mom's Cell Phone: </td>
      <td colspan="3" valign="middle"><input name="mother_cell_tel" type="text" id="mother_cell_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Dad's Work Phone: </td>
      <td colspan="3" valign="middle"><input name="father_work_tel" type="text" id="father_work_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Dad's Cell Phone: </td>
      <td colspan="3" valign="middle"><input name="father_cell_tel" type="text" id="father_cell_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Preferred Language: </td>
      <td colspan="3" valign="middle"><input name="language" type="text" id="language" size="6" maxlength="20" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Student email: </td>
      <td colspan="3" valign="middle"><input name="student_email" type="text" id="student_email" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Parents' email </td>
      <td colspan="3" valign="middle"><input name="parents_email" type="text" id="parents_email" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Discount %: </td>
      <td colspan="3" valign="middle"><input name="discount" type="text" id="discount" value="0" size="10" maxlength="4" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Discount Expiry Date: </td>
      <td colspan="3" valign="middle"><script>DateInput('discount_expiry_date', true, 'YYYY-MM-DD')</script></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="top">Related Friends: </td>
      <td colspan="3" valign="middle"><textarea name="related_friends" cols="45" rows="3" id="related_friends"></textarea></td>
      <td valign="middle"><input name="lookup2" type="button" onclick="lookup_friends(this.form)" class="btn" id="lookup2"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Lookup Details"/></td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle">Group Lessons: <br />
        (can select multiple lessons) </td>
      <td colspan="3" valign="middle"><select name="group_lessons[]" class="dropdowntext" size="3" multiple="multiple" id="group_lessons[]">
          <option value="None" <?php echo "selected=\"selected\""; ?>>None</option>
          <?php
do {  
?><option value="<?php echo $row_group_lessons['group_lesson']?>"><?php echo $row_group_lessons['group_lesson']?></option>
          <?php
} while ($row_group_lessons = mysql_fetch_assoc($group_lessons));
  $rows = mysql_num_rows($group_lessons);
  if($rows > 0) {
      mysql_data_seek($group_lessons, 0);
	  $row_group_lessons = mysql_fetch_assoc($group_lessons);
  }
?>
      </select></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="3" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="30" colspan="4" valign="middle"><div align="center" class="style3">
        <div align="left" class="style4">Course and Payment Details </div>
      </div></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Course Name: </td>
      <td colspan="3" valign="middle"><select name="course_name" class="dropdowntext" id="course_name">
          <option value="None" <?php echo "selected=\"selected\""; ?>>None</option>
          <?php
do {  
?><option value="<?php echo $row_course_names['course_name']?>"><?php echo $row_course_names['course_name']?></option>
          <?php
} while ($row_course_names = mysql_fetch_assoc($course_names));
  $rows = mysql_num_rows($course_names);
  if($rows > 0) {
      mysql_data_seek($course_names, 0);
	  $row_course_names = mysql_fetch_assoc($course_names);
  }
?>
      </select></td>
      <td width="239"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Grade:</td>
      <td colspan="3" valign="middle"><select name="grade" class="dropdowntext" id="grade">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
      </select></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Teacher:</td>
      <td colspan="3" valign="middle"><select name="teacher" class="dropdowntext" id="teacher">
        <?php
do {  
?>
        <option value="<?php echo $row_teacher['teacher']?>"><?php echo $row_teacher['teacher']?></option>
        <?php
} while ($row_teacher = mysql_fetch_assoc($teacher));
  $rows = mysql_num_rows($teacher);
  if($rows > 0) {
      mysql_data_seek($teacher, 0);
	  $row_teacher = mysql_fetch_assoc($teacher);
  }
?>
      </select> <input name="lookup" type="button" onClick="lookup_teacher_rate(this.form)" class="btn" id="lookup"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Lookup Rates"/></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">External Rate: </td>
      <td colspan="3" valign="middle"><input name="ext_rate" type="text" id="ext_rate" size="6" maxlength="6" />
          <span class="bluetext">(before discount) </span></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Internal Cost: </td>
      <td colspan="3" valign="middle"><input name="internal_cost" type="text" id="internal_cost" size="6" maxlength="6" />
  &nbsp;&nbsp;Cost Type:
  <input name="cost_type" type="text" id="cost_type" size="4" maxlength="4" />
  <span class="bluetext"> (S or F) </span></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Time:</td>
      <td colspan="3" valign="middle"><input name="time" type="text" id="time" size="6" maxlength="8" /></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Duration:</td>
      <td colspan="3" valign="middle"><select name="duration" class="dropdowntext" id="duration">
          <option value="15">15</option>
          <option value="30">30</option>
          <option value="45">45</option>
          <option value="60">1 Hr</option>
          <option value="75">1 Hr 15 Min</option>
          <option value="90">1.5 Hr</option>
          <option value="105">1 Hr 45 Min</option>
          <option value="120">2 Hr</option>
      </select></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Start Date: </td>
      <td colspan="3" valign="middle"><script>DateInput('start_date', true, 'YYYY-MM-DD')</script></td>
      <td></td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">End Date: </td>
      <td colspan="3" valign="middle"><script>DateInput('end_date', true, 'YYYY-MM-DD', '2008-06-30')</script></td>
      <td></td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">First Cheque No.: </td>
      <td colspan="3" valign="middle"><input name="cheque_no" type="text" id="cheque_no" size="6" maxlength="6" /></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Cheque Holder Name: </td>
      <td colspan="3" valign="middle"><input name="cheque_holders" type="text" id="cheque_holders" size="45" maxlength="60" /></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    
    <tr>
      <td height="21" valign="middle">&nbsp;</td>
      <td height="21" colspan="4" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="21" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" valign="middle">&nbsp;</td>
      <td height="30" colspan="4" valign="top"><div align="center">
        <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Create"/>&nbsp;
         <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
      </div></td>
      <td height="30" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="3" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="3" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="3" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($course_names);

mysql_free_result($teacher);

mysql_free_result($group_lessons);
?>
