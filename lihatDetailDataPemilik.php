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
body,td,th {
	font-family: Calibri;
	text-align: left;
}
</style>
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
$query_Recordset1 = "SELECT * FROM assetbaru where id='$_GET[id]' ORDER BY k_id ASC";
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset2 = "SELECT * FROM download2 where id='$_GET[id]'";
$Recordset2 = mysql_query($query_Recordset2, $eTanah) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset3 = "SELECT * FROM ketbaru where id='$_GET[id]' ORDER BY k_id ASC";
$Recordset3 = mysql_query($query_Recordset3, $eTanah) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
$idcdesa=$row_Recordset1['idcdesa'];

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset4 = "SELECT * FROM download where id='$idcdesa'";
$Recordset4 = mysql_query($query_Recordset4, $eTanah) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<title>Untitled Document</title>
</head>

<body onLoad="MM_preloadImages('img/btn/print-btn2.png')">
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Data Asset</li>
    <li class="TabbedPanelsTab" tabindex="0">Data Perubahan & Keterangan Asset</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="81">NO URUT : </td>
          <td width="521" align="left"><strong><?php echo $row_Recordset2['no']; ?></strong></td>
          <td width="170">Nama Wajib Pajak : <?php echo $row_Recordset2['namapemilik']; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table border="1" cellpadding="3" cellspacing="0" width="100%">
        <tr>
          <td rowspan="2" bgcolor="#CCCCCC">No Persil</td>
          <td rowspan="2" bgcolor="#CCCCCC">Kelas Desa</td>
          <td rowspan="2" bgcolor="#CCCCCC">Luas Tersedia ( m2 )</td>
          <td rowspan="2" bgcolor="#CCCCCC">ipeda</td>
          <td colspan="4" bgcolor="#CCCCCC">Asal Usul Asset</td>
          <td rowspan="2" bgcolor="#CCCCCC">Status</td>
          <td rowspan="2" bgcolor="#CCCCCC">Klasifikasi</td>
          <td rowspan="2" bgcolor="#CCCCCC">C Desa</td>
          <td colspan="3" rowspan="2" bgcolor="#CCCCCC">Tindakan</td>
        </tr>
        <tr>
          <td bgcolor="#CCCCCC">Metode</td>
          <td bgcolor="#CCCCCC">Tahun</td>
          <td bgcolor="#CCCCCC">No Urut</td>
          <td bgcolor="#CCCCCC">Atas Nama</td>
        </tr>
        <?php do { ?>
        <tr>
          <td><?php echo $row_Recordset1['no_persil']; ?></td>
          <td><?php echo $row_Recordset1['kelas_desa']; ?></td>
          <td><?php echo $row_Recordset1['luas_tersedia']; ?></td>
          <td><?php echo $row_Recordset1['ipeda']; ?></td>
          <td><?php echo $row_Recordset1['diperoleh']; ?></td>
          <td><?php echo $row_Recordset1['tahun']; ?></td>
          <td><a href="http://localhost/cDesa/tampilCariMultipleUrutPemilik.php?keyword=<?php echo $row_Recordset1['no_kohir']; ?>"/><?php echo $row_Recordset1['no_kohir']; ?></a></td>
          <td><?php echo $row_Recordset1['atasnama']; ?></td>
          <td><font style="color:#C00"><strong><?php echo $row_Recordset1['status']; ?></strong></font></td>
          <td><?php echo $row_Recordset1['klasifikasi']; ?></td>
          <td><a href="http://localhost/cDesa/tampilCariMultipleNomor.php?keyword=<?php echo $row_Recordset1['nocdesa']; ?>"><?php echo $row_Recordset1['nocdesa']; ?></a></td>
          <td><a href="http://localhost/cDesa/suratbukti/<?php echo $row_Recordset1['name']; ?>"><img src="img/btn/view.png" width="30" height="30" id="sprytrigger3" /></a></td>
          <td><a href="http://localhost/cDesa/files/<?php echo $row_Recordset4['name']; ?>"><img src="img/btn/print.png" width="30" height="30" id="sprytrigger1" /></a></td>
          <td><a href="form_pindahDataPemilik.php?k_id=<?php echo $row_Recordset1['k_id']; ?>&amp;&amp;id=<?php echo $row_Recordset1['id']; ?>" onClick="return confirm('Apakah anda yakin ingin memindah Asset <?php echo $row_Recordset1['no_persil']; ?> ?')"><img src="img/btn/pindah.png" alt="" width="30" height="30" id="sprytrigger2" /></a></td>
        </tr>
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
      <div class="tooltipContent" id="sprytooltip3">Cetak Bukti</div>
<div class="tooltipContent" id="sprytooltip2">Pindahkan Asset</div>
<div class="tooltipContent" id="sprytooltip1">Cetak C Desa</div>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
var sprytooltip2 = new Spry.Widget.Tooltip("sprytooltip2", "#sprytrigger2");
var sprytooltip3 = new Spry.Widget.Tooltip("sprytooltip3", "#sprytrigger3");
</script>

      <p align="right"><a href="tambahAssetBaru.php?id=<?php echo $_GET[id]; ?>"><img src="img/btn/tambah.png" alt="" width="100" height="36" /></a> <a href="cetakassetbaru.php?id=<?php echo $_GET[id]; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','img/btn/print-btn2.png',1)"><img src="img/btn/print-btn1.png" alt="" name="Image3" width="100" height="36" border="0" id="Image3" /></a></p>
      <p></p>
     
    </div>
    <div class="TabbedPanelsContent">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="81">NO URUT :</td>
          <td width="521" align="left"><strong><?php echo $row_Recordset2['no']; ?></strong></td>
          <td width="170">Nama Wajib Pajak : <?php echo $row_Recordset2['namapemilik']; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
<?php if ($totalRows_Recordset3 > 0) { // Show if recordset not empty ?>
  <table border="1" cellpadding="3" cellspacing="0" width="100%">
    <tr>
      <td rowspan="2" bgcolor="#CCCCCC">No Persil</td>
      <td rowspan="2" bgcolor="#CCCCCC">Kelas Desa</td>
      <td rowspan="2" bgcolor="#CCCCCC">Luas Yang Dipindah</td>
      <td rowspan="2" bgcolor="#CCCCCC">Ipeda</td>
      <td colspan="4" bgcolor="#CCCCCC">Sebab dan Waktu Perubahan</td>
      <td rowspan="2" bgcolor="#CCCCCC">Klasifikasi</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC">Metode</td>
      <td bgcolor="#CCCCCC">Tahun</td>
      <td bgcolor="#CCCCCC">Kohir</td>
      <td bgcolor="#CCCCCC">Atas Nama</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset3['no_persil']; ?></td>
        <td><?php echo $row_Recordset3['kelas_desa']; ?></td>
        <td><?php echo $row_Recordset3['luas_terpindah']; ?></td>
        <td><?php echo $row_Recordset3['ipeda']; ?></td>
        <td><?php echo $row_Recordset3['dipindah']; ?></td>
        <td><?php echo $row_Recordset3['tahun_pindah']; ?></td>
        <td><a href="http://localhost/cDesa/tampilCariMultipleUrutPemilik.php?keyword=<?php echo $row_Recordset3['no_kohir_pindah']; ?>"/><?php echo $row_Recordset3['no_kohir_pindah']; ?></a></td>
        <td><?php echo $row_Recordset3['atasnama_pindah']; ?></td>
        <td><?php echo $row_Recordset3['klasifikasi']; ?></td>
      </tr>
      <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
  </table>
        <p align="right"><a href="cetakperubahanassetbaru.php?id=<?php echo $_GET[id]; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','img/btn/print-btn2.png',1)"><img src="img/btn/print-btn1.png" alt="" name="Image3" width="100" height="36" border="0" id="Image3" /></a></p>
  <?php } // Show if recordset not empty ?></div>
  </div>
</div>
<p>&nbsp;
<p>&nbsp;</p>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
</html><?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
