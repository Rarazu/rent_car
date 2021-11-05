<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar pelanggan Perpustakaan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="list-buku.php">Rent</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="list-pelanggan.php">Pelanggan <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="list-karyawan.php">   Karyawan <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="form-sewa.php"> Sewa <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="list-mobil.php"> Mobil <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
  </div>
</nav>
    <div class="container">
        <div class="card">
            <!-- card header -->
            <div class="card-header bg-info">
                <h4 class="text-white">Data Pelanggan </h4>
            </div>
            <!-- card body -->
            <div class="card-body">
                <!-- kotak pencarian data pelanggan -->
                <form action="list-pelanggan.php" method="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Masukkan Keyword Pencarian" required />
                </form>
                <ul class="list-group">
                    <?php
                    include("connection.php");
                    if (isset($_GET["search"])) {
                        # jika pada saat loadd halaman ini,
                        # akan mengecek apakah data dengan method
                        # GET yg bernama "search"
                        $search = $_GET ["search"];
                        $sql = "select * from pelanggan
                        where id_pelanggan like '%$search%'
                        or nama_pelanggan like '%$search%' 
                        or alamat like '%$search%'
                        or Kontak like '%$search%'";
                    } else {
                        $sql = "select * from pelanggan";
                    }
                    
                    //eksekusi perintah SQL
                    $query = mysqli_query($connect, $sql);
                    while ($pelanggan = mysqli_fetch_array($query)) {?>
                        <li class="list-group-item">
                        <div class="row">
                            <!-- bagian data pelanggan -->
                            <div class="col-lg-8 col-md-10">
                                <h5>Nama pelanggan: <?php echo $pelanggan["nama_pelanggan"];?></h5>
                                <h6>Alamat: <?php echo $pelanggan["alamat_pelanggan"];?></h6>
                                <h6>Kontak: <?php echo $pelanggan["kontak"];?></h6>
                                <h6>ID pelanggan: <?php echo $pelanggan["id_pelanggan"];?></h6>
                            </div>

                            <!-- bagian tombol pilihan -->
                            <div class="col-lg-4 col-md-2">
                                <a href="form-pelanggan.php?id_pelanggan=<?php echo $pelanggan["id_pelanggan"];?>">
                                <button class="btn btn-info btn-block">
                                    Edit
                                </button>
                            </a>
                                <div class="card-footer">
                                    <a href="process-pelanggan.php?id_pelanggan=<?=$pelanggan["id_pelanggan"]?>"
                                    onclick="return confirm('Are you sure?')">
                                </div>
                                <button class="btn btn-block btn-danger">
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

            <div class="card-footer">
                <a href="form-pelanggan.php"> 
                    <button class="btn btn-success">
                        Tambah Data pelanggan
                    </button>
                </a>
            </div>
            <!-- card footer -->
        </div>
    </div>
</body>
</html>