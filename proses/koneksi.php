<?php 
//Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_online";
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    //peringatan jika koneksi gagal
    die("Koneksi database gagal". $conn->connect_error);
}
?>