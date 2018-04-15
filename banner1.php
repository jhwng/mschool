<script type='text/javascript'>

//HV Menu- by Ger Versluis (http://www.burmees.nl/)
//Submitted to Dynamic Drive (http://www.dynamicdrive.com)
//Visit http://www.dynamicdrive.com for this script and more

function Go(){return}

</script>
<script type='text/javascript' src='exmplmenu_var.js'></script>
<script type='text/javascript' src='menu_com.js'></script>

<?php
if ( $_SESSION['logged'] == 1 ) {
  $queryUser = "SELECT user_name as thisUserName FROM user WHERE user_id=$thisUserID";
  // echo "$queryUser<br>";
  $result = mysql_query($queryUser, $promusic) or die(mysql_error());
  $row = mysql_fetch_array($result);
  extract($row);
}
?>

<table width="750" border="0" cellspacing="0" cellpadding="0">
    <td width="203"><a href="class_schedule.php"><img src="images/promusic_logo.gif" alt="Pro Music" width="203" height="86" border="0" /></a></td>
    <td width="133">&nbsp;</td>
    <td width="414" valign="bottom"><div align="right" class="banner_text">Pro-Music School Administration System</div><br>
      <div align="right" class="bluetext"><?php if ( $_SESSION['logged'] == 1 ) echo $thisUserName . "&nbsp;&nbsp;";  if ( $versionNum <> "" ) echo $versionNum . "&nbsp;"; else echo "1.00.00&nbsp;";?></div></td>
  </tr>
</table>

<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25"><div align="right"></div></td>
  </tr>
</table>
