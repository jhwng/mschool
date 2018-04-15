<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_rwu = "localhost";
$database_rwu = "pro-music";
$username_rwu = "test";
$password_rwu = "test";
$rwu = mysql_pconnect($hostname_rwu, $username_rwu, $password_rwu) or trigger_error(mysql_error(),E_USER_ERROR); 
?>