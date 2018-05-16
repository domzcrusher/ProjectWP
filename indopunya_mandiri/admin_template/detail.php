<?php

require_once "core/init.php";
require_once "view/header.php";

$kode = $_GET['kode'];

if (isset($kode)) {
  $detail = tampilkan_per_kode($kode);
  while ($row = mysqli_fetch_assoc($detail)) {
    $kode_detail        = $row['kode'];
    $nama_detail        = $row['nama'];
    $wilayah_detail     = $row['wilayah'];
    $gaji_detail        = $row['gaji'];
    $sex_detail         = $row['sex'];
    $alamat_detail      = $row['alamat'];
    $notelp_detail      = $row['no_telp'];
    $status_detail      = $row['status'];
    $gambar_detail      = $row['gambar'];
  }
}
function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
}
 ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>DETAIL PROFIL KARYAWAN</h1>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-center">
                        <img src="image/<?= $gambar_detail; ?>" class="img_circle">
                    </div>
                </div>
              <td><a class="btn btn-success btn-sm" href="edit.php?kode=<?= $_GET['kode']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                  <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')" href="hapus.php?kode=<?= $_GET['kode']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </td>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="font-size:18px">
                            <tr>
                                <th>Kode</th>
                                <td>:</td>
                                <td>
                                    <?= $kode_detail; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td>
                                    <?= $nama_detail; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Wilayah</th>
                                <td>:</td>
                                <td>
                                    <?= $wilayah_detail; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Gaji</th>
                                <td>:</td>
                                <td>Rp
                                    <?= rupiah($gaji_detail); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td>
                                    <?= $sex_detail; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td>
                                    <?= $alamat_detail; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>:</td>
                                <td>
                                    <?= $notelp_detail; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    <?= $status_detail; ?>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
 require_once "view/footer.php";

  ?>
