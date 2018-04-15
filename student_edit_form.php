
<form id="form1" name="form1" method="post" onSubmit="return check_student_form(this, 'edit');" action="student_edit.php?action=3">
  <table width="750" height="685" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    
    <tr>
      <td width="140" height="20" valign="middle">&nbsp;</td>
      <td width="166" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="4" valign="middle">
        <div align="right">
          <input name="submit1" type="submit" class="btn" id="submit1"
		 onclick="document.form1.action = 'student_edit.php?action=4'; return true;" 
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Submit Changes"/>
        &nbsp;
         <input name="submit1" type="button" class="btn" id="submit1"
		 <?php $url = "student_edit.php" ?>
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
      <input name="button" type="button" class="btn" id="button" onclick="studentNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Search"/></td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle"><strong>Parents/Guardian: </strong><a href="#" style="text-decoration:none" onMouseover="showhint('To associate the student to different parents, enter the new parents names and click the Search button. If the new parents account has not been created, enter the parents names,  phone numbers, address, etc. and check the New Account button.', this, event, '320px')">[?]</a></td>
      <td colspan="4" valign="middle"><input name="parents_names" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$parents_names\""; } ?>
	  type="text" id="parents_names" size="45" maxlength="60" />
        <span class="bluetext">
        &nbsp;&nbsp;&nbsp;<input name="button" type="button" class="btn" id="button" 
		onclick="if ( document.form1.full_name.value == '' ) { alert ('Please specify Student Name first') } else { checkParentsNames(this.form) }"
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
      <td valign="middle"><input name="birthdate" type="text" id="birthdate" size="12" maxlength="12" <?php if ($birthdate <> "") echo "VALUE=\"" . $birthdate . "\""; ?> onChange='checkDateFormat(form, this)' /></td>
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
	  type="text" id="postal_code" size="7" maxlength="7" /></td>
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
      <td valign="middle">Student email: </td>
      <td colspan="3" valign="middle"><input name="student_email" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$student_email\""; } ?>
	  type="text" id="student_email" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Enrollment Date: </td>
      <td colspan="3" valign="middle"><input name="enrollment_date" type="text" id="enrollment_date" size="12" maxlength="12" <?php if ($enrollment_date <> "") echo "VALUE=\"" . $enrollment_date . "\""; ?> onChange='checkDateFormat(form, this)' /></td>
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
      <td colspan="3" valign="middle"><input name="discount" type="text" id="discount" value=<?php if ( $discount <> "" ) { echo "\"$discount\""; } else { echo "\"0\""; } ?> size="6" maxlength="4" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Discount Expiry Date: </td>
      <td colspan="3" valign="middle"><input name="discount_expiry_date" type="text" id="discount_expiry_date" size="12" maxlength="12" <?php if ($discount_expiry_date <> "") echo "VALUE=\"" . $discount_expiry_date . "\""; ?> onChange='checkDateFormat(form, this)' /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="top">Related Friends: <a href="#" style="text-decoration:none" onMouseover="showhint('Doe, John | brother, with Teacher A;<br>Smith, Jane | with Teacher B', this, event, '320px')">[?]</a></td>
      <td colspan="3" valign="middle"><textarea name="related_friends" 
	  cols="50" rows="3" id="related_friends"><?php if ( $action <> "" ) {echo "$related_friends"; } ?>
</textarea></td>
      <td valign="middle">&nbsp;&nbsp;
	  <input name="lookup2" type="button" onclick="lookup_friends(this.form)" class="btn" id="lookup2"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Lookup Details"/>&nbsp;</td>
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
      <td valign="middle">
	  <input type="hidden" name="student_id" id="student_id"  />
	  <input type="hidden" name="account_id" id="account_id"  />
	  <input type="hidden" name="old_account_id" id="old_account_id"  />	  </td>
      <td colspan="3" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="30" valign="middle">&nbsp;</td>
      <td height="30" colspan="4" valign="top"><div align="center">
         <input name="submit1" type="submit" class="btn" id="submit1"
		 onclick="document.form1.action = 'student_edit.php?action=4'; return true;" 
		 onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Submit Changes"/>
        &nbsp;
         <input name="submit1" type="button" class="btn" id="submit1"
		 <?php $url = "student_edit.php" ?>
		 onclick='window.location.href="<?php echo $url ?>" '
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
      </div></td>
      <td height="30" valign="middle">&nbsp;</td>
    </tr>
  </table>
</form>