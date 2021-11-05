<?php
include("connection.php");
if (isset($_POST["simpan_karyawan"])) {
    # proses insert new data
    // tampung data input anggota dari user
    $id_karyawan = $_POST["id_karyawan"];
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);


    // membuat perintah SQL utk insert data ke tbl anggota
    $sql = "insert into karyawan values 
    ('$id_karyawan','$nama_karyawan','$alamat_karyawan','$kontak','$username','$password')";

    // eksekusi perintah / menjalankan perintah SQL
    mysqli_query($connect, $sql);

    // direct / dikembalikan ke halaman list anggota
    header("location:list-karyawan.php");
}

if (isset($_POST["edit_karyawan"])) {
    # tampung data yg akan diupdate
    $id_karyawan = $_POST["id_karyawan"];
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    
    if (empty($_POST["password"])) {
        # password tidak ikut teredit
        $sql = "update karyawan set nama_karyawan='$nama_karyawan',
        alamat_karyawan='$alamat_karyawan',
        kontak='$kontak',username='$username' where 
        id_karyawan='$id_karyawan'";
    } else {
        # password ikut teredit
        $password = sha1($_POST["password"]);
        $sql = "update karyawan set nama_karyawan='$nama_karyawan',
        alamat_karyawan='$alamat_karyawan',
        kontak='$kontak',username='$username' where 
        id_karyawan='$id_karyawan'";
    }

    if ( mysqli_query($connect, $sql)) {
        header("location:list-karyawan.php");
    } else {
        echo mysqli_error($connect);
    }
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