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
$query_Recordset1 = sprintf("SELECT * FROM download2 WHERE no_SPPT LIKE %s ORDER BY no_SPPT ASC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
    <td width="14%" bgcolor="#3D91CB">NOMOR URUT</td>
    <td width="21%" bgcolor="#3D91CB">NAMA WAJIB PAJAK</td>
    <td width="17%" bgcolor="#3D91CB">NOMOR SERTIFICATE</td>
    <td width="20%" bgcolor="#3D91CB">NOMOR OBJEK PAJAK</td>
    <td colspan="4" bgcolor="#3D91CB">TINDAKAN</td>
  </tr>
  <? 
  ?>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['no']; ?></td>
      <td><div class="link_right"><a href="lihatDetailDataPemilik.php?id=<?=$row_Recordset1['id'];?>"><?php echo $row_Recordset1['namapemilik']; ?></a></div></td>
      <td><?php echo $row_Recordset1['no_Sertificate']; ?></td>
      <td><?php echo $row_Recordset1['no_SPPT']; ?></td>
      <td width="15%"><a href="editDataPemilik.php?id=<?php echo $row_Recordset1['id']; ?>">Perbarui Data</a></td>
      <td width="15%"><a href="deletePemilik.php?id=<?php echo $row_Recordset1['id']; ?>" onClick="return confirm('Apakah anda yakin ingin menghapus <?php echo $row_Recordset1['namapemilik']; ?> ?')"><img src="img/btn/delete.png" width="100" height="36" /></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html><?php
mysql_free_result($Recordset1);
?>
