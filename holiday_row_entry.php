    <tr height="25" valign="middle">
		  <td><div align="center">
            <input name="delete<?php echo $j; ?>" type="checkbox" id="delete<?php echo $j; ?>" value="Y" 
            <?php if ( $delete == "Y" ) { echo "checked=\"checked\""; } ?> />
  </div></td>
              <td height="20">
            <div align="center">
                <input name="date<?php echo $j; ?>" type="text" id="date<?php echo $j; ?>" size="10" maxlength="14" 
		  <?php if ($date <> "") echo "VALUE=\"" . $date . "\""; ?> 
		  onChange='checkDateFormat(form, this); this.style.backgroundColor="#FC9494"; document.form2.changed<?php echo $j; ?>.value="1"' />
            </div></td>
              <td height="20">
            <div align="center">
              <input name="desc<?php echo $j; ?>" type="text" id="desc<?php echo $j; ?>" size="45" maxlength="100"
			<?php echo "VALUE=\"$desc\""; ?> 
			onChange='this.style.backgroundColor="#FC9494"; document.form2.changed<?php echo $j; ?>.value="1"' >
            </div>            
			<input name="holiday_id<?php echo $j; ?>" type="hidden" id="holiday_id<?php echo $j; ?>" 
		   value="<?php echo $holiday_id; ?>"/>
			<input name="changed<?php echo $j; ?>" type="hidden" id="changed<?php echo $j; ?>" 
		   value="<?php echo $changed; ?>"/>
</td>
          </tr>
