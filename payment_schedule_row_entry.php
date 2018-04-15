        <tr>
          <td align="center">
            <input name="delete<?php echo $j; ?>" 
			  onChange="document.form2.update<?php echo $j; ?>.value='1'" 
			  type="checkbox" id="delete<?php echo $j; ?>" value="delete" 
            <?php if ( $delete == "delete" ) { echo "checked=\"checked\""; } ?> />
		  </td>
		  <td height="20" align="center">
            <input name="month<?php echo $j; ?>" style="text-align: center" type="text" id="month<?php echo $j; ?>" size="8" maxlength="10" 	<?php echo "VALUE=\"$month\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"' />
          </td>
          <td height="22">
            <input name="date<?php echo $j; ?>"  style="text-align: center" 
			onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"; if (!(checkDateFormat(form, this))) {this.value = "<?php echo "$chqDate"; ?>" }'
			type="text" id="date<?php echo $j; ?>" size="10" maxlength="10" 
			<?php echo "VALUE=\"$chqDate\""; ?>  />
          </td>
		  <td height="20" align="center">
            <?php if ( $usageAmt == 0 ) echo "&nbsp"; else echo number_format($usageAmt, 2); ?> 
		  </td>
          <td height="20">
            <input name="amount<?php echo $j; ?>"  style="text-align: right<?php if ($usageAmt <> $amount && $status == '' && $usageAmt <> "" ) echo ';color:blue;font-weight: bold'; ?>" type="text" id="amount<?php echo $j; ?>" size="7" maxlength="7"
			<?php echo "VALUE=\"$amount\""; ?> 
			onChange='document.form2.update<?php echo $j; ?>.value="1";  this.style.backgroundColor="#FC9494"; if ( this.value == "C" || this.value == "c" ) { this.value = "<?php echo number_format ($usageAmt, 2); ?>" }; if ( isNaN(this.value) ) {alert("Please enter a number"); this.value = "<?php echo "$amount"; ?>" }; if ( this.value == "" ) this.value="0"; if ( document.form2.date<?php echo $j; ?>.value == "" ) alert ("Enter a Cheque Date in order to add a record"); ' />
          </td>
          <td align="center">
            <input name="chq_num<?php echo $j; ?>"  style="text-align: center" type="text" id="chq_num<?php echo $j; ?>" size="5" maxlength="8"
			<?php echo "VALUE=\"$chqNum\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; if ( this.value == "C" || this.value == "c" ) {this.value = document.form2.chq_num<?php if ($j > 0 ) echo $j - 1; else echo "0"; ?>.value<?php if ( $j > 0 ) echo " * 1 + 1"; ?>}; this.style.backgroundColor="#FC9494"' />
          </td>
          <td>
            <input name="chq_name<?php echo $j; ?>" type="text" id="chq_name<?php echo $j; ?>" size="30" maxlength="45"
			<?php echo "VALUE=\"$chqName\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; if ( this.value == "C" || this.value == "c" ) {this.value = document.form2.chq_name<?php if ($j > 0 ) echo $j - 1; else echo "0"; ?>.value }; this.style.backgroundColor="#FC9494"' />
          </td>
          <td height="20"> 
            <input name="status<?php echo $j; ?>"  style="text-align: center<?php if ( $status == 'LD' || $status == 'L') echo ';color:green;font-weight: bold'; ?>" type="text" id="status<?php echo $j; ?>" size="2" maxlength="2" 
			<?php echo "VALUE=\"$status\""; ?> 
			onChange='document.form2.update<?php echo $j; ?>.value="1";  this.style.backgroundColor="#FC9494"; this.value=this.value.toUpperCase(); if ( this.value != "R" && this.value != "D" && this.value != "B" && this.value != "H" && this.value != "S" && this.value != "LD" && this.value != "L" && this.value != "LB" && this.value != "LH" && this.value != "") { alert("Please enter R, D, S, H, B, L, LB, LD or LH"); this.value = "<?php echo "$status"; ?>" }  '/>
            
            </td>
          <td><input name="payment_method<?php echo $j; ?>" type="text" id="payment_method<?php echo $j; ?>" size="15" maxlength="45" 
		  <?php echo "VALUE=\"$paymentMethod\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; if ( this.value == "C" || this.value == "c" ) {this.value = document.form2.payment_method<?php if ($j > 0 ) echo $j - 1; else echo "0"; ?>.value }; this.style.backgroundColor="#FC9494"' /></td>
          <td height="20">
            <input name="remarks<?php echo $j; ?>" type="text" id="remarks<?php echo $j; ?>" size="25" maxlength="100" 
			<?php echo "VALUE=\"$remarks\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; if ( this.value == "C" || this.value == "c" ) {this.value = document.form2.remarks<?php if ($j > 0 ) echo $j - 1; else echo "0"; ?>.value }; this.style.backgroundColor="#FC9494"' />
          
           <input name="payment_id<?php echo $j; ?>" type="hidden" id="payment_id<?php echo $j; ?>" 
		   value="<?php echo $paymentID; ?>"/>
           <input name="usageAmt<?php echo $j; ?>" type="hidden" id="usageAmt<?php echo $j; ?>" 
		   value="<?php echo $usageAmt; ?>"/>
           <input name="userID<?php echo $j; ?>" type="hidden" id="userID<?php echo $j; ?>" 
		   value="<?php echo $userID; ?>"/>
           <input name="userName<?php echo $j; ?>" type="hidden" id="userName<?php echo $j; ?>" 
		   value="<?php echo $userName; ?>"/>
           <input name="timestamp<?php echo $j; ?>" type="hidden" id="timestamp<?php echo $j; ?>" 
		   value="<?php echo $timestamp; ?>"/>
           <input name="update<?php echo $j; ?>" type="hidden" id="update<?php echo $j; ?>" 
		   value="0"/>
          </td>
          <td height="20" align="center">
		    <?php if ( $userName == "unknown" ) echo "&nbsp;"; else echo $userName; ?>
          </td>
          <td height="20" align="center">
		    <?php echo $timestamp; ?>
          </td>
        </tr>
