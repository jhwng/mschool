    <tr height="28" valign="middle" bgcolor=
   <?php if ( $rowCount == 1 ) { $rowCount = 0; echo "\"#FFFFF2\"";}
   else { $rowCount = 1; echo "\"#ECECFF\""; } ?> >
      <td><div align="left"><?php echo $sname; ?> </div>
	  <input name="sname<?php echo $j; ?>" type=hidden id="sname<?php echo $j; ?>" value="<?php echo $sname; ?>" />
</td>
       <td><div align="left"><?php echo $course; ?>&nbsp;</div>	  
	   <input name="course<?php echo $j; ?>" type=hidden id="course<?php echo $j; ?>" value="<?php echo $course; ?>" />
</td>
       <td><div align="left"><?php echo $chqDate; ?>&nbsp;</div>	  
	   <input name="chqDate<?php echo $j; ?>" type=hidden id="chqDate<?php echo $j; ?>" value="<?php echo $chqDate; ?>" />
</td>
       <td><div align="left"><?php echo $chqNum; ?>&nbsp;</div>	  
	   <input name="chqNum<?php echo $j; ?>" type=hidden id="chqNum<?php echo $j; ?>" value="<?php echo $chqNum; ?>" />
</td>
       <td><div align="right"><?php echo $amount; ?>&nbsp;</div>
	   <input name="amount<?php echo $j; ?>" type=hidden id="amount<?php echo $j; ?>" value="<?php echo $amount; ?>" />
	   <input name="payment_id<?php echo $j; ?>" type="hidden" id="payment_id<?php echo $j; ?>" value="<?php echo $paymentID; ?>"/>
	   </td>
		  <td><div align="center">
            <input name="deposit<?php echo $j; ?>" type="checkbox" id="deposit<?php echo $j; ?>" value="yes" <?php if ( $deposit == "yes" ) { echo "checked=\"checked\""; } ?> />
		  </div></td>
       <td><div align="left"><?php echo $chqName; ?>&nbsp;</div>	  
	   <input name="chqName<?php echo $j; ?>" type=hidden id="chqName<?php echo $j; ?>" value="<?php echo $chqName; ?>" />
	   <input name="status<?php echo $j; ?>" type=hidden id="stats<?php echo $j; ?>" value="<?php echo $status; ?>" />
</td>
    </tr>
