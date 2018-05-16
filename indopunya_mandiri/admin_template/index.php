<?php

require_once "core/init.php";
require_once "view/header.php";

// fungsi Paging
$halaman = 10;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$result = tampilkan();
$total = mysqli_num_rows($result);
$pages = ceil($total/$halaman);
$query = mysqli_query($link,"SELECT * FROM data_karyawan LIMIT $mulai, $halaman")or die(mysql_error);

function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
}

if (isset($_GET['cari'])) {
	$list_karyawan = cari_nama($_GET['cari']);
}
session_start();
if($_SESSION['status'] !="login"){
	header("location:login_admin.php");
}

 ?>
  <div class="container-fluid" style="margin:10px;">
      <div class="row">
        <div class="col-md-8">
          <h1>Welcome Admin <?= $_SESSION['user']; ?></h1>
        </div>
        <div class="col-md-4">
          <form method="get">
              <div class="form-group">
                <br>
                  <input type="search" name="cari" class="form-control" placeholder="Ingin Mencari Pegawai, Ketik Saja">
              </div>
          </form>
        </div>
      </div>
      <hr>
      <div class="row" style="margin-top:50px;">
          <h3 class="text-center">Data Pegawai PT. INDOPUNYA MANDIRI</h3>
      </div>

      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Pegawai</th>
                <th>Wilayah</th>
                <th>Gaji Utama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Status</th>
                <th>Tools</th>
              </tr>
            </thead>
            <?php
              $no = $mulai+1;
              while ($row = mysqli_fetch_assoc($query)) :?>
            <tr>
              <td><?= $no; ?></td>
              <td><h5><?= $row['kode']; ?>
              <td><a href="detail.php?kode=<?= $row['kode']; ?>"><?= $row['nama'];  ?>
              <td><?= $row['wilayah']; ?></td>
              <td>Rp <?= rupiah($row['gaji']); ?></td>
              <td><?= $row['sex']; ?></td>
              <td><?= $row['alamat']; ?></td>
              <td><?= $row['no_telp']; ?></td>
              <td>
                <?php
                if($row['status'] == 'Tetap'){
									echo '<span class="label label-primary">Tetap</span>';
								}
								else if ($row['status'] == 'Kontrak' ){
									echo '<span class="label label-warning">Kontrak</span>';
								}
                 ?>
              </td>
              <td><a class="btn btn-success btn-sm" href="edit.php?kode=<?= $row['kode']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                  <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')" href="hapus.php?kode=<?= $row['kode']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </td>
            </tr>
            <?php
              $no++;
              endwhile; ?>
          </table>
        </div>
        <div class="text-center">
          <ul class="pagination">
            <?php for ($i=1; $i<=$pages ; $i++){ ?>
            <li><a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
  </div>

<?php
require_once "view/footer.php";

 ?>
