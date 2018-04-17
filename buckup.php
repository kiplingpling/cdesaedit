<html>
<head>
	<title>Backup Databas</title>
	<link href="plugin/eTanah.css" rel="stylesheet" type="text/css">
	<link href="plugin/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="plugin/custom.css" rel="stylesheet" type="text/css">
	<link href="plugin/font-awesome.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="" method="post" name="postform">
	<div align="center">
	  <h4>
	  	<b>Silahkan klik tombol dibawah ini untuk memulai backup atau menyadangkan database cdesa anda !</b>
	  </h4>
	  <br>
	    <button type="submit" name="backup"  onClick="return confirm('Apakah Anda yakin ingin backup data ?')" class="btn btn-primary btn-lg" style="border-radius: 70%">
	    	<span class="text-center">
	    		<i class="fas fa-cloud-download-alt fa-4x"></i><br>Backup
	    	</span>
	    </button>
	  
  </div>
</form>

<?php
if(isset($_POST['backup'])){

	//membuat nama file
	$file=date("DdMY").'_cdesa_backup_data_'.time().'.sql';
	
	//panggil fungsi dengan memberi parameter untuk koneksi dan nama file untuk backup
	backup_tables("localhost","djcomp","qwerty1998","etanah",$file);
	
	?>
<!-- <p align="center">&nbsp;</p>
	<p align="center"><a style="cursor:pointer" onClick="location.href='download_backup_data.php?nama_file=<?php echo $file;?>'" title="Download">Backup database telah selesai. <font color="#0066FF">Download file database</font></a>
</p> -->
<div class="container text-center">
	<div class="alert alert-success" style="font-size: 20px;">
		<b>Database Berhasil di Backup. 
		Silahkan Download 
		<a style="cursor:pointer; color: #FFF; text-decoration: underline;" onClick="location.href='download_backup_data.php?nama_file=<?php echo $file;?>'" title="Download">Disini</a>
		</b>
	</div>
</div>
	<?php
}else{
	unset($_POST['backup']);
}

/*
untuk memanggil nama fungsi :: jika anda ingin membackup semua tabel yang ada didalam database, biarkan tanda BINTANG (*) pada variabel $tables = '*'
jika hanya tabel-table tertentu, masukan nama table dipisahkan dengan tanda KOMA (,) 
*/
function backup_tables($host,$user,$pass,$name,$nama_file,$tables = '*')
{
	//untuk koneksi database
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}else{
		//jika hanya table-table tertentu
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//looping dulu ah
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		//menyisipkan query drop table untuk nanti hapus table yang lama
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				//menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat. so toy mode : ON
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					//akan menelusuri setiap baris query didalam
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//simpan file di folder yang anda tentukan sendiri. kalo saya sech folder "DATA"
	$nama_file;
	
	$handle = fopen('./backup/'.$nama_file,'w+');
	fwrite($handle,$return);
	fclose($handle);
}
?>
<script src="plugin/fontawesome-all.min.js"></script>
</body>
</html>

