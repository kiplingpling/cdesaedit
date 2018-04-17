<?php
 
ini_set('display_errors',0);
require_once "db.php";
 
//ambil parameter
$id = $_POST['id'];
 
if($id == ''){
     exit;
}else{
     $sql = "
          SELECT
               id
          FROM
               download
          WHERE
               id = = '$id'
          ORDER BY id
     ";
     $getId = mysql_query($sql,$koneksi) or die ('Query Gagal');
     while($data = mysql_fetch_array($getId)){
          echo '<option value="'.$data['id'].'">'.$data['id'].'</option>';
     }
     exit;    
}
?>