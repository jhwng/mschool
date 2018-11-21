
<form id="form1" name="form1" method="post" onSubmit="return check_teacher_form(this, 'edit');" action="teacher.php?action=3">
  <table width="750" height="455" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    
    <tr>
      <td width="140" height="20" valign="middle">&nbsp;</td>
      <td width="166" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="4" valign="middle">
        <div align="right">
          <input name="submit1" type="submit" class="btn" id="submit1"
		 onclick="document.form1.action = 'teacher.php?action=1'; return true;" 
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Create Teacher"/>
&nbsp;
<input name="submit1" type="submit" class="btn" id="submit1"
		 onclick="document.form1.action = 'teacher.php?action=4'; return true;" 
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Update Teacher"/>
        &nbsp;
         <input name="submit1" type="button" class="btn" id="submit1"
		 <?php $url = "teacher.php" ?>
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
      <td valign="middle"><strong>Teacher Name: </strong></td>
      <td colspan="4" valign="middle"><input name="teacher"
	  type="text" id="teacher"  size="45" maxlength="60"  
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$teacher\""; } ?>/>&nbsp;&nbsp;&nbsp;
      <input name="button" type="button" class="btn" id="button" onclick="teacherNameSearch(this.form)" onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Search"/></td>
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
      <td valign="middle">Home Phone: </td>
      <td colspan="3" valign="middle"><input name="home_tel" 
  	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$home_tel\""; } ?>
      type="text" id="home_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Cell Phone: </td>
      <td colspan="3" valign="middle"><input name="cell_tel" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$cell_tel\""; } ?>
	  type="text" id="cell_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Other Phone: </td>
      <td colspan="3" valign="middle"><input name="other_tel" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$other_tel\""; } ?>
	  type="text" id="other_tel" size="45" maxlength="100" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Email Address: </td>
      <td colspan="3" valign="middle"><input name="email" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$email\""; } ?>
	  type="text" id="email" size="45" maxlength="45" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">SIN:</td>
      <td colspan="3" valign="middle"><input name="sin" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$sin\""; } ?>
	  type="text" id="sin" size="12" maxlength="12" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Active (Y/N):</td>
      <td colspan="3" valign="middle"><input name="active" type="text" id="active" onChange='this.value=this.value.toUpperCase(); if ( this.value != "Y" && this.value != "N" ) { alert ("Must be either Y or N"); this.value=<?php echo "\"$active\""; ?> }' size="4" maxlength="1" <?php if ( $action <> "" ) echo "VALUE=" . "\"$active\"";  else echo "VALUE='Y'"; ?> /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle">&nbsp;</td>
      <td valign="middle">Teacher Since: </td>
      <td colspan="3" valign="middle"><input name="teacher_since" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$teacher_since\""; } ?> 
	   type="text" id="teacher_since" size="12" maxlength="10" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    
    <tr>
      <td height="29" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top">Profile:</td>
      <td colspan="4" valign="middle">
        <textarea name="profile_override" cols="90" rows="10" id="profile_override"
        <?php
        if ($action <> "" && !$UserIsManager) {
            echo "readonly";
        }
        ?> >
          <?php
          if ( $action <> "" ) {
            // Since $profile_override is already setup in teacher.php based on
            // user's role whether he's a Manager or not, there's no need to make
            // that decision again here.
            // TODO: check other forms and see if we can simplify them too.
            echo "$profile_override";

            /*if ($UserIsManager) {
              echo "$profile_override";
            }
            else {
              //jng - can't use "disabled" attribute since it's not submitted with form
              echo $unauthorized_msg;
            }*/

            //echo "$profile";
          }
          ?>
        </textarea>
      </td>
    </tr>
    <tr>
      <td height="29" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top"></td>
      <td colspan="4" valign="middle">
        <!-- jng: can't use "disabled" since the textarea contents are not submitted with form -->
        <textarea hidden name="profile" cols="90" rows="10" id="profile" style="background-color: red; color: white">
          <?php if ( $action <> "" ) {echo "$profile"; } ?>
        </textarea>
      </td>
    </tr>
    <tr>
      <td height="29" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle">
	  <input type="hidden" name="teacher_id" id="teacher_id"  /></td>
      <td colspan="3" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="30" valign="middle">&nbsp;</td>
      <td height="30" colspan="5" valign="top"><div align="center">
         <input name="submit1" type="submit" class="btn" id="submit1"
		 onclick="document.form1.action = 'teacher.php?action=1'; return true;" 
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Create Teacher"/>
&nbsp;
<input name="submit1" type="submit" class="btn" id="submit1"
		 onclick="document.form1.action = 'teacher.php?action=4'; return true;" 
		 onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Update Teacher"/>
        &nbsp;
         <input name="submit1" type="button" class="btn" id="submit1"
		 <?php $url = "teacher.php" ?>
		 onclick='window.location.href="<?php echo $url ?>" '
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
      </div></td>
    </tr>
  </table>
</form>