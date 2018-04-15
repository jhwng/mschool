  <table width="750" border="0" cellspacing="0" cellpadding="0">
          
          <tr><div align="left">
		    <td width="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
              <div align="left">
                Teacher:
                  <input name="teacher" type="text" id="teacher" size="20" maxlength="60" 
				  <?php if ($teacher <> "" ) { echo "VALUE=\"$teacher\""; } ?>/>
&nbsp;&nbsp;&nbsp;Time:
<input name="time" type="text" id="time" size="8" maxlength="8" 
<?php if ($time <> "" ) { echo "VALUE=\"$time\""; } ?>/>
&nbsp;&nbsp;&nbsp;Duration:
<input name="duration" type="text" id="duration" size="4" maxlength="4" 
<?php if ($duration <> "" ) { echo "VALUE=\"$duration\""; } ?>/>
&nbsp;&nbsp;&nbsp;Tuition Fee:
<input name="tuition_fee" type="text" id="tuition_fee" size="8" maxlength="10" 
<?php if ($external_rate > 0 ) { $fee = number_format($external_rate * $duration / 15,2); echo "VALUE=\"$fee\""; } ?>/>
&nbsp;&nbsp;&nbsp;Day of Week: <input name="dow" type="text" id="dow" size="2" maxlength="2" 
<?php if ($dow <> "" ) { echo "VALUE=\"$dayOfWeek[$dow]\""; } ?>/><br><br>
<span class="style4">School Year: <?php echo "$schYear"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>Course: <?php echo "$courseName"; ?><br><br>
              </div></td>
			<td>&nbsp;</td>
		  </tr>
    <tr>
      <td width="30">&nbsp;</td>
      <td width="720">
  
  <table width="720" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#FFBA75">
      <td width="100" height="25"><div align="center">Month</div></td>
      <td width="70"><div align="center">Current<br># Lessons</div></td>
      <td width="90"><div align="center">PD Cheques </div></td>
      <td width="90"><div align="center">Ad-hoc<br>Payment</div></td>
      <td width="90"><div align="center">( Other Fees )</div></td>
      <td width="90"><div align="center">( Usage )</div></td>
      <td width="90"><div align="center">Balance<br>(culmulative)</div></td>
      <td width="74"><div align="center">W Amount<br>(culmulative)</div></td>
      <td width="74"><div align="center">T Amount<br>(culmulative)</div></td>
    </tr>

