<?php
// api_posko.php
header('Content-Type: application/json'); // Beri tahu browser bahwa ini adalah JSON
include 'koneksi.php'; // Sertakan file koneksi

// Tentukan aksi apa yang diminta (via GET atau POST)
$action = $_REQUEST['action'] ?? '';

// Routing berdasarkan aksi
switch ($action) {
    case 'load_all':
        load_all_data($koneksi);
        break;
    case 'tambah_posko':
        tambah_posko($koneksi, $_POST);
        break;
    case 'tambah_logistik':
        tambah_logistik($koneksi, $_POST);
        break;
    case 'tambah_stok':
        tambah_stok($koneksi, $_POST);
        break;
    case 'get_posko': // Untuk fitur edit
        get_single_data($koneksi, 'posko_pengungsian', 'id_posko', $_GET['id']);
        break;
    case 'update_posko': // Untuk simpan editan
        update_posko($koneksi, $_POST);
        break;
    case 'hapus_posko':
        hapus_data($koneksi, 'posko_pengungsian', 'id_posko', $_POST['id']);
        break;
    case 'hapus_logistik':
        hapus_data($koneksi, 'logistik', 'id_logistik', $_POST['id']);
        break;
    case 'hapus_stok':
        hapus_data($koneksi, 'stok', 'id_stok', $_POST['id']);
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Aksi tidak valid']);
}

$koneksi->close();

// --- FUNGSI-FUNGSI ---

function load_all_data($k) {
    $dataPosko = $k->query("SELECT * FROM posko_pengungsian ORDER BY nama_posko")->fetch_all(MYSQLI_ASSOC);
    $dataLogistik = $k->query("SELECT * FROM logistik ORDER BY nama_barang")->fetch_all(MYSQLI_ASSOC);
    
    // Query stok dengan JOIN agar dapat nama posko dan nama barang
    $sqlStok = "SELECT s.id_stok, p.nama_posko, l.nama_barang, l.satuan, s.jumlah_stok, s.update_terakhir 
                FROM stok s
                LEFT JOIN posko_pengungsian p ON s.id_posko = p.id_posko
                LEFT JOIN logistik l ON s.id_logistik = l.id_logistik
                ORDER BY p.nama_posko, l.nama_barang";
    $dataStok = $k->query($sqlStok)->fetch_all(MYSQLI_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'dataPosko' => $dataPosko,
        'dataLogistik' => $dataLogistik,
        'dataStok' => $dataStok
    ]);
}

function tambah_posko($k, $data) {
    // PENTING: Pastikan kolom Anda 'penanggung_jawab' (bukan 'penangungg_jawab')
    $stmt = $k->prepare("INSERT INTO posko_pengungsian (nama_posko, alamat_posko, kapasitas_maksimal, penanggung_jawab) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $data['nama_posko'], $data['alamat_posko'], $data['kapasitas_maksimal'], $data['penanggung_jawab']);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Posko berhasil ditambahkan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan posko: ' . $stmt->error]);
    }
    $stmt->close();
}

function update_posko($k, $data) {
    if (!isset($data['id_posko_edit'], $data['nama_posko_edit'], $data['alamat_posko_edit'], $data['kapasitas_maksimal_edit'], $data['penanggung_jawab_edit'])) {
        echo json_encode(['status' => 'error', 'message' => 'Data edit tidak lengkap']);
        return;
    }

    $stmt = $k->prepare("UPDATE posko_pengungsian SET nama_posko = ?, alamat_posko = ?, kapasitas_maksimal = ?, penanggung_jawab = ? WHERE id_posko = ?");
    $stmt->bind_param("ssisi", 
        $data['nama_posko_edit'], 
        $data['alamat_posko_edit'], 
        $data['kapasitas_maksimal_edit'], 
        $data['penanggung_jawab_edit'], 
        $data['id_posko_edit']
    );
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Posko berhasil diperbarui']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui posko: ' . $stmt->error]);
    }
    $stmt->close();
}


function tambah_logistik($k, $data) {
    $stmt = $k->prepare("INSERT INTO logistik (nama_barang, satuan) VALUES (?, ?)");
    $stmt->bind_param("ss", $data['nama_barang'], $data['satuan']);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Logistik berhasil ditambahkan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan logistik: ' . $stmt->error]);
    }
    $stmt->close();
}

function tambah_stok($k, $data) {
    // Cek dulu apakah data sudah ada
    $cekStmt = $k->prepare("SELECT id_stok FROM stok WHERE id_posko = ? AND id_logistik = ?");
    $cekStmt->bind_param("ii", $data['id_posko'], $data['id_logistik']);
    $cekStmt->execute();
    $result = $cekStmt->get_result();
    $cekStmt->close();

    $now = date('Y-m-d H:i:s');

    if ($result->num_rows > 0) {
        // Jika sudah ada, UPDATE
        $stmt = $k->prepare("UPDATE stok SET jumlah_stok = ?, update_terakhir = ? WHERE id_posko = ? AND id_logistik = ?");
        $stmt->bind_param("isii", $data['jumlah_stok'], $now, $data['id_posko'], $data['id_logistik']);
        $msg = 'Stok berhasil diperbarui';
    } else {
        // Jika belum ada, INSERT
        $stmt = $k->prepare("INSERT INTO stok (id_posko, id_logistik, jumlah_stok, update_terakhir) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $data['id_posko'], $data['id_logistik'], $data['jumlah_stok'], $now);
        $msg = 'Stok berhasil ditambahkan';
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => $msg]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan stok: ' . $stmt->error]);
    }
    $stmt->close();
}

function get_single_data($k, $tabel, $kolom_id, $id) {
    $stmt = $k->prepare("SELECT * FROM $tabel WHERE $kolom_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result()->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $result]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengambil data']);
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