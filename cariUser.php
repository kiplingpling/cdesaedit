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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['keyword'])) {
  $colname_Recordset1 = $_GET['keyword'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_Recordset1 = sprintf("SELECT * FROM pengguna WHERE username LIKE %s ORDER BY username ASC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
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
<table border="0" class="zebra-table">
  <tr>
    <td bgcolor="#3D91CB">ID</td>
    <td bgcolor="#3D91CB">Username</td>
    <td bgcolor="#3D91CB">Password</td>
    <td colspan="2" bgcolor="#3D91CB">Tindakan</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['ID']; ?></td>
      <td><?php echo $row_Recordset1['username']; ?></td>
      <td>Password is not available</td>
      <td><a href="editUser.php?ID=<?php echo $row_Recordset1['ID']; ?>"><img src="img/btn/edit.png" width="35" height="35" /></a></td>
      <td><a href="deleteUser.php?ID=<?php echo $row_Recordset1['ID']; ?>" onClick="return confirm('Apakah anda yakin ingin menghapus <?php echo $row_Recordset1['username']; ?> ?')"><img src="img/btn/deletedata.png" width="35" height="35" /></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html><?php
mysql_free_result($Recordset1);
?>
