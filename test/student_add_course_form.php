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
      <td colspan="3" valign="middle"><select name="course" class="dropdowntext" id="course">
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
      </select></td>
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
      <td height="23" valign="middle">Rate Category:</td>
      <td colspan="3" valign="middle"><input name="rate_category" type="text" id="rate_category" size="20" maxlength="20" /></td>
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
      <td height="23" valign="middle">External Rate: </td>
      <td colspan="3" valign="middle"><input name="ext_rate" type="text" id="ext_rate" size="6" maxlength="6" /></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Internal Rate: </td>
      <td colspan="3" valign="middle"><input name="internal_rate" type="text" id="internal_rate" size="6" maxlength="6" /> 
        <span class="style6">(split % or fixed amount) </span></td>
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
