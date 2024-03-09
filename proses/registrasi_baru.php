<?php 
    include "koneksi.php";
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(md5($_POST['password']));
    
    $sql = "INSERT INTO users (username, password) VALUES  ('$username' ,'$password')";
    $login = mysqli_query($conn, $sql);