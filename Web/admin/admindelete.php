<?php 

require ('../koneksi.php');
	$id = $_GET['id'];
	$nama = $row['fullname'];
	$no_hp = $row['no_hp'];
	$alamat = $row['alamat'];
	$username = $row['username'];
	$password = $row['password'];
	$role = $row['role'];
mysqli_query($koneksi, "DELETE FROM admindetail WHERE '$id' = id_admin") or die (mysql_error());
header('Location: adminhome.php ');

?>