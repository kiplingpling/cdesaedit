<?php require_once('Connections/eTanah.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_tampil = "-1";
if (isset($_POST['keyword'])) {
  $colname_tampil = $_POST['keyword'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_tampil = sprintf("SELECT * FROM download2 WHERE namapemilik LIKE %s ORDER BY namapemilik ASC", GetSQLValueString("%" . $colname_tampil . "%", "text"));
$tampil = mysql_query($query_tampil, $eTanah) or die(mysql_error());
$row_tampil = mysql_fetch_assoc($tampil);
$totalRows_tampil = mysql_num_rows($tampil);$colname_tampil = "-1";
if (isset($_GET['keyword'])) {
  $colname_tampil = $_GET['keyword'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_tampil = sprintf("SELECT * FROM download2 WHERE namapemilik LIKE %s ORDER BY namapemilik ASC", GetSQLValueString("%" . $colname_tampil . "%", "text"));
$tampil = mysql_query($query_tampil, $eTanah) or die(mysql_error());
$row_tampil = mysql_fetch_assoc($tampil);
$totalRows_tampil = mysql_num_rows($tampil);

$query_tampil = "SELECT * FROM `download2` ORDER BY id ASC";
$tampil = mysql_query($query_tampil, $eTanah) or die(mysql_error());
$row_tampil = mysql_fetch_assoc($tampil);
$totalRows_tampil = mysql_num_rows($tampil);

$colname_tampil = "-1";
if (isset($_GET['name'])) {
  $colname_tampil = $_GET['name'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_tampil = sprintf("SELECT * FROM `download2` WHERE name = %s ORDER BY name ASC", GetSQLValueString($colname_tampil, "text"));
$tampil = mysql_query($query_tampil, $eTanah) or die(mysql_error());
$row_tampil = mysql_fetch_assoc($tampil);
?>
<style>
/*-----------LinkBiru---------*/
.link{
width:950px;
clear:both;
text-align:left;
padding:0px 0 0px 0px;
border-top:1px #d5d5d5 solid;
margin:0px 0 0 0;
}
.copyrights{
float:left;
}
.link_right{
float:left;
}
.link_right a{
text-decoration:none; padding:0 0px 0 0px; color:#006FBE;
}
.link_right a:hover{
color:#DD4629;
</style>
<style>
@charset "utf-8";
/* CSS Document */
/* CSS for Zebra Table in index.html */
.zebra-table {
	width: 100%;
	border-collapse: collapse;
	box-shadow: 0 1px 2px 1px #ddd;
	overflow: hidden;
	border:5px solid #fff;
	color: #F00;
	font-family: Calibri;
	font-size: 14px;
	background-color: #E4E4E4;
	font-weight: bold;
}
.zebra-table th,.zebra-table td{
	vertical-align: top;
	padding:5px 7px;
	text-align: left;
	margin:0;
	color: #000;
	font-weight: normal;
}
.zebra-table tbody tr:nth-child(odd) { /*
Make table like zebra */
background: #eee ;
}/* End CSS for Zebra Table in index.html
*/
.zebra-table tr td {
	font-family: Calibri;
	font-size: 14px;
	font-style: normal;
	color: #333;
}
body {
	background-color: #FFF;
}
</style>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="zebra-table">
  <tr>
    <td width="104" bgcolor="#008cba" style="color: #FFF;">NO URUT</td>
    <td width="245" bgcolor="#008cba" style="color: #FFF;">NAMA WAJIB PAJAK</td>
    <td width="316" bgcolor="#008cba" style="color: #FFF;">NOMOR SERTIFICATE</td>
    <td width="316" bgcolor="#008cba" style="color: #FFF;">NOMOR OBJEK PAJAK</td>
  </tr>
      <?php
$select=mysql_query("select * from download2 order by no asc");
while($row1=mysql_fetch_array($select)){
$row_tampil=$row1['id'];
$name=$row1['name'];
$nomor=$row1['no'];
$nama=$row1['namapemilik'];
$no_Sertificate=$row1['no_Sertificate'];
$no_SPPT=$row1['no_SPPT'];
?>
  <tr>
    <td><?php echo $nomor ;?></td>
    <td><?php echo $nama ;?></td>
    <td><?php echo $no_Sertificate ;?></td>
    <td><?php echo $no_SPPT ;?></td>
  </tr>
   <?php }?>
</table>
<?php
mysql_free_result($tampil);
?>
