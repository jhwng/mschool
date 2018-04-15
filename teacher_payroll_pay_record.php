        <tr>
          <td align="center">
            <input name="delete<?php echo $j; ?>" onChange='document.form2.update<?php echo $j; ?>.value="1"' type="checkbox" id="delete<?php echo $j; ?>" value="delete" 
            <?php if ( $delete == "delete" ) { echo "checked=\"checked\""; } ?> />
		  </div></td>
          <td height="22"><div align="center">
            <input name="date<?php echo $j; ?>" style="text-align: center" <?php echo "VALUE=\"$payDate\""; ?> 
			onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"; if (!(checkDateFormat(form, this))) {this.value = "<?php echo "$payDate"; ?>" }'
			type="text" id="date<?php echo $j; ?>" size="10" maxlength="10" 
			<?php echo "VALUE=\"$date\""; ?>  >
          </div></td>
          <td><div align="center">
            <input name="chq_num<?php echo $j; ?>" style="text-align: center" type="text" id="chq_num<?php echo $j; ?>" size="5" maxlength="8"
			<?php echo "VALUE=\"$chqNum\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"' >
          </div></td>
          <td height="20" align="center">
            <input name="amount<?php echo $j; ?>" style="text-align: right" type="text" id="amount<?php echo $j; ?>" size="6" maxlength="10"
			<?php echo "VALUE=\"$amount\""; ?> 
			onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"; if ( this.value == "C" || this.value == "c" ) { this.value = "<?php echo $payrollAmount; ?>" }; if ( isNaN(this.value) ) {alert("Please enter a number"); this.value = "<?php echo "$amount"; ?>" }' >
          </td>
          <td align="center" height="20">
            <input name="chq_amount<?php echo $j; ?>" style="text-align: right" type="text" id="chq_amount<?php echo $j; ?>" size="6" maxlength="10"
			<?php echo "VALUE=\"$chqAmt\""; ?> 
			onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"; if ( this.value == "C" || this.value == "c" ) { this.value = "<?php echo $netPay; ?>" }; if ( isNaN(this.value) ) {alert("Please enter a number"); this.value = "<?php echo "$chqAmt"; ?>" }' >
          </td>
          <td><div align="center">
		  <input name="payment_method<?php echo $j; ?>" style="text-align: left" type="text" id="payment_method<?php echo $j; ?>" size="8" maxlength="45" 
		  <?php echo "VALUE=\"$paymentMethod\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"' >          </div></td>
          <td height="20"><div align="center">
            <input name="remarks<?php echo $j; ?>" type="text" id="remarks<?php echo $j; ?>" size="25" maxlength="100" 
			<?php echo "VALUE=\"$remarks\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"' >
          
           <input name="payment_id<?php echo $j; ?>" type="hidden" id="payment_id<?php echo $j; ?>" 
		   value="<?php echo $paymentID; ?>"/>
           <input name="userID<?php echo $j; ?>" type="hidden" id="userID<?php echo $j; ?>" 
		   value="<?php echo $userID; ?>"/>
           <input name="userName<?php echo $j; ?>" type="hidden" id="userName<?php echo $j; ?>" 
		   value="<?php echo $userName; ?>"/>
           <input name="timestamp<?php echo $j; ?>" type="hidden" id="timestamp<?php echo $j; ?>" 
		   value="<?php echo $timestamp; ?>"/>
           <input name="update<?php echo $j; ?>" type="hidden" id="update<?php echo $j; ?>" 
		   value="0"/>
          </div></td>
          <td height="20" align="center">
		    <?php if ( $userName == "unknown" ) echo "&nbsp;"; else echo $userName; ?>
          </td>
          <td height="20" align="center">
		    <?php echo $timestamp; ?>
          </td>
        </tr>
