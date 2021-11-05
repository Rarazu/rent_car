<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form mobil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="text-white">
                    Form mobil
                </h4>
            </div>

            <div class="card-body">
                <?php
                if (isset($_GET["id_mobil"])) {
                    # form untuk edit
                    $id_mobil = $_GET["id_mobil"];
                    $sql = "select * from mobil where id_mobil='$id_mobil'";

                    include "connection.php";
                    #ekseukusi SQL
                    $hasil = mysqli_query($connect, $sql);

                    #konversi ke array
                    $mobil = mysqli_fetch_array($hasil);
                    ?>
                    <form action="process-mobil.php" method="post" enctype="multipart/form-data">
                    ID Mobil
                    <input type="number" name="id_mobil" class="form-control mb-2" required
                    value=<?=$mobil["id_mobil"]?> readonly>

                    Nomor Mobil
                    <input type="text" name="nomor_mobil" class="form-control mb-2" required
                    value=<?=$mobil["nomor_mobil"]?>>

                    Merk
                    <select name="merk" class="form-control mb-2" required>
                        <option value="<?=$mobil["merk"]?>" selected>
                           <?=$mobil["merk"]?>
                        </option>
                        <option value="Toyota">Toyota</option>
                        <option value="Honda">Honda</option>
                        <option value="Suzuki">Suzuki</option>
                        <option value="Daihatsu">Daihatsu</option>
                        <option value="BMW">BMW</option>
                    </select>

                    Jenis
                    <select name="jenis" class="form-control mb-2" required>
                        <option value="<?=$mobil["jenis"]?>" selected>
                           <?=$mobil["jenis"]?>
                        </option>
                        <option value="Mobil Sedan">Mobil Sedan</option>
                        <option value="Mobil Coupe">Mobil Coupe</option>
                        <option value="Mobil Hatcback">Mobil Hatcback</option>
                        <option value="Mobil MPV">Mobil MPV</option>
                        <option value="Mobil SUV">Mobil SUV</option>
                    </select>

                    Warna
                    <select name="warna" class="form-control mb-2" required>
                        <option value="<?=$mobil["warna"]?>" selected>
                           <?=$mobil["warna"]?>
                        </option>
                        <option value="Hitam">Hitam</option>
                        <option value="Putih">Putih</option>
                        <option value="Silver">Silver</option>
                    </select>
               
                    Tahun Pembuatan
                    <input type="text" name="tahun_pembuatan" class="form-control mb-2" required
                    value=<?=$mobil["tahun_pembuatan"]?>>
                    
                    Biaya Sewa
                    <input type="number" name="biaya_sewa_per_hari" class="form-control mb-2" required
                    value=<?=$mobil["biaya_sewa_per_hari"]?>>

                    Image <br>
                    <img src="gambar/<?=$mobil["image"]?>" width="300">
                    <input type="file" name="image" class="form-control mb-2">

                    <button type="submit" class="btn btn-info btn-block" name="update_mobil">
                        Simpan
                    </button>
                </form>
                    <?php
                } else {
                    # form untuk insert
                    ?>
                    <form action="process-mobil.php" method="post" enctype="multipart/form-data">
                    ID Mobil
                    <input type="number" name="id_mobil" class="form-control mb-2" required>

                    Nomor Mobil
                    <input type="text" name="nomor_mobil" class="form-control mb-2" required>

                    Merk
                    <select name="merk" class="form-control mb-2" required>
                        <option value="Toyota">Toyota</option>
                        <option value="Honda">Honda</option>
                        <option value="Suzuki">Suzuki</option>
                        <option value="Daihatsu">Daihatsu</option>
                        <option value="BMW">BMW</option>
                    </select>

                    Jenis
                    <select name="jenis" class="form-control mb-2" required>
                        <option value="Mobil Sedan">Mobil Sedan</option>
                        <option value="Mobil Coupe">Mobil Coupe</option>
                        <option value="Mobil Hatcback">Mobil Hatcback</option>
                        <option value="Mobil MPV">Mobil MPV</option>
                        <option value="Mobil SUV">Mobil SUV</option>
                    </select>

                    Warna
                    <select name="warna" class="form-control mb-2" required>
                        <option value="Hitam">Hitam</option>
                        <option value="Putih">Putih</option>
                        <option value="Silver">Silver</option>
                    </select>
               
                    Tahun Pembuatan
                    <input type="text" name="tahun_pembuatan" class="form-control mb-2" required>
                    
                    Biaya Sewa
                    <input type="number" name="biaya_sewa_per_hari" class="form-control mb-2" required>

                    Image <br>
                    <input type="file" name="image" class="form-control mb-2">

                    <button type="submit" class="btn btn-info btn-block" name="simpan_mobil">
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