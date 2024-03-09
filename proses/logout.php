<?php
session_start();
session_destroy();
header("Location:../toko/login.php");
// echo "Anda Berhasil Logout <b>LOGOUT</b>";
// echo "<br>Silahkan login : <a href='../toko/login.php'>LOGIN</a>";
?>