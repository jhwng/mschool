    <tr bgcolor="#FFFFD7">
      <td height="24" colspan="12" nowrap="nowrap" bgcolor="#ECFFEC"><div align="center">
        <input name="submit" type="submit" class="btn" id="submit" 
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Submit Changes"/>

        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="payment_schedule.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="PD Cheques"/>

        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="adhoc_payments.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick="location.href='<?php echo "$url"; ?>'"
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Ad-hoc Payments"/>

        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="misc_items.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Other Fees"/>

        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="balance_report.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Balance Report"/>

        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="add_classes.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Add Classes"/>

        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="bulk_changes.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Bulk Changes"/>

        <input name="submit2" type="button" class="btn" id="submit2"
   <?php $url="course_details.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onclick='location.href=&quot;<?php echo "$url"; ?>&quot;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Course Details"/>

        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="class_listing.php?&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='enrollWindow=window.open("<?php echo $url; ?>","classListing","location,status,resizable=yes,scrollbars,toolbar,menubar"); enrollWindow.focus();'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="  Print  " />

        <input name="submit" type="button" class="btn" id="submit"
   onClick='location.href="#top"' 
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Top of Page"/>

        <input name="submit2" type="button" class="btn" id="submit2"
   <?php $url="student_edit.php?student_id=$student_id&action=5"; ?>
   onclick='studProfWindow=window.open("<?php echo "$url"; ?>", "Student Profile", "location=0,toolbar=0,menubar=0,status=1,height=1000,width=800");
           studProfWindow.moveBy(800, 0); studProfWindow.focus(); '
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Student Profile"/>

      </div></td>
    </tr>
    <tr bgcolor="#E2D8F3">
      <td height="16" colspan="5" nowrap="nowrap"><div align="center" class="style3 style9 style11">Registered Class
<?php echo " - $mmm"; ?>
</div></td>
      <td colspan="7" bgcolor="#FFBA75"><div align="center" class="style9">Reschedule Class </div></td>
    </tr>
    <tr bgcolor="#FFFFD7">
      <td width="64" nowrap="nowrap" class="style6 style8"><div align="center">Date/Cancel</div></td>
      <td width="55" class="style6 style8"><div align="center">Time/Type</div></td>
      <td width="47" nowrap="nowrap" class="style6 style8"><div align="left">Duration</div></td>
      <td width="77" class="style6 style8"><div align="center">Teacher/Course</div></td>
      <td width="26" class="style6 style8"><div align="center">Rate</div></td>
      <td width="80" class="style6 style8"><div align="center">Cancel</div></td>
      <td width="110" nowrap="nowrap" class="style6 style8"><div align="center">Reschedule Date</div></td>
      <td width="50" class="style6 style8"><div align="center">Time</div></td>
      <td width="50" class="style6 style8"><div align="center">Duration</div></td>
      <td width="120" class="style6 style8"><div align="center">Teacher</div></td>
      <td width="100" nowrap="nowrap" class="style6 style8"><div align="left">Grd/Rate/Cost/Type</div></td>
      <td width="200" class="style6 style8"><div align="center">Remarks / By</div></td>
    </tr>
