<?php

function tampilkan(){

	$query  = "SELECT * FROM data_karyawan";
	return result($query);
}

function tampilkan_per_kode($kode){

	$query  = "SELECT * FROM data_karyawan WHERE kode='$kode'";
	return result($query);
}

function tampil_wilayah($filter){
	$query = "SELECT * FROM data_karyawan WHERE wilayah='$filter'";
	return result($query);
}

function tampil_urut(){
	$query = "SELECT * FROM data_karyawan ORDER BY nama ASC";
	return result($query);
}

function cari_nama($cari){
	$query = "SELECT * FROM data_karyawan WHERE nama LIKE '%$cari%'";
	return result($query);
}

function result($query){
	global $link;

	if ($result = mysqli_query($link, $query) or die('gagal menampilkan data')) {

		return $result;

	}

}

function tambah_data($kode, $nama, $alamat, $gaji, $status, $wilayah, $sex, $gambar, $notelp){
  $kode = escape($kode);
  $nama = escape($nama);
  $alamat = escape($alamat);
  $gaji = escape($gaji);
  $status = escape($status);
  $wilayah = escape($wilayah);
  $sex = escape($sex);
  $gambar = escape($gambar);
  $notelp = escape($notelp);


  $query = "INSERT INTO data_karyawan (kode, nama, alamat, gaji, status, wilayah, sex, gambar, no_telp) VALUES
            ('$kode','$nama','$alamat','$gaji','$status','$wilayah','$sex','$gambar','$notelp')";
  return run($query);
}

function edit_data($kode, $nama, $alamat, $gaji, $status, $wilayah, $sex, $gambar, $notelp){
  $query = "UPDATE data_karyawan SET nama='$nama', alamat='$alamat', gaji='$gaji', status='$status', wilayah='$wilayah', sex='$sex', no_telp='$notelp', gambar='$gambar'
            WHERE kode='$kode';";
  return run($query);
}

function edit_tanpa_gambar($kode, $nama, $alamat, $gaji, $status, $wilayah, $sex, $notelp){
  $query = "UPDATE data_karyawan SET nama='$nama', alamat='$alamat', gaji='$gaji', status='$status', wilayah='$wilayah', sex='$sex', no_telp='$notelp'
            WHERE kode='$kode';";
  return run($query);
}

function hapus_data($kode){
  $query = "DELETE FROM data_karyawan WHERE kode='$kode';";
  return run($query);
}

function run($query){
	global $link;

	if (mysqli_query($link, $query)) return true;
	else return false;
}

function escape($data){
	global $link;
	return mysqli_real_escape_string($link, $data);
}
 ?>
