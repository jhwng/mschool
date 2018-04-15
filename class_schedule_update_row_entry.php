
<tr valign="top" bgcolor=
   <?php if ( $rowCount == 1 ) { $rowCount = 0; echo "\"#FFFFF2\"";}
   else { $rowCount = 1; echo "\"#ECECFF\""; } ?>>
      <td width="70" nowrap="nowrap"><div align="center">
	  <?php 
	  echo $classDate; 
	  if ( $cancelReason <> "" ) 
	    { echo "<br />" . "<span class=\"style6 style8\">$cancelReason</span>"; }
//	  if ( $cancelReason == "W" || $cancelReason == "T" )
//	    { echo "<span class=\"style6 style8\">( $minute_balance )</span>"; }
	  ?>
	  </div></td>
      
	  <td width="55" nowrap="nowrap"><div align="center"><?php echo $classTime; if ( $classType <> "" ) echo "<br />" . "<span class=\"style6 style8\">$classType</span>";
?></div></td>
     
	  <td><div align="center"><?php echo $duration; ?>
	  <?php if ( $cancelReason == "W" || $cancelReason == "T" )
	    { echo "<span class=\"style6 style8\"><br>( $minute_balance )</span>"; } ?>
	  </div></td>
      
	  <td nowrap="nowrap"><?php echo "$teacherName<br><span class=\"style6 style8\">$cname</span>"; ?></td>
      
	  <td nowrap="nowrap"><div align="center"><?php echo $extRate . "<br>" . number_format($extRate * $duration / 15, 2); ?></div></td> 
      
	  <td nowrap="nowrap"><input name="cancel_class<?php echo $j; ?>" type="checkbox" id="cancel_class<?php echo $j; ?>" value="Y" <?php if ( $cancelClass == "Y" ) { echo "checked"; } ?>
	      onChange='if ( (this.checked) && (document.form2.reschedule_class<?php echo $j; ?>.checked) ) {alert("You can only cancel OR reschedule a class, NOT doing both")}; if (( this.checked ) && <?php echo $minute_balance; ?> < <?php echo $duration; ?>  && ( <?php echo "\"$cancelReason\""; ?> == "W"  ||  <?php echo "\"$cancelReason\""; ?> == "T" )) { alert ("You cannot change a cancelled class with partial minute balance"); this.checked=0}' />
        
		<select name="cancel_reason<?php echo $j; ?>" class="dropdowntext" id="cancel_reason<?php echo $j; ?>" onChange='this.style.backgroundColor="#FC9494"; if ( this.value != "" && !(document.form2.cancel_class<?php echo $j; ?>.checked) ) { alert("Please check the Cancel Class CheckBox to confirm this cancellation")}'>
        <option value="" selected="selected"> </option>
        <option value="W" <?php if ( $RcancelReason == "W" ) echo 'selected="selected"'; ?> >W</option>
        <option value="T" <?php if ( $RcancelReason == "T" ) echo 'selected="selected"'; ?> >T</option>
        <option value="WO" <?php if ( $RcancelReason == "WO" ) echo 'selected="selected"'; ?> >WO</option>
        <option value="CXL" <?php if ( $RcancelReason == "CXL" ) echo 'selected="selected"'; ?> >CXL</option>
        <option value="WOT" <?php if ( $RcancelReason == "WOT" ) echo 'selected="selected"'; ?> >WOT</option>
        <option value="DEL" <?php if ( $RcancelReason == "DEL" ) echo 'selected="selected"'; ?> >DEL</option>
        </select></td>
      
	  <td nowrap="nowrap"><input name="reschedule_class<?php echo $j; ?>" type="checkbox" id="reschedule_class<?php echo $j; ?>" value="Y" 
	      <?php if ( $rescheduleClass == "Y" ) { echo "checked"; } ?>
	      onChange='if ( (this.checked) && (document.form2.cancel_class<?php echo $j; ?>.checked) ) {alert("You can only cancel OR reschedule a class, NOT doing both")}; if ( (this.checked) && <?php echo "\"$cancelReason\""; ?> != "" ) { alert ("Cannot reschedule a cancelled class"); this.checked=0}' />
      <input name="Rdate<?php echo $j; ?>" 
	  <?php echo "VALUE=\"" . $Rdate . "\""; ?> type="text" id="Rdate<?php echo $j; ?>" size="10" maxlength="10" onChange='checkDateFormat(form, this); this.style.backgroundColor="#FC9494"; if ( !( document.form2.rescheduleClass<?php echo $j; ?>.checked)) { alert ("Please check the Reschedule CheckBox to confirm rescheduling")}'
	   /></td>
     
	 <td><input name="Rtime<?php echo $j; ?>" 
	  <?php echo "VALUE=\"" . $Rtime . "\""; ?> type="text" id="Rtime<?php echo $j; ?>" size="6" maxlength="8" onChange='checkTimeFormat(form, this); this.style.backgroundColor="#FC9494"; if ( !( document.form2.reschedule_class<?php echo $j; ?>.checked)) { alert ("Please check the Reschedule CheckBox to confirm rescheduling")}' /></td>
      
	  <td><select name="Rduration<?php echo $j; ?>" class="dropdowntext" id="Rduration<?php echo $j; ?>" onChange='this.style.backgroundColor="#FC9494"; if ( !( document.form2.rescheduleClass<?php echo $j; ?>.checked)) { alert ("Please check the Reschedule CheckBox to confirm rescheduling")}' >
        <option value="15" <?php if ( $Rduration == "15" ) echo 'selected="selected"'; ?>>15</option>
        <option value="30" <?php if ( $Rduration == "30" ) echo 'selected="selected"'; ?>>30</option>
        <option value="45" <?php if ( $Rduration == "45" ) echo 'selected="selected"'; ?>>45</option>
        <option value="60" <?php if ( $Rduration == "60" ) echo 'selected="selected"'; ?>>1 Hr</option>
        <option value="75" <?php if ( $Rduration == "75" ) echo 'selected="selected"'; ?>>1 Hr 15 Min</option>
        <option value="90" <?php if ( $Rduration == "90" ) echo 'selected="selected"'; ?>>1.5 Hr</option>
        <option value="105" <?php if ( $Rduration == "105" ) echo 'selected="selected"'; ?>>1 Hr 45 Min</option>
        <option value="120" <?php if ( $Rduration == "120" ) echo 'selected="selected"'; ?>>2 Hr</option>
      </select></td>
      
	  <td><select name="Rteacher<?php echo $j; ?>" class="dropdowntext" id="Rteacher<?php echo $j; ?>" onChange="this.style.backgroundColor='#FC9494'; lookupTeacherRateForClass(this.form, this.value, '<?php echo $cname; ?>', <?php echo $j; ?>)" >
        <?php
