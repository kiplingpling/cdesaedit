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

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset2 = "SELECT * FROM kopsurat where id=1 ORDER BY id ASC";
$Recordset2 = mysql_query($query_Recordset2, $eTanah) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE download2 SET namapemilik=%s, no_SPPT=%s, no_Sertificate=%s WHERE id=%s",
                       GetSQLValueString($_POST['namapemilik'], "text"),
                       GetSQLValueString($_POST['no_SPPT'], "text"),
					   GetSQLValueString($_POST['no_Sertificate'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_eTanah, $eTanah);
  $Result1 = mysql_query($updateSQL, $eTanah) or die(mysql_error());

  $updateGoTo = "kelolapemilik.php";
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
$query_Recordset1 = sprintf("SELECT * FROM download2 WHERE id = %s ORDER BY id ASC", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="plugin/bootstrap.min.css" rel="stylesheet" type="text/css">

<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Calibri;
}
</style>
</head>

<body>

<div class="container">
  <div class="text-center">
    <h4><b>SILAHKAN ISI FORM DIBAWAH INI UNTUK MENGUBAH DATA</b></h4>
  </div>
  
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <div class="form-group">
      <label><b style="font-size: 1em">Nama</b></label>
      <input type="text" name="namapemilik" value="<?php echo htmlentities($row_Recordset1['namapemilik'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" />
    </div>
    <div class="form-group">
      <label><b style="font-size: 1em">Nomor NOP ( SPPT )</b></label>
      <input type="text" name="no_SPPT" value="<?php echo $row_Recordset2['nosppt']; ?>" class="form-control" />
    </div>
    <div class="form-group">
      <label><b style="font-size: 1em">Nomor Sertificate</b></label>
      <input type="text" name="no_Sertificate" value="<?php echo htmlentities($row_Recordset1['no_Sertificate'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" />
    </div>
    <button type="submit" name="submit" id="submit" class="btn btn-primary">
      <i class="fas fa-save"></i> Simpan
    </button>
  <a href="kelolapemilik.php" class="btn btn-default">
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
mysql_free_result($Recordset2);
?>
