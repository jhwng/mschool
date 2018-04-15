    <tr height="20" bgcolor=
   <?php if ( $rowCount == 1 ) { $rowCount = 0; echo "\"#FFFFF2\"";}
   else { $rowCount = 1; echo "\"#ECECFF\""; } ?> >
      <td align="center"><?php if ($strong == 1) echo "<strong>"; echo "$j"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="center"><?php if ($strong == 1) echo "<strong>"; echo "$dayOfWeek[$dow]"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="center"><?php if ($strong == 1) echo "<strong>"; echo "$time"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><a href='<?php echo"balance_report.php?action=4&student_id=$studentID&full_name=" . urlencode($fullName) . "&course_name=" . urlencode ($courseName) . "&start_date=$startDate&end_date=$endDate"; ?>' target="_blank"><?php if ($strong == 1) echo "<strong>"; echo "$fullName</a>"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><?php if ($strong == 1) echo "<strong>"; echo $courseName; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><?php if ($strong == 1) echo "<strong>"; echo $teacher; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="center" height=18><span<?php if ($balance < 0) echo " class=\"redtext\""; ?>><?php if ($strong == 1) echo "<strong>"; if ( $balance == 0 ) echo "&nbsp;"; else echo number_format($balance, 2); if ($strong == 1) echo "</strong>"; ?></span></td>
      <td align="left"><?php if ($strong == 1) echo "<strong>"; echo "$pNames"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><?php if ($strong == 1) echo "<strong>"; echo "$homeTel" . "&nbsp;"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><?php if ($strong == 1) echo "<strong>"; echo "$mWorkTel" . "&nbsp;"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><?php if ($strong == 1) echo "<strong>"; echo "$mCellTel" . "&nbsp;"; if ($strong == 1) echo "</strong>"; ?></td>
    </tr>
