<?php
//memasukkan file config.php
session_start();
include('../config/config.php');
include('header.php');
?>

<div class="container">
  <center>
    <font size="4">Laporan Data Lokasi Pinjam</font>
  </center>
  <hr>

  <div class="table-responsive mt-2">
    <table aria-label="Laporan Data Lokasi Pinjam" id="myTable" class="table table-bordered jambo_table bulk_action">
      <thead>
        <tr>
          <th>No</th>
          <th>Lokasi Pinjam</th>
          <th>jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
        $kd_peminjam = $_SESSION['kd_peminjam'];
        $hari_ini = date("Y-m-d");
        $sql = mysqli_query($koneksi, "SELECT *, COUNT(*) as jumlah 
FROM peminjaman 
GROUP BY lokasi_pinjam;
        ") or die(mysqli_error($koneksi));
        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
        if (mysqli_num_rows($sql) > 0) {

          //membuat variabel $no untuk menyimpan nomor urut
          $no = 1;
          //melakukan perulangan while dengan dari dari query $sql
          while ($data = mysqli_fetch_assoc($sql)) {
            //menampilkan data perulangan
            // print_r($data);

            echo '<tr';
            echo '>
							<td>' . $no++ . '</td>
						
							<td>' . $data['lokasi_pinjam'] . '</td>
							<td>' . $data['jumlah'] . '</td>
						</tr>
						';
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