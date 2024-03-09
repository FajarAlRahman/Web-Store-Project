<?php 
//menghubungkan file koneksi.php
include_once("koneksi.php");
//mengambil id dari url
$id_produk = $_GET['id'];
//sql untuk menghapus data sesuai id
$sql = "DELETE from produk WHERE id_produk='$id_produk'";
// Syntax untuk menghapus data berdasarkan id
$conn->query($sql);
//kembali ke kategori.php
header("Location:../toko/produk.php");
?>