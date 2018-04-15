
<form id="form1" name="form1" method="post" onSubmit="return check_student_form(this);" action="student_create_2.php?action=1">
  <table width="750" height="685" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    
    <tr>
      <td width="140" height="20" valign="middle">&nbsp;</td>
      <td width="166" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="4" valign="middle">
        <div align="right">
          <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Create"/>
          &nbsp;<input name="submit" type="submit" class="btn" id="submit"
		 onclick="document.form1.action = 'student_edit.php?action=3'; return true;" 
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="  Edit  "/>
        &nbsp;
         <input name="submit" type="button" class="btn" id="submit"
		 <?php $url = $wwwhost . "/student.php?action=3" ?>
		 onclick='window.location.href="<?php echo $url ?>" '
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
        </div></td></tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle"><span class="style4">Personal Details</span></td>
      <td colspan="4" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle"><strong>Student Full Name: </strong></td>
      <td colspan="4" valign="middle"><input name="full_name"
	  type="text" id="full_name"  size="45" maxlength="60"  
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$full_name\""; } ?>/>&nbsp;&nbsp;&nbsp;
      <input name="submit" type="button" class="btn" id="submit" onclick="studentNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Search"/></td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle"><strong>Parents/Guardian: </strong></td>
      <td colspan="4" valign="middle"><input name="parents_names" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$parents_names\""; } ?>
	  type="text" id="parents_names" size="45" maxlength="60" />
        &nbsp;&nbsp;
        <span class="bluetext">
        <input name="Button" type="button" class="btn" id="Button" onclick="checkParentsNames(this.form)"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Search"/>
        </span> &nbsp;&nbsp;&nbsp;
        <input name="newaccount" type="checkbox" id="newaccount" value="yes"
        <?php if ( $newaccount == "yes" ) { echo "checked=\"checked\""; } ?>/>
      <span class="bluetext">New Account?</span></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle"><strong>Home Phone: </strong></td>
      <td colspan="4" valign="middle"><input name="home_tel" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$home_tel\""; } ?>
	  type="text" id="home_tel" size="20" maxlength="20" />
      <span class="bluetext">(e.g. 905-479-5800)</span></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Name Tie Breaker: </td>
      <td colspan="4" valign="middle"><input name="name_tie_breaker" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$name_tie_breaker\""; } ?>
	  type="text" id="name_tie_breaker" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Date of Birth: </td>
      <td valign="middle"><script>DateInput('birthdate', true, 'YYYY-MM-DD', <?php if ( $action <> "" ) { echo "\"$birthdate\""; } else { echo "\"1900-01-01\""; } ?>)</script></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Sex:</td>
      <td colspan="4" valign="middle"><select name="sex" class="dropdowntext" id="sex">
        <option value="M" <?php if ( $sex == "M" ) echo 'selected="selected"'; ?>>M</option>
        <option value="F" <?php if ( $sex == "F" ) echo 'selected="selected"'; ?>>F</option>
      </select></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Address:</td>
      <td colspan="4" valign="middle"><input name="addr1" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$addr1\""; } ?>
	  type="text" id="addr1" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="4" valign="middle"><input name="addr2" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$addr2\""; } ?>
	  type="text" id="addr2" size="45" maxlength="45" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">City:</td>
      <td colspan="3" valign="middle"><input name="city" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$city\""; } ?>
	  type="text" id="city" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Province:</td>
      <td colspan="3" valign="middle"><input name="province" type="text" id="province" value=
      <?php if ( $action <> "" ) { echo "\"$province\""; } else { echo "\"Ontario\""; } ?>
	  size="45" maxlength="45" /></td>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Postal Code: </td>
      <td colspan="3" valign="middle"><input name="postal_code" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$postal_code\""; } ?>
	  onChange="stripSpaces(this.form)" type="text" id="postal_code" size="7" maxlength="7" />
        <span class="bluetext">        (No Space) </span></td>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Mom's Work Phone: </td>
      <td colspan="3" valign="middle"><input name="mother_work_tel" 
  	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$mother_work_tel\""; } ?>
      type="text" id="mother_work_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Mom's Cell Phone: </td>
      <td colspan="3" valign="middle"><input name="mother_cell_tel" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$mother_cell_tel\""; } ?>
	  type="text" id="mother_cell_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Dad's Work Phone: </td>
      <td colspan="3" valign="middle"><input name="father_work_tel" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$father_work_tel\""; } ?>
	  type="text" id="father_work_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Dad's Cell Phone: </td>
      <td colspan="3" valign="middle"><input name="father_cell_tel" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$father_cell_tel\""; } ?>
	  type="text" id="father_cell_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Parents' email : </td>
      <td colspan="3" valign="middle"><input name="parents_email" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$parents_email\""; } ?>
	  type="text" id="parents_email" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Enrollment Date: </td>
      <td colspan="3" valign="middle"><script>DateInput('enrollment_date', true, 'YYYY-MM-DD', <?php if ( $action <> "" ) { echo "\"$enrollment_date\""; } ?>)</script></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Student email: </td>
      <td colspan="3" valign="middle"><input name="student_email" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$student_email\""; } ?>
	  type="text" id="student_email" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Preferred Language: </td>
      <td colspan="3" valign="middle"><input name="language" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$language\""; } ?>
	  type="text" id="language" size="6" maxlength="20" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Discount %: </td>
      <td colspan="3" valign="middle"><input name="discount" type="text" id="discount" value=<?php if ( $action <> "" ) { echo "\"$discount\""; } else { echo "\"0\""; } ?> size="6" maxlength="4" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Discount Expiry Date: </td>
      <td colspan="3" valign="middle"><script>DateInput('discount_expiry_date', true, 'YYYY-MM-DD'<?php if ( $action <> "" ) { echo ", \"$discount_expiry_date\""; } ?>)</script></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="top">Related Friends: </td>
      <td colspan="3" valign="middle"><textarea name="related_friends" 
	  cols="45" rows="3" id="related_friends"><?php if ( $action <> "" ) {echo "$related_friends"; } ?>
