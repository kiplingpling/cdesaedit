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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE download SET namapemilik=%s, keterangan=%s WHERE id=%s",
                       GetSQLValueString($_POST['namapemilik'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_eTanah, $eTanah);
  $Result1 = mysql_query($updateSQL, $eTanah) or die(mysql_error());

  $updateGoTo = "thanksEdit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_Recordset1 = sprintf("SELECT * FROM download WHERE id = %s ORDER BY id ASC", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="plugin/bootstrap.min.css" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Calibri;
}
</style>
</head>

<body>
<div style="margin-left: 25px; margin-right: 25px;">
  
<h3><b>SILAHKAN ISI FORM DIBAWAH INI UNTUK MENGUBAH DATA</b></h3>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <div class="form-group">
    <label style="font-size: 20px;">Nama Wajib Pajak</label>
    <input type="text" name="namapemilik" value="<?php echo htmlentities($row_Recordset1['namapemilik'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" />
  </div>
  <div class="form-group">
    <label style="font-size: 20px;">Keterangan</label>
    <input type="text" name="keterangan" value="<?php echo htmlentities($row_Recordset1['keterangan'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" />
  </div>
  <button type="submit" name="submit" id="submit" class="btn btn-primary">
    <i class="fas fa-save"></i> Simpan
  </button>
  <a href="kelola.php" class="btn btn-default">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
</form>

</div>



<script src="plugin/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
<script src="plugin/js/bootstrap.min.js"></script>
<script src="plugin/fontawesome-all.min.js"></script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
