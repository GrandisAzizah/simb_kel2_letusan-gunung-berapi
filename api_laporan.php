<?php
// api_laporan.php
header('Content-Type: application/json');
include 'koneksi.php'; // Memanggil file koneksi.php Anda

$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'load_all':
        load_all_data($koneksi);
        break;
    case 'tambah_laporan':
        tambah_laporan($koneksi, $_POST);
        break;
    case 'tambah_letusan':
        tambah_letusan($koneksi, $_POST);
        break;
    case 'verifikasi_laporan':
        verifikasi_laporan($koneksi, $_POST);
        break;
    case 'hapus_laporan':
        hapus_data($koneksi, 'laporan', 'id_laporan', $_POST['id']);
        break;
    case 'hapus_letusan':
        hapus_data($koneksi, 'letusan', 'id_letusan', $_POST['id']);
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Aksi tidak valid']);
}

$koneksi->close();

// --- FUNGSI-FUNGSI ---

function load_all_data($k) {
    // Ambil laporan dan gabung dengan nama petugas
    $sqlLaporan = "SELECT l.*, p.nama_petugas 
                   FROM laporan l
                   LEFT JOIN petugas p ON l.id_petugas = p.id_petugas
                   ORDER BY l.waktu_laporan DESC, l.id_laporan DESC";
    $dataLaporan = $k->query($sqlLaporan)->fetch_all(MYSQLI_ASSOC);

    // Ambil letusan dan gabung dengan nama gunung
    $sqlLetusan = "SELECT le.*, g.nama_gunung 
                   FROM letusan le
                   LEFT JOIN gunung g ON le.id_gunung = g.id_gunung
                   ORDER BY le.tanggal_letusan DESC";
    $dataLetusan = $k->query($sqlLetusan)->fetch_all(MYSQLI_ASSOC);

    echo json_encode([
        'status' => 'success',
        'dataLaporan' => $dataLaporan,
        'dataLetusan' => $dataLetusan
    ]);
}

function tambah_laporan($k, $data) {
    // Status diatur otomatis 'Menunggu Verifikasi'
    $stmt = $k->prepare("INSERT INTO laporan (id_petugas, waktu_laporan, judul_laporan, detail_laporan, status_verifikasi) VALUES (?, ?, ?, ?, 'Menunggu Verifikasi')");
    $stmt->bind_param("isss", 
        $data['id_petugas'], 
        $data['waktu_laporan'], 
        $data['judul_laporan'], 
        $data['detail_laporan']
    );
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Laporan berhasil dikirim']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim laporan: ' . $stmt->error]);
    }
    $stmt->close();
}

function tambah_letusan($k, $data) {
    $stmt = $k->prepare("INSERT INTO letusan (id_gunung, tanggal_letusan, tingkat_letusan, durasi_letusan, jumlah_korban, dampak_ekonomi) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssis",
        $data['id_gunung'],
        $data['tanggal_letusan'],
        $data['tingkat_letusan'],
        $data['durasi_letusan'],
        $data['jumlah_korban'],
        $data['dampak_ekonomi']
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data letusan berhasil disimpan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data letusan: ' . $stmt->error]);
    }
    $stmt->close();
}

function verifikasi_laporan($k, $data) {
    $stmt = $k->prepare("UPDATE laporan SET status_verifikasi = ? WHERE id_laporan = ?");
    $stmt->bind_param("si", $data['status'], $data['id_laporan']);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Status laporan diperbarui']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status: ' . $stmt->error]);
    }
    $stmt->close();
}

function hapus_data($k, $tabel, $kolom_id, $id) {
    $stmt = $k->prepare("DELETE FROM $tabel WHERE $kolom_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data: ' . $stmt->error]);
    }
    $stmt->close();
}
?>