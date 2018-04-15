        <tr>
          <td><div align="center">
            <input name="delete<?php echo $j; ?>" onChange='document.form2.update<?php echo $j; ?>.value="1"' type="checkbox" id="delete<?php echo $j; ?>" value="delete" 
            <?php if ( $delete == "delete" ) { echo "checked=\"checked\""; } ?> />
		  </div></td>
          <td height="22"><div align="center">
            <input name="date<?php echo $j; ?>" style="text-align: center" 
			onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"; if (!(checkDateFormat(form, this))) {this.value = "<?php echo "$date"; ?>" }'
			type="text" id="date<?php echo $j; ?>" size="10" maxlength="10" 
			<?php echo "VALUE=\"$date\""; ?>  >
          </div></td>
          <td height="20"><div align="center">
            <input name="amount<?php echo $j; ?>" style="text-align: right" type="text" id="amount<?php echo $j; ?>" size="6" maxlength="6"
			<?php echo "VALUE=\"$amount\""; ?> 
			onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"; if ( isNaN(this.value) ) {alert("Please enter a number"); this.value = "<?php echo "$amount"; ?>" }; if ( document.form2.date<?php echo $j; ?>.value == "" ) alert ("Enter a Cheque Date in order to add a record"); ' >
          </div></td>
          <td><div align="center">
            <input name="remarks<?php echo $j; ?>" type="text" id="remarks<?php echo $j; ?>" size="45" maxlength="100" 
			<?php echo "VALUE=\"$remarks\""; ?> onChange='document.form2.update<?php echo $j; ?>.value="1"; this.style.backgroundColor="#FC9494"' >
          
           <input name="misc_item_id<?php echo $j; ?>" type="hidden" id="misc_item_id<?php echo $j; ?>"  value="<?php echo $miscItemID; ?>"/>
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
