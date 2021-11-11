<?php
include "connection.php";
# menampung data yg dikirim
$id_sewa = $_POST["id_sewa"];
$tgl_sewa = $_POST["tgl_sewa"];
$id_pelanggan = $_POST["id_pelanggan"];
$id_karyawan = $_POST["id_karyawan"];
$total_bayar = $_POST["total_bayar"];
$id_mobil = $_POST["id_mobil"]; //array

# perintah SQL untuk insert ke tabel pinjam
$sql = "insert into sewa values
('$id_sewa','$tgl_sewa',
'$id_pelanggan','$id_karyawan', '$total_bayar', '$id_mobil')";

if (mysqli_query($connect, $sql)) {
    # jika berhasil insert ke tabel pinjam
    # insert ke tabel detail_pinjam
    for ($i=0; $i < count($mobil) ; $i++) {  // karena array (mobil yg dipinjam bisa > 1)
        $id_mobil = $mobil[$i];
        $sql = "insert into sewa values
        ('$id_sewa','$id_mobil')";
        if (mysqli_query($connect, $sql)) {
            # jika berhasil insert ke tabel detail_pinjam
            # yaudah lanjut
        } else {
            # jika gagal insert ke tabel detail_pinjam
            echo mysqli_error($connect);
            exit;
        }
        
    }
    header("location:list-sewa.php");
} else {
    # jika gagal insert ke tabel pinjam
    echo mysqli_error($connect);
}

?>