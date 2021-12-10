<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM detailukuran WHERE id_detailukuran='$id'";
	$result = mysqli_query($koneksi, $query);

	if ($result) {
		header('Location: detailukuran.php ');
	}else {
		echo "<script type='text/javascript'> alert('The record couldn't be deleted!')</script>";
		echo "<script type='text/javascript'> location='detailukuran.php'; </script>";
	}

?>