<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_eTanah = "localhost";
$database_eTanah = "etanah";
$username_eTanah = "djcomp";
$password_eTanah = "qwerty1998";
$eTanah = mysql_pconnect($hostname_eTanah, $username_eTanah, $password_eTanah) or trigger_error(mysql_error(),E_USER_ERROR); 
?>