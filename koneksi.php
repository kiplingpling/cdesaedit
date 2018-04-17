<?php  
$server  = "localhost";  
$username = "djcomp";  
$password = "qwerty1998";  
$database = "etanah";  
$koneksi = mysql_connect($server,$username,$password) or die ('Koneksi gagal');  
if($koneksi){  
mysql_select_db($database) or die ('Database belum dibuat');   
}  
?>  