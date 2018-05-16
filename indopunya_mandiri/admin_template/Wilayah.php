<?php

require_once "core/init.php";
require_once "view/header.php";

function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
}
 ?>

    <div class="container-fluid" style="margin:50px 10px 50px 10px;">
        <div class="row">
            <div class="col-md-3">
                <form method="get">
                    <div class="form-group">
                        <br>
                        <select name="filter" onchange="form.submit()" class="form-control">
              <option value="0">-Filter Berdasarkan Wilayah-</option>
              <?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
              <option value="Banten" <?php if($filter == 'Banten '){ echo 'selected'; } ?>>Banten</option>
              <option value="DKI Jakarta" <?php if($filter == 'DKI Jakarta'){ echo 'selected'; } ?>>DKI Jakarta</option>
              <option value="Jawa Barat" <?php if($filter == 'Jawa Barat'){ echo 'selected'; } ?>>Jawa Barat</option>
              <option value="Jawa Tengah" <?php if($filter == 'Jawa Tengah'){ echo 'selected'; } ?>>Jawa Tengah</option>
              <option value="Jawa Timur" <?php if($filter == 'Jawa Timur'){ echo 'selected'; } ?>>Jawa Timur</option>
              <option value="Bali" <?php if($filter == 'Bali'){ echo 'selected'; } ?>>Bali</option>
           </select>
                    </div>
                </form>
            </div>
            <div class=" col-md-offset-8">
                <h1>WILAYAH KERJA</h1>
            </div>
        </div>
        <hr>
        <div class="row" style="margin-top:50px;">
            <h3 class="text-center">Data Pegawai PT. INDOPUNYA MANDIRI</h3>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-stripped table-hover">
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
                    <?php
         error_reporting(0);
          if ($filter) {
            $sql = tampil_wilayah($filter);
          } else {
            $halaman = 10;
            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
            $result = tampil_urut();
            $total = mysqli_num_rows($result);
            $pages = ceil($total/$halaman);
            $sql = mysqli_query($link,"SELECT * FROM data_karyawan ORDER BY nama ASC LIMIT $mulai, $halaman")or die(mysql_error);
          }
          $no = $mulai + 1;
          while ($row = mysqli_fetch_assoc($sql)) :?>
                        <tr>
                            <td>
                                <?= $no; ?>
                            </td>
                            <td>
                                <h5>
                                    <?= $row['kode']; ?>
                                </h5>
                            </td>
                            <td>
                                <a href="detail.php?kode=<?= $row['kode']; ?>">
                                    <?= $row['nama'];  ?>
                                </a>
                            </td>
                            <td>
                                <?= $row['wilayah']; ?>
                            </td>
                            <td>Rp
                                <?= rupiah($row['gaji']); ?>
                            </td>
                            <td>
                                <?= $row['sex']; ?>
                            </td>
                            <td>
                                <?= $row['alamat']; ?>
                            </td>
                            <td>
                                <?= $row['no_telp']; ?>
                            </td>
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
                    <li>
                        <a href="?halaman=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <?php
 require_once "view/footer.php";

  ?>
