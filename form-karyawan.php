<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form karyawan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="list-mobil.php">Rent</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    </li>
      <li class="nav-item active">
        <a class="nav-link" href="list-pelanggan.php">Pelanggan <span class="sr-only">(current)</span></a>
      </li>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="list-karyawan.php">Karyawan <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="list-sewa.php"> Daftar Sewa <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="form-sewa.php"> Sewa <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
  </div>
</nav>
<div class="container">
        <div class="card-header bg-info">
            <h4 class="text-white">Form karyawan</h4>
        </div>

        <div class="card-body">
            <?php
            if (isset($_GET["id_karyawan"])) {
                // memeriksa ketika load file ini,
                // apakah membawa data GET dgn nama "id_anggota'
                // jika true, maka form anggota digunakan utk edit

                # mengakses data anggota dari id_anggota yg dikirim
                include "connection.php";
                $id_karyawan = $_GET["id_karyawan"];
                $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
                # eksekusi perintah SQL
                $hasil = mysqli_query($connect, $sql);
                # konversi ke bentuk array
                $karyawan = mysqli_fetch_array($hasil);
                ?>

                <form action="process-karyawan.php" method="post"
                onsubmit ="return confirm('Apakah anda yakin ingin mengubah data ini?')">
                ID karyawan
                <input type="text" name="id_karyawan"
                class="form-control mb-2" required
                value="<?=$karyawan["id_karyawan"];?>" readonly/>

                Name
                <input type="text" name="nama_karyawan"
                class="form-control mb-2" required
                value="<?=$karyawan["nama_karyawan"];?>"/>

                Alamat
                <input type="text" name="alamat_karyawan"
                class="form-control mb-2" required
                value="<?=$karyawan["alamat_karyawan"];?>"/>

                Kontak
                <input type="text" name="kontak"
                class="form-control mb-2" required
                value="<?=$karyawan["kontak"];?>"/>

                Username
                <input type="text" name="username"
                class="form-control mb-2" required
                value="<?=$karyawan["username"];?>"/>

                Password
                <input type="password" name="password"
                class="form-control mb-2s"/>

                <button type="submit" class="btn btn-success btn-block"
                name="edit_karyawan">
                    Simpan
                </button>
            </form>
                <?php
            }else {
                // jika felse maka form anggota digunakan utk insert
                // atau tambah data baru
                ?>
                <form action="process-karyawan.php" method="post">
                Id Karyawan
                <input type="text" name="id_karyawan"
                class="form-control mb-2" required/>

                Nama
                <input type="text" name="nama_karyawan"
                class="form-control mb-2" required/>

                Alamat
                <input type="text" name="alamat_karyawan"
                class="form-control mb-2" required/>

                Kontak
                <input type="text" name="kontak"
                class="form-control mb-2" required/>

                Username
                <input type="text" name="username"
                class="form-control mb-2" required/>

                Password 
                <input type="password" name="password"
                class="form-control mb-2" required/>

                <button type="submit" class="btn btn-success btn-block"
                name="simpan_karyawan">
                    Simpan
                </button>
            </form>
                <?php
            }
            ?>
            
        </div>
    </div>
</body>
</html>