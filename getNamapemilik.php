<?php
 
ini_set('display_errors',0);
require_once "db.php";
 
//ambil parameter
$no = $_POST['no'];
 
if($no == ''){
     exit;
}else{
     $sql = "
          SELECT
		       no,
               namapemilik
          FROM
               download
          WHERE
               no = '$no'
          ORDER BY namapemilik
     ";
     $getNamapemilik = mysql_query($sql,$koneksi) or die ('Query Gagal');
     while($data = mysql_fetch_array($getNamapemilik)){
          echo '<option value="'.$data['namapemilik'].'">'.$data['namapemilik'].'</option>';
     }
     exit;    
}
?>