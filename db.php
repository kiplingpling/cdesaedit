<?php
 
$hostname = "localhost"; /*nama server*/
$dbuser   = "djcomp"; /*nama username database*/
$dbpass   = "qwerty1998"; /*password database*/
$dbName   = "etanah"; /*nama database*/
 
$koneksi  = mysql_connect($hostname,$dbuser,$dbpass) or die ('Tidak bisa konek DB');
$konekDB  = mysql_select_db($dbName,$koneksi) or die ('DB tidak ada');
?>