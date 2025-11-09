<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "gunung_berapi");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Pencarian wilayah (fitur search)
$cari = "";
if (isset($_GET['cari'])) {
    $cari = $koneksi->real_escape_string($_GET['cari']);
    $query = "SELECT * FROM wilayah_terdampak 
                WHERE wilayah_terdampak LIKE '%$cari%' OR nama_gunung LIKE '%$cari%'";
} else {
    $query = "SELECT * FROM wilayah_terdampak";
}

$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sebaran Wilayah Terdampak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="template.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="nav-left">
                <!-- ikon sidebar -->
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-justify"
                    viewBox="0 0 16 16" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                    <path fill-rule="evenodd"
                        d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>

                <div class="offcanvas offcanvas-start" id="offcanvasSidebar" data-bs-scroll="true"
                    data-bs-backdrop="false" tabindex="-1">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body justify-content-start">
                        <a href="index.php">Beranda</a>
                        <a href="status.php">Cek Status Gunung</a>
                        <a href="sebaran.php">Wilayah Terdampak</a>
                        <a href="dataPosko.php">Posko & Logistik</a>
                        <a href="dataKorban.php">Data Korban & Pengungsi</a>
                        <a href="laporan.php">Laporan Kejadian & Riwayat Letusan</a>
                    </div>
                </div>

                <!-- nama brand -->
                <a class="navbar-brand" href="#">Volcanoes Monitor</a>
            </div>

            <!-- menu kanan -->
            <div class="nav-menu">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container mt-4 mb-5">
        <h4 class="text-center fw-bold">Sebaran Wilayah Terdampak</h4>

        <!-- Form Pencarian -->
        <div class="text-center mt-3 mb-3">
            <form method="GET" action="">
                <input type="text" name="cari" placeholder="Cari Wilayah" value="<?= htmlspecialchars($cari) ?>" class="form-control d-inline-block" style="width: 300px;">
                <button type="submit" class="btn btn-outline-secondary btn-sm">🔍</button>
            </form>
        </div>

        <!-- Tabel -->
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Gunung</th>
                    <th>Wilayah Terdampak</th>
                    <th>Waktu Kejadian</th>
                    <th>Korban</th>
                    <th>Informasi Terbaru</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= ($row['nama_gunung']) ?></td>
                            <td><?= ($row['wilayah_terdampak']) ?></td>
                            <td><?= ($row['waktu_kejadian']) ?></td>
                            <td><?= ($row['korban']) ?></td>
                            <td><?= ($row['informasi_terbaru']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>Footer</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
