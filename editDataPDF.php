<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="plugin/bootstrap.min.css" />
<title>Untitled Document</title>
</head>

<body>
  <div style="margin-left: 25px; margin-right: 25px;">
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
  <h3><b>Upload Data Baru</b></h3>
  <div class="form-group">
    <input type="file" name="photo" id="photo" class="form-control" />
  </div>
  <button type="submit" name="submit" id="submit" class="btn btn-primary">
    <i class="fas fa-save"></i> Simpan
  </button>
  <a href="kelola.php" class="btn btn-default">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>

</form>
<br />


  <?
$conn=mysql_connect("localhost","djcomp","qwerty1998") or die(mysql_error());
$sdb=mysql_select_db("etanah",$conn) or die(mysql_error());
if(isset($_POST['submit'])!=""){
$name=$_FILES['photo']['name'];
$size=$_FILES['photo']['size'];
$type=$_FILES['photo']['type'];
$temp=$_FILES['photo']['tmp_name'];
$caption1=$_POST['caption'];
$link=$_POST['link'];
move_uploaded_file($temp,"files/".$name);
$insert=mysql_query("UPDATE download SET name='$name' WHERE id='$_GET[id]'");
if($insert){
echo '<div class="alert alert-success" style="font-size: 20px;">';
echo '<strong>SUKSES !</strong> Terimaksih data Anda telah diperbarui';
echo '</div>';
}
else{
die(mysql_error());
}
}
?>


</div>
<script src="plugin/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
<script src="plugin/js/bootstrap.min.js"></script>
<script src="plugin/fontawesome-all.min.js"></script>
</body>
</html>