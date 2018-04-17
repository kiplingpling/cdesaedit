<?php require_once('Connections/eTanah.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>
  <?
if(isset($_POST['submit'])!=""){
$name=$_FILES['photo']['name'];
$size=$_FILES['photo']['size'];
$type=$_FILES['photo']['type'];
$temp=$_FILES['photo']['tmp_name'];
$caption1=$_POST['caption'];
$link=$_POST['link'];
move_uploaded_file($temp,"sppt/".$name);
$insert=mysql_query("UPDATE download2 SET name='$name' WHERE id='$_GET[id]'");
if($insert){
echo 'Terimaksih data Anda telah diperbarui !';
}
else{
die(mysql_error());
}
}
?>
</p>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
  <table width="400" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="137">Upload SPPT Baru</td>
      <td width="263"><label for="photo"></label><input type="file" name="photo" id="photo" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" id="submit" value="Simpan" />
        <a href="kelolapemilik.php">Kembali</a></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>