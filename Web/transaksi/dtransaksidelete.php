<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM detailtransaksi WHERE id_detailtransaksi='$id'";
	$result = mysqli_query($koneksi, $query);

	header('Location: detailtransaksi.php ');

?>