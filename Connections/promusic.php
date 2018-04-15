<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_promusic = "localhost";
$database_promusic = "xxx";
$username_promusic = "yyy";
$password_promusic = "zzz";
$promusic = mysql_pconnect($hostname_promusic, $username_promusic, $password_promusic) or trigger_error(mysql_error(),E_USER_ERROR); 

$wwwhost = "http://localhost/promusic";
?>