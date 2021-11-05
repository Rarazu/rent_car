<?php
include "connection.php";
if (isset($_POST["simpan_mobil"])) {
    # menampung data yg dikirim ke dalam variabel
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $warna = $_POST["warna"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];

    # manage upload file
    $fileName = $_FILES["image"]["name"]; // file name
    $extension = pathinfo($_FILES["image"]["name"]);
    $ext = $extension["extension"]; // ekstensi file

    $image = time()."-".$fileName;

    # proses upload
    $folderName = "gambar/$image";
    if (move_uploaded_file($_FILES["image"]["tmp_name"],$folderName)) {
        # proses insert data ke tabel mobil
        $sql = "insert into mobil values
        ('$id_mobil','$nomor_mobil','$merk','$jenis','$warna',
        '$tahun_pembuatan','$biaya_sewa_per_hari',
        '$image')";

        # eksekusi perintah SQL
        mysqli_query($connect, $sql);

        echo "Tambah data mobil berhasil";
        # direct ke halaman list-mobil
        header("location:list-mobil.php");
    }
    else {
        echo "Upload file gagal";
    }
}

elseif (isset($_POST["update_mobil"])) {
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $warna = $_POST["warna"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];

    # jika update data beserta gambar
    if (!empty($_FILES["image"]["name"])) {
        # ambil data nama file yg akan dihapus
        $sql = "select * from mobil where id_mobil='$id_mobil'";
        $hasil = mysqli_query($connect, $sql);
        $mobil = mysqli_fetch_array($hasil);
        $oldFileName = $mobil["gambar"];
        
        # membuang path file yg lama
        $path = "gambar/$oldFileName";
        echo $path;

        # cek eksistensi file yg lama
        if (file_exists($path)) {
            # hapus file yg lama
            unlink($path);
        }

        # membuat file name baru
        $image = time()."-".$_FILES["image"]["name"];
        $folder = "gambar/$image";

        # proses upload file yg baru
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $folder)) {
            $sql = "update mobil set nomor_mobil='$nomor_mobil',
            merk='$merk', jenis='$jenis', warna='$warna',
            tahun_pembuatan='$tahun_pembuatan',
            biaya_sewa_per_hari='$biaya_sewa_per_hari',
            image='$image'
            where id_mobil='$id_mobil'";

            if (mysqli_query($connect, $sql)) {
                # jika update berhasil
                header("location:list-mobil.php");
            } else {
                # jika update gagal
                echo mysqli_error($connect);
            }
            
        }
    }

    # jika update data saja
    else {
        $sql = "update mobil set nomor_mobil='$nomor_mobil',
            merk='$merk', jenis='$jenis', warna='$warna',
            tahun_pembuatan='$tahun_pembuatan',
            biaya_sewa_per_hari='$biaya_sewa_per_hari'
            where id_mobil='$id_mobil'";

            if (mysqli_query($connect, $sql)) {
                # jika update berhasil
                header("location:list-mobil.php");
            } else {
                # jika update gagal
                echo mysqli_error($connect);
            }
    }
}

elseif (isset($_GET["id_mobil"])) {
    $id_mobil = $_GET["id_mobil"];
    # ambil data dari tabel mobil sesuai id_mobil yg dikirim
    $sql = "select * from mobil where id_mobil='$id_mobil'";
    $hasil = mysqli_query($connect, $sql);
    $mobil = mysqli_fetch_array($hasil);
    $oldFileName = $mobil["image"];

    # ambil data name yg dihapus
    $oldFileName = $mobil["image"];

    # membuat path file yg lama
    $path = "gambar/$oldFileName";

    # hapus file yg ada di folder
    # cek eksistensi yang lama
    if (file_exists($path)) {
        # hapus file yg lama
        unlink($path);
    }

    # hapus data yg ada di tabel mobil
    $sql = "delete from mobil where id_mobil='$id_mobil'";
    if (mysqli_query($connect, $sql)) {
        header("location:list-mobil.php");
    } else {
        echo mysqli_error($connect);
    }
}
?>