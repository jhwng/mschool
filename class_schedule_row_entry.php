<tr valign="top" bgcolor=
  <?php
  if ( $rowCount == 1 ) {
    $rowCount = 0;
    echo "\"#FFFFF2\"";
  }
  else {
    $rowCount = 1;
    echo "\"#ECECFF\"";
  }
  ?>>

  <td width="70" nowrap="nowrap">
    <div align="center">
    <?php
    echo $classDate;
    if ( $cancelReason <> "" ) {
      echo "<br />" . "<span class=\"redtext\">$cancelReason</span>";
    }
    if ( $from_studentCreditID > 0 ) {
      $query = "SELECT date as fromCreditDate FROM student_credit_minutes WHERE student_credit_id = $from_studentCreditID";
      $result = mysql_query($query, $promusic) or die(mysql_error());
      $row = mysql_fetch_array($result);

      if ( is_array($row)) {
        extract($row);
        echo "<br />" . "<span class=\"style6 style8\">$fromCreditDate</span>";
      }
    }
//	  if ( $cancelReason == "W" || $cancelReason == "T" )
//	    { echo "<span class=\"style6 style8\">( $minute_balance )</span>"; }
    ?>
    </div>
  </td>
      
  <td width="55" nowrap="nowrap">
    <div align="center">
    <?php
    echo $classTime . "<br><span class=\"style6 style8\">" . $dayOfWeek[$dow] . "</span>";
    if ( $classType <> "" ) {
      echo "<br /><span class=\"redtext\">" . "$classType" . "</span>";
    }
    ?>
    </div>
  </td>
     
  <td>
    <div align="center">
    <?php echo $duration; ?>
	<?php
    if ( $cancelReason == "W" || $cancelReason == "T" ) {
      if ( $minute_balance > 0 ) {
        echo "<span class=\"redtext\"><br>( $minute_balance )</span>";
      }
    }
    else {
      echo "<span class=\"style6 style8\"><br>( $minute_balance )</span>";
    }
    ?>
    </div>
  </td>
      
  <td><?php echo "$teacherName<br><span class=\"style6 style8\">$cname</span>"; ?></td>
      
  <td nowrap="nowrap">
    <div align="center">
    <?php echo $extRate . "<br>" . number_format($extRate * $duration / 15, 2); ?>
    </div>
  </td>
      
  <td nowrap="nowrap">
    <input name="cancel_class<?php echo $j; ?>" type="checkbox" id="cancel_class<?php echo $j; ?>" value="Y"
      onChange='
        if ( (this.checked) && (document.form2.reschedule_class<?php echo $j; ?>.checked) ) {
          alert("You can only cancel OR reschedule a class, NOT doing both");
        }

        if ((this.checked) &&
            <?php echo $minute_balance; ?> < <?php echo $duration; ?> &&
            (<?php echo "\"$cancelReason\""; ?> == "W" || <?php echo "\"$cancelReason\""; ?> == "T")) {
          alert ("You cannot change a cancelled class with partial minute balance");
          this.checked=0;
        }
    ' />
        
    <select name="cancel_reason<?php echo $j; ?>" class="dropdowntext" id="cancel_reason<?php echo $j; ?>"
      onChange='
        this.style.backgroundColor="#FC9494";
        if (this.value != "" && !(document.form2.cancel_class<?php echo $j; ?>.checked)) {
          alert("Please check the Cancel Class CheckBox to confirm this cancellation");
        }
      '>
      <option value="" selected="selected"> </option>
      <option value="W">W</option>
      <option value="T">T</option>
      <option value="WO">WO</option>
      <option value="CXL">CXL</option>
      <option value="WOT">WOT</option>
    </select>
  </td>
      
  <td nowrap="nowrap">
    <input name="reschedule_class<?php echo $j; ?>" type="checkbox" id="reschedule_class<?php echo $j; ?>" value="Y"
      onChange='
        if ((this.checked) && (document.form2.cancel_class<?php echo $j; ?>.checked)) {
          alert("You can only cancel OR reschedule a class, NOT doing both");
          this.checked=0;
        }

        if ((this.checked) &&
            <?php echo $minute_balance; ?> == 0 &&
            (<?php echo "\"$cancelReason\""; ?> == "W" || <?php echo "\"$cancelReason\""; ?> == "T" )) {
          alert ("You cannot reschedule a cancelled class with 0 minute balance");
          this.checked=0;
        }
      ' />

    <input name="Rdate<?php echo $j; ?>"
      <?php echo "VALUE=\"" . $classDate . "\""; ?>
      type="text" id="Rdate<?php echo $j; ?>" size="10" maxlength="10"
      onChange='
        if (!(checkDateFormat(form, this))) {
          this.value = "<?php echo "$classDate"; ?>";
        }

        this.style.backgroundColor="#FC9494";

        if (!(document.form2.reschedule_class<?php echo $j; ?>.checked)) {
          alert ("Please check the Reschedule CheckBox to confirm rescheduling");
        }
      ' />
  </td>

  <td>
    <input name="Rtime<?php echo $j; ?>"
	  <?php echo "VALUE=\"" . $classTime . "\""; ?> type="text" id="Rtime<?php echo $j; ?>" size="6" maxlength="8"
      onChange='
        if (!(checkTimeFormat(form, this))) {
          this.value = "<?php echo "$classTime"; ?>"
        }

        this.style.backgroundColor="#FC9494";

        if (!(document.form2.reschedule_class<?php echo $j; ?>.checked)) {
          alert ("Please check the Reschedule CheckBox to confirm rescheduling");
        }
      ' />
  </td>

  <td>
    <?php
    if ( $cancelReason == "W" || $cancelReason == "T" ) {
      $dur = $minute_balance;
    }
    else {
      $dur = $duration;
    }
    ?>
    <select name="Rduration<?php echo $j; ?>" class="dropdowntext" id="Rduration<?php echo $j; ?>"
      onChange='
        this.style.backgroundColor="#FC9494";
        if (!(document.form2.reschedule_class<?php echo $j; ?>.checked)) {
          alert ("Please check the Reschedule CheckBox to confirm rescheduling");
        }

        if ((<?php echo "\"$cancelReason\""; ?> == "T" || <?php echo "\"$cancelReason\""; ?> == "W") &&
            this.value > <?php echo $minute_balance; ?> ) {
          alert("Duration cannot be longer than remaining minutes");
        }
      ' >

      <?php
      if ($cancelReason == "W" || $cancelReason == "T") {
        $endingMin = $minute_balance;
      }
      else {
        if ( $classType <> "" ) {
          $endingMin = $duration;
        }
        else {
          $endingMin = 120;
        }
      }
      $m = 15;
      while ( $m <= $endingMin ) {
        echo "<option value=\"$m\" ";
        if ( $dur == $m ) {
          echo 'selected="selected" ';
        }
        echo ">" . $m . "</option>\n";
        $m += 15;
      }
      ?>
    </select>
  </td>

  <td>
    <select name="Rteacher<?php echo $j; ?>" class="dropdowntext" id="Rteacher<?php echo $j; ?>"
      onChange="
        this.style.backgroundColor='#FC9494';
        if ( !( document.form2.reschedule_class<?php echo $j; ?>.checked)) {
          alert ('Please check the Reschedule CheckBox to confirm rescheduling');
        }
        lookupTeacherRateForClass(this.form, this.value, '<?php echo $cname; ?>', <?php echo $j; ?>);
      " >
      <?php
      do {
      ?>
        <option value="<?php echo $row_teacher['teacher']?>"
          <?php
          if ($row_teacher['teacher'] == $teacherName) {
            echo "selected=\"selected\"";
          }
          ?>>
          <?php echo $row_teacher['teacher']?>
        </option>
      <?php
      } while ($row_teacher = mysql_fetch_assoc($teacher));

      $rows = mysql_num_rows($teacher);

      if($rows > 0) {
        mysql_data_seek($teacher, 0);
	    $row_teacher = mysql_fetch_assoc($teacher);
      }
      ?>
    </select>
  </td>

  <td nowrap="nowrap">
    <input name="Rgrade<?php echo $j; ?>"
      <?php echo "VALUE=\"" . $grade . "\""; ?>
      type="text" id="Rgrade<?php echo $j; ?>" size="1" maxlength="4"
      onChange="
        // Grade
        this.style.backgroundColor='#FC9494';
        if ( !( document.form2.reschedule_class<?php echo $j; ?>.checked)) {
          alert ('Please check the Reschedule CheckBox to confirm rescheduling');
        }
      " />

    <input name="Rext_rate<?php echo $j; ?>"
      <?php echo "VALUE=\"" . $extRate . "\""; ?>
      type="text" id="Rext_rate<?php echo $j; ?>" size="4" maxlength="8"
      onChange='
        // External Rate
        this.style.backgroundColor="#FC9494";
        if (!(isPositiveNumber(this.value))) {
          alert("Please enter a positive number");
          this.value = "<?php echo "$extRate"; ?>";
        }

        //Bjng
        // User is changing external-cost, so get both the real internal-cost and cost-type values.
        var real_cost_type = document.form2.Rcost_type<?php echo $j; ?>.value;
        var cost_type_override = document.form2.Rcost_type_override<?php echo $j; ?>.value;

        if (cost_type_override == "F" || cost_type_override == "S") {
          real_cost_type = cost_type_override;
        }

        var real_internal_cost = parseFloat(document.form2.Rcost<?php echo $j; ?>.value);
        var internal_cost_override = parseFloat(document.form2.Rcost_override<?php echo $j; ?>.value);

        if (!isNaN(internal_cost_override)) {
          real_internal_cost = internal_cost_override;
        }
        //Ejng

        //if (document.form2.Rcost_type<?php echo $j; ?>.value == "F" &&
        if (real_cost_type == "F" &&
            parseFloat(document.form2.Rext_rate<?php echo $j; ?>.value) <= real_internal_cost) {
            //parseFloat(document.form2.Rext_rate<?php echo $j; ?>.value) <= parseFloat(document.form2.Rcost<?php echo $j; ?>.value)) {
          //alert ("Row Entry: For Fixed Internal Cost, it must be less than External Rate");
          alert ("Invalid \"External Rate\".\n\nPlease check with School Admin.");  //jng
        }
        if ( !( document.form2.reschedule_class<?php echo $j; ?>.checked)) {
          alert ("Please check the Reschedule CheckBox to confirm rescheduling");
        }' />
      <br />

    <input name="Rcost_override<?php echo $j; ?>" id="Rcost_override<?php echo $j; ?>"
      type="text" size="4" maxlength="8"
      <?php
      //jng
      if ($UserIsManager) {
        echo "VALUE=\"" . $internalCost . "\"";
      }
      else {
        // Can't use "disabled" attribute since it's not submitted with form
        echo "VALUE=\"-\" readonly ";
      }
      ?>

      onChange='
        // Internal Cost override
        this.style.backgroundColor="#FC9494";
        if (!(isPositiveNumber(this.value))) {
          alert("Please enter a positive number");
          this.value = "<?php echo "$internalCost"; ?>";
        }

        //Bjng
        // User is changing internal-cost-override, so get the real cost-type value.
        var real_cost_type = document.form2.Rcost_type<?php echo $j; ?>.value;
        var cost_type_override = document.form2.Rcost_type_override<?php echo $j; ?>.value;

        if (cost_type_override == "F" || cost_type_override == "S") {
          real_cost_type = cost_type_override;
        }
        //Ejng

        //if (document.form2.Rcost_type<?php echo $j; ?>.value == "F" &&
        if (real_cost_type == "F" &&
            parseFloat(document.form2.Rext_rate<?php echo $j; ?>.value) <= parseFloat(this.value)) {
          //alert ("For Fixed Internal Cost, it must be less than External Rate");
          alert ("Invalid \"Internal Rate\".\n\nPlease check with School Admin.");  //jng
        } else { // value == "S"
          if (parseFloat(this.value) >= 100) {
            alert ("Invalid \"Internal Split Rate\".\n\nPlease check with School Admin.");  //jng
          }
        }

        if ( !( document.form2.reschedule_class<?php echo $j; ?>.checked)) {
          alert ("Please check the Reschedule CheckBox to confirm rescheduling");
        }
      ' />

    <input name="Rcost_type_override<?php echo $j; ?>" id="Rcost_type_override<?php echo $j; ?>"
      type="text" size="1" maxlength="1"

      <?php
      //jng
      if ($UserIsManager) {
        echo "VALUE=\"" . $costType . "\"";
      }
      else {
        // Can't use "disabled" attribute since it's not submitted with form
        echo "VALUE=\"-\" readonly ";
      }
      ?>

      onChange='
        // Cost Type override
        this.style.backgroundColor="#FC9494";
        this.value=this.value.toUpperCase();

        //Bjng
        // User is changing cost-type-override, so get the real internal-cost value.
        var real_internal_cost = parseFloat(document.form2.Rcost<?php echo $j; ?>.value);
        var internal_cost_override = parseFloat(document.form2.Rcost_override<?php echo $j; ?>.value);

        if (!isNaN(internal_cost_override)) {
          real_internal_cost = internal_cost_override;
        }
        //Ejng

        if ( this.value != "S" && this.value != "F" ) {
          alert("XPlease enter S or F");
          this.value = "<?php echo "$costType"; ?>";
        }
        if ( this.value == "F" &&
             parseFloat(document.form2.Rext_rate<?php echo $j; ?>.value) <= real_internal_cost ) {
             //parseFloat(document.form2.Rext_rate<?php echo $j; ?>.value) <= parseFloat(document.form2.Rcost<?php echo $j; ?>.value) ) {
          //alert ("For Fixed Internal Cost, it must be less than External Rate");
          alert ("Invalid \"External Rate\".\n\nPlease check with School Admin.");  //jng
        } else { // value == "S"
          if (real_internal_cost >= 100) {
            alert ("Invalid \"Internal Split Rate\".\n\nPlease check with School Admin.");  //jng
          }
        }

        if ( !( document.form2.reschedule_class<?php echo $j; ?>.checked)) {
          alert ("Please check the Reschedule CheckBox to confirm rescheduling");
        }
      ' />

      <br>

    <input type="text" readonly style="background-color: red; color: white"
      name="Rcost<?php echo $j; ?>" id="Rcost<?php echo $j; ?>" size="4" maxlength="8"
      <?php
      echo "VALUE=\"" . $internalCost . "\"";
      ?>
    />

    <input type="text" readonly style="background-color: red; color: white"
      name="Rcost_type<?php echo $j; ?>" id="Rcost_type<?php echo $j; ?>" size="1" maxlength="1"
      <?php
      echo "VALUE=\"" . $costType . "\"";
      ?>
    />
  </td>

  <td>
    <input name="Rremarks<?php echo $j; ?>" <?php echo "VALUE=\"" . $remarks . "\""; ?>
      onChange='
        // Remarks
        this.style.backgroundColor="#FC9494";
        if ( !( document.form2.reschedule_class<?php echo $j; ?>.checked) &&
             !( document.form2.cancel_class<?php echo $j; ?>.checked)) {
          alert ("You need to either check the Cancel Class or Reschedule Class Check Box");
        }
        if ( this.value == "del" && ( <?php echo "\"$cancelReason\""; ?> != "" ||
             <?php echo "\"$classType\""; ?> != "" )) {
          alert ("Cannot delete a cancelled or makeup class");
          document.form2.reschedule_class<?php echo $j; ?>.checked = 0;
        }
      '
      type="text" id="Rremarks<?php echo $j; ?>" size="30" maxlength="100"
    />
    <?php echo "$userName | $timestamp"; ?>
  </td>
</tr>
