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
$pdf->Cell(0, 5, 'Alamat : Jl.XXXXXX No.00, Bondowoso', '0', '1', 'C', false);
$pdf->Cell(0, 5, 'No. HP : 080000000000', '0', '1', 'C', false);
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
$pdf->Cell(35,6, 'Varian Rasa',1,0,'C'); //width, height, text
$pdf->Cell(30,6, 'Ukuran',1,0,'C'); //width, height, text
$pdf->Cell(30,6, 'Det.Ukuran',1,0,'C'); //width, height, text
$pdf->Cell(35,6, 'Ukuran Cup',1,0,'C'); //width, height, text
$pdf->Cell(35,6, 'Harga Satuan',1,0,'C'); //width, height, text
$pdf->Cell(20,6, 'Qty',1,0,'C'); //width, height, text
$pdf->Cell(35,6, 'Sub Harga',1,0,'C'); //width, height, text
$pdf->Ln(2); // Line break

//memanggil data pada database
$no = 0;
$query = mysqli_query($koneksi, 
	"SELECT pesanan.id_pesanan, pesanan.id_transaksi, pesanan.id_barang, transaksi.id_transaksi, barang.id_barang, barang.varian, barang.ukuran, barang.id_detailukuran, detailukuran.id_detailukuran, detailukuran.varianukuran, detailukuran.harga, pesanan.qty, pesanan.subharga
    FROM pesanan
    INNER JOIN transaksi ON pesanan.id_transaksi = transaksi.id_transaksi
    INNER JOIN barang ON pesanan.id_barang = barang.id_barang
    INNER JOIN detailukuran ON barang.id_detailukuran = detailukuran.id_detailukuran
	ORDER BY tgltransaksi asc");

while($row = mysqli_fetch_array($query)){
	$no++;
	$pdf->Ln(4);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(12, 6, $no.".", 1, 0, 'C'); //width, height, text
	$pdf->Cell(33, 6, $row['id_transaksi'], 1, 0, 'C'); //width, height, text
	$pdf->Cell(35, 6, $row['varian'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(30, 6, $row['ukuran'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(30, 6, $row['id_detailukuran'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(35, 6, $row['varianukuran'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(35, 6, $row['harga'], 1, 0, 'R'); //width, height, text
	$pdf->Cell(20, 6, $row['qty'], 1, 0, 'R'); //width, height, text
	$pdf->Cell(35, 6, $row['subharga'], 1, 0, 'R'); //width, height, text

	$pdf->Ln(2);
}

$pdf->Output();
?>