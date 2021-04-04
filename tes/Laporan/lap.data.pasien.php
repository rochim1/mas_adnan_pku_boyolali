<?php
require('../assets/fpdf/fpdf.php');

// Database Connection 
$conn = new mysqli('localhost', 'root', '', 'rumahsakit');
//Check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
// Select data from MySQL database
$select = "SELECT * FROM pasien ORDER BY no_rm ASC";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
while($row = $result->fetch_object()){
  $no_rm = $row->no_rm;
  $nm_pasien = $row->nm_pasien;
  $tmp_lahir = $row->tmp_lahir;
  $tgl_lahir = $row->tgl_lahir;
  $jenis_klm = $row->jenis_klm;
  $pekerjaan = $row->pekerjaan;
  $no_telp = $row->no_telp;
  $alamat = $row->alamat;

  $pdf->SetFillColor(24,224,23);
  $pdf->SetFont('Arial', 'B',10);
  $pdf->Cell(20,10,$no_rm,1);
  $pdf->Cell(40,10,$nm_pasien,1);
  $pdf->Cell(80,10,$tmp_lahir,1);
  $pdf->Cell(40,10,$tgl_lahir,1);
  $pdf->Cell(40,10,$jenis_klm,1);
  $pdf->Cell(80,10,$pekerjaan,1);
  $pdf->Cell(40,10,$no_telp,1);
  $pdf->Cell(40,10,$alamat,1);
  $pdf->Ln();
}
$pdf->Output();

?>