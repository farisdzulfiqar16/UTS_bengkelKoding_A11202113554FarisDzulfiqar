<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dokter</title>
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('index') ?>">Sistem Informasi Poliklinik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('periksa') ?>">Periksa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('pasien') ?>">Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('dokter') ?>">Dokter</a>
                    </li>

                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <h2>Dokter</h2>

    <!-- Form -->
    <form class="form row" method="POST" action="<?= base_url('pasien/save') ?>" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <?php
        // Mendefinisikan variabel untuk menyimpan data form
        $Nama = '';
        $Alamat = '';
        $NoHP = '';

        // Mengecek apakah form telah disubmit
        if (isset($_POST['simpan'])) {
            // Mengambil nilai dari form dan melakukan sanitasi input untuk menghindari SQL Injection
            $Nama = mysqli_real_escape_string($mysqli, $_POST['Nama']);
            $Alamat = mysqli_real_escape_string($mysqli, $_POST['Alamat']);
            $NoHP = mysqli_real_escape_string($mysqli, $_POST['NoHP']);
            // Membuat query untuk memasukkan data ke tabel 'pasien'
            $query = "INSERT INTO pasien (Nama, Alamat, NoHP) VALUES ('$Nama', '$Alamat', '$NoHP')";
            // Menjalankan query dan menyimpan hasilnya
            $result = mysqli_query($mysqli, $query);

            // Mengecek apakah query berhasil dieksekusi
            if ($result) {
                echo "Data berhasil disimpan!";
            } else {
                echo "Terjadi kesalahan saat menyimpan data: " . mysqli_error($mysqli);
            }
        }
        ?>



        <div class="col">
            <label for="inputIsi" class="form-label fw-bold">
                Nama
            </label>
            <input type="text" class="form-control" name="Nama" id="inputNama" placeholder="Nama" value="<?php echo $Nama ?>">
        </div>
        <br>
        <div class="col">
            <label for="inputTanggalAwal" class="form-label fw-bold">
                Alamat
            </label>
            <input type="text" class="form-control" name="Alamat" id="inputAlamat" placeholder="Alamat" value="<?php echo $Alamat ?>">
        </div>
        <br>
        <div class="col mb-2">
            <label for="inputTanggalAkhir" class="form-label fw-bold">
                No HP
            </label>
            <input type="text" class="form-control" name="NoHP" id="inputNo HP" placeholder="Nomer Hp" value="<?php echo $NoHP ?>">
        </div>
        <br>
        <div class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
    </form>
    
    <table class="table table-hover">
        <!-- thead atau baris judul -->
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pasien</th>
                <th scope="col">Alamat</th>
                <th scope="col">No.HP</th>
            </tr>
        </thead>
        <tbody>
                
        </tbody>
    </table>

    <!-- pop up pesan -->
    <?php if (isset($message)) : ?>
        <div class="alert alert-success mt-3">
            <?= $message; ?>
        </div>
    <?php endif; ?>

    <!-- Boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>