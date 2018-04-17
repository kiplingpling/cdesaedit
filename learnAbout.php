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
<p><strong>Apa Aplikasi cDesa ?</strong></p>
<p>Aplikasi cDesa adalah sebuah software atau perangkat lunak komputer berbasis web base offline yang dikembangkan oleh sebuah perusahaan teknologi terbaik dan terbesar di Indonesia yaitu DJ Computer Indonesia untuk dimanfaatkan sebagai sistem administrasi pertanahan desa dalam hal ini adalah buku cDesa. Aplikasi ini dibuat berdasarkan keluhan dari desa desa di Indonesia yang mengeluhkan bahwa buku c desa masih menggunakan sistem manual.</p>
<p><strong>Siapa Penemu Aplikasi cDesa</strong> ?</p>
<table width="655" border="0">
  <tr>
    <td width="170" rowspan="6"><img src="img/apptemplate/Juni Prayitno.jpeg" width="170" height="170" /></td>
    <td width="4">&nbsp;</td>
    <td width="90">Nama</td>
    <td width="10">:</td>
    <td width="359"><strong>Juni Prayitno</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tempat Ttl</td>
    <td>:</td>
    <td>Kendal, 09 Juni 1997</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">Alamat</td>
    <td valign="top">:</td>
    <td>Dsn Panceng RT 01 RW 05 Ds Kebon Gembong Pageruyung - Kendal</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Jabatan</td>
    <td>:</td>
    <td>CEO &amp; Founder DJ Computer Indonesia</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>E mail</td>
    <td>:</td>
    <td>juniprayitno123@gmail.com</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">Pendidikan</td>
    <td valign="top">:</td>
    <td>SMK Negeri 5 Kendal</td>
  </tr>
</table>
<p><strong>Kapan ditemukannya Aplikasi cDesa</strong> ?</p>
<p>Aplikasi cDesa dtemukan pada tanggal 16 Januari 2017.</p>
<p>Kami segenap dewan direksi dari DJ Computer Indonesia dan tim mengucapkan banyak terimakasih kepada Anda yang telah menggunakan Aplikasi ini dan terdaftar sebagai pengguna resmi cDesa.</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
