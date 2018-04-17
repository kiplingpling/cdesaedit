<?php
 
require_once "db.php";
 
// ambil data
$sql = "
SELECT *
FROM
     download2
ORDER BY no
";
$getComboid = mysql_query($sql,$koneksi) or die ('Query Gagal');
?>
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
$host="localhost"; // Host name 
$username="djcomp"; // Mysql username 
$password="qwerty1998"; // Mysql password 
$db_name="etanah"; // Database name 
$tbl_name="assetbaru"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// Get value of id that sent from hidden field 
$id=$_GET['id'];

// Find highest answer number. 
$sql2="SELECT MAX(no) AS Max_no FROM download2";
$result=mysql_query($sql2);
$rows2=mysql_fetch_array($result);

// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1 
if ($rows2) {
$Max_no = $rows2['Max_no']+1;
}
else {
$Max_no = 1;
}

$conn=mysql_connect("localhost","djcomp","qwerty1998") or die(mysql_error());
$sdb=mysql_select_db("etanah",$conn) or die(mysql_error());
if(isset($_POST['submit'])!=""){
$name=$_FILES['photo']['name'];
$size=$_FILES['photo']['size'];
$type=$_FILES['photo']['type'];
$temp=$_FILES['photo']['tmp_name'];
$nomor=addslashes($_POST['id']);
$k_id=$_GET['k_id'];
$no_persil=addslashes($_POST['no_persil']);
$kelas_desa=addslashes($_POST['kelas_desa']);
$luas_tersedia=addslashes($_POST['luas_tersedia']);
$luas_terpindah=addslashes($_POST['luas_terpindah']);
$luas_tersediaupdate=addslashes($_POST['input']);
$luas_sisaupdate=$luas_tersediaupdate-$luas_tersedia;
$luas_sisa=$luas_tersedia-$luas_terpindah;
$ipeda=addslashes($_POST['ipeda']);
$diperoleh=addslashes($_POST['diperolehtampung']);
$tahun=addslashes($_POST['tahuntampung']);
$diperolehsejarah=addslashes($_POST['diperoleh']);
$tahunsejarah=addslashes($_POST['tahun']);
$no_kohir=addslashes($_POST['no_kohir']);
$atasnama=addslashes($_POST['atasnama']);
$dipindah=addslashes($_POST['dipindah']);
$tahun_pindah=addslashes($_POST['tahun_pindah']);
$no_kohir_pindah=addslashes($_POST['no_kohir_pindah']);
$atasnama_pindah=addslashes($_POST['atasnama_pindah']);
$status=addslashes($_POST['status']);
$klasifikasi=addslashes($_POST['klasifikasi']);
$nocdesa=addslashes($_POST['nocdesa']);
$kohirpindahsejarah=addslashes($_POST['notampung']);
$namapindahsejarah=addslashes($_POST['namatampung']);
$namapindah=addslashes($_POST['nama']);
$dari_no=addslashes($_POST['notampung']);
$dari_nama=addslashes($_POST['dari_nama']);
$idcdesa=addslashes($_POST['idcdesa']);
$insert2=mysql_query("insert into download2(no, namapemilik) values('$Max_no','$namapindah')");
$sql1="SELECT id FROM download2 WHERE no='$Max_no' && namapemilik='$namapindah'";
$result=mysql_query($sql1);
$rows1=mysql_fetch_array($result);
$idbaru=$rows1['id'];
if ($luas_sisaupdate) {
$statusupdate ='Sebagian / Min';
}
else {
$statusupdate ='Tidk Aktif';
}

$sql="SELECT MAX(k_id) AS Maxa_id FROM assetbaru WHERE id='$idbaru'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);

// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1 
if ($rows) {
$Max_id = $rows['Maxa_id']+1;
}
else {
$Max_id = 1;
}
$caption1=$_POST['caption'];
$link=$_POST['link'];
move_uploaded_file($temp,"suratbukti/".$name);

$insert=mysql_query("insert into assetbaru(name, id, k_id, no_persil, kelas_desa, luas_tersedia, luas_terpindah, luas_sisa, ipeda, diperoleh, tahun, no_kohir, atasnama, dipindah, tahun_pindah, no_kohir_pindah, atasnama_pindah, status, klasifikasi, nocdesa, idcdesa) values('$name','$idbaru','$Max_id','$no_persil','$kelas_desa','$luas_tersedia','$luas_terpindah','$luas_sisa','$ipeda','$diperolehsejarah','$tahunsejarah','$no_kohir','$dari_nama','$dipindah','$tahun_pindah','$no_kohir_pindah','$atasnama_pindah','$status','$klasifikasi','$nocdesa','$idcdesa')");

$insert3=mysql_query("insert into sejarahbaru(id, k_id, no_persil, kelas_desa, luas_terpindah, metode, tahun, dari_no, dari_nama, ke_no, ke_nama, klasifikasi) values('$id','$k_id','$no_persil','$kelas_desa','$luas_tersedia','$diperolehsejarah','$tahunsejarah','$dari_no','$dari_nama','$Max_no','$namapindah','$klasifikasi')");


$update=mysql_query("Update asset set luas_tersedia='$luas_sisaupdate', luas_terpindah='$luas_tersedia', luas_sisa='$luas_sisaupdate', status='$statusupdate' WHERE k_id='$_GET[k_id]' AND id='$_GET[id]'");

if($insert2 & $insert & $insert3 & $update){
  $insertGoTo = "lihatDetailData.php?id=" . $row_Recordset1['id'] . "";
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  header(sprintf("Location: %s", $insertGoTo));
}
else{
die(mysql_error());
}
}

  mysql_select_db($database_eTanah, $eTanah);
  $Result1 = mysql_query($insertSQL, $eTanah) or die(mysql_error());

  $insertGoTo = "lihatDetailData.php?id=" . $row_Recordset1['id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset1 = "SELECT * FROM asset WHERE k_id='$_GET[k_id]' AND id='$_GET[id]' ORDER BY k_id ASC";
$Recordset1 = mysql_query($query_Recordset1, $eTanah) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset2 = "SELECT * FROM download where id='$_GET[id]'";
$Recordset2 = mysql_query($query_Recordset2, $eTanah) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset3 = "SELECT * FROM download2 where no='$kohirpindah' AND namapemilik='$namapindah'";
$Recordset3 = mysql_query($query_Recordset3, $eTanah) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

mysql_select_db($database_eTanah, $eTanah);
$query_Recordset3 = "SELECT * FROM keterangan WHERE k_id='$_GET[k_id]' AND id='$_GET[id]' ORDER BY k_id ASC";
$Recordset3 = mysql_query($query_Recordset3, $eTanah) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
#form1 table {
	text-align: left;
}
body {
	background-color: #FFF;
}
</style>

