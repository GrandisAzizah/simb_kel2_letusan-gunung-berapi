<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan Wilayah Terdampak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
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

            <button type="submit" name="submit" class="btn btn-danger w-100">Simpan Laporan</button>
            <a href="sebaran.php" class="btn btn-secondary w-100 mt-2">Kembali ke Daftar Sebaran</a>
        </form>
    </div>
</body>
</html>

<?php
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
