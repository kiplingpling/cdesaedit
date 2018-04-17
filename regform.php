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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO reg (idreg, namadesa, kodedesa, provinsi, kabupaten, kecamatan, jalan, kodepos, telp, email, namakades, jmlcdesa, namalengkap, ttl, dusun, jabatan, `no`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['idreg'], "int"),
                       GetSQLValueString($_POST['namadesa'], "text"),
                       GetSQLValueString($_POST['kodedesa'], "text"),
                       GetSQLValueString($_POST['provinsi'], "text"),
                       GetSQLValueString($_POST['kabupaten'], "text"),
                       GetSQLValueString($_POST['kecamatan'], "text"),
                       GetSQLValueString($_POST['jalan'], "text"),
                       GetSQLValueString($_POST['kodepos'], "text"),
                       GetSQLValueString($_POST['telp'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['namakades'], "text"),
                       GetSQLValueString($_POST['jmlcdesa'], "int"),
                       GetSQLValueString($_POST['namalengkap'], "text"),
                       GetSQLValueString($_POST['ttl'], "text"),
                       GetSQLValueString($_POST['dusun'], "text"),
                       GetSQLValueString($_POST['jabatan'], "text"),
                       GetSQLValueString($_POST['no'], "text"));

  mysql_select_db($database_eTanah, $eTanah);
  $Result1 = mysql_query($insertSQL, $eTanah) or die(mysql_error());

  $insertGoTo = "succes.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset1 = "SELECT * FROM reg";
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
body {
	background-image: url(img/apptemplate/background1.jpg);
	background-attachment:fixed;
}
</style>
</head>

<body>      
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1"><table align="center" width="900" border="0" cellpadding="20" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" valign="middle" align="left"><p>&nbsp;</p>
      <h1>FORMULIR INSTALASI APLIKASI CDESA</h1>
      <p>DJ Computer Indonesia 2017</p>
      <p><br />
    </p></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><h3>I. IDENTITAS DESA </h3></td>
    </tr>
  <tr>
    <td bgcolor="#FFFFFF">Nama Desa</td>
    <td bgcolor="#FFFFFF"><input type="text" name="namadesa" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Kode Desa      </td>
    <td bgcolor="#FFFFFF"><input type="text" name="kodedesa" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Provinsi</td>
    <td bgcolor="#FFFFFF"><input type="text" name="provinsi" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Kabupaten</td>
    <td bgcolor="#FFFFFF"><input type="text" name="kabupaten" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Kecamatan</td>
    <td bgcolor="#FFFFFF"><input type="text" name="kecamatan" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Alamat Jalan</td>
    <td bgcolor="#FFFFFF"><input type="text" name="jalan" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Kode Pos</td>
    <td bgcolor="#FFFFFF"><input type="text" name="kodepos" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">No Telephone</td>
    <td bgcolor="#FFFFFF"><input type="text" name="telp" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">E mail</td>
    <td bgcolor="#FFFFFF"><input type="text" name="email" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Nama Kepala Desa</td>
    <td bgcolor="#FFFFFF"><input name="namakades" type="text" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Jumlah Buku C</td>
    <td bgcolor="#FFFFFF"><input type="text" name="jmlcdesa" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><h3>II. IDENTITAS PEMOHON</h3></td>
    </tr>
  <tr>
    <td bgcolor="#FFFFFF">Nama Lengkap</td>
    <td bgcolor="#FFFFFF"><input type="text" name="namalengkap" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Tempat, Tanggal Lahir</td>
    <td bgcolor="#FFFFFF"><input type="text" name="ttl" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Dusun</td>
    <td bgcolor="#FFFFFF"><input type="text" name="dusun" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Jabatan</td>
    <td bgcolor="#FFFFFF"><input type="text" name="jabatan" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">No Telphone</td>
    <td bgcolor="#FFFFFF"><input type="text" name="no" value="" size="100%" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><input type="submit" value="Insert record" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"></td>
  </tr>
</table>
<input type="hidden" name="idreg" value="" size="32" />
        <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
