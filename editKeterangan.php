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
  $updateSQL = sprintf("UPDATE keterangan SET k_status=%s WHERE k_id=%s",
                       GetSQLValueString($_POST['k_status'], "text"),
                       GetSQLValueString($_POST['k_id'], "int"));

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
if (isset($_GET['k_id'])) {
  $colname_Recordset1 = $_GET['k_id'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_Recordset1 = sprintf("SELECT * FROM keterangan WHERE k_id = %s ORDER BY k_id ASC", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<p>
  <?php
mysql_free_result($Recordset1);
?>
</p>
<p>&nbsp;</p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="left">
    <tr valign="baseline">
      <td nowrap align="right">Status Kepemilikan :</td>
      <td><select name="k_status">
        <option value="Aktif" <?php if (!(strcmp("Aktif", htmlentities($row_Recordset1['k_status'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Aktif</option>
        <option value="Sebagian" <?php if (!(strcmp("Sebagian", htmlentities($row_Recordset1['k_status'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Sebagian</option>
        <option value="Tidak Aktif" <?php if (!(strcmp("Tidak Aktif", htmlentities($row_Recordset1['k_status'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Tidak Aktif</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Ubah Status"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="k_id" value="<?php echo $row_Recordset1['k_id']; ?>">
</form>
<p>&nbsp;</p>
