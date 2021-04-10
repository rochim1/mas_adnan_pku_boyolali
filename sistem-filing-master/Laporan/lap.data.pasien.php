<?php

include('/config/config.php');
?>


<div class="container" style="margin-top:20px">
  <center>
    <font size="6">Laporan XXX</font>
  </center>
  <hr>
  <button onclick="trig_print()" class="btn btn-primary right" on>Print</button>
  <button type="button" class="btn btn-secondary bg-dark" data-toggle="modal" data-target="#exampleModal">
    <i class="fa fa-sliders"></i>
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">filter laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">terapkan</button>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive mt-2">
    <table aria-label="Data Peminjam" id="myTable" class="table table-striped jambo_table bulk_action">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Peminjam</th>
          <th>Alamat</th>
          <th>No Telp</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
        $sql = mysqli_query($koneksi, "SELECT * FROM peminjam ORDER BY kd_peminjam ASC") or die(mysqli_error($koneksi));
        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
        if (mysqli_num_rows($sql) > 0) {
          //membuat variabel $no untuk menyimpan nomor urut
          $no = 1;
          //melakukan perulangan while dengan dari dari query $sql
          while ($data = mysqli_fetch_assoc($sql)) {
            //menampilkan data perulangan
            echo '
						<tr>
							<td>' . $no++ . '</td>
							<td>' . $data['nmpeminjam'] . '</td>
							<td>' . $data['alamat'] . '</td>
							<td>' . $data['no_telp'] . '</td>
							<td>' . $data['keterangan'] . '</td>
							<td>
								<a href="dashboard.php?page=edit_peminjam&kd_peminjam=' . $data['kd_peminjam'] . '" class="btn btn-secondary btn-sm">Edit</a>
								<a href="dashboard.php?page=delete_peminjam&kd_peminjam=' . $data['kd_peminjam'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
            // $no++;
          }
          //jika query menghasilkan nilai 0
        } else {
          echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
        }
        ?>
      <tbody>
    </table>
  </div>

</div>