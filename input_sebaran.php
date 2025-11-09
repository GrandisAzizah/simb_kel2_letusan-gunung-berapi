<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Laporan Sebaran Wilayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="template.css">
</head>
<body>
    <!-- Navbar -->
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

    <!-- Konten Form -->
    <div class="container mt-5 mb-5">
        <h3 class="text-center fw-bold mb-4">Tambah Laporan Sebaran Wilayah Terdampak</h3>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Nama Gunung</label>
                <input type="text" name="nama_gunung" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Wilayah Terdampak</label>
                <input type="text" name="wilayah_terdampak" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Waktu Kejadian</label>
                <input type="datetime-local" name="waktu_kejadian" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Korban</label>
                <input type="number" name="jumlah_korban" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Informasi Terbaru</label>
                <textarea name="informasi_terbaru" class="form-control" rows="3" required></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="sebaran.php" class="btn btn-secondary">← Kembali</a>
                <button type="submit" name="submit" class="btn btn-danger">Simpan Laporan</button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer>
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

<?php
// Proses simpan data ke database
if (isset($_POST['submit'])) {
    $nama_gunung = $_POST['nama_gunung'];
    $wilayah = $_POST['wilayah_terdampak'];
    $waktu = $_POST['waktu_kejadian'];
    $korban = $_POST['jumlah_korban'];
    $info = $_POST['informasi_terbaru'];

    $query = "INSERT INTO sebaran_wilayah (nama_gunung, wilayah_terdampak, waktu_kejadian, jumlah_korban, informasi_terbaru)
              VALUES ('$nama_gunung', '$wilayah', '$waktu', '$korban', '$info')";

    if ($koneksi->query($query)) {
        echo "<script>alert('Laporan berhasil disimpan!'); window.location='sebaran.php';</script>";
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Gagal menyimpan laporan: " . $koneksi->error . "</div>";
    }
}
?>
