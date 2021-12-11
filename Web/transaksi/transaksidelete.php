<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM transaksi WHERE id_transaksi='$id'";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "<script type='text/javascript'> alert('The record could not be deleted!') </script>";
		echo "<script type='text/javascript'> location='transaksihome.php'; </script>";
	}else {
		header('Location: transaksihome.php');
	}

?>