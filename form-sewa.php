<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg petugas
if (!isset($_SESSION["karyawan"])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Form Sewa</title>
</head>
<body>
<div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Form Sewa Mobil
                </h4>
            </div>

            <div class="card-body">
                <form action="process-sewa.php" method="post">
                    <!-- tgl_pinjam dibuat otomatis -->
                    <?php
                     date_default_timezone_set('Asia/Jakarta');
                    ?>
                    Tanggal Pinjam
                    <input type="text" name="tgl_sewa" class="form-control mb-2" 
                    readonly value="<?=(date("Y-m-d H:i:s"))?>">
                
                    <!-- pilih pelanggan melalui nama -->
                    Pilih Data pelanggan
                    <select name="id_pelanggan" class="form-control mb-2" required>
                    <?php
                      include "connection.php";
                      $sql = "select * from pelanggan";
                      $hasil = mysqli_query($connect, $sql);
                      while ($pelanggan = mysqli_fetch_array($hasil)) {
                    ?>

                 <option value="<?=($pelanggan["id_pelanggan"])?>">
                  <?=($pelanggan["nama_pelanggan"])?>
                 </option>

                 <?php
                 }
                 ?>
                </select>

                 <!-- petugas ambil dari data login -->
                 <input type="hidden" name="id_karyawan" 
                value="<?=($_SESSION["karyawan"]["id_karyawan"])?>">
                
                Karyawan
                <input type="text" name="nama_karyawan" 
                class="form-control mb-2" readonly
                value="<?=($_SESSION["karyawan"]["nama_karyawan"])?>">

                <!-- tampilkan pilihan mobil yg akan dipinjam -->
                Pilih Mobil yang akan di Sewa
                <select name="id_mobil[]" class="form-control mb-2" 
                required multiple="multiple">
                    <?php
                    $sql = " select * from mobil";
                    $hasil = mysqli_query($connect, $sql);
                    while ($mobil = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?=($mobil["id_mobil"])?>">
                           <?=($mobil["jenis"])?>
                        </option>
                        <?php
                    }
                    ?>
                </select>

                <button type="submit "class="btn btn-block btn-dark">
                    Pinjam
                </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>