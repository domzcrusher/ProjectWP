<?php

require_once "core/init.php";
require_once "view/header.php";

$error = '';
// membuat query max
$carikode = mysqli_query($link, "SELECT max(kode) FROM data_karyawan") or die (mysqli_error());

// menjadikannya array
$datakode = mysqli_fetch_array($carikode);

// jika $datakode
if ($datakode) {
  $nilaikode = substr($datakode[0], 4);

  // menjadikan $nilaikode ( int )
  $urut = (int) $nilaikode;

  // setiap $kode di tambah 1
  $urut = $urut + 1;
  $kode_otomatis = "PEG-".str_pad($urut, 4, "0", STR_PAD_LEFT);
} else {
  $kode_otomatis = "PEG-0001";
}


if (isset($_POST['submit'])) {
  $kode        = $_POST['kode'];
  $nama        = $_POST['nama'];
  $alamat      = $_POST['alamat'];
  $gaji        = $_POST['gaji'];
  $status      = $_POST['status'];
  $wilayah     = $_POST['wilayah'];
  $sex         = $_POST['sex'];
  $notelp      = $_POST['notelp'];
  $nama_gambar = $_FILES['gambar']['name'];
	$file_gambar = $_FILES['gambar']['tmp_name'];
	$directory	 = "image/$nama_gambar";
	move_uploaded_file($file_gambar, $directory);

  if (tambah_data($kode, $nama, $alamat, $gaji, $status, $wilayah, $sex, $nama_gambar, $notelp)) {
    header('Location: index.php');
  }else {
    $error = 'Ada Masalah Saat Menambahkan Data';
  }
}
 ?>

    <div class="container" style="margin-top:50px; margin-bottom:50px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #111128; color:white;">
                        <h3 class="text-center">Tambah Pegawai</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="kode">Kode</label> <br>
                                <input type="text" class="form-control" name="kode" size="37" readonly value="<?= $kode_otomatis; ?>"> <br> <br>

                                <label for="nama">Nama Lengkap</label> <br>
                                <input type="text" class="form-control" name="nama" size="37" value=""> <br> <br>

                                <label for="alamat">Alamat</label> <br>
                                <textarea name="alamat" class="form-control" rows="5" cols="40" value=""></textarea> <br> <br>

                                <label for="gaji">Gaji Utama</label> <br>
                                <input type="number" class="form-control" name="gaji" min="800000" max="8000000" step="50000" style="width: 19em" value=""> <br> <br>

                                <label for="status">Status</label> <br>
                                <select name="status" class="form-control">
                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
              </select> <br> <br>

                                <label for="wilayah">Wilayah</label> <br>
                                <select name="wilayah" class="form-control">
                <option value="Banten">Banten</option>
                <option value="DKI Jakarta">DKI Jakarta</option>
                <option value="Jawa Barat">Jawa Barat</option>
                <option value="Jawa Tengah">Jawa Tengah</option>
                <option value="Jawa Timur">Jawa Timur</option>
                <option value="Bali ">Bali</option>
              </select> <br> <br>

                                <label for="sex">Jenis Kelamin</label> <br>
                                <select name="sex" class="form-control">
                <option value="Laki-Laki">L</option>
                <option value="Perempuan">P</option>
              </select> <br> <br>

                                <label for="notelp">No Telepon</label> <br>
                                <input type="text" class="form-control" name="notelp" size="37" value=""> <br> <br>

                                <label for="exampleInputFile">Foto Profil</label> <br>
                                <input name="gambar" class="form-control-file" type="file" id="exampleInputFile"> <br> <br>

                                <div id="error">
                                    <?= $error  ?>
                                </div>

                                <div class="text-center">
                                    <input type="submit" class="btn btn-default" name="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
 require_once "view/footer.php";

  ?>
