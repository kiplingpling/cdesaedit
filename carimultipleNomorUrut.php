<?php require_once('Connections/eTanah.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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
  $insertSQL = sprintf("INSERT INTO `download` (`no`, namapemilik, keterangan) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['no'], "text"),
                       GetSQLValueString($_POST['namapemilik'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"));

  mysql_select_db($database_eTanah, $eTanah);
  $Result1 = mysql_query($insertSQL, $eTanah) or die(mysql_error());

  $insertGoTo = "inputData.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="img/apptemplate/ico.png" />
<link href="plugin/eTanah.css" rel="stylesheet" type="text/css">
<link href="plugin/bootstrap.css" rel="stylesheet" type="text/css">
<link href="plugin/custom.css" rel="stylesheet" type="text/css">
<link href="plugin/font-awesome.css" rel="stylesheet" type="text/css">
<title>Kelola Data</title>
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
<style type="text/css">
footer {
	font-family: Calibri;
	font-size: 12px;
	color: #333;
}
body,td,th {
	font-family: "Open Sans", sans-serif;
	color: #EFEFEF;
}
body {
	background-color: #EFEFEF;
	background-image: url(img/apptemplate/backgroundblur.jpg);
}
#conten-wrapper table tr td table tr .headingchild table tr td #form1 table tr td {
	font-family: Calibri;
	font-size: 14px;
	color: #333;
	font-weight: bold;
}
#conten-wrapper table tr td table tr .headingchild table tr td #form table tr td {
	font-size: 12px;
	font-family: Calibri;
	font-weight: bold;
	color: #333;
}
#navmenu #adminprofil table tr .headingchild {
	font-family: Calibri;
	font-size: 12px;
}
</style></head>

<body onload="MM_preloadImages('img/btn/home2.jpg','img/btn/input2.jpg','img/btn/user2.jpg','img/btn/disclaimerapp2.jpg','img/btn/bantuan2.jpg')">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="240" height="50" bgcolor="#006699"><img src="img/apptemplate/logo.jpg" width="240" height="50" alt="logo" /></td>
    <td bgcolor="#0199CB"><table width="100%" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td width="95%" align="right" valign="top"><a href="<?php echo $logoutAction ?>" class="btn btn-default">Log Out</a></td>
        <td width="5%" align="right" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

<div id="navmenu"><div id="adminprofil"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle" align="center"><p><img src="img/apptemplate/administrator_icon copy.png" width="120" height=120 alt="admin" /></p></td>
  </tr>
  <tr>
    <td align="center">ADMINISTRATOR</td>
  </tr>
  <tr>
    <td align="center" class="headingchild">Aplikasi cDesa V 2.0</td>
  </tr>
</table>
</div>
<a href="index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('home','','img/btn/home2.jpg',1)"><img src="img/btn/slide.jpg" width="240" height="25" /><img src="img/btn/home1.jpg" name="home" width="240" height="40" border="0" id="home" /></a>
<a href="inputData.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('input','','img/btn/input2.jpg',1)"><img src="img/btn/input1.jpg" name="input" width="240" height="40" border="0" id="input" /></a><a href="carimultiple.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('carimultiple','','img/btn/caridatamultiple1.jpg',1)"><img src="img/btn/caridatamultiple2.jpg" name="carimultiple" width="240" height="40" border="0" id="carimultiple" /></a>
<a href="userAuthentification.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('user','','img/btn/user2.jpg',1)"><img src="img/btn/user1.jpg" name="user" width="240" height="40" border="0" id="user" /></a>
<a href="tampilBackupData.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('backup','','img/btn/backupdata1.jpg',1)"><img src="img/btn/backupdatabase2.jpg" name="backup" width="240" height="40" border="0" id="backup" /></a> 
<a href="disclaimer.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('disclaimer','','img/btn/disclaimerapp2.jpg',1)"><img src="img/btn/disclaimerapp1.jpg" name="disclaimer" width="240" height="40" border="0" id="disclaimer" /></a>
<a href="support/PAC.pdf" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('bantuan','','img/btn/bantuan2.jpg',1)"><img src="img/btn/bantuan1.jpg" name="bantuan" width="240" height="40" border="0" id="bantuan" /></a><img src="img/apptemplate/footeras.jpg" width="240" height="73" /></div>
<div id="conten-wrapper"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="569" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="67%" valign="bottom">&nbsp;</td>
        <td width="33%" valign="bottom">&nbsp;</td>
      </tr>
      <tr>
        <td valign="bottom"><span class="Heading">CARI DATA</span> <span class="headingchild">Berdasarkan nomor SPPT</span></td>
        <td><form id="form2" name="form2" method="get" action="tampilCariMultipleSPPTPemilik.php" target="frame3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="93%" valign="top"><div class="form-group input-group">
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Cari Data Berdasarkan Nomor NOP" />
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit" name="Cari" id="Cari">Ok </button>
                </span> </div></td>
            </tr>
          </table>
        </form></td>
      </tr>
    </table>
      <table width="400" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><a href="carimultiple.php" class="btn btn-default">Data Letter C</a></td>
          <td><a href="carimultiplepemilik.php" class="btn btn-primary">Data Pemilik Letter C Setelah 1997</a></td>
        </tr>
        <tr>
          <td width="116">&nbsp;</td>
          <td width="284">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div id="headwrap1"></div></td>
          </tr>
        <tr>
          <td height="463" valign="top" align="right">    <iframe src="kelolapemilik.php" scrolling="yes" width="100%" height="400" frameborder="0" name="frame3"></iframe>
            <p><table width="430" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><a href="carimultiplepemilik.php" class="btn btn-default">Berdasarkan Nama Wajib Pajak</a></td>
          <td><a href="carimultipleNomorSPPT.php" class="btn btn-primary">Berdasarkan Nomor SPPT</a></td>
        </tr>
        <tr>
          <td width="185">&nbsp;</td>
          <td width="135">&nbsp;</td>
        </tr>
      </table></p></td>
          </tr>
</table></td>
  </tr>
</table>
</div>
<script src="plugin/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
<script src="plugin/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
<script src="plugin/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
<script src="plugin/js/custom.js"></script>
</body>
</html>