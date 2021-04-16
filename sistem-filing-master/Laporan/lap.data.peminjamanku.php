<?php
session_start();
include('../config/config.php');
include('header.php');

?>
<link href="../assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container" style="margin-top:20px">
  <center>
    <font size="6">Laporan Data Peminjamanku</font>
  </center>
  <hr>
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
        $kd_peminjam = $_SESSION['kd_peminjam'];
        //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
        $sql = mysqli_query($koneksi, "SELECT * FROM peminjaman where kd_peminjam = '$kd_peminjam' ORDER BY no_pinjam ASC") or die(mysqli_error($koneksi));
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


<script>
window.print();
</script>