<!—Include Script jQuery, sesuaikan nama versi jQuery yang digunakan pada bagian src -->
<script type="text/javascript" src="plugin/js/jquery-1.10.2.js"></script>
 
<!-- Script Ajax untuk Mengontrol Dropdown List Bertingkat -->
<script type="text/javascript">
$(function() {
     $("#no").change(function(){
          $("img#imgLoad").show();
          var no = $(this).val();
 
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "getNamapemilikBaru.php",
             data: "no="+no,
             success: function(msg){
                 if(msg == ''){
                         $("select#nama").html('<option value="">--Pilih Nama WP--</option>');
                        
                 }else{
                           $("select#nama").html(msg);                                                       
                 }
                 $("img#imgLoad").hide();
 
                 getAjaxAlamat();                                                        
             }
          });                    
     });
 
     $("#nama").change(getAjaxAlamat);
     function getAjaxAlamat(){
          $("img#imgLoadMerk").show();
          var idProvinsi = $("#nama").val();
 
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "getKota.php",
             data: "idProvinsi="+idProvinsi,
             success: function(msg){
                 if(msg == ''){
                         $("select#cmbKota").html('<option value="">--Pilih Kota--</option>');                                                                                  
                 }else{
                           $("select#cmbKota").html(msg);                              
                 }
                 $("img#imgLoadMerk").hide();                                                        
             }
          });
     }    
});
</script>
</head>

