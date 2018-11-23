    <tr>
      <td align="center">
        <?php
        if ($strong == 1)
          echo "<strong>";
        echo "$month";
        if ($strong == 1)
          echo "</strong>";
        ?>
      </td>

      <td align="center">
        <?php
        if ($strong == 1)
          echo "<strong>";
        echo $number_of_lessons;
        if ($strong == 1)
          echo "</strong>";
        ?>
      </td>

      <td align="right"><span<?php if ($monthlyPDchqAmount < 0) echo " class=\"redtext\""; ?>>
        <?php
        if ($strong == 1)
          echo "<strong>";
        if ( $monthlyPDchqAmount == 0 )
          echo "&nbsp;";
        else
          echo number_format($monthlyPDchqAmount, 2);
        if ($strong == 1)
          echo "</strong>";
        ?>
      </span></td>

      <td align="right"><span<?php if ($adHocPayment < 0) echo " class=\"redtext\""; ?>>
        <?php
        if ($strong == 1)
          echo "<strong>";
        if ( $adHocPayment == 0 )
          echo "&nbsp;";
        else
          echo number_format($adHocPayment, 2);
        if ($strong == 1)
          echo "</strong>";
        ?>
      </span></td>

      <td align="right"><span<?php if ($miscAmt < 0) echo " class=\"redtext\""; ?>>
        <?php
        if ($strong == 1)
          echo "<strong>";
        if ( $miscAmt == 0 )
          echo "&nbsp;";
        else
          echo number_format($miscAmt, 2);
        if ($strong == 1)
          echo "</strong>";
        ?>
      </span></td>

      <td align="right"><span<?php if ($usageAmt < 0) echo " class=\"redtext\""; ?>>
        <?php
        if ($strong == 1)
          echo "<strong>";
        if ( $usageAmt == 0 )
          echo "&nbsp;";
        else
          echo number_format($usageAmt, 2);
        if ($strong == 1)
          echo "</strong>";
        ?>
      </span></td>

      <td align="right" height=18><span<?php if ($balance < 0) echo " class=\"redtext\""; ?>>
        <?php
        if ($strong == 1)
          echo "<strong>";
        if ( $balance == 0 )
          echo "&nbsp;";
        else
          echo number_format($balance, 2);
        if ($strong == 1)
          echo "</strong>";
        ?>
      </span></td>

      <td align="right" height=18><span<?php if ($WrunningTotal < 0) echo " class=\"redtext\""; ?>>
        <?php
        if ($strong == 1)
          echo "<strong>";
        if ( $WrunningTotal == 0 )
          echo "&nbsp;";
        else
          echo number_format($WrunningTotal, 2);
        if ($strong == 1)
          echo "</strong>";
        ?>
      </span></td>

      <td align="right" height=18><span<?php if ($TrunningTotal < 0) echo " class=\"redtext\""; ?>>
        <?php
        if ($strong == 1)
          echo "<strong>";
        if ( $TrunningTotal == 0 )
          echo "&nbsp;";
        else
          echo number_format($TrunningTotal, 2);
        if ($strong == 1)
          echo "</strong>";
        ?>
      </span></td>
    </tr>
