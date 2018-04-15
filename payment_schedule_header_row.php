<form id="form2" name="form2" method="post" action="payment_schedule.php?action=1">
  <table width="1030" border="0" cellspacing="0" cellpadding="0">
          
          <tr><div align="left">
		    <td width="34">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Teacher: <input name="teacher" type="text" id="teacher" size="30" maxlength="60" 
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
&nbsp;&nbsp;&nbsp;Day of Week: <input name="dow" type="text" id="dow" size="3" maxlength="3" 
<?php if ($dow <> "" ) { echo "VALUE=\"$dayOfWeek[$dow]\""; } ?>/><br></br>
<span class="style4">School Year: <?php echo "$schYear"; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;Course: <?php echo "$courseName"; ?> <br><br>
              </div></td>
			<td>&nbsp;</td>
		  </tr>

    <tr>
      <td>&nbsp;</td>
      <td width="1016">
	  <table width="1016" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td width="35" bgcolor="#FFBA75"><div align="center">Del</div></td>
          <td width="70" height="20" bgcolor="#FFBA75"><div align="center">Month</div></td>
          <td width="80" height="20" bgcolor="#FFBA75"><div align="center">Date</div></td>
          <td width="60" height="20" bgcolor="#FFBA75"><div align="center">Usage</div></td>
          <td width="60" bgcolor="#FFBA75"><div align="center">Chq Amt</div></td>
          <td width="60" bgcolor="#FFBA75"><div align="center">Chq No. </div></td>
          <td width="180" bgcolor="#FFBA75"><div align="center">Cheque Name </div></td>
          <td width="42" bgcolor="#FFBA75"><div align="center">Status<br /><a href="#" style="text-decoration:none" onMouseover="showhint('R - single chq received<br>D - single chq deposited<br>S - amount split to this person/course from an L chq<br>H - single chq held, chq that needs updating<br>B - single chq bounced from bank<br>L - group chq received<br>LB group chq bounced<br>S - amount split to this person/course from an L chq<br>LD - group chq deposited<br>LH - group chq bounced<br>Blank - cheque already returned, or held waiting to be returned', this, event, '350px')">[?]</a></div></td>
          <td width="100" bgcolor="#FFBA75"><div align="center">Payment Method</div></td>
          <td width="150" bgcolor="#FFBA75"><div align="center">Remarks</div></td>
          <td width="60" bgcolor="#FFBA75"><div align="center">User</div></td>
          <td width="144" bgcolor="#FFBA75"><div align="center">Time</div></td>
        </tr>
