<?php require_once('Connections/eTanah.php'); ?>
<?php require_once('Connections/eTanah.php'); ?>
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
$query_Recordset1 = "SELECT * FROM reg ORDER BY idreg ASC";
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "coba.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_eTanah, $eTanah);
  
  $LoginRS__query=sprintf("SELECT username, password FROM pengguna WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $eTanah) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8" /> 
    <title>Login</title>
    <link rel="shortcut icon" href="img/apptemplate/ico.png" />
    <link rel="stylesheet" type="text/css" href="plugin/css/loginstyle.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body,td,th {
	font-family: HelveticaNeue-Light, "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
}
body {
	background-color: #CCC;
	background-image: url(img/apptemplate/anigifbacg.gif);
}
</style>
</head>
<body>

<p>&nbsp;</p>
<p align="center"><strong>N E G A R A &nbsp;&nbsp;  K E S A T U A N &nbsp;&nbsp;  R E P U B L I K &nbsp;&nbsp;  I N D O N E S I A</strong></p>
<p align="center">&nbsp;</p>
<p align="center">** Menuju Indonesia Hebat **</p>
<p>&nbsp;</p>
<p align="center">** Maaf username atau password anda tidak valid</p>
<p align="center">Silahkan masukkan kembali !</p>
<form name="form" ACTION="<?php echo $loginFormAction; ?>" METHOD="POST">
  <h1><img src="img/apptemplate/login.png" width="286" height="53"></h1>
<p>&nbsp;</p>
    <p align="center">Pemerintah Desa <? echo $row_Recordset1['namadesa']; ?></p>
        <p>&nbsp;</p>
  <div class="inset">
  <p>
    <label for="email">U S E R N A M E</label>
    <input type="text" name="email" id="email">
  </p>
  <p>
    <label for="password">P A S S W O R D</label>
    <input type="password" name="password" id="password">
    <font style="color:#FFF">© 2017 DJ Computer Indonesia.</font></p>
</div>
  <p class="p-container">
    <span>Selamat berselancar !</span>
    <input type="submit" name="go" id="go" value="Log in">
  </p>
  <p class="p-container">&nbsp;</p>
</form>
<p align="center"><strong>D J &nbsp; &nbsp; C O M P U T E R &nbsp; &nbsp; I N D O N E S I A</strong></p>
<p align="center">&nbsp;</p>
<p align="center">Aplikasi ini dikembangkan oleh DJ Computer Indonesia yang digunakan untuk pengelolaan</p>
<p align="center">administrasi pertanahan desa di seluruh Indonesia khususnya data yang terdapat</p>
<p align="center">dalam buku letter C. © Hak cipta milik DJ Computer Indonesia.</p>
<p align="center">&nbsp;</p>
<p align="center">-- CEO &amp; Founder ( Juni Prayitno )</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
