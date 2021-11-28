<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$query = "DELETE FROM user WHERE id_user='$id'";
	$result = mysqli_query($koneksi, $query);

	header('Location: userhome.php ');

?>