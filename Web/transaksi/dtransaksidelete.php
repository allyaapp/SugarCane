<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM pesanan WHERE id_pesanan='$id'";
	$result = mysqli_query($koneksi, $query);

	if ($result) {
		header('Location: detailtransaksi.php');
	}else {
		echo "<script type='text/javascript'> alert('The record couldn't be deleted!')</script>";
		echo "<script type='text/javascript'> location='detailtransaksi.php'; </script>";
	}

?>