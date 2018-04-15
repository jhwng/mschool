<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_promusic = "sql.webair.com";
$database_promusic = "promusic";
$username_promusic = "samuel";
$password_promusic = "foobar";
$promusic = mysql_pconnect($hostname_promusic, $username_promusic, $password_promusic) or trigger_error(mysql_error(),E_USER_ERROR); 

$wwwhost = "http://localhost/promusic";
?>