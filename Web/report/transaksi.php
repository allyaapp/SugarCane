<?php
require('../fpdf/fpdf.php');
require('../koneksi.php');

$pdf = new FPDF();
$pdf->AddPage('l', 'A4', 0);

//header
$pdf->SetFont('Arial', 'B', 18); //font, style, size
$pdf->Cell(0, 5, 'SugarCane Report', '0', '1', 'C', false);
$pdf->Image('../images/logo.png',15,2,28); //margin kiri, pojok kiri, ukuran
$pdf->Ln(1); // Line break

$pdf->SetFont('Arial', 'B', 10); //font, style, size
$pdf->SetFont(''); //menghapus bold
$pdf->Cell(0, 5, 'Alamat : Jln. Mastrip Perum Villa Kembang Asri Blok AB-04 Sukowiryo, Bondowoso', '0', '1', 'C', false);
$pdf->Cell(0, 5, 'No. HP : 085781203604', '0', '1', 'C', false);
$pdf->Ln(3); // Line break
$pdf->Cell(275, 0.6, '', '0', '1', 'C', true);
$pdf->Ln(7); // Line break

//body
$pdf->SetFont('Arial', 'B', 12); //font, style, size
$pdf->Cell(0, 5, 'Laporan Data Transaksi', '0', '1', 'L', false); //width, height, text
$pdf->Ln(7); // Line break

$pdf->SetFont('Arial','B',11); //font, style, size
$pdf->Cell(12,6, 'No.',1,0,'C'); //width, height, text
$pdf->Cell(33,6, 'ID Transaksi',1,0,'C'); //width, height, text
$pdf->Cell(40,6, 'Nama User',1,0,'C'); //width, height, text
$pdf->Cell(65,6, 'Alamat',1,0,'C'); //width, height, text
$pdf->Cell(31,6, 'No. HP',1,0,'C'); //width, height, text
$pdf->Cell(35,6, 'Tgl Transaksi',1,0,'C'); //width, height, text
$pdf->Cell(29,6, 'Ongkir',1,0,'C'); //width, height, text
$pdf->Cell(29,6, 'Total Harga',1,0,'C'); //width, height, text
$pdf->Ln(2); // Line break

//memanggil data pada database
$no = 0;
$query = mysqli_query($koneksi, 
	"SELECT transaksi.id_transaksi, transaksi.id_user, user.id_user, user.nama, user.alamat, user.no_hp, transaksi.tgltransaksi, transaksi.ongkir, transaksi.totalharga 
	FROM transaksi 
    INNER JOIN user ON transaksi.id_user = user.id_user 
	ORDER BY tgltransaksi asc");

while($row = mysqli_fetch_array($query)){
	$no++;
	$pdf->Ln(4);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(12, 6, $no.".", 1, 0, 'C'); //width, height, text
	$pdf->Cell(33, 6, $row['id_transaksi'], 1, 0, 'C'); //width, height, text
	$pdf->Cell(40, 6, $row['nama'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(65, 6, $row['alamat'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(31, 6, $row['no_hp'], 1, 0, 'R'); //width, height, text
	$pdf->Cell(35, 6, $row['tgltransaksi'], 1, 0, 'R'); //width, height, text
	$pdf->Cell(29, 6, $row['ongkir'], 1, 0, 'R'); //width, height, text
	$pdf->Cell(29, 6, $row['totalharga'], 1, 0, 'R'); //width, height, text

	$pdf->Ln(2);
}

$pdf->Output();
?>