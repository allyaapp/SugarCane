<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM transaksi WHERE id_transaksi='$id'";
	$result = mysqli_query($koneksi, $query);

	header('Location: transaksihome.php ');

?>