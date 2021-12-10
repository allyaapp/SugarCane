<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM barang WHERE id_barang='$id'";
	$result = mysqli_query($koneksi, $query);

	if ($result) {
		header('Location: baranghome.php');
	} else {
		echo "<script type='text/javascript'> alert('The record couldn't be deleted!!') </script>";
		echo "<script type='text/javascript'> location='baranghome.php'; </script>";
	}

?>