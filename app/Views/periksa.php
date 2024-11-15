<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Periksa</title>
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

    <h2>Periksa</h2>

 <!-- Form -->
    <form class="form row" method="POST" action="<?= base_url('/periksa/save') ?>" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputPasien" class="sr-only">Pasien</label>
            <select class="form-control" name="id_pasien">
                <?php
                $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
                while ($data = mysqli_fetch_array($pasien)) {
                    $selected = ($data['id'] == $id_pasien) ? 'selected="selected"' : '';
                ?>
                    <option value="<?php echo $data['id']; ?>" <?php echo $selected; ?>><?php echo $data['nama']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>

    <?php
    $result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
    $no = 1;
    while ($data = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['nama_pasien'] ?></td>
            <td><?php echo $data['nama_dokter'] ?></td>
            <td><?php echo $data['tgl_periksa'] ?></td>
            <td><?php echo $data['catatan'] ?></td>
            <td>
                <a class="btn btn-success rounded-pill px-3" 
                href="index.php?page=periksa&id=<?php echo $data['id'] ?>">
                Ubah</a>
                <a class="btn btn-danger rounded-pill px-3" 
                href="index.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
            </td>
        </tr>
    <?php
    }
    ?>

        <div class="col">
            <label for="inputIsi" class="form-label fw-bold">
                Nama
            </label>
            <input type="text" class="form-control" name="Nama" id="inputNama" placeholder="Nama" value="<?php echo $Nama_pasien ?>">
        </div>
        <br>
        <div class="col">
            <label for="inputTanggalAwal" class="form-label fw-bold">
                Nama Dokter
            </label>
            <input type="text" class="form-control" name="Nama dokter" id="inputAlamat" placeholder="Nama Dokter" value="<?php echo $Nama_dokter ?>">
        </div>
        <br>

        <div class="col mb-2">
            <label for="inputTanggalAkhir" class="form-label fw-bold">
                Tanggal Periksa
            </label>
            <input type="date" class="form-control" name="Tanggal periksa" id="inputTanggal" placeholder="Tanggal periksa" value="<?php echo $tgl_periksa ?>">
        </div>

        <div class="col">
            <label for="inputTanggalAwal" class="form-label fw-bold">
                Catatan
            </label>
            <input type="text" class="form-control" name="Nama dokter" id="catatan" placeholder="Catatan" value="<?php echo $catatan ?>">
        </div>
        <br>

        <div class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
    </form>

    <!-- Boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>