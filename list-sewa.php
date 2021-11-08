<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Daftar Sewa</title>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Daftar Sewa
                </h4>
            </div>

            <div class="card-body">
                <ul class="list-group">
                    <?php
                    include "connection.php";
                    $sql = "select 
                    sewa.*,pelanggan.*,karyawan.* 
                    from 
                    sewa inner join pelanggan
                    on pelanggan.id_pelanggan=sewa.id_pelanggan
                    inner join karyawan 
                    on sewa.id_karyawan=karyawan.id_karyawan";

                    $hasil = mysqli_query($connect, $sql);
                    while ($sewa = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Kode sewa</small>
                                    <h5><?=($sewa["id_sewa"])?></h5>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                <small class="text-info">Peminjam</small>
                                    <h5><?=($sewa["nama_pelanggan"])?></h5>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                <small class="text-info">karyawan</small>
                                    <h5><?=($sewa["nama_karyawan"])?></h5>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                <small class="text-info">Tgl. sewa</small>
                                    <h5><?=($sewa["tgl_sewa"])?></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <h6>
                                        Status :
                                        <?php if ($sewa["tgl_sewa"] != $sewa["tgl_kembali"]) { ?>
                                            <div class="badge badge-warning">
                                                Masih Disewa 
                                            </div>
                                            <a href="process-kembali.php?id_sewa=<?=$sewa["id_sewa"]?>"
                                            onclick="return confirm('Kamu yakin ingin kembali?')">
                                            <button class="btn btn-sm btn-success mx-2">
                                                Dikembalikan
                                            </button>
                                            </a>

                                        <?php } else {?>
                                            <div class="badge badge-success">
                                                Sudah Dikembalikan 
                                            </div>
                                            <div class="badge badge-info">
                                                Total Bayar : Rp <?=(number_format($sewa["total_bayar"],2))?>
                                            </div>
                                        <?php } ?>
                                    </h6>
                                </div>
                            </div>

                            <small class="text-success">
                                List mobil yang disewa
                            </small>

                            <ul>
                                <?php
                                $id_sewa = $sewa["id_sewa"];
                                $sql = "select * from sewa 
                                inner join mobil 
                                on sewa.id_mobil = mobil.id_mobil
                                ";

                                $hasil_mobil = mysqli_query($connect, $sql);
                                while ($mobil = mysqli_fetch_array($hasil_mobil)) {
                                    ?>
                                    <li>
                                        <small>
                                            <?=($mobil["jenis"])?>
                                            <i class="text-primary">
                                                (Merk <?=($mobil["merk"])?>)
                                            </i>
                                        </small>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    
</body>
</html>

