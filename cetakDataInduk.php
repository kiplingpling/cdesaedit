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
 
mysql_select_db($database_eTanah, $eTanah);
$query_Recordset2 = "SELECT * FROM kopsurat where id=1 ORDER BY id ASC";
$Recordset2 = mysql_query($query_Recordset2, $eTanah) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
 
#ambil data di tabel dan masukkan ke array
$query = "SELECT no, namapemilik, keterangan FROM download ORDER BY no ASC";
$sql = mysql_query ($query);
$data = array();
while ($row = mysql_fetch_assoc($sql)) {
	array_push($data, $row);
}
 
#setting judul laporan dan header tabel
$kop = addslashes($row_Recordset2['kopkab']);
$kopkec = addslashes($row_Recordset2['kopkec']);
$nama = addslashes($row_Recordset2['kopdes']);
$alamat = addslashes($row_Recordset2['alamat']);
$email = addslashes($row_Recordset2['email']);
$judul = "Laporan";
$childlaporan = "Data Induk Letter C Desa";
$footer = "Data ini dicetak menggunakan aplikasi cDesa";
$header = array(
		array("label"=>"No Kohir", "length"=>20, "align"=>"L"),
		array("label"=>"Nama Pemilik", "length"=>80, "align"=>"L"),
		array("label"=>"Keterangan", "length"=>90, "align"=>"L")
	);
 
#sertakan library FPDF dan bentuk objek
require_once ("fpdf/fpdf.php");
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
 
#tampilkan judul laporan
$pdf->image('img/btn/logo.png',11,8);
$pdf->SetFont('Arial','B','14');
$pdf->Cell(0,2, $kop, '0', 1, 'C');
$pdf->SetFont('Arial','B','12');
$pdf->Cell(0,10, $kopkec, '0', 1, 'C');
$pdf->SetFont('Arial','B','16');
$pdf->Cell(0,2, $nama, '0', 1, 'C');
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,8, $alamat, '0', 1, 'C');
$pdf->SetFont('Arial','I','10');
$pdf->Cell(0,0, $email, '0', 1, 'C');
$pdf->image('img/btn/garis.jpg',11,37);
$pdf->SetFont('Arial','B','13');
$pdf->Cell(0,20, '', '0', 1, 'C');
$pdf->SetFont('Arial','B','13');
$pdf->Cell(0,0, $judul, '0', 1, 'C');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,10, $childlaporan, '0', 1, 'C');
$pdf->SetFont('Arial','B','13');
$pdf->Cell(0,8, '', '0', 1, 'C');
 
#buat header tabel
$pdf->SetFont('Arial','','11');
$pdf->SetFillColor(204,204,204);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header as $kolom) {
	$pdf->Cell($kolom['length'], 10, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
 
#tampilkan data tabelnya
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetFont('Arial','','11');
$fill=false;
foreach ($data as $baris) {
	$i = 0;
	foreach ($baris as $cell) {
		$pdf->Cell($header[$i]['length'], 8, $cell, 1, '0', $kolom['align'], $fill);
		$i++;
	}
	$fill = !$fill;
	$pdf->Ln();
}

$pdf->SetFont('Arial','','10');
$pdf->Cell(0,10, $subjudul2, '0', 1, 'L');

$pdf->SetFont('Arial','','7');
$pdf->Cell(0,0, $footer, '0', 1, 'L');
#output file PDF
$pdf->Output();

mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
?>
