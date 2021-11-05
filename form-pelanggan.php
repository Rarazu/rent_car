<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form pelanggan</title>
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
    <a class="nav-link" href="list-pelanggan.php">pelanggan <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="list-karyawan.php">Karyawan <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="form-mobil.php"> Mobil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="list-sewa.php"> Sewa <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
  </div>
</nav>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="text-white">Form pelanggan</h4>
            </div>

            <div class="card-body">
                <?php
                if(isset($_GET["id_pelanggan"])){
                  // jika true, maka form pelanggan digunakan utk edit

                # mengakses data pelanggan dari id_pelanggan yg dikirim
                include "connection.php";
                $id_pelanggan = $_GET["id_pelanggan"];
                $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
                # eksekusi perintah SQL
                $hasil = mysqli_query($connect, $sql);
                # konversi ke bentuk array
                $pelanggan = mysqli_fetch_array($hasil);
                ?>

                <form action="process-pelanggan.php" method="post"
                onsubmit ="return confirm('Apakah anda yakin ingin mengubah data ini?')">
                ID pelanggan
                <input type="text" name="id_pelanggan"
                class="form-control mb-2" required
                value="<?=$pelanggan["id_pelanggan"];?>" readonly/>

                Name
                <input type="text" name="nama_pelanggan"
                class="form-control mb-2" required
                value="<?=$pelanggan["nama_pelanggan"];?>"/>

                Alamat
                <input type="text" name="alamat_pelanggan"
                class="form-control mb-2" required
                value="<?=$pelanggan["alamat_pelanggan"];?>"/>

                Kontak
                <input type="text" name="kontak"
                class="form-control mb-2" required
                value="<?=$pelanggan["kontak"];?>"/>

                <button type="submit" class="btn btn-success btn-block"
                name="edit_pelanggan">
                    Simpan
                </button>
            </form>
                <?php
                }else{
                    // jika false, maka form pelanggan digunakan untuk insert
                    ?>
                    <form action="process-pelanggan.php" method="post">
                    ID pelanggan
                    <input type="text" name="id_pelanggan" 
                    class="form-control mb-2" required />

                    Nama pelanggan
                    <input type="text" name="nama_pelanggan" 
                    class="form-control mb-2" required />

                    Alamat pelanggan
                    <input type="text" name="alamat_pelanggan" 
                    class="form-control mb-2" required />

                    Kontak
                    <input type="text" name="kontak" 
                    class="form-control mb-2" required />

                    <button type="submit"
                    class="btn btn-success btn-block"
                    name="simpan_pelanggan">
                        Simpan
                    </button>
                    </form>
                    <?php
                }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>