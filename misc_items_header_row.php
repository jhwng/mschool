<form id="form2" name="form2" method="post" action="misc_items.php?action=1">
  <table width="800" border="0" cellspacing="0" cellpadding="0">
           <tr>
		    <td width="30">&nbsp;</td>
            <td width="770">Teacher: <input name="teacher" type="text" id="teacher" size="30" maxlength="60" <?php if ($teacher <> "" ) { echo "VALUE=\"$teacher\""; } ?>/>&nbsp;&nbsp;&nbsp;&nbsp;Time:
<input name="time" type="text" id="time" size="8" maxlength="8" 
<?php if ($time <> "" ) { echo "VALUE=\"$time\""; } ?>/>
&nbsp;&nbsp;&nbsp;Duration:
<input name="duration" type="text" id="duration" size="4" maxlength="4" 
<?php if ($duration <> "" ) { echo "VALUE=\"$duration\""; } ?>/>
&nbsp;&nbsp;&nbsp;Tuition Fee:
<input name="tuition_fee" type="text" id="tuition_fee" size="8" maxlength="10" 
<?php if ($external_rate > 0 ) { $fee = number_format($external_rate * $duration / 15,2); echo "VALUE=\"$fee\""; } ?>/>
&nbsp;&nbsp;&nbsp;Day of Week: <input name="dow" type="text" id="dow" size="3" maxlength="3" 
<?php if ($dow <> "" ) { echo "VALUE=\"$dayOfWeek[$dow]\""; } ?>/><br></br>
<span class="style4">School Year: <?php echo "$schYear"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>Course: <?php echo "$courseName"; ?><br><br>
              </td>
			<td>&nbsp;</td>
		  </tr>

    <tr>
      <td width="30">&nbsp;</td>
      <td width="770">
	  <table width="770" border="1" cellpadding="0" cellspacing="0">
        <tr>
		  <td width="35" bgcolor="#FFBA75"><div align="center">Del</div></td>
          <td width="100" height="20" bgcolor="#FFBA75"><div align="center">Date</div></td>
          <td width="80" bgcolor="#FFBA75"><div align="center">Amount</div></td>
          <td width="200" bgcolor="#FFBA75"><div align="center">Remarks</div></td>
          <td width="100" bgcolor="#FFBA75"><div align="center">User</div></td>
          <td width="200" bgcolor="#FFBA75"><div align="center">Time</div></td>
        </tr>
