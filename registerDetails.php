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
if (isset($_GET['idreg'])) {
  $colname_Recordset1 = $_GET['idreg'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_Recordset1 = sprintf("SELECT * FROM reg WHERE idreg = 2", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<p>Berdasarkan peraturan perusahaan DJ  Computer Indonesia bahwa setiap pengguna resmi Aplikasi cDesa harus memiliki  Tanda Daftar Aplikasi sebagai alat bukti pemakaian secara legal, maka dengan  ini diterangkan bahwa : </p>
<p>&nbsp;</p>
<table width="502" border="0">
  <tr>
    <td width="94">No TDA</td>
    <td width="12">:</td>
    <td width="382"><strong><?php echo $row_Recordset1['no']; ?></strong></td>
  </tr>
  <tr>
    <td>Nama Desa</td>
    <td>:</td>
    <td><strong><?php echo $row_Recordset1['namadesa']; ?></strong></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><?php echo $row_Recordset1['jalan']; ?></td>
  </tr>
  <tr>
    <td>Kecamatan</td>
    <td>:</td>
    <td><?php echo $row_Recordset1['kecamatan']; ?></td>
  </tr>
  <tr>
    <td>Kabupaten</td>
    <td>:</td>
    <td><?php echo $row_Recordset1['kabupaten']; ?></td>
  </tr>
  <tr>
    <td>Provinsi</td>
    <td>:</td>
    <td><?php echo $row_Recordset1['provinsi']; ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>Telah terdaftar pada  administrasi perusahaan sebagai Legal User / Pengguna Resmi Aplikasi cDesa  sejak tanggal ditetapkannya Tanda Daftar Aplikasi cDesa. </p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
