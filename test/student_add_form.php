<?php 
/* $first_name = "Vania"; 
$last_name = "Wu";
$parents_name = "Raymond Wu";
$birthdate = "";
$sex="M";
*/
?>
<form id="form1" name="form1" method="post" action="formprocess1.php">
  <table width="750" height="685" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    
    <tr>
      <td width="140" height="20" valign="middle">&nbsp;</td>
      <td width="166" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="4" valign="middle">
        <div align="right">
          <input name="submit2" type="submit" class="btn" id="submit2"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value=" Next  "/>
          <input name="submit3" type="submit" class="btn" id="submit3"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="  Edit  "/>
          <input name="submit4" type="submit" class="btn" id="submit4"
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
      <td colspan="4" valign="middle"><input name="last_name" type="text" id="last_name" size="45" maxlength="60" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Parent/Guardian: </td>
      <td colspan="4" valign="middle"><input name="parents_names" type="text" id="parents_names" size="45" maxlength="60" /></td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Date of Birth:</td>
      <td width="239" valign="middle" class="bluetext"><input name="birthdate" type="text" id="birthdate" size="10" maxlength="10" />
      (YYYY-MM-DD)</td>
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
      <td colspan="3" valign="middle"><input name="parent_email" type="text" id="parent_email" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Discount %: </td>
      <td colspan="3" valign="middle"><input name="discount" type="text" id="discount" size="10" maxlength="4" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Discount Expiry Date: </td>
      <td colspan="3" valign="middle"><input name="discount_expiry_date" type="text" id="discount_expiry_date" size="10" maxlength="10" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="top">Related Friends: </td>
      <td colspan="3" valign="middle"><textarea name="related_friends" cols="40" rows="3" id="related_friends">test</textarea></td>
      <td valign="middle">&nbsp;</td>
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
<?php
if ($action == 1) require('student_add_course_form.php');
?>
    <tr>
      <td height="21" valign="middle">&nbsp;</td>
      <td height="21" colspan="4" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td height="21" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" valign="middle">&nbsp;</td>
      <td height="30" colspan="4" valign="top"><div align="center">
        <input name="submit" type="submit" class="btn" id="submit"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value=" Next  "/>
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