<body>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
<table width="836" align="left">
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap"><p><strong>PINDAHKAN ASSET TANAH</strong> ( DATA BARU )</p></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap"><strong>Berikut Informasi asset tanah yang akan dipindahkan</strong></td>
    </tr>
    <tr valign="baseline">
      <td width="268" align="left" nowrap="nowrap">No Persil dan Huruf Persil</td>
      <td width="386"><input name="no_persil" type="text" value="<?php echo htmlentities($row_Recordset1['no_persil'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Kelas Desa</td>
      <td><input name="kelas_desa" type="text" value="<?php echo htmlentities($row_Recordset1['kelas_desa'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Dipindah Seluas</td>
      <td><input type="text" name="luas_tersedia" value="" size="32" /> 
      // Luas Tersedia <?php echo htmlentities($row_Recordset1['luas_tersedia'], ENT_COMPAT, 'utf-8'); ?> m2</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Ipeda</td>
      <td><input name="ipeda" type="text" value="<?php echo htmlentities($row_Recordset1['ipeda'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap"><strong>Kemana, kapan dan bagaimanakah asset tanah ini dipindahkan ?</strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Metode Perpindahan Tanah </td>
      <td><select name="diperoleh">
        <option value="-">---Metode---</option>
        <option value="Warisan">Warisan</option>
        <option value="Jual Beli">Jual Beli</option>
        <option value="Hibah">Hibah</option>
        <option value="Sengketa">Sengketa</option>
        <option value="Sertificate">Sertifikat</option>
        <option value="Tukar">Tukar</option>
        <option value="Lainnya">Lainnya</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Tahun</td>
      <td><select name="tahun">
        <option value="-">---Tahun---</option>
        <option value="1997">1997</option>
        <option value="1998">1998</option>
        <option value="1999">1999</option>
        <option value="2000">2000</option>
        <option value="2001">2001</option>
        <option value="2002">2002</option>
        <option value="2003">2003</option>
        <option value="2004">2004</option>
        <option value="2005">2005</option>
        <option value="2006">2006</option>
        <option value="2007">2007</option>
        <option value="2008">2008</option>
        <option value="2009">2009</option>
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
        <option value="2031">2031</option>
        <option value="2032">2032</option>
        <option value="2033">2033</option>
        <option value="2034">2034</option>
        <option value="2035">2035</option>
        <option value="2036">2036</option>
        <option value="2037">2037</option>
        <option value="2038">2038</option>
        <option value="2039">2039</option>
        <option value="2040">2040</option>
        <option value="2041">2041</option>
        <option value="2042">2042</option>
        <option value="2043">2043</option>
        <option value="2044">2044</option>
        <option value="2045">2045</option>
        <option value="2046">2046</option>
        <option value="2047">2047</option>
        <option value="2048">2048</option>
        <option value="2049">2049</option>
        <option value="2050">2050</option>
        <option value="2051">2051</option>
        <option value="2052">2052</option>
        <option value="2053">2053</option>
        <option value="2054">2054</option>
        <option value="2055">2055</option>
        <option value="2056">2056</option>
        <option value="2057">2057</option>
        <option value="2058">2058</option>
        <option value="2059">2059</option>
        <option value="2060">2060</option>
        <option value="2061">2061</option>
        <option value="2062">2062</option>
        <option value="2063">2063</option>
        <option value="2064">2064</option>
        <option value="2065">2065</option>
        <option value="2066">2066</option>
        <option value="2067">2067</option>
        <option value="2068">2068</option>
        <option value="2069">2069</option>
        <option value="2070">2070</option>
        <option value="2071">2071</option>
        <option value="2072">2072</option>
        <option value="2073">2073</option>
        <option value="2074">2074</option>
        <option value="2075">2075</option>
        <option value="2076">2076</option>
        <option value="2077">2077</option>
        <option value="2078">2078</option>
        <option value="2079">2079</option>
        <option value="2080">2080</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Atas Nama</td>
      <td><input type="text" name="nama" id="nama" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap"><strong>Klasifikasi asset tanah yang akan dipindahkan</strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Klasifikasi :</td>
      <td><input name="klasifikasi" type="text" value="<?php echo htmlentities($row_Recordset1['klasifikasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" readonly="readonly" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="left" nowrap="nowrap"><strong>Tambahkan surat perjanjian sebagai bukti tanah ini milik <?php echo $row_Recordset2['namapemilik']; ?></strong><strong></strong></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Upload Bukti :</td>
      <td><label for="photo"></label><input type="file" name="photo" id="photo" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><em>** File Berbentuk pdf</em></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><button type="submit" name="submit" id="submit" class="btn btn-default" onclick="return confirm('Pastikan semua data benar sebelum Anda menyimpan, karena operasi tidak bisa dibatalkan setelah Anda menyimpan. Apakah anda yakin ingin memindah Asset <?php echo $row_Recordset1['no_persil']; ?> milik <?php echo $row_Recordset2['namapemilik']; ?> ?')">Simpan</button>
                      <button type="reset" name="reset" id="reset" class="btn btn-primary">Batal</button></td>
    </tr>
  </table>
<input type="hidden" name="id" value="<?php echo $row_Recordset3['id']; ?>" size="32" />
<input type="hidden" name="idcdesa" value="<?php echo $row_Recordset2['id']; ?>" size="32" />
<input type="hidden" name="MM_insert" value="form1" />
<input type="hidden" name="dipindah" value="" size="32" />
<input type="hidden" name="notampung" value="" size="32" />
<input type="hidden" name="namatampung" value="" size="32" />
<input type="hidden" name="diperolehtampung" value="" size="32" />
<input type="hidden" name="tahuntampung" value="" size="32" />
<input type="hidden" name="tahun_pindah" value="" size="32" />
<input type="hidden" name="no_kohir" value="" size="32" />
<input type="hidden" name="atasnama" value="" size="32" />
<input type="hidden" name="nocdesa" value="<?php echo $row_Recordset2['no']; ?>" size="32" />
<input type="hidden" name="dari_nama" value="<?php echo $row_Recordset2['namapemilik']; ?>" size="32" />
<input type="hidden" name="status" value="Aktif" size="32" />
<input type="hidden" name="luas_terpindah" value="" size="32" />
<input type="hidden" name="no_kohir_pindah" value="" size="32" />
<input type="hidden" name="atasnama_pindah" value="" size="32" />
<input type="hidden" name="input" value="<?php echo htmlentities($row_Recordset1['luas_tersedia'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
