<?php require_once('Connections/promusic.php'); ?>
<?php
mysql_select_db($database_promusic, $promusic);
$query_course_name = "select course_name from course order by course_name;";
$course_name = mysql_query($query_course_name, $promusic) or die(mysql_error());
$row_course_name = mysql_fetch_assoc($course_name);
$totalRows_course_name = mysql_num_rows($course_name);

mysql_select_db($database_promusic, $promusic);
$query_teacher = "select teacher from teacher order by teacher;";
$teacher = mysql_query($query_teacher, $promusic) or die(mysql_error());
$row_teacher = mysql_fetch_assoc($teacher);
$totalRows_teacher = mysql_num_rows($teacher);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Teacher Profile</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style7 {color: #0000FF}
-->
</style>
</head>

<body>
<?php include 'banner1.php'; ?>
<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Create/Edit Teacher Profile Details</span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="formprocess1.php">
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="90">&nbsp;</td>
      <td width="187"><div align="left"></div></td>
      <td width="473"><div align="right">
        <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value=" New "/>
        <input name="submit3" type="submit" class="btn" id="submit3"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value=" Edit "/>
        <input name="submit2" type="submit" class="btn" id="submit2"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Teacher Name: </td>
      <td><select name="teacher" class="dropdowntext" id="teacher">
        <option value="None" <?php echo "selected=\"selected\""; ?>>Select a teacher</option>
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
      </select>
<span class="style7">        (enter teacher's name for edit) </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Home Phone: </td>
      <td><input name="home_tel" type="text" id="home_tel" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p>Cell Phone: </p>      </td>
      <td><input name="cell_tel" type="text" id="cell_tel" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>SIN:</td>
      <td><input name="sin" type="text" id="sin" size="12" maxlength="12" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Address:</td>
      <td><input name="addr1" type="text" id="addr1" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Address (line 2, optional): </td>
      <td><input name="addr2" type="text" id="addr2" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>City:</td>
      <td><input name="city" type="text" id="city" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Postal Code: </td>
      <td><input name="postal_code" type="text" id="postal_code" size="6" maxlength="6" /> 
        <span class="style7">(no space) </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Province:</td>
      <td><input name="province" type="text" id="province" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td valign="top">Profile:</td>
      <td><textarea name="profile" cols="80" rows="12" id="profile"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><p>Course:
        <select name="course1" class="dropdowntext" id="course1">
                <option value="None" <?php if (!(strcmp("None", $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>>None</option>
                <?php
do {  
?>
                <option value="<?php echo $row_course_name['course_name']?>"<?php if (!(strcmp($row_course_name['course_name'], $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_course_name['course_name']?></option>
                <?php
} while ($row_course_name = mysql_fetch_assoc($course_name));
  $rows = mysql_num_rows($course_name);
  if($rows > 0) {
      mysql_data_seek($course_name, 0);
	  $row_course_name = mysql_fetch_assoc($course_name);
  }
?>
          </select>
        &nbsp; &nbsp;Rate Category:
        <input name="rate_category1" type="text" id="rate_category1" size="10" maxlength="20" />        
        &nbsp; &nbsp;External Rate:
        <input name="external_rate1" type="text" id="external_rate1" size="4" />
        &nbsp; &nbsp;Internal Rate:
        <input name="internal_rate1" type="text" id="internal_rate1" size="4" maxlength="4" />
        &nbsp; &nbsp;Split %:
        <input name="split1" type="text" id="split1" size="4" maxlength="4" />
      </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><p>Course:
        <select name="course2" class="dropdowntext" id="course2">
                <option value="None" <?php if (!(strcmp("None", $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>>None</option>
                <?php
do {  
?>
                <option value="<?php echo $row_course_name['course_name']?>"<?php if (!(strcmp($row_course_name['course_name'], $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_course_name['course_name']?></option>
                <?php
} while ($row_course_name = mysql_fetch_assoc($course_name));
  $rows = mysql_num_rows($course_name);
  if($rows > 0) {
      mysql_data_seek($course_name, 0);
	  $row_course_name = mysql_fetch_assoc($course_name);
  }
?>
          </select>
        &nbsp; &nbsp;Rate Category:        
        <input name="rate_category2" type="text" id="rate_category2" size="10" maxlength="20" />
        &nbsp; &nbsp;External Rate:
        <input name="external_rate2" type="text" id="external_rate2" size="4" />
        &nbsp; &nbsp;Internal Rate:
        <input name="internal_rate2" type="text" id="internal_rate2" size="4" maxlength="4" />
        &nbsp; &nbsp;Split %:
        <input name="split2" type="text" id="split2" size="4" maxlength="4" />
      </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><p>Course:
        <select name="course3" class="dropdowntext" id="course3">
                <option value="None" <?php if (!(strcmp("None", $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>>None</option>
                <?php
do {  
?>
                <option value="<?php echo $row_course_name['course_name']?>"<?php if (!(strcmp($row_course_name['course_name'], $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_course_name['course_name']?></option>
                <?php
} while ($row_course_name = mysql_fetch_assoc($course_name));
  $rows = mysql_num_rows($course_name);
  if($rows > 0) {
      mysql_data_seek($course_name, 0);
	  $row_course_name = mysql_fetch_assoc($course_name);
  }
?>
          </select>
        &nbsp; &nbsp;Rate Category:
        <input name="rate_category3" type="text" id="rate_category3" size="10" maxlength="20" />        
        &nbsp; &nbsp;External Rate:
        <input name="external_rate3" type="text" id="external_rate3" size="4" />
        &nbsp; &nbsp;Internal Rate:
        <input name="internal_rate3" type="text" id="internal_rate3" size="4" maxlength="4" />
        &nbsp; &nbsp;Split %:
        <input name="split3" type="text" id="split3" size="4" maxlength="4" />
      </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><p>Course:
        <select name="course4" class="dropdowntext" id="course4">
                <option value="None" <?php if (!(strcmp("None", $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>>None</option>
                <?php
do {  
?>
                <option value="<?php echo $row_course_name['course_name']?>"<?php if (!(strcmp($row_course_name['course_name'], $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_course_name['course_name']?></option>
                <?php
} while ($row_course_name = mysql_fetch_assoc($course_name));
  $rows = mysql_num_rows($course_name);
  if($rows > 0) {
      mysql_data_seek($course_name, 0);
	  $row_course_name = mysql_fetch_assoc($course_name);
  }
?>
          </select>
        &nbsp; &nbsp;Rate Category:
        <input name="rate_category4" type="text" id="rate_category4" size="10" maxlength="20" />        
        &nbsp; &nbsp;External Rate:
        <input name="external_rate4" type="text" id="external_rate4" size="4" />
        &nbsp; &nbsp;Internal Rate:
        <input name="internal_rate4" type="text" id="internal_rate4" size="4" maxlength="4" />
        &nbsp; &nbsp;Split %:
        <input name="split4" type="text" id="split4" size="4" maxlength="4" />
      </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><p>Course:
        <select name="course5" class="dropdowntext" id="course5">
                <option value="None" <?php if (!(strcmp("None", $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>>None</option>
                <?php
do {  
?>
                <option value="<?php echo $row_course_name['course_name']?>"<?php if (!(strcmp($row_course_name['course_name'], $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_course_name['course_name']?></option>
                <?php
} while ($row_course_name = mysql_fetch_assoc($course_name));
  $rows = mysql_num_rows($course_name);
  if($rows > 0) {
      mysql_data_seek($course_name, 0);
	  $row_course_name = mysql_fetch_assoc($course_name);
  }
?>
          </select>
        &nbsp; &nbsp;Rate Category:
        <input name="rate_category5" type="text" id="rate_category5" size="10" maxlength="20" />        
        &nbsp; &nbsp;External Rate:
        <input name="external_rate5" type="text" id="external_rate5" size="4" />
        &nbsp; &nbsp;Internal Rate:
        <input name="internal_rate5" type="text" id="internal_rate5" size="4" maxlength="4" />
        &nbsp; &nbsp;Split %:
        <input name="split5" type="text" id="split5" size="4" maxlength="4" />
      </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><p>Course:
        <select name="course6" class="dropdowntext" id="course6">
                <option value="None" <?php if (!(strcmp("None", $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>>None</option>
                <?php
do {  
?>
                <option value="<?php echo $row_course_name['course_name']?>"<?php if (!(strcmp($row_course_name['course_name'], $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_course_name['course_name']?></option>
                <?php
} while ($row_course_name = mysql_fetch_assoc($course_name));
  $rows = mysql_num_rows($course_name);
  if($rows > 0) {
      mysql_data_seek($course_name, 0);
	  $row_course_name = mysql_fetch_assoc($course_name);
  }
?>
          </select>
        &nbsp; &nbsp;Rate Category:
        <input name="rate_category6" type="text" id="rate_category6" size="10" maxlength="20" />        
        &nbsp; &nbsp;External Rate:
        <input name="external_rate6" type="text" id="external_rate6" size="4" />
        &nbsp; &nbsp;Internal Rate:
        <input name="internal_rate6" type="text" id="internal_rate6" size="4" maxlength="4" />
        &nbsp; &nbsp;Split %:
        <input name="split6" type="text" id="split6" size="4" maxlength="4" />
      </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><p>Course:
        <select name="course7" class="dropdowntext" id="course7">
                <option value="None" <?php if (!(strcmp("None", $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>>None</option>
                <?php
do {  
?>
                <option value="<?php echo $row_course_name['course_name']?>"<?php if (!(strcmp($row_course_name['course_name'], $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_course_name['course_name']?></option>
                <?php
} while ($row_course_name = mysql_fetch_assoc($course_name));
  $rows = mysql_num_rows($course_name);
  if($rows > 0) {
      mysql_data_seek($course_name, 0);
	  $row_course_name = mysql_fetch_assoc($course_name);
  }
?>
          </select>
        &nbsp; &nbsp;Rate Category:
        <input name="rate_category7" type="text" id="rate_category7" size="10" maxlength="20" />        
        &nbsp; &nbsp;External Rate:
        <input name="external_rate7" type="text" id="external_rate7" size="4" />        
        &nbsp; &nbsp;Internal Rate:
        <input name="internal_rate7" type="text" id="internal_rate7" size="4" maxlength="4" />
        &nbsp; &nbsp;Split %:
        <input name="split7" type="text" id="split7" size="4" maxlength="4" />
      </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><p>Course: 
          <select name="course8" class="dropdowntext" id="course8">
            <option value="None" <?php if (!(strcmp("None", $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>>None</option>
            <?php
do {  
?>
            <option value="<?php echo $row_course_name['course_name']?>"<?php if (!(strcmp($row_course_name['course_name'], $row_course_name['course_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_course_name['course_name']?></option>
            <?php
} while ($row_course_name = mysql_fetch_assoc($course_name));
  $rows = mysql_num_rows($course_name);
  if($rows > 0) {
      mysql_data_seek($course_name, 0);
	  $row_course_name = mysql_fetch_assoc($course_name);
  }
?>
          </select>
&nbsp; &nbsp;Rate Category:
<input name="rate_category8" type="text" id="rate_category8" size="10" maxlength="20" />      
&nbsp; &nbsp;External Rate: 
      <input name="external_rate8" type="text" id="external_rate8" size="4" />
      &nbsp;&nbsp;&nbsp;Internal Rate:
      <input name="internal_rate8" type="text" id="internal_rate8" size="4" maxlength="4" />      
      &nbsp; &nbsp;Split %: 
      <input name="split8" type="text" id="split8" size="4" maxlength="4" />
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($course_name);

mysql_free_result($teacher);
?>
