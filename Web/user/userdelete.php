<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$result = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
    $row = mysqli_fetch_array($result);
	$pict = $row['foto'];
	unlink('../images/user/'.$pict);

	$query = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'");

	if (!$query) {
		echo "<script type='text/javascript'> alert('The record could not be deleted!') </script>";
		echo "<script type='text/javascript'> location='userhome.php'; </script>";
	}else {
		header('Location: userhome.php');
	}

?>