</textarea></td>
      <td valign="middle"><input name="lookup2" type="button" onclick="lookup_friends(this.form)" class="btn" id="lookup2"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Lookup Details"/></td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle">Group Lessons: <br />
        (can select multiple lessons) </td>
      <td colspan="3" valign="middle"><select name="group_lessons[]" class="dropdowntext" size="3" multiple="multiple" id="group_lessons[]">
        <option value="None" <?php if ( $action <> "" && stristr($group_lessons_str, 'None')) {echo "selected=\"selected\""; } if ( $action == "" ) { echo "selected=\"selected\""; } ?>>None</option>
        <?php
do {  
?>
        <option value="<?php echo $row_group_lessons['group_lesson']?>" <?php if ( $action <> "" && stristr($group_lessons_str, $row_group_lessons['group_lesson'])) {echo "selected=\"selected\""; } ?> ><?php echo $row_group_lessons['group_lesson']?></option>
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
        <div align="left" class="style4">Add a New Course </div>
      </div></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Course Name: </td>
      <td colspan="3" valign="middle"><select name="course_name" class="dropdowntext" id="course_name">
          <option value="None" <?php if ( $action <> "" && $course_name == 'None' ) {echo "selected=\"selected\""; } if ( $action == "" ) { echo "selected=\"selected\""; } ?>>None</option>
          <?php
do {  
?><option value="<?php echo $row_course_names['course_name']?>" <?php if ( $action <> "" && 
$row_course_names['course_name'] == $course_name ) {echo "selected=\"selected\""; } ?> ><?php echo $row_course_names['course_name']?></option>
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
        <option value="0" <?php if ( $action <> "" && $grade == "0" ) {echo "selected=\"selected\""; } ?> >0</option>
        <option value="1" <?php if ( $action <> "" && $grade == "1" ) {echo "selected=\"selected\""; } ?> >1</option>
        <option value="2" <?php if ( $action <> "" && $grade == "2" ) {echo "selected=\"selected\""; } ?> >2</option>
        <option value="3" <?php if ( $action <> "" && $grade == "3" ) {echo "selected=\"selected\""; } ?> >3</option>
        <option value="4" <?php if ( $action <> "" && $grade == "4" ) {echo "selected=\"selected\""; } ?> >4</option>
        <option value="5" <?php if ( $action <> "" && $grade == "5" ) {echo "selected=\"selected\""; } ?> >5</option>
        <option value="6" <?php if ( $action <> "" && $grade == "6" ) {echo "selected=\"selected\""; } ?> >6</option>
        <option value="7" <?php if ( $action <> "" && $grade == "7" ) {echo "selected=\"selected\""; } ?> >7</option>
        <option value="8" <?php if ( $action <> "" && $grade == "8" ) {echo "selected=\"selected\""; } ?> >8</option>
        <option value="9" <?php if ( $action <> "" && $grade == "9" ) {echo "selected=\"selected\""; } ?> >9</option>
        <option value="10" <?php if ( $action <> "" && $grade == "10" ) {echo "selected=\"selected\""; } ?> >10</option>
        <option value="11" <?php if ( $action <> "" && $grade == "11" ) {echo "selected=\"selected\""; } ?> >11</option>
      </select></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Teacher:</td>
      <td colspan="3" valign="middle">
        <select name="teacher" class="dropdowntext" id="teacher">
          <?php
do {  
?>
          <option value="<?php echo $row_teacher['teacher']?>" <?php if ( $action <> "" && 
$row_teacher['teacher'] == $selected_teacher ) {echo "selected=\"selected\""; } ?>><?php echo $row_teacher['teacher']?></option>
          <?php
} while ($row_teacher = mysql_fetch_assoc($teacher));
  $rows = mysql_num_rows($teacher);
  if($rows > 0) {
      mysql_data_seek($teacher, 0);
	  $row_teacher = mysql_fetch_assoc($teacher);
  }
?>
        </select>
      <input name="lookup" type="button" onClick="lookup_teacher_rate(this.form)" class="btn" id="lookup"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Lookup Rates"/></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">External Rate: </td>
      <td colspan="3" valign="middle"><input name="ext_rate" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$ext_rate\""; } ?>
	  type="text" id="ext_rate" size="6" maxlength="6" />
          <span class="bluetext">(per 15 minutes, before discount) </span></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Internal Cost: </td>
      <td colspan="3" valign="middle"><input name="internal_cost" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$internal_cost\""; } ?>
	  type="text" id="internal_cost" size="6" maxlength="6" />
  &nbsp;&nbsp;Cost Type:
  <input name="cost_type" 
  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$cost_type\""; } ?>
  type="text" id="cost_type" size="4" maxlength="4" />
  <span class="bluetext"> (S or F) </span></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Time:</td>
      <td colspan="3" valign="middle"><input name="time" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$time\""; } ?>
	  type="text" id="time" size="6" maxlength="8" onChange='checkTimeFormat(form, this)' /></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Duration:</td>
      <td colspan="3" valign="middle"><select name="duration" class="dropdowntext" id="duration">
          <option value="15" <?php if ( $action <> "" && $duration == "15" ) {echo "selected=\"selected\""; } ?>>15</option>
          <option value="30" <?php if ( $action <> "" && $duration == "30" ) {echo "selected=\"selected\""; } ?>>30</option>
          <option value="45" <?php if ( $action <> "" && $duration == "45" ) {echo "selected=\"selected\""; } ?>>45</option>
          <option value="60" <?php if ( $action <> "" && $duration == "60" ) {echo "selected=\"selected\""; } ?>>1 Hr</option>
          <option value="75" <?php if ( $action <> "" && $duration == "75" ) {echo "selected=\"selected\""; } ?>>1 Hr 15 Min</option>
          <option value="90" <?php if ( $action <> "" && $duration == "90" ) {echo "selected=\"selected\""; } ?>>1.5 Hr</option>
          <option value="105" <?php if ( $action <> "" && $duration == "105" ) {echo "selected=\"selected\""; } ?>>1 Hr 45 Min</option>
          <option value="120" <?php if ( $action <> "" && $duration == "120" ) {echo "selected=\"selected\""; } ?>>2 Hr</option>
      </select></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Start Date: </td>
      <td colspan="3" valign="middle"><script>DateInput('start_date', true, 'YYYY-MM-DD' <?php if ( $action <> "" ) { echo ", \"$start_date\""; } ?>)</script></td>
      <td></td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">End Date: </td>
      <td colspan="3" valign="middle"><script>DateInput('end_date', true, 'YYYY-MM-DD', <?php if ( $action <> "" ) { echo "\"$end_date\""; } else { echo "\"2008-06-30\""; } ?>)</script></td>
      <td></td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">First Cheque No.: </td>
      <td colspan="3" valign="middle"><input name="cheque_no" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$cheque_no\""; } ?>
	  type="text" id="cheque_no" size="6" maxlength="6" /></td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="23" valign="middle">Cheque Holder Name: </td>
      <td colspan="3" valign="middle"><input name="cheque_holders" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$cheque_holders\""; } ?>
	  type="text" id="cheque_holders" size="45" maxlength="60" /></td>
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
        &nbsp;
		<input name="submit" type="submit" class="btn" id="submit" 
		 onclick="document.form1.action = 'student_create_2.php?action=2'; return true;" 
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Add Course Only"/>
         &nbsp;
         <input name="submit2" type="button" class="btn" id="submit2"
		 <?php $url = $wwwhost . "/student_edit.php?action=3" ?>
   onclick='window.location.href=&quot;<?php echo $url ?>&quot; '
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="  Edit  "/>
         &nbsp;
		 <input name="submit" type="button" class="btn" id="submit"
		 <?php $url = $wwwhost . "/student.php" ?>
		 onclick='window.location.href="<?php echo $url ?>" '
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
      </div></td>
      <td height="30" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="top"><input type="hidden" name="student_id" id="student_id/></td>
      <td colspan="3" valign="middle">&nbsp;</td>
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