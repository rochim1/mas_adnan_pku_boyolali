<?php

include('../config/config.php');
include('header.php');
?>


<div class="container">
  <center>
    <font size="6">Laporan Data peminjam</font>
  </center>
  <hr>
</div>
<div class="table-responsive mt-2">
  <table aria-label="Data peminjam" id="myTable" class="table table-striped jambo_table bulk_action">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama peminjam</th>
        <th>No Telp</th>
        <th>Alamat</th>

      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($_POST['submit'])) {
        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];
        // echo $dari.$sampai;
        $sql = mysqli_query($koneksi, "SELECT * FROM peminjam WHERE tgl_daftar BETWEEN '$dari' AND '$sampai' ORDER BY kd_peminjam ASC") or die(mysqli_error($koneksi));
      } else {
        // echo "tidak dari sampai";
        //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
        $sql = mysqli_query($koneksi, "SELECT * FROM peminjam ORDER BY kd_peminjam ASC") or die(mysqli_error($koneksi));
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
                <td>' . $data['nmpeminjam'] . '</td>
                <td>' . $data['no_telp'] . '</td>
                <td>' . $data['alamat'] . '</td>
                
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