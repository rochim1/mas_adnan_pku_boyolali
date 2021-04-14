<?php

include('../config/config.php');
?>
<link href="../assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container" style="margin-top:20px">
  <center>
    <font size="6">Laporan Data Peminjaman</font>
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
          <form method="POST" action="dashboard.php?page=cetak_data_peminjaman">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">dari tanggal</label>
                  <input type="date" name="dari" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">sampai tanggal</label>
                  <input type="date" name="sampai" class="form-control">
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">terapkan</button>
              </div>
          </form>
        </div>

      </div>

    </div>
  </div>
</div>
<div class="table-responsive mt-2">
  <table aria-label="Laporan Data Peminjaman" id="myTable" class="table table-striped jambo_table bulk_action">
    <thead>
      <tr>
        <th>No</th>
        <th>No RM</th>
        <th>Nama Pasien</th>
        <th>Tujuan Pinjam</th>
        <th>Lokasi Pinjam</th>
        <th>tgl Hrs Kembali</th>
        <th>Kd Petugas</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($_POST['submit'])) {
        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];
        // echo $dari.$sampai;
        $sql = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE tgl_pinjam BETWEEN '$dari' AND '$sampai' ORDER BY no_pinjam ASC") or die(mysqli_error($koneksi));
      } else {
        // echo "tidak dari sampai";
        //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
        $sql = mysqli_query($koneksi, "SELECT * FROM peminjaman ORDER BY no_pinjam ASC") or die(mysqli_error($koneksi));
        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
      }

      if (mysqli_num_rows($sql) > 0) {
        // print_r($sql);
        //membuat variabel $no untuk menyimpan nomor urut
        $no = 1;
        //melakukan perulangan while dengan dari dari query $sql
        while ($data = mysqli_fetch_assoc($sql)) {
          //menampilkan data perulangan
          echo '
              <tr>
                <td>' . $no++ . '</td>
                <td>' . $data['no_rm'] . '</td>
                <td>' . $data['nm_pasien'] . '</td>
                <td>' . $data['tujuan_pinjam'] . '</td>
                <td>' . $data['lokasi_pinjam'] . '</td>
                <td>' . $data['tanggal_hrs_kmb'] . '</td>
                <td>' . $data['kd_petugas'] . '</td>
                <td>' . $data['status_pjm'] . '</td>
                
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