<?php
$koneksi = new mysqli("localhost", "root", "", "gunung_berapi");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$cari = "";
if (isset($_GET['cari'])) {
    $cari = $koneksi->real_escape_string($_GET['cari']);
    $query = "
        SELECT 
            g.nama_gunung,
            w.nama_wilayah,
            w.kategori_resiko,
            w.estimasi_populasi,
            d.tingkat_dampak,
            d.radius_dampak_km,
            d.deskripsi
        FROM dampak d
        JOIN wilayah w ON d.id_wilayah = w.id_wilayah
        JOIN letusan l ON d.id_letusan = l.id_letusan
        JOIN gunung g ON l.id_gunung = g.id_gunung
        WHERE w.nama_wilayah LIKE '%$cari%' OR g.nama_gunung LIKE '%$cari%'
    ";
} else {
    $query = "
        SELECT 
            g.nama_gunung,
            w.nama_wilayah,
            w.kategori_resiko,
            w.estimasi_populasi,
            d.tingkat_dampak,
            d.radius_dampak_km,
            d.deskripsi
        FROM dampak d
        JOIN wilayah w ON d.id_wilayah = w.id_wilayah
        JOIN letusan l ON d.id_letusan = l.id_letusan
        JOIN gunung g ON l.id_gunung = g.id_gunung
    ";
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
    <div class="container mt-4 mb-5">
        <h4 class="text-center fw-bold">Sebaran Wilayah Terdampak</h4>

        <div class="text-center mt-3 mb-3">
            <form method="GET" action="">
                <input type="text" name="cari" placeholder="Cari Gunung / Wilayah"
                    value="<?= htmlspecialchars($cari) ?>"
                    class="form-control d-inline-block" style="width: 300px;">
                <button type="submit" class="btn btn-outline-secondary btn-sm">🔍</button>
            </form>
        </div>

        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Gunung</th>
                    <th>Wilayah</th>
                    <th>Kategori Risiko</th>
                    <th>Populasi</th>
                    <th>Tingkat Dampak</th>
                    <th>Radius (Km)</th>
                    <th>Deskripsi Dampak</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama_gunung']) ?></td>
                            <td><?= htmlspecialchars($row['nama_wilayah']) ?></td>
                            <td><?= htmlspecialchars($row['kategori_resiko']) ?></td>
                            <td><?= htmlspecialchars($row['estimasi_populasi']) ?></td>
                            <td><?= htmlspecialchars($row['tingkat_dampak']) ?></td>
                            <td><?= htmlspecialchars($row['radius_dampak_km']) ?></td>
                            <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Belum ada data dampak wilayah.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
