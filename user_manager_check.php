<?php
// auth_inc.php must be included prior to including this file

if (!$UserIsManager) {
    echo "<link href=\"main.css\" rel=\"stylesheet\" type=\"text/css\" />";
    include 'banner1.php';

    echo "
    <table width='815' height='40' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td height='100' width='600' valign='middle'><div align='center'><span class='style2'>User \"$thisUserName\" is not authorized to access this page.</span></div></td>
      </tr>
    </table>";

    exit(1);
}
?>

