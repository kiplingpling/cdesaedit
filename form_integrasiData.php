<?php
 
require_once "db.php";
 
// ambil data
$sql = "
SELECT *
FROM
     download
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
$tbl_name="asset"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// Get value of id that sent from hidden field 
$id=$_GET['id'];


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
$diperoleh=addslashes($_POST['diperoleh']);
$tahun=addslashes($_POST['tahun']);
$no_kohir=addslashes($_POST['no_kohir']);
$atasnama=addslashes($_POST['atasnama']);
$dipindah=addslashes($_POST['dipindah']);
$tahun_pindah=addslashes($_POST['tahun_pindah']);
$no_kohir_pindah=addslashes($_POST['no_kohir_pindah']);
$atasnama_pindah=addslashes($_POST['atasnama_pindah']);
$status=addslashes($_POST['status']);
$klasifikasi=addslashes($_POST['klasifikasi']);
$kohirpindah=addslashes($_POST['no']);
$namapindah=addslashes($_POST['nama']);
$sql1="SELECT id FROM download WHERE no='$kohirpindah' && namapemilik='$namapindah'";
$result=mysql_query($sql1);
$rows1=mysql_fetch_array($result);
$idbaru=$rows1['id'];
if ($luas_sisaupdate) {
$statusupdate ='Aktif Sebagian';
}
if ($luas_sisaupdate<0) {
$statusupdate ='Minus / Tdk Sinkron';
}
else {
$statusupdate ='Tidak Aktif';
}
// Find highest answer number. 
$sql="SELECT MAX(k_id) AS Maxa_id FROM $tbl_name WHERE id='$idbaru'";
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
$insert=mysql_query("insert into asset(name, id, k_id, no_persil, kelas_desa, luas_tersedia, luas_terpindah, luas_sisa, ipeda, diperoleh, tahun, no_kohir, atasnama, dipindah, tahun_pindah, no_kohir_pindah, atasnama_pindah, status, klasifikasi, nocdesa, namapemilik) values('$name','$idbaru','$Max_id','$no_persil','$kelas_desa','$luas_tersedia','$luas_terpindah','$luas_sisa','$ipeda','$diperoleh','$tahun','$no_kohir','$atasnama','$dipindah','$tahun_pindah','$no_kohir_pindah','$atasnama_pindah','$status','$klasifikasi','$kohirpindah','$namapindah')");
$insert2=mysql_query("insert into keterangan(id, k_id, no_persil, kelas_desa, luas_terpindah, ipeda, dipindah, tahun_pindah, no_kohir_pindah, atasnama_pindah, klasifikasi) values('$id','$k_id','$no_persil','$kelas_desa','$luas_tersedia','$ipeda','$diperoleh','$tahun','$kohirpindah','$namapindah','$klasifikasi')");
$update=mysql_query("Update asset set luas_tersedia='$luas_sisaupdate', luas_terpindah='$luas_tersedia', luas_sisa='$luas_sisaupdate', status='$statusupdate' WHERE k_id='$_GET[k_id]' AND id='$_GET[id]'");
if($insert && $insert2 && $update){
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
$query_Recordset3 = "SELECT * FROM download where no='$kohirpindah' AND namapemilik='$namapindah'";
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
             url: "getNamapemilik.php",
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
      <td colspan="2" align="left" nowrap="nowrap"><p><strong>PINDAHKAN ASSET TANAH</strong></p></td>
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
        <option value="Tukar">Tukar</option>
	<option value="Wakaf">Wakaf</option>
	<option value="Lainnya">Lainnya</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Tahun</td>
      <td><select name="tahun">
        <option value="-">---Tahun---</option>
        <option value="1935">1935</option>
        <option value="1936">1936</option>
        <option value="1937">1937</option>
        <option value="1938">1938</option>
        <option value="1939">1939</option>
        <option value="1940">1940</option>
        <option value="1941">1941</option>
        <option value="1942">1942</option>
        <option value="1943">1943</option>
        <option value="1944">1944</option>
        <option value="1945">1945</option>
        <option value="1946">1946</option>
        <option value="1947">1947</option>
        <option value="1948">1948</option>
        <option value="1949">1949</option>
        <option value="1950">1950</option>
        <option value="1951">1951</option>
        <option value="1952">1952</option>
        <option value="1953">1953</option>
        <option value="1954">1954</option>
        <option value="1955">1955</option>
        <option value="1956">1956</option>
        <option value="1957">1957</option>
        <option value="1958">1958</option>
        <option value="1959">1959</option>
        <option value="1960">1960</option>
        <option value="1961">1961</option>
        <option value="1962">1962</option>
        <option value="1963">1963</option>
        <option value="1964">1964</option>
        <option value="1965">1965</option>
        <option value="1966">1966</option>
        <option value="1967">1967</option>
        <option value="1968">1968</option>
        <option value="1969">1969</option>
        <option value="1970">1970</option>
        <option value="1971">1971</option>
        <option value="1972">1972</option>
        <option value="1973">1973</option>
        <option value="1974">1974</option>
        <option value="1975">1975</option>
        <option value="1976">1976</option>
        <option value="1977">1977</option>
        <option value="1978">1978</option>
        <option value="1979">1979</option>
        <option value="1980">1980</option>
        <option value="1981">1981</option>
        <option value="1982">1982</option>
        <option value="1983">1983</option>
        <option value="1984">1984</option>
        <option value="1985">1985</option>
        <option value="1986">1986</option>
        <option value="1987">1987</option>
        <option value="1988">1988</option>
        <option value="1989">1989</option>
        <option value="1990">1990</option>
        <option value="1991">1991</option>
        <option value="1992">1992</option>
        <option value="1993">1993</option>
        <option value="1994">1994</option>
        <option value="1995">1995</option>
        <option value="1996">1996</option>
        <option value="1997">1997</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">No Kohir</td>
      <td><select name="no" id="no">
<option value="">--Pilih Kohir--</option>
<?php
                                   while($data = mysql_fetch_array($getComboid)){
                                        echo '<option value="'.$data['no'].'">'.$data['no'].'</option>';
                                   }
                              ?>
</select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Atas Nama</td>
      <td><select name="nama" id="nama">
<option value="">--Pilih Nama WP--</option>
<?php
                                   while($data = mysql_fetch_array($getnamaid)){
                                        echo '<option value="'.$data['namapemilik'].'">'.$data['namapemilik'].'</option>';
                                   }
                              ?>
</select></td>
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
<input type="hidden" name="MM_insert" value="form1" />
<input type="hidden" name="dipindah" value="-" size="32" />
<input type="hidden" name="tahun_pindah" value="-" size="32" />
<input type="hidden" name="no_kohir" value="<?php echo $row_Recordset2['no']; ?>" size="32" />
<input type="hidden" name="atasnama" value="<?php echo $row_Recordset2['namapemilik']; ?>" size="32" />
<input type="hidden" name="status" value="Aktif" size="32" />
<input type="hidden" name="luas_terpindah" value="" size="32" />
<input type="hidden" name="no_kohir_pindah" value="-" size="32" />
<input type="hidden" name="atasnama_pindah" value="-" size="32" />
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
