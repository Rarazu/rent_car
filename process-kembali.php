<?php
include "connection.php";
$id_sewa = $_GET["id_sewa"];
date_default_timezone_set('Asia/Jakarta');
$tgl_kembali = date_create(date("Y-m-d H:i:s"));
$tgl_kembali_fix = date("Y-m-d H:i:s");

# selisih hari = selisih tgl_kembali dan tgl_sewa
# jika selisiih hari > 7, maka denda = (selisih hari - 7) * 1
# else denda = 0

$sql = "select * from sewa where id_sewa='$id_sewa'";
$hasil = mysqli_query($connect, $sql);
$sewa = mysqli_fetch_array($hasil);
$tgl_sewa = date_create($sewa["tgl_sewa"]);

#menghitung selisih antara dua tanggal
$selisih = date_diff($tgl_kembali, $tgl_sewa);
# mengkonversi hasil selisih format jumlah hari
$selisih_hari  = $selisih->format("%a");

$biaya_sewa_per_hari = "select from mobil";
$total_bayar = $selisih_hari * $biaya_sewa_per_hari;


$sql = "insert into sewa values
('','$id_sewa','$tgl_kembali_fix','$total_bayar')";

if (mysqli_query($connect, $sql)) {
    header("location:list-sewa.php");
} else {
    echo mysqli_error($connect);
}

?>