<?php
include 'koneksi.php';

// Pencarian data
$cari = "";
if (isset($_GET['cari'])) {
    $cari = $koneksi->real_escape_string($_GET['cari']);
    $query = "SELECT * FROM sebaran_wilayah 
              WHERE nama_gunung LIKE '%$cari%' 
              OR wilayah_terdampak LIKE '%$cari%' 
              ORDER BY waktu_kejadian DESC";
} else {
    $query = "SELECT * FROM sebaran_wilayah ORDER BY waktu_kejadian DESC";
}

$result = $koneksi->query($query);
if (!$result) {
    die("Query error: " . $koneksi->error);
}
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
    <body class="d-flex flex-column min-vh-100">
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="nav-left">
                <!-- Sidebar icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-justify" viewBox="0 0 16 16" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar">
                    <path fill-rule="evenodd"
                        d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>

                <div class="offcanvas offcanvas-start" id="offcanvasSidebar" data-bs-scroll="true"
                    data-bs-backdrop="false" tabindex="-1">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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

                <!-- Brand -->
                <a class="navbar-brand" href="#">Volcanoes Monitor</a>
            </div>

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

    <!-- Konten Utama -->
    <div class="container mt-4 mb-5">
        <h4 class="text-center fw-bold mb-4">Sebaran Wilayah Terdampak</h4>

        <!-- Form Pencarian -->
        <form method="GET" action="" class="d-flex justify-content-center mb-3">
            <input type="text" name="cari" placeholder="Cari Gunung / Wilayah"
                   value="<?= htmlspecialchars($cari) ?>" class="form-control w-25">
            <button type="submit" class="btn btn-outline-secondary ms-2">🔍</button>
        </form>

        <!-- Tombol Tambah -->
        <div class="text-end mb-3">
            <a href="input_sebaran.php" class="btn btn-danger">+ Tambah Laporan Baru</a>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Gunung</th>
                        <th>Wilayah Terdampak</th>
                        <th>Waktu Kejadian</th>
                        <th>Jumlah Korban</th>
                        <th>Informasi Terbaru</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nama_gunung']) ?></td>
                                <td><?= htmlspecialchars($row['wilayah_terdampak']) ?></td>
                                <td><?= htmlspecialchars($row['waktu_kejadian']) ?></td>
                                <td><?= htmlspecialchars($row['jumlah_korban']) ?></td>
                                <td><?= htmlspecialchars($row['informasi_terbaru']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Belum ada laporan wilayah terdampak.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-auto">
        <p class="fw-bolder text-center mb-0 mt-3">Volcanoes Monitor</p>
        <p class="text-center mb-0">Kontak Darurat: <strong>BNPB 0812-1237575 / 021-29827444</strong></p>
        <p class="text-center mb-3">Telepon Darurat: <strong>112</strong></p>
        <div class="text-center small">
            <a href="#tentang-kami">Tentang Kami</a> |
            <a href="#privasi">Kebijakan Privasi</a> |
            <a href="#syarat">Syarat & Ketentuan</a>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
