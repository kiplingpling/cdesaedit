<html>
<head>
	<title>Recovery Database</title>
	<link href="plugin/bootstrap.min.css" rel="stylesheet" type="text/css">
</title>
</title>
<body>


<div class="container">
	<div class="text-center">
		<h4><b>
			Silahkan Pilih File Untuk Merestore Database.
		</b></h4>
	
		<br>
		<form enctype="multipart/form-data" action="recovery_data.php" method="post">
			<div class="form-group">
				<input type="file" name="datafile" class="form-control" id="gambar" />
			</div>
			<button type="submit" onClick="return confirm('Apakah Anda yakin akan restore database?')" name="restore" class="btn btn-warning btn-lg" style="border-radius: 70%;" >
				<i class="fas fa-cloud-upload-alt fa-3x"></i>
				<br>Restore
			</button>

		</form>
	</div>
</div>

<!-- <form enctype="multipart/form-data" action="recovery_data.php" method="post">
	<p align="center">Silahkan klik tombol dibawah ini untuk memulai merestore atau mengembalikan database cdesa anda yang pernah di backup !</p>
	<p align="center">&nbsp;</p>
	<table align="center">
	<tr><td>File Backup Database (*.sql) <input type="file" name="datafile" size="30" id="gambar" /></td></tr>
	<tr><td><input type="submit" onClick="return confirm('Apakah Anda yakin akan restore database?')" name="restore" value="Restore Database" /></td>
	</tr>
	</table>
</form> -->


<?php
if(isset($_POST['restore'])){
	$koneksi=mysql_connect("localhost","djcomp","qwerty1998");
	mysql_select_db("etanah",$koneksi);
	
	$nama_file=$_FILES['datafile']['name'];
	$ukuran=$_FILES['datafile']['size'];
	
	//periksa jika data yang dimasukan belum lengkap
	if ($nama_file=="")
	{
		echo "Fatal Error";
	}else{
		//definisikan variabel file dan alamat file
		$uploaddir='./restore/';
		$alamatfile=$uploaddir.$nama_file;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
		{
			
			$filename = './restore/'.$nama_file.'';
			
			// Temporary variable, used to store current query
			$templine = '';
			// Read in entire file
			$lines = file($filename);
			// Loop through each line
			foreach ($lines as $line)
			{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
			 
				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					// Perform the query
					mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
					// Reset temp variable to empty
					$templine = '';
				}
			} ?>

<div class="container text-center">
	<div class="alert alert-success" style="font-size: 20px;">
		<b>Database Berhasil di Restore. Silahkan Dicek</b>
	</div>
</div>
		
		<?php }else{
			//jika gagal
			echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
		}	
	}

}else{
	unset($_POST['restore']);
}
?>
<script src="plugin/fontawesome-all.min.js"></script>
</body>
</head>

	