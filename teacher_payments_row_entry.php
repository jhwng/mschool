        <tr>
          <td align="center">
            <input name="delete<?php echo $j; ?>" type="checkbox" id="delete<?php echo $j; ?>" value="delete" 
            <?php if ( $delete == "delete" ) { echo "checked=\"checked\""; } ?> />
		  </div></td>
          <td height="20">
 <select name="teacher<?php echo $j; ?>" class="dropdowntext" id="teacher<?php echo $j; ?>"  onChange="document.form2.changed<?php echo $j; ?>.checked=1" >
        <?php
           if ( $teacherName <> "" ) {
		     echo "<option value=\"$teacherName\" selected=\"selected\">$teacherName</option>";
		   }
		   else {
do {  
?>
        <option value="<?php echo $row_teacher['teacher']?>"<?php if ($row_teacher['teacher'] == $teacherName) {echo "selected=\"selected\"";} ?>><?php echo $row_teacher['teacher']?></option>
        <?php
} while ($row_teacher = mysql_fetch_assoc($teacher));
  $rows = mysql_num_rows($teacher);
  if($rows > 0) {
      mysql_data_seek($teacher, 0);
	  $row_teacher = mysql_fetch_assoc($teacher);
  }
  		   }
		   
?>
      </select></td>
          <td height="22"><div align="center">
            <input name="date<?php echo $j; ?>" 
			onchange='this.style.backgroundColor="#FC9494"; if (!(checkDateFormat(form, this))) {this.value = "<?php echo "$date"; ?>" } else {document.form2.changed<?php echo $j; ?>.checked=1}'
			type="text" id="date<?php echo $j; ?>" size="10" maxlength="10" 
			<?php echo "VALUE=\"$date\""; ?> />
          </div></td>
          <td height="20"><div align="center">
            <input name="amount<?php echo $j; ?>" style="text-align: right" type="text" id="amount<?php echo $j; ?>" size="8" maxlength="10"
			<?php echo "VALUE=\"$amount\""; ?> 
			onChange='this.style.backgroundColor="#FC9494"; if ( isNaN(this.value) ) {alert("Please enter a number"); this.value = "<?php echo "$amount"; ?>" } else {document.form2.changed<?php echo $j; ?>.checked=1}' >
          </div></td>
          <td><div align="center">
            <input name="chq_num<?php echo $j; ?>" type="text" id="chq_num<?php echo $j; ?>" size="5" maxlength="8"
			<?php echo "VALUE=\"$chqNum\""; ?> onChange='this.style.backgroundColor="#FC9494"; document.form2.changed<?php echo $j; ?>.checked=1' >
          </div></td>
          <td><div align="center">
		  <input name="payment_method<?php echo $j; ?>" type="text" id="payment_method<?php echo $j; ?>" size="15" maxlength="45" 
		  <?php echo "VALUE=\"$paymentMethod\""; ?> onChange='this.style.backgroundColor="#FC9494"; document.form2.changed<?php echo $j; ?>.checked=1' >          </div></td>
          <td height="20"><div align="center">
            <input name="remarks<?php echo $j; ?>" type="text" id="remarks<?php echo $j; ?>" size="50" maxlength="100" 
			<?php echo "VALUE=\"$remarks\""; ?> onchange='this.style.backgroundColor="#FC9494"; document.form2.changed<?php echo $j; ?>.checked=1' />
            <input name="payment_id<?php echo $j; ?>" type="hidden" id="payment_id<?php echo $j; ?>" 
		   value="<?php echo $paymentID; ?>"/>
            <input name="teacher_id<?php echo $j; ?>" type="hidden" id="teacher_id<?php echo $j; ?>"		   value="<?php echo $teacherID; ?>"/>
          </div></td>
          <td align="center">
            <input name="changed<?php echo $j; ?>" type="checkbox" id="changed<?php echo $j; ?>" value="changed" 
            <?php if ( $changed == "changed" ) { echo "checked=\"checked\""; } ?> />
		  </div></td>
        </tr>
