<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mobil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="text-white">
                    Daftar Mobil
                </h4>
            </div>

            <div class="card-body">
                <form action="list-mobil.php" method ="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Masukkan Keyword Pencarian" />
                </form>

                <ul class="list-group">
                    <?php
                    include "connection.php";
                    if (isset($_GET["search"])) {
                        $cari = $_GET["search"];
                        $sql = "select * from mobil 
                        where merk like '%$cari%' 
                        or jenis like '%$cari%' 
                        or warna like '%$cari%'
                        or biaya like '%$cari%'";
                    }else {
                        $sql = "select * from mobil";
                    }
                    # eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);
                    while ($buku = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- untuk gambar -->
                                    <img src="cover/<?=$buku["cover"]?>" 
                                    width="200" />
                                </div>
                                <div class="col-lg-6">
                                    <!-- untuk deskripsi buku -->
                                    <h5><?=$buku["judul_buku"]?></h5>
                                    <h6>Penulis : <?=$buku["penulis"]?></h6>
                                    <h6>Penerbit : <?=$buku["penerbit"]?></h6>
                                    <h6>Jumlah Halaman : <?=$buku["jumlah_halaman"]?></h6>
                                    <h6>Genre : <?=$buku["genre"]?></h6>
                                </div>
                                <div class="col-lg-2">
                                    <a href="form-buku.php?isbn=<?=$buku["isbn"]?>">
                                        <button class="btn btn-info btn-block">
                                         Edit
                                         </button>
                                    </a>

                                    <a href="process-buku.php?isbn=<?=$buku["isbn"]?>"
                                    onclick="return confirm('Are you sure?')">
                                        <button class="btn btn-danger btn-block">
                                          Hapus
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>