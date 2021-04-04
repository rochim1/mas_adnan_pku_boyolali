<?php

//include core crud
include include('class/core.php');
//memasukkan file config.php
// include('config.php');

$coreObj = new Core();
?>
	<div class="container" style="margin-top:20px">
    <?php
    if (isset($_GET['msg1']) == "insert") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Your Registration added successfully
            </div>";
      } 
    if (isset($_GET['msg2']) == "update") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Your Registration updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Record deleted successfully
            </div>";
    }
  ?>
		<center><font size="6">Data Pasien</font></center>
		<hr>
		<a href="index.php?page=tambah_mhs"><button class="btn btn-dark right">Tambah Data</button></a>
		<div class="table-responsive">
		<table class="table table-striped jambo_table bulk_action">
			<thead>
				<tr>
				
					<th>No RM</th>
					<th>Nama Pasien</th>
					<th>Tempat Tanggal Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Profesi</th>
					<th>Kontak</th>
					<th>Alamat</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
                <?php 

                $datas = $coreObj->displayData(); 
                foreach ((array) $datas as $data) {
                ?>
                <tr>
                <td><?php echo $data['no_rm']; ?></td>
                <td><?php echo $data['nm_pasien']; ?> </td>
                <td><?php echo $data['tmp_lahir']; $data['tgl_lahir'];?></td>
                <td><?php echo $data['jenis_klm']; ?></td>
                <td><?php echo $data['pekerjaan']; ?></td>
                <td><?php echo $data['no_telp']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td>
                <a href="edit.php?editId=<?php echo $data['id'] ?>" style="color:green">
                    <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
                <a href="index.php?deleteId=<?php echo $data['id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
                </td>
                </tr>
                <?php }


				//jika query menghasilkan nilai 0
				// }else{
				// 	echo '
				// 	<tr>
				// 		<td colspan="6">Tidak ada data.</td>
				// 	</tr>
				// 	';
				// }
				?>
			<tbody>
		</table>
	</div>
	</div>


