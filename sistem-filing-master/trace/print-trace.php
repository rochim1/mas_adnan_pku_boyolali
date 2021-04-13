<?php include('../config/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="card m-0 m-auto" style="width: 30rem;">
        <div class="card-body">
            <div class="text-center">
                <?php
                $id = $_GET['trace'];
                $peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman where no_pinjam = '$id'");

                if (mysqli_num_rows($peminjaman) == true) {
                    $data = mysqli_fetch_assoc($peminjaman);
                } else {
                    echo "ga ada";
                }

                ?>
                <h5 class="card-title">Kartu Trace</h5>
                <h6 class="card-subtitle mb-2 text-muted">SISTEM INFORMASI PENGOLAHAN DATA DI BAGIAN FILING
                    RS PKU AISYIYAH BOYOLALI</h6>
            </div>
            <hr>
            <p class="card-text">
            <form>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">no pinjam</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $_GET['trace'] ?>" class="selected" readonly class="form-control-plaintext">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">tgl pinjam</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo date('Y-m-d', strtotime($data['tgl_pinjam'])) ?>" class="selected" readonly class="form-control-plaintext">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">tgl hrs kembali</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo date('Y-m-d', strtotime($data['tanggal_hrs_kmb'])) ?>" class="selected" readonly class="form-control-plaintext">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">kd petugas</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $data['kd_petugas'] ?>" class="selected" readonly class="form-control-plaintext">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">lokasi pinjam</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $data['lokasi_pinjam'] ?>" class="selected" readonly class="form-control-plaintext">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">tujuan pinjam</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $data['tujuan_pinjam'] ?>" class="selected" readonly class="form-control-plaintext">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">no rm</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $data['no_rm'] ?>" class="selected" readonly class="form-control-plaintext">
                    </div>
                </div>
                <div class="form-group row">
                    <?php
                        if ($data['status_pjm'] == "dikembalikan") {
?>
                    <div class="alert float-right w-100 text-center text-white bg-primary alert-primary" role="alert">
                        dikembalikan
                    </div>
<?php
                        }

else{?>
                    <div class="alert float-right w-100 text-center text-white bg-danger alert-danger" role="alert">
                        belum dikembalikan
                    </div>
<?php
                        }
                    ?>

                </div>
            </form>
            <script>
                window.print();
            </script>
            </p>
        </div>
    </div>
</body>

</html>