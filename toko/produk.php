<?php 
    require "../proses/session.php"; 

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLengt = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString = $characters[rand(0, $charactersLengt - 1)];
        }
        return $randomString;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        
        <?php 
            if ($_SESSION['level'] == 'USER') : ?>
            .admin-level {
                display: none; 
            }
        <?php endif; ?>
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <link href="toko_style.css" rel="stylesheet" type="text/css">
        
        <div class="overlay">
            <?php require "navbar.php" ?>
            
            <div class="container content">
                <nav class="arial-label">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active mt-5" aria-current="page">
                            <a href="../toko/" class="no-decoration text-muted" >
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="26" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#0c134f" d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active mt-5" aria-current="page">
                            Produk
                        </li>  
                    </ol>
                </nav>
                <h1>Produk</h1>
                <div class="row mt-5 admin-level">

                <h3>Tambah Produk</h3>
                <div class="col-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Nama Produk :</span>
                            <input class="form-control" type="text" name="nama_produk" id="nama_produk" required />
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="kategori_produk">Kategori</label>
                            <select class="form-select" id="kategori_produk" name="kategori_produk" required>

                                <option value="">Pilih...</option>
                                <?php 
                                    include "koneksi.php";

                                    $sqlkategori_list = "SELECT * FROM kategori";
                                    $lis_kategori = $conn->query($sqlkategori_list);

                                    while ($row = $lis_kategori->fetch_array()) {
                                        $kategori_id = $row["id_kategori"];
                                        $kategori_nama = $row["nama_kategori"];

                                        echo "<option value=\"$kategori_id\">$kategori_nama</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Harga Produk :</span>
                            <input class="form-control" type="number" name="harga_produk" id="harga_produk" required />
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="gambar_produk">Gambar</label>
                            <input type="file" class="form-control" name="gambar_produk" id="gambar_produk" required >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-4">
                            <span class="input-group-text">Detail Produk</span>
                            <textarea class="form-control" rows="3" aria-label="With textarea" name="detail_produk" id="detail_produk" required ></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="ketersediaan_produk">Ketersediaan Produk</label>
                            <select class="form-select" id="ketersediaan_produk" name="ketersediaan_produk">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Habis">Habis</option>
                            </select>
                        </div>
                        <button type="submit" name="tambah_produk" class="btn btn-sm btn-primary">Tambah</button>
                    </div>     
                    </form>

                    <?php 
                        if(isset($_POST['tambah_produk'])){
                            $nama_produk = htmlspecialchars($_POST['nama_produk']);
                            $kategori_id = htmlspecialchars($_POST['kategori_produk']);
                            $harga = htmlspecialchars($_POST['harga_produk']);
                            $detail = htmlspecialchars($_POST['detail_produk']);
                            $ketersediaan = htmlspecialchars($_POST['ketersediaan_produk']);

                            $target_dir = "../image/";
                            $nama_file = basename($_FILES["gambar_produk"]["name"]);
                            $target_file = $target_dir . $nama_file;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            $image_size = $_FILES["gambar_produk"]["size"];
                            $random_name = generateRandomString(20);
                            $newname  = $random_name . "." . $imageFileType;

                            if($nama_produk == '' || $kategori_id == '' || $harga == '' || $detail == ''){
                                echo '<div class="alert alert-warning mt-3" role="alert">';
                                echo    "Data produk harus lengkap.";   
                                echo '</div>';
                            }
                            else{
                                if ($nama_file != '') {
                                    if ($image_size >= 2000000) {
                                        echo '<div class="alert alert-warning mt-3" role="alert">';
                                        echo    "File tidak boleh lebih dari 2mb.";   
                                        echo '</div>';
                                    }
                                    else{
                                        if($imageFileType != 'jpg' && $imageFileType != 'png' ){
                                            echo '<div class="alert alert-warning mt-3" role="alert">';
                                            echo    "File harus bertipe jpg/png.";   
                                            echo '</div>';
                                        }
                                        else{
                                            move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $target_dir . $newname);
                                        }
                                    }
                                }



                                $sqltambah = "INSERT INTO produk (nama_produk, kategori_id, gambar_produk, detail, harga, ketersediaan) VALUES ('$nama_produk', '$kategori_id', '$newname', '$detail', '$harga', '$ketersediaan')";
                                $simpan = $conn->query($sqltambah);

                                if ($simpan) {
                                    echo '<div class="alert alert-info mt-3" role="alert">';
                                    echo    "Produk berhasil ditambahkan.";   
                                    echo '</div>';

                                    echo '<meta http-equiv="refresh" content="0.8; url = produk.php"/>';

                                }
                                else{
                                    echo '<div class="alert alert-danger mt-3" role="alert">';
                                    echo "Error: " . $conn->error;
                                    echo '</div>';
                                }
            
                            }
                        }
                    ?>
                </div>
            
        
                <section id="Produk">
                        <div class="container mt-5">
                            <div class="row">
                                <?php 
                                    include_once("../proses/koneksi.php");
                                    $query="SELECT * FROM produk";
                                    $result= $conn->query($query);

                                    echo    "<div class='row'>";
                                    echo    "<div class='col-lg-3 mb-3'>";
                                    echo '<a href="cetak.php" class="btn btn-sm btn-primary">Cetak</a>';
                                    echo    "</div>";
                                    echo    "</div>";


                                    if ($result->num_rows > 0) {
                                        $count = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $id_produk = $row['id_produk'];
                                            $nama_produk = $row['nama_produk'];
                                            $harga = $row['harga'];
                                            $gambar = $row['gambar_produk'];
                                            $ketersediaan = $row['ketersediaan'];
                                    
                                            echo    "<div class='col-lg-3'>";
                                            echo        "<div class='box p-2'>";
                                            echo            "<img src='../image/$gambar' alt='' class='img-fluid'>";
                                            echo               "<h4>$nama_produk</h4>";
                                            echo               "<h5>$harga</h5>";
                                            echo               "<h6>$ketersediaan</h6>";
                                            echo            "<div class='btn-groub admin-level'>";
                                            echo                "<a href='../proses/delete_produk.php?id=$id_produk' class='btn btn-sm btn-danger'>Delete</a>";
                                            echo            "</div>";
                                            echo        "</div>";
                                            echo    "</div>";
                                            $count++;
                                            if ($count % 4 == 0) {
                                                echo "</div><div class='row mt-3'>";
                                            }
                                        }
                                    }
                                    else {
                                        echo "<div class='col-12 text-center '>";
                                        echo    "<h3>Tidak ada data produk</h3>";
                                        echo    "<h3 class='admil-level'>Silahkan tambahkan data produk...</h3>";
                                        echo "</div>";
                                    }
                                    $conn->close();?>?>
                                ?>
                        </div>
                    </div>
                </section>
            </div>
        </div> 
</body>
</html>