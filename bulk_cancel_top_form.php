<table width="766" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="230">&nbsp;</td>
    <td width="480">
	<form id="form1" name="form1" method="post" action="">
      <table width="450" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="287" height="30"><div align="left">From Date:&nbsp;&nbsp;
                <input name="from_date" type="text" id="from_date" size="10" maxlength="10" 
				<?php if ($action <> "") echo "VALUE=\"" . $fromDate . "\""; ?> 
				onChange='checkDateFormat(form, this)'/>
          </div></td>
          <td width="312"><div align="left">To Date:&nbsp;&nbsp;
                <input name="to_date" type="text" id="to_date" size="10" maxlength="10" 
				<?php if ($action <> "") echo "VALUE=\"" . $toDate . "\""; ?> 
				onChange='checkDateFormat(form, this)'/>
          </div></td>
        </tr>
        <tr>
          <td height="30"><div align="left">From Time:&nbsp;
                <input name="from_time" type="text" id="from_time" size="10" maxlength="10" 
				<?php if ( $action <> "" ) {echo "VALUE=" . "\"$fromTime\""; } ?>
	            onChange='checkTimeFormat(form, this)' />
          </div></td>
          <td><div align="left">To Time:&nbsp;
                <input name="to_time" type="text" id="to_time" size="10" maxlength="10" 
				<?php if ( $action <> "" ) {echo "VALUE=" . "\"$toTime\""; } ?>
	            onChange='checkTimeFormat(form, this)' />
          </div></td>
        </tr>
        <tr>
          <td height="30"><div align="left">Teacher:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="teacher" class="dropdowntext" id="teacher" 
			onChange='if (this.value=="0") alert("Please select a teacher, or All")' >
              <option value="0" selected="selected">Select One</option>
              <option value="All">All</option>
              <?php
do {  
?>
              <option value="<?php echo $row_teacher['teacher']?>" 
			  <?php if ( $row_teacher['teacher'] == $teacherName ) echo 'selected=\"selected\"';?>>              <?php echo $row_teacher['teacher']?></option>
              
              <?php
} while ($row_teacher = mysql_fetch_assoc($teacher));
  $rows = mysql_num_rows($teacher);
  if($rows > 0) {
      mysql_data_seek($teacher, 0);
	  $row_teacher = mysql_fetch_assoc($teacher);
  }
?>
              </select>
          </div></td>
          <td><div align="left">Cancel Reason: &nbsp;
            <select name="cancel_reason" class="dropdowntext" id="cancel_reason">
              <option value="T" <?php if ($cancelReason == "T" ) echo 'selected="selected"'; ?> 
			  >T</option>
              <option value="CXL" <?php if ($cancelReason == "CXL" ) echo 'selected="selected"'; ?> >CXL</option>
            </select>
            </div></td>
        </tr>
        <tr>
          <td colspan="2">Remarks:&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="remarks" type="text" id="remarks" size="61" 
			value="<?php echo $remarks; ?>" maxlength="100" /></td>
          </tr>
        <tr>
          <td colspan="2">Listing ordered by Teacher: 
            <input name="by_teacher" type="checkbox" id="by_teacher" value="Y" 
			<?php if ( $byTeacher == "Y" ) echo "checked=1"; ?> />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="submit" type="submit" class="btn" id="submit"
			onclick='document.form1.action = "bulk_cancel.php?action=1"; return true'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Retrieve Classes"/></td>
          </tr>
        
        
        <tr>
          <td colspan="2"><div align="center"></div></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </form></td>
    <td width="136">&nbsp;</td>
  </tr>
</table>