do {  
?>
        <option value="<?php echo $row_teacher['teacher']?>"<?php if ($row_teacher['teacher'] == $Rteacher) {echo "selected=\"selected\"";} ?>><?php echo $row_teacher['teacher']?></option>
        <?php
} while ($row_teacher = mysql_fetch_assoc($teacher));
  $rows = mysql_num_rows($teacher);
  if($rows > 0) {
      mysql_data_seek($teacher, 0);
	  $row_teacher = mysql_fetch_assoc($teacher);
  }
?>
      </select></td>
      
	  <td nowrap="nowrap">
	  <input name="Rgrade><?php echo $j; ?>" <?php echo "VALUE=\"" . $Rgrade . "\""; ?>
	  type="text" id="Rgrade<?php echo $j; ?>" size="1" maxlength="4" onChange="this.style.backgroundColor='#FC9494'; if ( !( document.form2.reschedule_class<?php echo $j; ?>.checked)) { alert ('Please check the Reschedule CheckBox to confirm rescheduling')}" />
	  <input name="Rext_rate<?php echo $j; ?>" <?php echo "VALUE=\"" . number_format($RextRate, 2) . "\""; ?> 
	  type="text" id="Rext_rate<?php echo $j; ?>" size="4" maxlength="8" onChange="this.style.backgroundColor='#FC9494'; if (!(isPositiveNumber(this.value))) { alert('Please enter a number')}; if (!(isPositiveNumber(this.value))) { alert('Please enter a number')};  if ( document.form2.Rcost_type<?php echo $j; ?>.value == 'F' && parseFloat(document.form2.Rext_rate<?php echo $j; ?>.value) <= parseFloat(this.value) ) { alert ('For fixed Internal Cost, it must be less than External Rate')}" /><br />
      
	  <input name="Rcost<?php echo $j; ?>" <?php echo "VALUE=\"" . number_format($Rcost, 2) . "\""; ?> 
	  type="text" id="Rcost<?php echo $j; ?>" size="4" maxlength="8" onChange="this.style.backgroundColor='#FC9494'; if (!(isPositiveNumber(this.value))) { alert('Please enter a number')};  if ( document.form2.Rcost_type<?php echo $j; ?>.value == 'F' && parseFloat(document.form2.Rext_rate<?php echo $j; ?>.value) <= parseFloat(this.value) ) { alert ('For fixed Internal Cost, it must be less than External Rate')}" />
      
	  <input name="Rcost_type<?php echo $j; ?>" <?php echo "VALUE=\"" . $RcostType . "\""; ?> 
	  type="text" id="Rcost_type<?php echo $j; ?>" size="1" maxlength="1" onChange="this.style.backgroundColor='#FC9494'; this.value=this.value.toUpperCase(); if ( this.value != 'S' && this.value != 'F' ) { alert('Please enter S or F')}; if ( this.value == 'F' && parseFloat(document.form2.Rext_rate<?php echo $j; ?>.value) <= parseFloat(document.form2.Rcost<?php echo $j; ?>.value) ) { alert ('For Fixed Internal Cost, it must be less than External Rate')}" /></td>
      
	  <td><input name="Rremarks<?php echo $j; ?>" <?php echo "VALUE=\"" . $Rremarks . "\""; ?> 
	  type="text" id="Rremarks<?php echo $j; ?>" size="20" maxlength="100" onChange="this.style.backgroundColor='#FC9494';" /></td>
    </tr>
