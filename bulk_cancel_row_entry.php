	<tr>
	<td><div align="center"><input type="checkbox" name="skip<?php echo $j; ?>" value="Y" id="skip<?php echo $j; ?>"/></div></td>
	  <td nowrap="nowrap"><div align="left"><?php echo $date; ?></div></td>
	  <td><div align="left"><?php echo $time; ?></div></td>
	  <td><div align="left"><?php echo $fullName; ?></div></td>
	  <td><div align="left"><?php echo $homeTel; ?></div></td>
	  <td><div align="left"><?php echo $teacherName1; ?></div></td>
	  <td><div align="left"><?php echo $courseName; ?></div></td>
	  <td><div align="left"><?php echo $duration; ?></div>
	  <input type="hidden" name="date<?php echo $j; ?>" id="date<?php echo $j; ?>" value="<?php echo $date; ?>" >
	  <input type="hidden" name="time<?php echo $j; ?>" id="time<?php echo $j; ?>" value="<?php echo $time; ?>" >
	  <input type="hidden" name="duration<?php echo $j; ?>" id="duration<?php echo $j; ?>" value="<?php echo $duration; ?>" >
	  <input type="hidden" name="course_id<?php echo $j; ?>" id="course_id<?php echo $j; ?>" value="<?php echo $courseID; ?>" >
	  <input type="hidden" name="grade<?php echo $j; ?>" id="grade<?php echo $j; ?>" value="<?php echo $grade; ?>" >
	  <input type="hidden" name="external_rate<?php echo $j; ?>" id="external_rate<?php echo $j; ?>" value="<?php echo $extRate; ?>" >
	  <input type="hidden" name="student_id<?php echo $j; ?>" id="student_id<?php echo $j; ?>" value="<?php echo $studentID; ?>" >
	  <input type="hidden" name="teacher_id<?php echo $j; ?>" id="teacher_id<?php echo $j; ?>" value="<?php echo $teacherID; ?>" >
	  <input type="hidden" name="remarks<?php echo $j; ?>" id="remarks<?php echo $j; ?>" value="<?php echo $remarks; ?>" >
	  <input type="hidden" name="class_id<?php echo $j; ?>" id="class_id<?php echo $j; ?>" value="<?php echo $classID; ?>" >
	  <input type="hidden" name="dow<?php echo $j; ?>" id="dow<?php echo $j; ?>" value="<?php echo $dow; ?>" >
	  <input type="hidden" name="internal_cost<?php echo $j; ?>" id="internal_cost<?php echo $j; ?>" value="<?php echo $internalCost; ?>" >
	  <input type="hidden" name="class_type<?php echo $j; ?>" id="class_type<?php echo $j; ?>" value="<?php echo $classType; ?>" >
	  <input type="hidden" name="cost_type<?php echo $j; ?>" id="cost_type<?php echo $j; ?>" value="<?php echo $costType; ?>" >
	  <input type="hidden" name="from_studentCreditID<?php echo $j; ?>" id="from_studentCreditID<?php echo $j; ?>" value="<?php echo $from_studentCreditID; ?>" >
	  <input type="hidden" name="to_studentCreditID<?php echo $j; ?>" id="to_studentCreditID<?php echo $j; ?>" value="<?php echo $to_studentCreditID; ?>" >
	  </td>
    </tr>
