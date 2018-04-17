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
$query_Recordset1 = sprintf("SELECT * FROM reg WHERE idreg = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p align="center"><strong>DATA PENDAFTARAN APLIKASI</strong></p>
<p align="center"><strong>( L E G A L )</strong></p>
<table border="0">
  <tr>
    <td>idreg</td>
    <td>namadesa</td>
    <td>kodedesa</td>
    <td>provinsi</td>
    <td>kabupaten</td>
    <td>kecamatan</td>
    <td>jalan</td>
    <td>kodepos</td>
    <td>telp</td>
    <td>email</td>
    <td>namakades</td>
    <td>jmlcdesa</td>
    <td>namalengkap</td>
    <td>ttl</td>
    <td>dusun</td>
    <td>jabatan</td>
    <td>no</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['idreg']; ?></td>
      <td><?php echo $row_Recordset1['namadesa']; ?></td>
      <td><?php echo $row_Recordset1['kodedesa']; ?></td>
      <td><?php echo $row_Recordset1['provinsi']; ?></td>
      <td><?php echo $row_Recordset1['kabupaten']; ?></td>
      <td><?php echo $row_Recordset1['kecamatan']; ?></td>
      <td><?php echo $row_Recordset1['jalan']; ?></td>
      <td><?php echo $row_Recordset1['kodepos']; ?></td>
      <td><?php echo $row_Recordset1['telp']; ?></td>
      <td><?php echo $row_Recordset1['email']; ?></td>
      <td><?php echo $row_Recordset1['namakades']; ?></td>
      <td><?php echo $row_Recordset1['jmlcdesa']; ?></td>
      <td><?php echo $row_Recordset1['namalengkap']; ?></td>
      <td><?php echo $row_Recordset1['ttl']; ?></td>
      <td><?php echo $row_Recordset1['dusun']; ?></td>
      <td><?php echo $row_Recordset1['jabatan']; ?></td>
      <td><?php echo $row_Recordset1['no']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
