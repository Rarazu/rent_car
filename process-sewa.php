<?php
include "connection.php";
# menampung data yg dikirim
$id_sewa = $_POST["id_sewa"];
$tgl_sewa = $_POST["tgl_sewa"];
$id_pelanggan = $_POST["id_pelanggan"];
$id_karyawan = $_POST["id_karyawan"];
$mobil = $_POST["id_mobil"]; //array
$jumlah_hari = $_POST["jumlah_hari"];
$total_bayar = 0;

for($i = 0; $i < count($mobil); $i++ ){
    $sql = "select * from mobil where id_mobil='".$id_mobil[$i]."'";
    $hasil = mysqli_query($connect, $sql);
    $car = mysqli_fetch_array($hasil);
    $biaya = $car["biaya_sewa_per_hari"];
    $total = $biaya * $jumlah_hari;
    $total_bayar += $total;
}
# perintah SQL untuk insert ke tabel pinjam
$sql = "insert into sewa values ('$id_sewa','$id_karyawan','$id_pelanggan', 
    '$tgl_sewa','$jumlah_hari','$total_bayar')";
echo $sql;

if (mysqli_query($connect, $sql)) {
    # jika berhasil insert ke tabel sewa
    # insert ke tabel detail_pinjam
    for ($i=0; $i < count($mobil) ; $i++) {  // karena array (mobil yg dipinjam bisa > 1)
        $id_mobil = $mobil[$i];
        $sql = "insert into detail_sewa values
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