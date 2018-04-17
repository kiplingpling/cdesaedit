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
  $updateSQL = sprintf("UPDATE pengguna SET username=%s, password=%s WHERE ID=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['ID'], "text"));

  mysql_select_db($database_eTanah, $eTanah);
  $Result1 = mysql_query($updateSQL, $eTanah) or die(mysql_error());

  $updateGoTo = "tampilUser.php?ID=" . $row_Recordset1['ID'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_Recordset1 = sprintf("SELECT * FROM pengguna WHERE ID = %s ORDER BY ID ASC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="plugin/eTanah.css" rel="stylesheet" type="text/css">
<link href="plugin/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="plugin/custom.css" rel="stylesheet" type="text/css">
<link href="plugin/font-awesome.css" rel="stylesheet" type="text/css">
<title>Untitled Document</title>
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
</head>

<body>

<div class="container">
  <div class="text-center" style="font-size: 25px; margin-top: 5px;">
    <b>Edit Data <?php echo $row_Recordset1['username']; ?></b>
  </div> <br />
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <div class="form-group">
      <label><b style="font-size: 15px">Username</b></label>
      <input name="username" type="text" class="form-control" value="<?php echo htmlentities($row_Recordset1['username'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" />
    </div>
    <div class="form-group">
      <label><b style="font-size: 15px">Password</b></label>
      <input name="password" type="text" class="form-control" value="<?php echo htmlentities($row_Recordset1['password'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" />
    </div>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="ID" value="<?php echo $row_Recordset1['ID']; ?>" />
    <button type="submit" name="submit" id="submit" class="btn btn-primary">
      <i class="fas fa-save"></i> Simpan
    </button>
    <button type="reset" name="reset" id="reset" class="btn btn-default">
      <i class="fas fa-ban"></i> Batal
    </button>
  </form>
</div>
<script src="plugin/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
<script src="plugin/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
<script src="plugin/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
<script src="plugin/js/custom.js"></script>
<script src="plugin/fontawesome-all.min.js"></script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
