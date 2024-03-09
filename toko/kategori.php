
<?php require "../proses/session.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
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
                            Kategori
                        </li>  
                    </ol>
                </nav>
                <h1>Kategori</h1>

                <div class="mt-5 admin-level col-6 admin-level">
                    <h3>Tambah Kategori</h3>
                    <form action="" method="post">
                        <div class="input-group">
                            <span class="input-group-text">Nama Kategori :</span>
                            <input class="form-control" type="text" name="nama_kategori" id="nama_kategori"/>
                            <button type="submit" name="tambah_kategori" class="btn btn-sm btn-primary">Tambah</button>
                        </div>
                    </form>

                    <?php 
                        if(isset($_POST['tambah_kategori'])){
                            $nama_kategori = htmlspecialchars($_POST['nama_kategori']);
                            $sqlcek = "SELECT nama_kategori FROM kategori WHERE nama_kategori = '$nama_kategori'";
                            $hasilcek = $conn->query($sqlcek);
                            $countcek = mysqli_num_rows($hasilcek);

                            if ($countcek > 0) {
                                echo '<div class="alert alert-warning mt-3" role="alert">';
                                echo    "Kategori sudah ada.";   
                                echo '</div>';
                                
                            } else {
                                $sqlsimpan = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
                                $simpan = $conn->query($sqlsimpan);

                                if($simpan){
                                    echo '<div class="alert alert-info mt-3" role="alert">';
                                    echo    "Kategori berhasil ditambahkan.";   
                                    echo '</div>';

                                    echo '<meta http-equiv="refresh" content="0.8; url = kategori.php"/>';
                                } else{
                                    echo mysqli_error($conn);
                                }
                                
                            }
                        }
                    ?>
                </div>
                <section id="Kategori">
                    <div class="container mt-5">
                        <div class="row">
                            <?php 
                            include_once("../proses/koneksi.php");
                            $query="SELECT * FROM kategori";
                            $result= $conn->query($query);

                            if ($result->num_rows > 0) {
                                $count = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $id_kategori = $row['id_kategori'];
                                    $nama_kategori = $row['nama_kategori'];

                                    echo    "<div class='col-lg-3'>";
                                    echo        "<div class='box  p-2'>";
                                    echo            "<h4>$nama_kategori</h4>";
                                    echo            "<div class='btn-groub admin-level'>";
                                                        // Button trigger modal 
                                    // echo               '<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">';
                                    // echo               "Edit";

                                    // echo              '</button>';
                                    echo '<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal' . $id_kategori . '">';
                                    echo "Edit";
                                    echo '</button>';
                                    echo                "<a href='../proses/delete_kategori.php?id=$row[id_kategori]' class='btn btn-sm btn-danger'>Delete</a>";     
                                    echo            '</div>';
                                    echo        "</div>";
                                    echo    "</div>";

                                    // Edit Modal for Each Category
                                    echo '<div class="modal fade" id="editModal' . $id_kategori . '" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel' . $id_kategori . '" aria-hidden="true">';
                                    echo    '<div class="modal-dialog modal-dialog-centered">';
                                    echo        '<div class="modal-content">';
                                    echo            '<div class="modal-header">';
                                    echo                '<h1 class="modal-title fs-5" id="editModalLabel' . $id_kategori . '">Edit Kategori</h1>';
                                    echo                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                                    echo                '</div>';
                                    echo            '<div class="modal-body">';
                                                        // <!-- Form for Editing -->
                                    echo                '<form action="../proses/edit_kategori.php" method="post">';
                                    echo                    '<div class="input-group">';
                                    echo                        '<span class="input-group-text">Nama Kategori :</span>';
                                    echo                        '<input class="form-control" type="text" name="nama_kategori" id="nama_kategori" value="' . $nama_kategori . '" />';
                                    echo                        '<input type="hidden" name="id_kategori" value="' . $id_kategori . '" />';
                                    echo                        '<button type="submit" name="simpan_edit_kategori" class="btn btn-sm btn-primary">Simpan Perubahan</button>';
                                    echo                    '</div>';
                                    echo                '</form>';
                                    echo            '</div>';
                                    echo            '<div class="modal-footer">';
                                    echo                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                                    echo            '</div>';
                                    echo        '</div>';
                                    echo    '</div>';
                                    echo '</div>';
                                    $count++;
                                    if ($count % 4 == 0) {
                                        echo "</div><div class='row mt-3'>";
                                    }
                                }
                            }
                            else {
                                echo "<div class='col-12 text-center '>";
                                echo    "<h3>Tidak ada data kategori</h3>";
                                echo    "<h3 class='admil-level' >Silahkan tambahkan data kategori...</h3>";
                                echo "</div>";
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
</body>
</html>