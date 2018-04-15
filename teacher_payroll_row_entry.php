  <tr height="20">
    <td><?php echo $courseName; ?></td>
    <td><?php echo $fullName; ?></td>
    <td align="center"><?php echo $grade; ?></td>
    <td align="right"><?php echo $cost; if ($costType == "S") echo "%"; ?></td>
    <td align="right"><?php echo $minutes; ?></td>
    <td align="right"><?php echo number_format($netPay, 2); ?></td>
  </tr>
