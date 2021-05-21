<?php
session_start();
include('../config/config.php');
include('header.php');
?>


<div class="container">
  <center>
    <font size="4">Laporan Data Pengembalian</font>
  </center>
  <hr>
</div>
<div class="table-responsive mt-2">
  <table aria-label="Data peminjaman" id="myTable" class="table table-bordered jambo_table bulk_action">
    <thead>
      <tr>
        <th>No</th>
        <th>KD Pinjam</th>
        <th>No RM</th>
        <th>Nama Pasien</th>
        <th>Tujuan Pinjam</th>
        <th>Lokasi Pinjam</th>
        <th>tgl pinjam</th>
        <th>tgl harus kembali</th>
        <th>Kd Petugas</th>

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
        $sql = mysqli_query($koneksi, "SELECT * FROM pinjam_kembali ORDER BY kd_pinjam_kembali ASC") or die(mysqli_error($koneksi));
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
                <td>' . $data['no_pinjam'] . '</td>
                <td>' . $data['no_rm'] . '</td>
                <td>' . $data['nm_pasien'] . '</td>
                <td>' . $data['tujuan_pinjam'] . '</td>
                <td>' . $data['lokasi_pinjam'] . '</td>
                
                <td>' . date("Y-m-d", strtotime($data['tgl_pinjam'])) . '</td>
                <td>' . date("Y-m-d", strtotime($data['tanggal_pengembalian'])) . '</td>

                <td>' . $data['kd_petugas'] . '</td>
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
  <?php include 'footer.php';
  ?>
</div>

</div>