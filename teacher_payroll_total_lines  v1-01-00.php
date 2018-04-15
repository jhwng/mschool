  <tr height="20">
    <td colspan="7"><div align="right"><?php echo $totalDesc; ?></div></td>
    <td align="right">
	<?php
	  if ( $totalDesc == "Net Pay " && $totalAmt < 0 ) {
	    echo "<span class=\"redtext\">"; 
	  } 
	  if ( $strong == 1 ) echo "<strong>"; 
	  echo number_format($totalAmt, 2); 
	  if ( $strong == 1 ) echo "</strong>";
	  if ( $totalDesc == "Net Pay " && $totalAmt < 0 ) {
	    echo "</span>"; 
	  } 
	?>
	</td>
  </tr>
