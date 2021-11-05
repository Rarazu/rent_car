<?php
include("connection.php");
if (isset($_POST["simpan_karyawan"])) {
    # proses insert new data
    // tampung data input anggota dari user
    $id_karyawan = $_POST["id_karyawan"];
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username= $_POST["username"];
    $password = sha1($_POST["password"]);
    
    // membuat perintah SQL utk insert data ke tabel karyawan
    $password = sha1($_POST['password']);
    $sql = "insert into karyawan values ('$id_karyawan','$nama_karyawan','$alamat_karyawan','$kontak',
    '$username', '$password')";

    // eksekusi perintah / menjalankan perintah SQL
    if (mysqli_query($connect, $sql)) {
        header("location:list-karyawan.php");
    }else {
        echo mysqli_error($connect);
    }
}

if (isset($_POST["edit_karyawan"])) {
    # tampung data yg akan diupdate
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username= $_POST["username"];

    if (empty($_POST["password"])) {
        # password tidak ikut teredit
        $sql = "update karyawan set nama_karyawan ='$nama_karyawan',
        kontak='$kontak',alamat_karyawan='$alamat_karyawan', 
        where id_karyawan='$id_karyawan'";
    } else {
        # password ikut ter edit
        $password = sha1($_POST['password']);
        $sql = "update karyawan set nama_karyawan ='$nama_karyawan',
        kontak='$kontak',alamat_karyawan='$alamat_karyawan',password='$password' 
        where id_karyawan='$id_karyawan'";
    }
    
    # eksekusi perintah SQL
    if (mysqli_query($connect, $sql)) {
        header("location:list-karyawan.php");
    }else {
        echo mysqli_error($connect);
    }

    # direct / dikembalikan ke halaman list anggota
    header("location:list-karyawan.php");
}
elseif (isset($_GET["id_karyawan"])) {
    $id_karyawan = $_GET["id_karyawan"];
    
    # hapus data yg ada di tabel buku
    $sql = "delete from karyawan where id_karyawan='$id_karyawan'";
    if (mysqli_query($connect, $sql)) {
        header("location:list-karyawan.php");
    } else {
        echo mysqli_error($connect);
    }
}
?>