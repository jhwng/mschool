    <tr height="28" bgcolor=
   <?php if ( $rowCount == 1 ) { $rowCount = 0; echo "\"#FFFFF2\"";}
   else { $rowCount = 1; echo "\"#ECECFF\""; } ?> >
      <td align="center"><?php if ($strong == 1) echo "<strong>"; echo "$j"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><?php if ($strong == 1) echo "<strong>"; echo $teacher; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><?php if ($strong == 1) echo "<strong>"; echo $courseName; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="left"><a href='<?php echo "class_schedule.php?action=newcourse&student_id=$studentID&fullname=" . urlencode($fullName) . "&coursename=" . urlencode ($courseName) ."&startdate=$startDate&enddate=$endDate"; ?>' target="_blank"><?php if ($strong == 1) echo "<strong>"; echo "$fullName</a>"; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="center"><?php if ($strong == 1) echo "<strong>"; echo $creditType; if ($strong == 1) echo "</strong>"; ?></td>
      <td align="center" height=18><?php if ($strong == 1) echo "<strong>"; if ( $minutes == 0 ) echo "&nbsp;"; else echo $minutes; if ($strong == 1) echo "</strong>"; ?></span></td>
    </tr>
