<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM barang WHERE id_barang='$id'";
	$result = mysqli_query($koneksi, $query);

	header('Location: baranghome.php ');

?>