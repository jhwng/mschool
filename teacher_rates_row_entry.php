    <tr height="25" valign="middle">
		  <td><div align="center">
            <input name="delete<?php echo $j; ?>" type="checkbox" id="delete<?php echo $j; ?>" value="delete" 
            <?php if ( $delete == "delete" ) { echo "checked=\"checked\""; } ?> />
		  </div></td>
      <td valign="middle"><div align="center">
        <select name="course_name<?php echo $j; ?>" class="dropdowntext" id="course_name<?php echo $j; ?>">
          <option value="None" > </option>
          <?php
do {  
?>
          <option value="<?php echo $row_course_names['course_name']?>" <?php if ( $action <> "" && 
$row_course_names['course_name'] == $course_name ) {echo "selected=\"selected\""; } ?> ><?php echo $row_course_names['course_name']?></option>
          <?php
} while ($row_course_names = mysql_fetch_assoc($course_names));
  $rows = mysql_num_rows($course_names);
  if($rows > 0) {
      mysql_data_seek($course_names, 0);
	  $row_course_names = mysql_fetch_assoc($course_names);
  }
?>
        </select>
      </div></td>
          <td height="20">
            <div align="center">
              <input name="rate_category<?php echo $j; ?>" type="text" id="rate_category<?php echo $j; ?>" size="10" maxlength="20"
			<?php echo "VALUE=\"$rate_category\""; ?> 
			onChange='this.style.backgroundColor="#FC9494"' >
            </div></td>
          <td>
	        <div align="center">
	          <input name="ext_rate<?php echo $j; ?>" <?php echo "VALUE=\"" .  number_format($external_rate,2) . "\""; ?> 
                type="text" id="ext_rate<?php echo $j; ?>" size="8" maxlength="8"
                  onChange='this.style.backgroundColor="#FC9494";
                  if (!(isPositiveNumber(this.value))) {
                    alert("Please enter a positive number");
                    this.value = "<?php echo "$external_rate"; ?>";
                  }
                  if ( document.form2.cost_type<?php echo $j; ?>.value == "F" &&
                       parseFloat(document.form2.ext_rate<?php echo $j; ?>.value) <= parseFloat(document.form2.cost<?php echo $j; ?>.value) ) {
                    //alert ("For Fixed Internal Cost, it must be less than External Rate");
                    alert ("Invalid \"External Rate\".\n\nPlease check with School Admin."); //jng
                  }' />
	          
	          <input name="teacher_rate_id<?php echo $j; ?>" type="hidden" id="teacher_rate_id<?php echo $j; ?>" 
		   value="<?php echo $teacher_rate_id; ?>"/>
            </div></td>
          <td height="20">
	        <div align="center">
	          <input name="cost<?php echo $j; ?>" <?php echo "VALUE=\"" . number_format($internal_cost,2) . "\""; ?> 
                type="text" id="cost<?php echo $j; ?>" size="8" maxlength="8"
                onChange='
                  this.style.backgroundColor="#FC9494";
                  if (!(isPositiveNumber(this.value))) {
                    alert("Please enter a positive number");
                    this.value = "<?php echo "$internal_cost"; ?>";
                  }
                  if ( document.form2.cost_type<?php echo $j; ?>.value == "F" &&
                       parseFloat(document.form2.ext_rate<?php echo $j; ?>.value) <= parseFloat(this.value) ) {
                    //alert ("For fixed Internal Cost, it must be less than External Rate");
                    alert ("Invalid \"External Rate\".\n\nPlease check with School Admin.");  //jng
                  }' />
            </div></td>
          <td height="20">
	        <div align="center">
	          <input name="cost_type<?php echo $j; ?>" <?php echo "VALUE=\"" . $cost_type . "\""; ?> 
                type="text" id="cost_type<?php echo $j; ?>" size="4" maxlength="4"
                onChange='
                  this.style.backgroundColor="#FC9494";
                  this.value=this.value.toUpperCase();
                  if ( this.value != "S" && this.value != "F" ) {
                    alert("Please enter S or F");
                    this.value = "<?php echo "$cost_type"; ?>";
                  }
                  if ( this.value == "F" &&
                       parseFloat(document.form2.ext_rate<?php echo $j; ?>.value) <= parseFloat(document.form2.cost<?php echo $j; ?>.value) ) {
                    this.value = "<?php echo "$cost_type"; ?>";
                    //alert ("For Fixed Internal Cost, it must be less than External Rate");
                    alert ("Invalid \"External Rate\".\n\nPlease check with School Admin.");  //jng
                  }' />
            </div></td>
          <td height="20">
            <div align="center">
              <input name="grades_applied<?php echo $j; ?>" type="text" id="grades_applied<?php echo $j; ?>" size="20" maxlength="40"
			<?php echo "VALUE=\"$grades_applied\""; ?> 
			onChange='this.style.backgroundColor="#FC9494"' >
            </div></td>
          <td height="20">
            <div align="center">
              <input name="start_date<?php echo $j; ?>" type="text" id="start_date<?php echo $j; ?>" size="10" maxlength="12"
			<?php echo "VALUE=\"$start_date\""; ?> 
			onChange='this.style.backgroundColor="#FC9494"; checkDateFormat(form, this)' >
            </div></td>
          <td height="20">
            <div align="center">
              <input name="end_date<?php echo $j; ?>" type="text" id="end_date<?php echo $j; ?>" size="10" maxlength="12"
			<?php echo "VALUE=\"$end_date\""; ?> 
			onChange='this.style.backgroundColor="#FC9494"; checkDateFormat(form, this)' >
            </div></td>
    </tr>
