<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_promusic = "localhost";
$database_promusic = "xxx";
$username_promusic = "yyy";
$password_promusic = "zzz";

//$promusic = mysql_pconnect($hostname_promusic, $username_promusic, $password_promusic) or trigger_error(mysql_error(),E_USER_ERROR);

//xxxjng - Use non-persistent connection to avoid potential "weird" issues
//         with transactions (for instance, since the transactions in this
//         PHP app are NOT explicitly rolled back if a page hits an error,
//         it means the executed insert/update/delete could be inadvertently
//         committed if subsequently another page issues another
//         "START TRANSACTION" --which is expected behavior for MySQL).
//         The 4th parameter of mysql_connect() is for 'new_link' and
//         'true' means always get a new link.
$promusic = mysql_connect($hostname_promusic, $username_promusic, $password_promusic, true) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_promusic, $promusic); //xxxjng

$wwwhost = "http://localhost/promusic";
?>
