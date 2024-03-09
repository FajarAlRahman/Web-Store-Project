<?php 
    include ("koneksi.php");

    if(isset($_POST['simpan_edit_kategori'])){
        // cek "id_kategori" key ada dalam the $_POST array
        if(isset($_POST['id_kategori'])){
            $id_kategori = $_POST['id_kategori'];
            $nama_kategori = htmlspecialchars($_POST['nama_kategori']);

            // query update
            $update_query = "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = $id_kategori";
            $result = $conn->query($update_query);

            if ($result) {
                // Redirect ke kategori.php
                header("Location: ../toko/kategori.php");
            } else {
                // Mengatasi SQL error
                echo "Error: " . $conn->error;
            }
        } else {
            // error jika id_kategori tidak diset
            echo "Error: id_kategori is not set.";
        }
    }
   
?>
