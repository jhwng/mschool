<form id="form2" name="form2" method="post" action="adhoc_payments.php?action=1">
  <table width="1000" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
		    <td width="5">&nbsp;</td>
            <td>
              <div align="left">
                Teacher:
                  <input name="teacher" type="text" id="teacher" size="30" maxlength="60" 
				  <?php if ($teacher <> "" ) { echo "VALUE=\"$teacher\""; } ?>/>
&nbsp;&nbsp;&nbsp;Time:
<input name="time" type="text" id="time" size="8" maxlength="8" 
<?php if ($time <> "" ) { echo "VALUE=\"$time\""; } ?>/>
&nbsp;&nbsp;&nbsp;Duration:
<input name="duration" type="text" id="duration" size="4" maxlength="4" 
<?php if ($duration <> "" ) { echo "VALUE=\"$duration\""; } ?>/>
&nbsp;&nbsp;&nbsp;Tuition Fee:
<input name="tuition_fee" type="text" id="tuition_fee" size="8" maxlength="10" 
<?php if (isset($external_rate) && $external_rate > 0 ) { $fee = number_format($external_rate * $duration / 15,2); echo "VALUE=\"$fee\""; } ?>/>
&nbsp;&nbsp;&nbsp;Day of Week: <input name="dow" type="text" id="dow" size="3" maxlength="3" 
<?php if ($dow <> "" ) { echo "VALUE=\"$dayOfWeek[$dow]\""; } ?>/><br></br>
<span class="style4">School Year: <?php echo "$schYear"; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>Course: <?php echo "$courseName"; ?><br><br>
              </div></td>
			<td>&nbsp;</td>
		  </tr>

    <tr>
      <td>&nbsp;</td>
      <td width="950">
	  <table width="950" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td width="35" bgcolor="#FFBA75"><div align="center">Del</div></td>
          <td width="60" height="20" bgcolor="#FFBA75"><div align="center">Date</div></td>
          <td width="60" bgcolor="#FFBA75"><div align="center">Amount</div></td>
          <td width="60" bgcolor="#FFBA75"><div align="center">Chq No. </div></td>
          <td width="120" bgcolor="#FFBA75"><div align="center">Cheque Name </div></td>
          <td width="120" bgcolor="#FFBA75"><div align="center">Payment Method</div></td>
          <td width="100" bgcolor="#FFBA75"><div align="center">Remarks</div></td>
          <td width="120" bgcolor="#FFBA75"><div align="center">Month Allocation<br>( 1 - 12 )</div></td>
          <td width="60" bgcolor="#FFBA75"><div align="center">User</div></td>
          <td width="144" bgcolor="#FFBA75"><div align="center">Time</div></td>
        </tr>
