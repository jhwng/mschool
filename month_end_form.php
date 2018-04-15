<link href="main.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <table width="1000" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#FFBA75">
      <td width="55">Month</td>
      <td width="55">No. Class</td>
      <td width="55">Total Mins </td>
      <td width="55">Ext Mins</td>
      <td width="55">Net Fee </td>
      <td width="55">PD Chq </td>
      <td width="55">Wmins this mth </td>
      <td width="55">Wamt this mth </td>
      <td width="55">Cur Yr Wmins </td>
      <td width="55">Cur Yr Wamt </td>
      <td width="55">Wmins used </td>
      <td width="55">Cur Yr Tmins </td>
      <td width="55">Cur Yr Tamt </td>
      <td width="55">Tmins used </td>
      <td width="55">Cash</td>
      <td width="55">Cash used </td>
      <td width="55">Misc items </td>
      <td width="55"><p>Bal</p>
      </td>
    </tr>
      <tr <tr valign="top" bgcolor=
        <?php if ( $rowCount == 1 ) { $rowCount = 0; echo "\"#ECECFF\"";}
              else { $rowCount = 1; echo "\"#FFFFF2\""; } ?>>
      <td><?php echo $month; ?></td>
      <td><?php echo $number_of_lessons; ?></td>
      <td><?php echo $total_mins; ?></td>
      <td><?php echo $extra_mins; ?></td>
      <td><?php echo $net_fee; ?></td>
      <td><?php echo $PD_cheque; ?></td>
      <td><?php echo $wmins_this_month; ?></td>
      <td><?php echo $tmins_this_month; ?></td>
      <td><?php echo $cur_year_wmins; ?></td>
      <td><?php echo $cur_year_wamt; ?></td>
      <td><?php echo $wmins_used_this_month; ?></td>
      <td><?php echo $cur_year_tmins; ?></td>
      <td><?php echo $cur_year_tamt; ?></td>
      <td><?php echo $tmins_used_this_month; ?></td>
      <td><?php echo $cash_balance; ?></td>
      <td><?php echo $cash_used_this_month; ?></td>
      <td><?php echo $adhoc_payments + misc_items; ?></td>
      <td><?php echo $balance; ?></td>
    </tr>
  </table>
</form>
