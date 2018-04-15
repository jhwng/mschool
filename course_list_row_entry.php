    <tr height="25" valign="middle">
		  <td><div align="center">
            <input name="current<?php echo $j; ?>" type="checkbox" id="current<?php echo $j; ?>" value="Y" 
            <?php if ( $current == "Y" ) { echo "checked=\"checked\""; } ?> />
  </div></td>
              <td height="20">
            <div align="center">
              <input name="course_name<?php echo $j; ?>" type="text" id="course_name<?php echo $j; ?>" size="45" maxlength="45"
			<?php echo "VALUE=\"$courseName\""; ?> 
			onChange='this.style.backgroundColor="#FC9494"' >
	          <input name="course_id<?php echo $j; ?>" type="hidden" id="course_id<?php echo $j; ?>" 
		   value="<?php echo $courseID; ?>"/>
            </div></td>
          </tr>
