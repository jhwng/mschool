      </form>
      <form id="courseform" name="courseform" method="post" action="bulk_changes.php?action=2" onsubmit="return checkBulkChangesFields(this);">
        <table width="772" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="25">&nbsp;</td>
            <td colspan="2" align="left"><span class="style4">School Year: <?php echo "$schYear"; ?></span></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td colspan="2" align="left"><span class="bluetext">Note: Bulk Changes will change all class entries between Old Start Date and June 30</span></td>
          </tr>
          <tr>
            <td width="163" height="25">&nbsp;</td>
            <td width="211" align="left">Old Start  Date: </td>
            <td width="398" align="left"><input name="old_start_date" type="text" id="old_start_date" size="10" maxlength="10" onchange='checkDateFormat(form, this)' <?php if ( $action <> "" ) {echo "VALUE=" . "\"$oldStartDate\""; } ?>/></td>
          </tr>
          
          <tr>
            <td height="25">&nbsp;</td>
            <td align="left">New Start Date: </td>
            <td align="left"><input name="new_start_date" type="text" id="new_start_date" size="10" maxlength="10" onchange='checkDateFormat(form, this)' <?php if ( $action <> "" ) {echo "VALUE=" . "\"$newStartDate\""; } ?>/></td>
          </tr>
          
          <tr>
            <td height="25">&nbsp;</td>
            <td align="left">Grade:</td>
            <td align="left"><select name="grade" class="dropdowntext" id="grade">
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
              <option value="n/a" <?php if ( $action <> "" && $grade == "n/a" ) {echo "selected=\"selected\""; } ?> >n/a</option>
            </select></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td align="left">Teacher:</td>
            <td align="left"><select name="teacher" class="dropdowntext" id="teacher">
              <?php
do {  
?>
              <option value="<?php echo $row_teacher['teacher']?>" <?php if ( $action <> "" && 
$row_teacher['teacher'] == $teacherName ) {echo "selected=\"selected\""; } ?>><?php echo $row_teacher['teacher']?></option>
              <?php
} while ($row_teacher = mysql_fetch_assoc($teacherList));
  $rows = mysql_num_rows($teacherList);
  if($rows > 0) {
      mysql_data_seek($teacherList, 0);
	  $row_teacher = mysql_fetch_assoc($teacherList);
  }
?>
            </select>
              <input name="lookup" type="button" onclick="lookupTeacherRateForAddClasses(this.form, 'courseform')" class="btn" id="lookup"
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Lookup Rates"/></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td align="left">External Rate: </td>
            <td align="left"><input name="ext_rate" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$external_rate\""; } ?>
	  type="text" id="ext_rate" size="6" maxlength="6" />
              <span class="bluetext">( per 15 minutes, before discount ) </span></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td align="left">Internal Cost: </td>
            <td align="left"><input name="internal_cost" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$internal_cost\""; } ?>
	  type="text" id="internal_cost" size="6" maxlength="6" />
&nbsp;&nbsp;Cost Type:
<input name="cost_type"
  onchange='this.value=this.value.toUpperCase();
  if (this.value != "S" && this.value != "F") {
    alert("Please enter S or F");
  }
  if (this.value == "F" &&
      parseFloat(document.courseform.ext_rate<?php if (isset($j)) echo $j; ?>.value) <= parseFloat(document.courseform.internal_cost<?php if (isset($j)) echo $j; ?>.value)) {
    alert ("For Fixed Internal Cost, it must be less than External Rate");
  }'
  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$cost_type\""; } ?>
  type="text" id="cost_type" size="4" maxlength="4"
