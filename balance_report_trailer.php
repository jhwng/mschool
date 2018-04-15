	  </table>
		</td>
			<td>&nbsp;</td>
	</tr>
	</table>
	
      <table>
	  	<tr>
		<td width="34">&nbsp;</td>
	<td width="650"><div align="center"> <br>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="payment_schedule.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="PD Cheques"/>
	<input name="class_schedule" type="button" class="btn" id="class_schedule"
	<?php $url = "class_schedule.php?action=newcourse&student_id=$student_id&fullname=" . urlencode($fullname) . "&coursename=$courseName&startdate=$startdate&enddate=$enddate"; ?>
    onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Class Schedule"/>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="add_classes.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Add Classes"/>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="adhoc_payments.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Ad-hoc Payments"/>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="misc_items.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Other Fees"/>
        <input name="submit" type="button" class="btn" id="submit"
   <?php $url="bulk_changes.php?action=4&student_id=$student_id&full_name=" . urlencode($fullname) . "&start_date=$startdate&end_date=$enddate&course_name=$courseName"; ?>
   onClick='location.href="<?php echo "$url"; ?>"'
   onmouseover="this.className='btn btnhov'" onMouseOut="this.className='btn'" value="Bulk Changes"/>
	  </div></td>
	</tr>
</table>