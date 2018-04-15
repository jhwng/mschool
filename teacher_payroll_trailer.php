</table>
</td>
</tr>
</table>
<p>
<table width="740" border="0" cellspacing="0" cellpadding="0">
          
    <tr>
      <td width="40">&nbsp;
	    <input name="teacher_id" type="hidden" id="teacher_id" value="<?php echo $teacher_id; ?>"/>
        <input name="teacher" type="hidden" id="teacher" value="<?php echo $teacher; ?>"/>
        <input name="month" type="hidden" id="month" value="<?php echo $month; ?>"/>
	  </td>
      <td width="700">
  
  <table width="700" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#FFBA75">
	  <td width="30" height="22"><div align="center">Del</div></td>
      <td width="80"><div align="center">Date</div></td>
      <td width="60"><div align="center">Chq No.</div></td>
      <td width="65"><div align="center">Payroll<br>Amount</div></td>
      <td width="65"><div align="center">Cheque<br>Amount</div></td>
      <td width="70"><div align="center">Payment Method</div></td>
      <td width="140"><div align="center">Remarks</div></td>
      <td width="60" bgcolor="#FFBA75"><div align="center">User</div></td>
      <td width="130" bgcolor="#FFBA75"><div align="center">Time</div></td>
    </tr>

<?php
	// display payroll record
	$query = "select payment_id as paymentID, date as payDate, cheque_num as chqNum, amount, cheque_amount as chqAmt, payment_method as paymentMethod, remarks, teacher_payroll.user_id, user_name,  DATE_FORMAT(teacher_payroll.timestamp,'%Y-%m-%d %H:%i') from teacher_payroll, user where teacher_payroll.user_id = user.user_id and teacher_id = $teacher_id and month = \"$month\" order by payDate";
    // echo "$query<br>";
	$result = mysql_query($query, $promusic) or die(mysql_error());
    $numRowsPay = mysql_num_rows($result);

	$j = 0;
    while ( list ($paymentID, $payDate, $chqNum, $amount, $chqAmt, $paymentMethod, $remarks, $userID, $userName, $timestamp) = mysql_fetch_row($result)) {
       require ('teacher_payroll_pay_record.php');
	   $j += 1;
	}  // End while
    
	// Display 1 blank form lines for adding new entry
	$date = "";
	$amount = 0;
	$chqNum = "";
	$chqAmt = 0;
	$paymentMethod = "";
	$remarks = "";
	$userName="&nbsp;";
	$timestamp="&nbsp;";
	$i = 1;
    while ( $i <= 1 ) {
	  require ('teacher_payroll_pay_record.php');
	  $i += 1;
	  $j += 1;
	}

?>

	<tr height="35"><td colspan="9" align="center">
        <input name="num_entries" type="hidden" id="num_entries" value="<?php echo $numRowsPay; ?>"/>
	  <input name="update" type="submit" class="btn" id="update" onclick='document.form2.action="teacher_payroll.php?action=2"; return true;' onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Update Teacher Payroll Record" />
	    </td>
	</tr>
  </table>
  </td>
  </tr>
</table>
</form>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<p>&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Teacher's Signature: ________________________________ 
</p>
