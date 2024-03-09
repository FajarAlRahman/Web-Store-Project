<?php 
//menghubungkan file koneksi.php
include_once("koneksi.php");
//mengambil id dari url
$id_kategori = $_GET['id'];
//sql untuk menghapus data sesuai id
$sql = "DELETE from kategori WHERE id_kategori='$id_kategori'";
// Syntax untuk menghapus data berdasarkan id
$conn->query($sql);
//kembali ke kategori.php
header("Location:../toko/kategori.php");
?>