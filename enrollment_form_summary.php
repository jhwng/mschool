<?php if ( $sectionCnt == 3 || $sectionCnt == 5 || $sectionCnt == 7 || $sectionCnt == 9 || $sectionCnt == 11 ) { echo '<div style="page-break-after:always">&nbsp;</div>'; }?>
<p>&nbsp;   </p>
<table width="650" border="0" cellspacing="0" cellpadding="1" >
<tr><td width="100">&nbsp;</td>
 <td>
 <table width="500" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td height="27" colspan="5" class="style3 style7"><div align="center">Payment Summary </div></td>
    </tr>
  <tr>
    <td width="20%"><div align="center">Date</div></td>
    <td width="20%"><div align="center">Total Fees </div></td>
    <td width="20%"><div align="center">Amout Received </div></td>
    <td width="20%"><div align="center">Monthly<br />
      Outstanding </div></td>
    <td width="20%"><div align="center">YTD<br />
      Outstanding </div></td>
  </tr>
  <tr>
    <td height="20"><div align="center">Jul 1, <?php echo $fromYear; ?></div></td>
    <td><div align="right"><?php echo number_format($ttlFee[1],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[1],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[1],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[1],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Aug 1, <?php echo $fromYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[2],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[2],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[2]-$ttlBalance[1],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[2],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Sep 1, <?php echo $fromYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[3],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[3],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[3]-$ttlBalance[2],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[3],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Oct 1, <?php echo $fromYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[4],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[4],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[4]-$ttlBalance[3],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[4],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Nov 1, <?php echo $fromYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[5],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[5],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[5]-$ttlBalance[4],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[5],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Dec 1, <?php echo $fromYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[6],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[6],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[6]-$ttlBalance[5],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[6],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Jan 1, <?php echo $toYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[7],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[7],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[7]-$ttlBalance[6],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[7],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Feb 1, <?php echo $toYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[8],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[8],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[8]-$ttlBalance[7],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[8],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Mar 1, <?php echo $toYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[9],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[9],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[9]-$ttlBalance[8],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[9],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Apr 1, <?php echo $toYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[10],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[10],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[10]-$ttlBalance[9],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[10],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">May 1, <?php echo $toYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[11],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[11],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[11]-$ttlBalance[10],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[11],2); ?></div></td>
  </tr>
  <tr>
    <td height="20" align="center">Jun 1, <?php echo $toYear; ?> </td>
    <td><div align="right"><?php echo number_format($ttlFee[12],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlReceived[12],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[12]-$ttlBalance[11],2); ?></div></td>
    <td><div align="right"><?php echo number_format($ttlBalance[12],2); ?></div></td>
  </tr>
</table>
</td>
</tr>
</table>
