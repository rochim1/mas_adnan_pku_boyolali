<?php
session_start();

// print_r($_SESSION);
if (!isset($_SESSION['id'], $_SESSION['user_role_id'])) {
  if (!isset($_SESSION['kd_peminjam'])) {
    header('location:index.php?lmsg=true');
    exit;
  }
}
require_once('config/config.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/ico" />
  <style>
    #myTable tr td {
      padding: 10px 18px;
      padding-bottom: 0px;
    }
  </style>
  <title> SISTEM INFORMASI PENGOLAHAN DATA DI BAGIAN FILING
    RS PKU AISYIYAH BOYOLALI </title>



  <!-- Bootstrap -->
  <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="assets/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="assets/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="assets/css/custom.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <center>
              &nbsp; <a href="index.php" class="fa fa-mortar-board fa-2x" style="color:#fff;"><span>
                  <font size="4.95" color="white" face="Helvetica Neue">SISTEM FILLING</font>
                </span></a>
            </center>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="assets/images/avatar2.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,
                <?php
                if (!isset($_SESSION['kd_peminjam'])) {
                  echo $_SESSION['nama_depan'];
                } else {
                  echo $_SESSION['nmpeminjam'];
                }
                ?></span>
              <h2>
                <?php
                if (!isset($_SESSION['kd_peminjam'])) {
                  $status = $_SESSION['user_role_id'];
                  if ($status == 1) {
                    echo 'kepala rm';
                  } elseif ($status == 2) {
                    echo 'admin';
                  } else {
                    echo 'user';
                  }
                } else {
                  echo "user";
                }
                ?>
              </h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Home <span class="fa fa-chevron"></span></a>
                </li>

                <?php if (isset($_SESSION['kd_peminjam'])) { ?>
                  <li><a><i class="fa fa-desktop"></i> Data Peminjamanku <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard.php?page=tampil_peminjamanku">Tampil Data Peminjamanku</a></li>
                      <li><a href="dashboard.php?page=tampil_haruskembali">Peringatan Pengembalian</a></li>
                      <li><a onclick="printPeminjamanku()">Laporan Peminjamanku</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-desktop"></i> Data Pengembalian ku <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard.php?page=tampil_pengembalianku">Tampil Data Pengembalianku</a></li>
                      <li><a onclick="printPengembalianku()">Laporan Pengembalianku</a></li>
                    </ul>
                  </li>
                <?php } ?>





                <?php
                if (isset($_SESSION['user_role_id']) == 2) {
                ?>
                  <li><a href="#"><i class="fa fa-desktop"></i> Data Pasien <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard.php?page=tampil_pasien">Tampil Data Pasien</a></li>
                      <li><a href="dashboard.php?page=tambah_pasien">Tambah Data Pasien</a></li>
                    </ul>
                  </li>


                  <li><a><i class="fa fa-desktop"></i> Data Petugas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard.php?page=tampil_petugas">Tampil Data</a></li>
                      <li><a href="dashboard.php?page=tambah_petugas">Tambah Data</a></li>
                    </ul>
                  </li>
                <?php
                }

                if (isset($_SESSION['user_role_id']) !== 1 and !isset($_SESSION['kd_peminjam'])) {
                ?>
                  <li><a><i class="fa fa-desktop"></i> Data Peminjam <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard.php?page=tampil_peminjam">Tampil Data Peminjam</a></li>
                      <li><a href="dashboard.php?page=tambah_peminjam">Tambah Data Peminjam</a></li>
                    </ul>
                  </li>
                <?php
                }

                if (isset($_SESSION['user_role_id']) == 2 or isset($_SESSION['user_role_id']) == 1) {
                ?>

                  <li><a><i class="fa fa-desktop"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard.php?page=tampil_pasien_PRJ">Transaksi Pendaftaran Pasien Rawat Jalan</a></li>
                      <li><a href="dashboard.php?page=tampil_peminjaman_DRM">Transaksi Peminjaman DRM</a></li>
                      <li><a href="dashboard.php?page=tampil_pengembalian_DRM">Transaksi Pengembalian</a></li>
                      <li><a href="dashboard.php?page=peringatan_peminjaman">Peringatan Peminjaman</a></li>
                      <li><a href="dashboard.php?page=retensi">Sistem Retensi</a></li>
                    </ul>
                  </li>

                  <?php
                  if (isset($_SESSION['user_role_id']) !== 3) {
                  ?>
                    <li><a><i class="fa fa-desktop"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="dashboard.php?page=cetak_data_pasien">Laporan Data Pasien</a></li>
                        <li><a onclick="printPetugas()" href="#">Laporan Data Petugas</a></li>
                        <li><a onclick="printPeminjam()" href="#">Laporan Data Peminjam</a></li>
                        <li><a href="dashboard.php?page=cetak_data_pendaftaran_pasien">Laporan Data Pendaftaran Pasien</a></li>
                        <li><a href="dashboard.php?page=cetak_data_peminjaman">Laporan Data Peminjaman</a></li>

                        <li><a href="dashboard.php?page=cetak_data_pengembalian">Laporan Data Pengembalian</a></li>
                        <li><a href="dashboard.php?page=cetak_data_blm_kembali">Laporan Data Belum Kembali</a></li>
                        <li><a onclick="printLokasiPinjam()">Laporan Data Lokasi Peminjaman</a></li>
                        <li><a onclick="printPengendalian()">Laporan Data Pengendalian</a></li>

                        <li><a onclick="printKeterlambatan()">Laporan Data Keterlambatan</a></li>
                      </ul>
                    </li>
                <?php
                  }
                }
                ?>


                <li><a><i class="fa fa-gear"></i> Settings <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="#">Settings 1</a></li>
                    <li><a href="#">Settings 2</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings" href="#">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen" href="#">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock" href="#">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="index.php?logout=true">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open">
                <a href="#" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="assets/images/avatar2.jpg" alt="User Avatar Image"> <?php
                                                                                if (isset($_SESSION['user_role_id'])) {
                                                                                  echo $_SESSION['nama_depan'];
                                                                                } else {
                                                                                  echo $_SESSION['nmpeminjam'];
                                                                                }

                                                                                ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#"> Profile</a>
                  <a class="dropdown-item" href="#">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                  <a class="dropdown-item" href="index.php?logout=true"><i class="fa fa-sign-out pull-right"></i> Log
                    Out</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content - HALAMAN UTAMA ISI DISINI -->
      <div class="right_col" role="main">
        <?php
        $queries = array();
        // print_r('<pre>');
        parse_str($_SERVER['QUERY_STRING'], $queries);
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        switch ($queries['page']) {
          case 'tampil_pasien':
            # code...
            // include 'index.php';

            include 'Pasien/tampil.php';
            break;
          case 'tambah_pasien':
            # code...
            include 'Pasien/tambah.php';
            break;
          case 'edit_pasien':
            # code...
            include 'Pasien/edit.php';
            break;
          case 'edit_pasien_save':
            # code...
            include 'Pasien/edit.php';
            break;
          case 'delete_pasien':
            # code...
            include 'Pasien/delete.php';
            break;
          case 'tampil_petugas':
            # code...
            include 'Petugas/tampil.php';
            break;
          case 'tambah_petugas':
            # code...
            include 'Petugas/tambah.php';
            break;
          case 'edit_petugas':
            # code...
            include 'Petugas/edit.php';
            break;
          case 'edit_petugas_save':
            # code...
            include 'Petugas/edit.php';
            break;
          case 'delete_petugas':
            # code...
            include 'Petugas/delete.php';
            break;
            //peminjam
          case 'tampil_peminjam':
            # code...
            include 'Peminjam/tampil.php';
            break;
          case 'tambah_peminjam':
            # code...
            include 'Peminjam/tambah.php';
            break;
          case 'edit_peminjam':
            # code...
            include 'Peminjam/edit.php';
            break;
          case 'edit_peminjam_save':
            # code...
            include 'Peminjam/edit.php';
            break;
          case 'delete_peminjam':
            # code...
            include 'Peminjam/delete.php';
            break;

            //PRJ
          case 'tampil_pasien_PRJ':
            # code...
            include 'PRJ/tampil.php';

            break;
          case 'tambah_pasien_PRJ':
            # code...
            include 'PRJ/tambah.php';
            break;
          case 'edit_pasien_PRJ':
            # code...
            include 'PRJ/edit.php';
            break;
          case 'edit_pasien_save_PRJ':
            # code...
            include 'PRJ/edit.php';
            break;
          case 'delete_pasien_PRJ':
            # code...
            include 'PRJ/delete.php';
            break;
            //END PRJ

            //Peminjaman DRM
          case 'tampil_peminjaman_DRM':
            # code...
            include 'PeminjamanDRM/tampil.php';

            break;
          case 'tambah_peminjaman_DRM':
            # code...
            include 'PeminjamanDRM/tambah.php';
            break;
          case 'edit_peminjaman_DRM':
            # code...
            include 'PeminjamanDRM/edit.php';
            break;
          case 'edit_peminjaman_save':
            # code...
            include 'PeminjamanDRM/edit.php';
            break;
          case 'delete_peminjaman_PRJ':
            # code...
            include 'PeminjamanDRM/delete.php';
            break;
            // END Peminjaman DRM


            //pengembalian DRM
          case 'tampil_pengembalian_DRM':
            # code...
            include 'pengembalianDRM/tampil.php';

            break;
          case 'tambah_pengembalian_DRM':
            # code...
            include 'pengembalianDRM/tambah.php';
            break;
          case 'edit_pengembalian_DRM':
            # code...
            include 'pengembalianDRM/edit.php';
            break;
          case 'edit_pengembalian_save':
            # code...
            include 'pengembalianDRM/edit.php';
            break;
          case 'delete_pengembalian_PRJ':
            # code...
            include 'pengembalianDRM/delete.php';
            break;
            // END pengembalian DRM

            // laporan
            // cetak_data_pasien
          case 'cetak_data_pasien':
            # code...
            include 'Laporan/lap.data.pasien.php';
            break;

          case 'cetak_data_pendaftaran_pasien':
            # code...
            include 'Laporan/lap.data.pendaftaranpasien.php';
            break;

          case 'cetak_data_peminjaman':
            # code...
            include 'Laporan/lap.data.peminjaman.php';
            break;

          case 'cetak_data_blm_kembali':
            # code...
            include 'Laporan/lap.data.belumkembali.php';
            break;

          case 'cetak_data_pengembalian':
            # code...
            include 'Laporan/lap.data.pengembalian.php';
            break;

          case 'tampil_peminjamanku':
            # code...
            include 'peminjamanku/tampil.php';
            break;

          case 'tampil_pengembalianku':
            # code...
            include 'pengembalianku/tampil.php';
            break;

          case 'detail_pengembalian':
            # code...
            include 'pengembalianku/detail_pengembalian.php';
            break;

          case 'tampil_haruskembali':
            # code...
            include 'peminjamanku/haruskembali.php';
            break;

          case 'detail_peminjaman':
            # code...
            include 'peminjamanku/detail_peminjaman.php';
            break;

          case 'peringatan_peminjaman':
            # code...
            include 'PeminjamanDRM/peringatan_peminjaman.php';
            break;

          case 'retensi':
            # code...
            include 'Retensi/tampil.php';
            break;

          case 'delete_retensi':
            # code...
            include 'Retensi/delete.php';
            break;

          case 'recover_retensi':
            # code...
            include 'Retensi/recover.php';
            break;


            // end laporan
          default:
            #code...
            include 'home.php';
            break;
        }
        ?>
        <div class="collapse" id="print_area">

        </div>
      </div>

      <!-- /page content -->

      <!-- footer content -->
      <footer>

        <div class="pull-right">
          Copyright @ 2021 Sistem Filling
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="assets/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="assets/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="assets/nprogress/nprogress.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="assets/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="assets/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="assets/skycons/skycons.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="assets/js/custom.min.js"></script>
  <!-- datetime  -->
  <script src="assets/moment.min.js"></script>

  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#myTable').dataTable({
        aLengthMenu: [
          [25, 50, 100, 200, -1],
          [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
      });
    });
  </script>

  <script script type="text/javascript">
    function trig_print() {
      del_column(print);
    };

    function del_column(callback) {
      var tble = $('#myTable').clone();
      var print_area = $('#print_area').html(tble);
      print_area = $('#print_area').children().prop('id', "tb_clone");

      // var row = document.getElementById("tb_clone").rows; // Getting the rows
      var row = $("#tb_clone tr").length; // Getting the rows
      var row_obj = $("#tb_clone tr"); // Getting the rows
      var row_col = $("#tb_clone th").length;
      var col_obj = $("#tb_clone th"); // Getting the columns

      for (var i = 0; i < row_col; i++) {
        // Getting the text of columnName
        var str = row_obj[0].cells[i].innerHTML;

        // If 'Geek_id' matches with the columnName 
        if (str.search("Aksi") != -1) {
          for (var j = 0; j < row; j++) {
            // Deleting the ith cell of each row
            row_obj[j].deleteCell(i);
          }
        }
      }
      callback();
    }

    function print() {
      // var print_area = $("#tb_clone").innerHTML;
      var print_area = document.getElementById('tb_clone').outerHTML;
      var printWindow = window.open('', 'myWindow', 'height=300,width=500');
      printWindow.document.write(
        '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">'
      );
      printWindow.document.write(
        '<div id="print" class="container border-1 border" style="width: 794px; height: 1123px;"> <nav class="pb-0 p-5 pt-0 navbar navbar-light d-inline-block w-100 position-relative"> <a class="navbar-brand d-inline-block position-absolute" href="#" class="p-4"> <img class="m-3" src="assets/images/ump-logo.png" width="120px" alt=""> </a> <div class="position-relative text-center d-inline-block w-100 pt-5 pb-4" style="padding-left: 50px;"> <div class="w-100"> <h3>RS PKU AISYIYAH BOYOLALI</h3> <span> Jl. Pasar Sapi Baru, Dusun 1, Karanggeneng, Kec. Boyolali, <br>Kabupaten Boyolali, Jawa Tengah 57312 </span> </div></div><hr> </nav> <div id="content" class="w-100 h-100 p-3 pt-0">'
      );
      printWindow.document.write('<h4 class="text-center mt-2 w-50 m-auto m-0">' + $("#myTable").attr('aria-label') +
        '</h4>');
      printWindow.document.write(print_area);
      printWindow.document.write('</div></div>');

      printWindow.document.close();
      printWindow.focus();
      setTimeout(function() {
        printWindow.print();
      }, 3000);
    }

    function printPetugas() {
      window.open('Laporan/lap.data.petugas.php', 'laporanPasien', 'height=300,width=500');

    }

    function printPeminjamanku() {
      window.open('Laporan/lap.data.peminjamanku.php', 'laporanPasien', 'height=300,width=500');

    }

    function printPengembalianku() {
      window.open('Laporan/lap.data.pengembalianku.php', 'laporanPasien', 'height=300,width=500');

    }

    function printPeminjam() {
      window.open('Laporan/lap.data.peminjam.php', 'laporanPasien', 'height=300,width=500');
    }

    function printPendaftarPasien() {
      window.open('Laporan/lap.data.pendaftaranpasien.php', 'laporanPasien', 'height=300,width=500');
    }


    function printPengembalian() {
      window.open('Laporan/lap.data.pengembalian.php', 'laporanPasien', 'height=300,width=500');
    }

    function printBelumKembali() {
      window.open('Laporan/lap.data.belumkembali.php', 'laporanPasien', 'height=300,width=500');
    }

    function printLokasiPinjam() {
      window.open('Laporan/lap.data.lokasipeminjaman.php', 'laporanPasien', 'height=300,width=500');
    }

    function printPengendalian() {
      window.open('Laporan/lap.data.pengendalian.php', 'laporanPasien', 'height=300,width=500');
    }

    function printKeterlambatan() {
      window.open('Laporan/lap.data.keterlambatan.php', 'laporanPasien', 'height=300,width=500');
    }
  </script>
</body>

</html>