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

$colname_Recordset1 = "-1";
if (isset($_GET['keyword'])) {
  $colname_Recordset1 = $_GET['keyword'];
}

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset1 = sprintf("SELECT * FROM asset WHERE kelas_desa='$colname_Recordset1' ORDER BY `id` ASC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$search=$row_Recordset1['id'];

$colname_Recordset2 = "-1";
if (isset($row_Recordset1['id'])) {
  $colname_Recordset2 = $row_Recordset1['id'];
}

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset2 = sprintf("SELECT * FROM download WHERE `id` LIKE %s ORDER BY `no` ASC", GetSQLValueString("%" . $colname_Recordset2 . "%", "text"));
$Recordset2 = mysql_query($query_Recordset2, $eTanah) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" class="zebra-table">
  <tr>
  
    <td width="14%" bgcolor="#3D91CB">No Persil</td>
    <td width="21%" bgcolor="#E4E4E4"><strong>Kelas Desa</strong></td>
    <td width="17%" bgcolor="#3D91CB">Klasifikasi</td>
    <td width="20%" bgcolor="#3D91CB">C Desa Terkait</td>
    <td width="20%" bgcolor="#3D91CB">Nama Wajib Pajak</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['no_persil']; ?></td>
      <td><strong><?php echo $row_Recordset1['kelas_desa']; ?></strong></td>
      <td><?php echo $row_Recordset1['klasifikasi']; ?></td>
      <td><div class="link_right"><a href="http://localhost/cDesa/tampilCariMultipleNomor.php?keyword=<?php echo $row_Recordset1['nocdesa']; ?>"/><?php echo $row_Recordset1['nocdesa']; ?></a></div></td>
      <td><?php echo $row_Recordset1['namapemilik']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html><?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
?>
