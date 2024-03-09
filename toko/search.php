<?php require "../proses/session.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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

        <div class="overlay"></div>  
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
                        Search
                        </li>  
                    </ol>
                </nav>
                <h1>Search</h1>
            <section id="Search">
                <div class="container mt-5">
                    <div class="row">
                <?php 
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    echo "<h5>Search Parameter: $search</h5>"; 
            
                    // $filter = $search ? "WHERE nama_produk LIKE '%$search%'" : '';
                    // $query = "SELECT * FROM produk $filter";
                    $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$search%'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        $count = 0;
                        while ($row = $result->fetch_assoc()) {
                            $id_produk = $row['id_produk'];
                            $nama_produk = $row['nama_produk'];
                            $harga = $row['harga'];
                            $gambar = $row['gambar_produk'];
                            $ketersediaan = $row['ketersediaan'];

                            echo "<div class='col-lg-3'>";
                            echo "<div class='box p-2'>";
                            echo "<img src='../image/$gambar' alt='' class='img-fluid'>";
                            echo "<h4>$nama_produk</h4>";
                            echo "<h5>$harga</h5>";
                            echo "<h6>$ketersediaan</h6>";
                            echo "<div class='btn-group admin-level'>";
                            echo "<a href='../proses/delete_produk.php?id=$id_produk' class='btn btn-sm btn-danger'>Delete</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            $count++;
                            if ($count % 4 == 0) {
                                echo "</div><div class='row mt-3'>";
                            }
                        }
                    } else {
                        echo "<div class='col-12 text-center '>";
                        echo "<h3>No products found</h3>";
                        echo "</div>";
                    }

                    $conn->close();
                ?>
            </div>
        </div>
    </section>
    </div>
</body>
</html>