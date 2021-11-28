<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM detailukuran WHERE id_detailukuran='$id'";
	$result = mysqli_query($koneksi, $query);

	header('Location: detailukuran.php ');

?>