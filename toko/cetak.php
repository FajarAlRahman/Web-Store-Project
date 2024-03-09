<?php 
// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, 'DAFTAR PRODUK', 0, 1, 'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 6, 'NAMA PRODUK', 1, 0);
// $pdf->Cell(50, 6, 'KATEGORI', 1, 0);
// $pdf->Cell(25, 6, 'GAMBAR PRODUK', 1, 0);
$pdf->Cell(50, 6, 'DETAIL', 1, 0);
$pdf->Cell(30, 6, 'HARGA', 1, 0);
$pdf->Cell(30, 6, 'KETERSEDIAAN', 1, 1);
$pdf->SetFont('Arial', '', 10);
include '../proses/koneksi.php';
$cetak = mysqli_query($conn, "select * from produk");
while ($row = mysqli_fetch_array($cetak)) {
    $pdf->Cell(50, 6, $row['nama_produk'], 1, 0);
    // $pdf->Cell(50, 6, $row['nama_kategori'], 1, 0);
    // $pdf->Cell(25, 6, $row['gambar_produk'], 1, 0);
    $pdf->Cell(50, 6, $row['detail'], 1, 0);
    $pdf->Cell(30, 6, $row['harga'], 1, 0);
    $pdf->Cell(30, 6, $row['ketersediaan'], 1, 1);
}
$pdf->Output();
?>
