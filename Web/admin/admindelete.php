<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM admindetail WHERE id_admin='$id'");
    $row = mysqli_fetch_array($result);
	$pict = $row['foto'];
	unlink('../images/admin/'.$pict);

	$query = mysqli_query($koneksi, "DELETE FROM admindetail WHERE id_admin='$id'");

	if ($query) {
		header('Location: adminhome.php');
	}else {
		echo "<script> alert('The record couldn't be deleted!')</script>";
		echo "<script> location='adminhome.php'; </script>";
	}

?>