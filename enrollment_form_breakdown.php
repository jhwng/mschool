<?php if ( $sectionCnt == 3 || $sectionCnt == 5 || $sectionCnt == 7 || $sectionCnt == 9 || $sectionCnt == 11 ) { echo '<div style="page-break-after:always">&nbsp;</div>'; }?>
<form id="form1" name="form1" method="post" action="" >
  <table width="759" border="1" cellspacing="0" cellpadding="1" >
    <!--DWLayoutTable-->
    <tr>
      <td height="20" colspan="2" valign="middle" bordercolor="#FFFFFF"><div align="right" class="style3 style8">
        <div align="center" class="style7">
          <div align="left">Tuition Fee Breakdown </div>
        </div>
      </div></td>
      <td width="4" bordercolor="#FFFFFF">&nbsp;</td>
      <td width="68" valign="middle"><div align="center">Date</div></td>
      <td width="68" valign="middle"><div align="center"># Classes </div></td>
      <td width="68" valign="middle"><div align="center"> Fees</div></td>
      <td width="68" valign="middle"><div align="center">Amount<br />
        Received</div></td>
      <td width="68" valign="middle"><div align="center">Payment<br /> 
      Method </div></td>
      <td width="68" valign="middle"><div align="center">Monthly<br />
      Outstanding </div></td>
    </tr>
    <tr>
      <td width="103" height="20" valign="middle" bordercolor="#FFFFFF"><div align="left">Student Name: &nbsp;</div></td>
      <td width="150" valign="middle" bordercolor="#FFFFFF"><?php echo $fullName; ?></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Jul 1, <?php echo $fromYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[1]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[1],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[1],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[1]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[1],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF"><div align="left">Course: &nbsp;</div></td>
      <td valign="middle" bordercolor="#FFFFFF"><?php echo $courseName; ?></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Aug 1, <?php echo $fromYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[2]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[2],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[2],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[2]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[2]-$balance[1],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF"><div align="left">Teacher: &nbsp;</div></td>
      <td valign="middle" bordercolor="#FFFFFF"><?php echo $teacher; ?></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Sep 1, <?php echo $fromYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[3]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[3],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[3],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[3]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[3]-$balance[2],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF"><div align="left">Fee per lesson: &nbsp;</div></td>
      <td valign="middle" bordercolor="#FFFFFF"><?php echo number_format($fee, 2); ?></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Oct 1, <?php echo $fromYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[4]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[4],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[4],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[4]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[4]-$balance[3],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" colspan="2" valign="middle" bordercolor="#FFFFFF"><div align="left"><span class="style12">Scheduled Time </span></div></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Nov 1, <?php echo $fromYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[5]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[5],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[5],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[5]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[5]-$balance[4],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF">July to Aug:</td>
      <td valign="middle" bordercolor="#FFFFFF"><input name="jul_aug" type="text" id="jul_aug" value="<?php echo $dayOfWeek[$dow] . " - " . $time . " (" . $duration . "mins)"; ?>" size="35" maxlength="60" /></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Dec 1, <?php echo $fromYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[6]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[6],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[6],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[6]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[6]-$balance[5],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF">Sept to June:</td>
      <td valign="middle" bordercolor="#FFFFFF"><input name="sep_jun" type="text" id="sep_jun" value="<?php echo $dayOfWeek[$dow] . " - " . $time . " (" . $duration . "mins)"; ?>" size="35" maxlength="60" /></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Jan 1, <?php echo $toYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[7]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[7],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[7],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[7]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[7]-$balance[6],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF">Start Date: </td>
      <td valign="middle" bordercolor="#FFFFFF"><input name="date1" type="text" id="date1" value="<?php echo $date1; ?>" size="35" maxlength="60" /></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Feb 1, <?php echo $toYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[8]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[8],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[8],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[8]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[8]-$balance[7],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF">End Date: </td>
      <td valign="middle" bordercolor="#FFFFFF"><input name="date2" type="text" id="date2" value="<?php echo $date2; ?>" size="35" maxlength="60" /></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Mar 1, <?php echo $toYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[9]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[9],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[9],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[9]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[9]-$balance[8],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF">Remarks:</td>
      <td valign="middle" bordercolor="#FFFFFF"><input name="textfield" type="text" size="35" maxlength="60" /></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Apr 1, <?php echo $toYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[10]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[10],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[10],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[10]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[10]-$balance[9],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle" bordercolor="#FFFFFF"><input name="textfield2" type="text" size="35" maxlength="60" /></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">May 1, <?php echo $toYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[11]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[11],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[11],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[11]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[11]-$balance[10],2); ?>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" valign="middle" bordercolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="middle" bordercolor="#FFFFFF"><input name="textfield3" type="text" size="35" maxlength="60" /></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
      <td valign="middle">Jun 1, <?php echo $toYear; ?></td>
      <td valign="middle" align="center"><?php echo $lessons[12]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($usage[12],2); ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($amtReceived[12],2); ?>&nbsp;</td>
      <td valign="middle" align="center"><?php echo $paymentMethod[12]; ?>&nbsp;</td>
      <td valign="middle" align="right"><?php echo number_format($balance[12]-$balance[11],2); ?>&nbsp;</td>
    </tr>
  </table>
</form>
