<?php 
include "koneksi.php";
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars(md5($_POST['password']));

$sql = "SELECT * FROM users WHERE username = '$username' && password = '$password'";
$login = mysqli_query($conn, $sql);
$terima = mysqli_num_rows($login);
$data = mysqli_fetch_array($login);

if ($terima > 0) {
        session_start();
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];
        header('location:../toko');
        // echo "USER BERHASIL LOGIN<br>";
        // echo "Username =", $_SESSION['username'], "<br>";
        // echo "Level =", $_SESSION['level'], "<br>";
    
        // echo "<br><a href=../toko/index.php><b>Ke Home</b></a></center><br>";
        // echo "<a href=logout.php><b>LOGOUT</b></a></center>";
} 
else {
    session_start();
    $_SESSION['login'] = "Username atau Password Salah";
    header('location:../toko/login.php');
}
mysqli_close($conn);
?>