	  </table>
		</td>
			<td>&nbsp;</td>
	</tr>
	</table>
	  <table>
	  	<tr>
		<td width="40">&nbsp;</td>
	<td width="900"><div align="left"> <br>
	<input name="update" type="submit" class="btn" id="update"
   onClick='document.form2.action="payment_schedule.php?action=2"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Update PD Cheques"/>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="balance_report.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Balance Report"/>
	<input name="class_schedule" type="button" class="btn" id="class_schedule"
	<?php $url = "class_schedule.php?action=newcourse&student_id=$student_id&fullname=" . urlencode($fullname) . "&coursename=$courseName&startdate=$startdate&enddate=$enddate"; ?>
    onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Class Schedule"/>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="add_classes.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Add Classes"/>        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="adhoc_payments.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Ad-hoc Payments"/>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="misc_items.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Other Fees"/>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="enrollment_form.php?&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='enrollWindow=window.open("<?php echo $url; ?>","enrollmentForm","location,status,resizable=yes,scrollbars,toolbar,menubar"); enrollWindow.focus();'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Enrollment Form"/>

	  </div></td>
	</tr>
</table>
