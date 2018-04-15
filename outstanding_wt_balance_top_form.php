<table width="815" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="83">&nbsp;</td>
    <td width="606" valign="middle"><div align="center"><span class="style2">Outstanding W and T Balance Report </span></div></td>
    <td width="61">&nbsp;</td>
  </tr>
</table>

<form id="form1" name="form1" method="post" action="outstanding_wt_balance.php?action=1">
  <table width="750" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center">Period Between: 
          <input name="start_date" type="text" id="start_date" onChange='checkDateFormat(form, this)' value="<?php echo $startDate; ?>" size="10" maxlength="10" />
          &nbsp;and &nbsp;
          <input name="end_date" type="text" id="end_date" onchange='checkDateFormat(form, this)' value="<?php echo $endDate; ?>" size="10" maxlength="10" />
          &nbsp;&nbsp;&nbsp;
		  Teacher:&nbsp;&nbsp;
            <select name="by_teacher" class="dropdowntext" id="by_teacher" >
              <option value="All" selected="selected">All</option>
              <?php
do {  
?>
              <option value="<?php echo $row_teacher['teacher']?>" 
			  <?php if ( $row_teacher['teacher'] == $byTeacherName ) echo 'selected="selected"';?>>              <?php echo $row_teacher['teacher']?></option>
              
              <?php
} while ($row_teacher = mysql_fetch_assoc($teacher));
  $rows = mysql_num_rows($teacher);
  if($rows > 0) {
      mysql_data_seek($teacher, 0);
	  $row_teacher = mysql_fetch_assoc($teacher);
  }
?>
              </select>
          <input name="submit2" type="submit" class="btn" id="submit" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Display List"/>
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
