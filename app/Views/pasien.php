<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman pasien</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/logout') ?>">Logout</a>
                    </li>
                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <h2>Pasien</h2>

    <!-- Form -->
    <form class="form mx-sm-3 mb-2" method="POST" action="<?= base_url('pasien/save') ?>">
        <div class="col">
            <label for="inputNama" class="form-label fw-bold">
                Nama
            </label>
            <input type="text" class="form-control" name="Nama" id="inputNama" placeholder="Nama" value="<?= isset($pasien['Nama']) ? $pasien['Nama'] : '' ?>">
        </div>
        <br>
        <div class="col">
            <label for="inputAlamat" class="form-label fw-bold">
                Alamat
            </label>
            <input type="text" class="form-control" name="Alamat" id="inputAlamat" placeholder="Alamat" value="<?= isset($pasien['Alamat']) ? $pasien['Alamat'] : '' ?>">
        </div>
        <br>
        <div class="col mb-2">
            <label for="inputNoHP" class="form-label fw-bold">
                No HP
            </label>
            <input type="text" class="form-control" name="NoHP" id="inputNoHP" placeholder="Nomer Hp" value="<?= isset($pasien['NoHP']) ? $pasien['NoHP'] : '' ?>">
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
            <!-- Data pasien -->
            <?php if (isset($pasien) && count($pasien) > 0): ?>
                <?php $no = 1; ?>
                <?php foreach ($pasien as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($row['alamat'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($row['NoHP'] ?? ''); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
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