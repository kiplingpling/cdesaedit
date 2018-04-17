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

$colname_tampil = "-1";
if (isset($_POST['keyword'])) {
  $colname_tampil = $_POST['keyword'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_tampil = sprintf("SELECT * FROM download WHERE namapemilik LIKE %s ORDER BY namapemilik ASC", GetSQLValueString("%" . $colname_tampil . "%", "text"));
$tampil = mysql_query($query_tampil, $eTanah) or die(mysql_error());
$row_tampil = mysql_fetch_assoc($tampil);
$totalRows_tampil = mysql_num_rows($tampil);$colname_tampil = "-1";
if (isset($_GET['keyword'])) {
  $colname_tampil = $_GET['keyword'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_tampil = sprintf("SELECT * FROM download WHERE namapemilik LIKE %s ORDER BY namapemilik ASC", GetSQLValueString("%" . $colname_tampil . "%", "text"));
$tampil = mysql_query($query_tampil, $eTanah) or die(mysql_error());
$row_tampil = mysql_fetch_assoc($tampil);
$totalRows_tampil = mysql_num_rows($tampil);

$query_tampil = "SELECT * FROM `download` ORDER BY id ASC";
$tampil = mysql_query($query_tampil, $eTanah) or die(mysql_error());
$row_tampil = mysql_fetch_assoc($tampil);
$totalRows_tampil = mysql_num_rows($tampil);

$colname_tampil = "-1";
if (isset($_GET['name'])) {
  $colname_tampil = $_GET['name'];
}
mysql_select_db($database_eTanah, $eTanah);
$query_tampil = sprintf("SELECT * FROM `download` WHERE name = %s ORDER BY name ASC", GetSQLValueString($colname_tampil, "text"));
$tampil = mysql_query($query_tampil, $eTanah) or die(mysql_error());
$row_tampil = mysql_fetch_assoc($tampil);
?>
<style>
/*-----------LinkBiru---------*/
.link{
width:950px;
clear:both;
text-align:left;
padding:0px 0 0px 0px;
border-top:1px #d5d5d5 solid;
margin:0px 0 0 0;
}
.copyrights{
float:left;
}
.link_right{
float:left;
}
.link_right a{
text-decoration:none; padding:0 0px 0 0px; color:#006FBE;
}
.link_right a:hover{
color:#DD4629;
</style>
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
body {
	background-color: #FFF;
}
</style>
<?php
$conn=mysql_connect("localhost","djcomp","qwerty1998") or die(mysql_error());
$sdb=mysql_select_db("etanah",$conn) or die(mysql_error());
if(isset($_POST['submit'])!=""){
$name=$_FILES['photo']['name'];
$size=$_FILES['photo']['size'];
$type=$_FILES['photo']['type'];
$temp=$_FILES['photo']['tmp_name'];
$nomor=addslashes($_POST['no']);
$nama=addslashes($_POST['namapemilik']);
$ket=addslashes($_POST['keterangan']);
$caption1=$_POST['caption'];
$link=$_POST['link'];
move_uploaded_file($temp,"files/".$name);
$insert=mysql_query("insert into download(name, no, namapemilik, keterangan)values('$name','$nomor','$nama','$ket')");
if($insert){
header("location:inputData.php");
}
else{
die(mysql_error());
}
}
?>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
<body onLoad="MM_preloadImages('img/btn/print-btn2.png')">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="zebra-table">
  <tr>
    <td width="104" bgcolor="#008cba" style="color: #FFF;">NO KOHIR</td>
    <td width="245" bgcolor="#008cba" style="color: #FFF;">NAMA WAJIB PAJAK</td>
    <td width="316" bgcolor="#008cba" style="color: #FFF;">KETERANGAN</td>
    <td width="114" bgcolor="#008cba" style="color: #FFF;">TINDAKAN</td>
  </tr>
      <?php
$select=mysql_query("select * from download order by no asc");
while($row1=mysql_fetch_array($select)){
$row_tampil=$row1['id'];
$name=$row1['name'];
$nomor=$row1['no'];
$nama=$row1['namapemilik'];
$ket=$row1['keterangan'];
?>
  <tr>
    <td><?php echo $nomor ;?></td>
    <td><?php echo $nama ;?></td>
    <td><?php echo $ket ;?></td>
    <td><a href="http://localhost/cDesa/files/<?php echo $name;?>" target="_self" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image1','','img/btn/print-btn2.png',1)"><img src="img/btn/print-btn1.png" name="Image1" width="100" height="36" border="0" id="Image1" /></a></td>
  </tr>
   <?php }?>
</table>
<?php
mysql_free_result($tampil);
?>