/>
<span class="bluetext"> ( S or F ) </span></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td align="left">Time:</td>
            <td align="left"><input name="time" 
	  <?php if ( $action <> "" ) {echo "VALUE=" . "\"$time\""; } ?>
	  type="text" id="time" size="6" maxlength="8" onchange='checkTimeFormat(form, this)' /></td>
          </tr>
          <tr>
            <td height="25">&nbsp;</td>
            <td align="left">Duration:</td>
            <td align="left"><select name="duration" class="dropdowntext" id="duration">
              <option value="15" <?php if ( $action <> "" && $duration == "15" ) {echo "selected=\"selected\""; } ?>>15</option>
              <option value="30" <?php if ( $action <> "" && $duration == "30" ) {echo "selected=\"selected\""; } ?>>30</option>
              <option value="45" <?php if ( $action <> "" && $duration == "45" ) {echo "selected=\"selected\""; } ?>>45</option>
              <option value="60" <?php if ( $action <> "" && $duration == "60" ) {echo "selected=\"selected\""; } ?>>60</option>
              <option value="75" <?php if ( $action <> "" && $duration == "75" ) {echo "selected=\"selected\""; } ?>>75</option>
              <option value="90" <?php if ( $action <> "" && $duration == "90" ) {echo "selected=\"selected\""; } ?>>90</option>
              <option value="105" <?php if ( $action <> "" && $duration == "105" ) {echo "selected=\"selected\""; } ?>>105</option>
              <option value="120" <?php if ( $action <> "" && $duration == "120" ) {echo "selected=\"selected\""; } ?>>120</option>
            </select></td>
          </tr>
          
          <tr>
            <td height="25">&nbsp;</td>
            <td align="left">Remarks:</td>
            <td align="left"><input name="remarks" type="text" id="remarks" 
			  <?php if ( $remarks <> "" ) echo "value=\"$remarks\"";  ?> size="45" maxlength="200" /></td>
          </tr>
          <tr>
            <td height="36">&nbsp;</td>
            <td align="left"><strong>Update Course Details: </strong></td>
            <td align="left">
			  <label>
                <input name="details_update" type="radio" value="none" 
				  <?php if ( $updateCourse == "none" ) echo "checked=\"checked\""; ?> />
                No</label>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label>
                <input type="radio" name="details_update" value="all" 
				  <?php if ( $updateCourse == "all" ) echo "checked=\"checked\""; ?>/>
                All Details Except Start Date</label>
</td>
          </tr>
          
          <tr>
            <td height="15">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="15">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3">
              <div align="center">
                <input name="change" type="submit" class="btn" id="change"
      onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Submit Bulk Changes"/>
                &nbsp;
                <input name="classSchedule" type="button" class="btn" id="classSchedule"
   <?php $url =  "class_schedule.php?action=newcourse&student_id=$student_id&fullname=" . urlencode($fullname) . "&coursename=" . urlencode($courseName) . "&startdate=$startdate&enddate=$enddate"; ?>
   onClick='window.location.href="<?php echo $url ?>"' 
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Class Schedule"/>
                &nbsp;
                <input name="PaymentSchedule" type="button" class="btn" id="paymentSchedule"
   <?php $url =  "payment_schedule.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&coursename=" . urlencode($courseName) . "&start_date=$startdate&end_date=$enddate"; ?>
   onClick='window.location.href="<?php echo $url ?>"' 
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="PD Cheques"/>
                &nbsp;
                <input name="submit" type="button" class="btn" id="submit"
   <?php $url="balance_report.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=" . urlencode($courseName); ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Balance Report"/>&nbsp;&nbsp;
                <input name="submit2" type="button" class="btn" id="submit2"
   <?php $url="adhoc_payments.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=" . urlencode($courseName); ?>
   onclick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Ad-hoc Payments"/>&nbsp;&nbsp;
                <input name="submit" type="button" class="btn" id="submit"
   <?php $url="misc_items.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=" . urlencode($courseName); ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Other Fees"/>
              </div></td></tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
			<input name="full_name" type="hidden" id="full_name" />
			<input name="course_name" type="hidden" id="course_name" />
            <input name="start_date" type="hidden" id="start_date" />
			<input name="end_date" type="hidden" id="end_date" />	
            <input name="course_id" type="hidden" id="course_id" />
			<input name="student_id" type="hidden" id="student_id" />			</td>
          </tr>
        </table>
      </form>
