<?php

require_once "core/init.php";

$kode = $_GET['kode'];

$sql = tampilkan_per_kode($kode);
$data = mysqli_fetch_assoc($sql);
if(is_file("image/".$data['gambar'])){
unlink("image/".$data['gambar']);
}
if (isset($_GET['kode'])) {
	if (hapus_data($_GET['kode'])) {
		echo "<script> alert ('Artikel Berhasil Dihapus'); document.location='index.php'</script>";
	}else{
		echo "<script> alert ('Artikel Gagal Dihapus'); document.location='tampil.php'</script>";
	}
}

 ?>
