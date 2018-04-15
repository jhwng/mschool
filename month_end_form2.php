<link href="main.css" rel="stylesheet" type="text/css">
<form id="form1" name="form1" method="post" action="">
  <table width="964" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#FFBA75">
      <td width="62" align="center" bgcolor="#FFBA75">Month</td>
      <td width="70" align="center" bgcolor="#FFBA75">Wmins this month</td>
      <td width="74" align="center" bgcolor="#FFBA75">Tmins this month</td>
      <td width="67" align="center" bgcolor="#FFBA75">YTD<br />
      Wmins </td>
      <td width="67" align="center" bgcolor="#FFBA75">YTD<br />
      Tmins </td>
      <td width="67" align="center" bgcolor="#FFBA75">No. Classes</td>
      <td width="85" align="center" bgcolor="#FFBA75"> Class mins this month </td>
      <td width="67" align="center" bgcolor="#FFBA75">Usage this month </td>
      <td width="67" align="center" bgcolor="#FFBA75">Misc item amount </td>
      <td width="67" align="center" bgcolor="#FFBA75">PD Chq </td>
      <td width="56" align="center" bgcolor="#FFBA75">YTD<br />
      cash </td>
      <td width="67" align="center" bgcolor="#FFBA75">Amount Paid </td>
      <td width="68" align="center" bgcolor="#FFBA75">Cash used this month </td>
      <td width="50" align="center" bgcolor="#FFBA75"><p>Balance</p>      </td>
    </tr>
      <tr valign="top" bgcolor=
        <?php if ( $rowCount == 1 ) { $rowCount = 0; echo "\"#ECECFF\"";}
              else { $rowCount = 1; echo "\"#FFFFF2\""; } ?>>
      <td><?php echo $month; ?></td>
      <td><?php echo $number_of_lessons; ?></td>
      <td><?php echo $total_mins; ?></td>
      <td><?php echo $extra_mins; ?></td>
      <td><?php echo $net_fee; ?></td>
      <td><?php echo $PD_cheque; ?></td>
      <td><?php echo $wmins_this_month; ?></td>
      <td><?php echo $cur_year_wmins; ?></td>
      <td><?php echo $cur_year_tmins; ?></td>
      <td><?php echo $cur_year_tamt; ?></td>
      <td><?php echo $cash_balance; ?></td>
      <td><?php echo $cash_used_this_month; ?></td>
      <td><?php echo $adhoc_payments + misc_items; ?></td>
      <td><?php echo $balance; ?></td>
    </tr>
  </table>
</form>
