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
$pdf->Cell(0, 5, 'Laporan Data Admin', '0', '1', 'L', false); //width, height, text
$pdf->Ln(7); // Line break

$pdf->SetFont('Arial','B',12); //font, style, size
$pdf->Cell(12,6, 'No.',1,0,'C'); //width, height, text
$pdf->Cell(26,6, 'ID Admin',1,0,'C'); //width, height, text
$pdf->Cell(50,6, 'Nama Admin',1,0,'C'); //width, height, text
$pdf->Cell(70,6, 'Alamat',1,0,'C'); //width, height, text
$pdf->Cell(34,6, 'No.HP',1,0,'C'); //width, height, text
$pdf->Cell(35,6, 'Username',1,0,'C'); //width, height, text
$pdf->Cell(35,6, 'Password',1,0,'C'); //width, height, text
$pdf->Cell(12,6, 'Role',1,0,'C'); //width, height, text
$pdf->Ln(2); // Line break

//memanggil data pada database
$no = 0;
$query = mysqli_query($koneksi, "SELECT * FROM admindetail ORDER BY role asc");
while($row = mysqli_fetch_array($query)){
	$no++;
	$pdf->Ln(4);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(12, 6, $no.".", 1, 0, 'C'); //width, height, text
	$pdf->Cell(26, 6, $row['id_admin'], 1, 0, 'C'); //width, height, text
	$pdf->Cell(50, 6, $row['fullname'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(70, 6, $row['alamat'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(34, 6, $row['no_hp'], 1, 0, 'R'); //width, height, text
	$pdf->Cell(35, 6, $row['username'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(35, 6, $row['password'], 1, 0, 'L'); //width, height, text
	$pdf->Cell(12, 6, $row['role'], 1, 0, 'R'); //width, height, text
	$pdf->Ln(2);
}

$pdf->Output();
?>