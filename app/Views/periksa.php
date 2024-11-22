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

    <h2>Periksa</h2>

    <!-- Form -->
    <form class="form mx-sm-3 mb-2" method="POST" action="<?= base_url('periksa/save') ?>" name="myForm" onsubmit="return(validate());">
        <!-- nama Pasien -->
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputPasien" class="sr-only">Pasien</label>
            <select class="form-control" name="Pasien">
                <option value="">Pilih Pasien</option>
                <?php foreach ($pasien as $data): ?>
                    <option value="<?= $data['ID']; ?>"><?= $data['nama']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <br>
        <!-- Nama Dokter -->
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputDokter" class="sr-only">Dokter</label>
            <select class="form-control" name="id_dokter" id="inputDokter">
                <option value="">Pilih Dokter</option>
                <?php foreach ($dokter as $data): ?>
                    <option value="<?= $data['ID']; ?>"><?= $data['nama']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <!-- tanggal periksa -->
        <div class="col mb-2">
            <label for="inputTanggalAkhir" class="form-label fw-bold">
                Tanggal Periksa
            </label>
            <input type="datetime-local" class="form-control" name="tgl_periksa" id="inputTanggal" placeholder="Tanggal periksa" value="<?= date('Y-m-d\TH:i'); ?>" />
        </div>

        <!-- Catatan -->
        <div class="col">
            <label for="catatan" class="form-label fw-bold">
                Catatan
            </label>
            <textarea class="form-control" name="catatan" id="inputCatatan" placeholder="Catatan pasien"><?php echo isset($catatan) ? $catatan : ''; ?></textarea>
        </div>

        <br>

        <div class="form-group">
            <label for="obat">Obat</label>
            <textarea id="obat" name="obat" class="form-control"><?= old('obat'); ?></textarea>
        </div>

        <table class="table table-hover">
            <!-- thead atau baris judul -->
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pasien</th>
                    <th scope="col">Dokter</th>
                    <th scope="col">Taggal Periksa</th>
                    <th scope="col">Catatan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data pasien -->
                <?php if (isset($periksa) && count($periksa) > 0): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($periksa as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['Pasien'] ?? ''); ?></td>
                            <td><?= htmlspecialchars($row['Dokter'] ?? ''); ?></td>
                            <td><?= htmlspecialchars($row['tgl_Periksa'] ?? ''); ?></td>
                            <td><?= htmlspecialchars($row['catatan'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- simpan data -->
        <div class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
    </form>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- Boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>