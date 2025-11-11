<?php
// fetch_api_data.php - Mengambil data dari Endpoint Laporan Gunung Api MAGMA

// URL API yang paling relevan untuk laporan aktivitas gunung api
$api_url = "https://magma.esdm.go.id/v1/gunung-api/laporan"; 
$cari = isset($_POST['cari']) ? $_POST['cari'] : '';

// --- 1. Ambil Data dari API menggunakan cURL ---
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15); // Tingkatkan timeout untuk koneksi eksternal

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

header('Content-Type: application/json');

if ($http_code !== 200 || $response === false) {
    // Jika gagal, kembalikan response error
    http_response_code(500); 
    echo json_encode(['data' => [], 'error' => 'Gagal mengambil data dari MAGMA. Pastikan endpoint ini terbuka untuk publik.']);
    exit;
}

$data_api = json_decode($response, true);

// Asumsi: Data laporan berada di dalam key 'data' atau langsung di root array
// Anda mungkin perlu menyesuaikan baris ini jika struktur respons berbeda
$data_list = $data_api['data'] ?? $data_api; 

$filtered_data = [];
$cari_lower = strtolower($cari);

foreach ($data_list as $record) {
    
    // *** ASUMSI PEMETAAN FIELD JSON MAGMA ***
    // (Anda harus menyesuaikan nama-nama key ini {nama_gunung, rekomendasi, dll.} sesuai dengan JSON asli yang diterima)
    $nama_gunung_api = $record['volcano_name'] ?? $record['nama_gunung'] ?? 'N/A';
    $rekomendasi = $record['recommendation'] ?? $record['rekomendasi'] ?? 'Cek laporan resmi PVMBG.';
    $level_status = $record['status_level'] ?? $record['level'] ?? 'N/A';
    $waktu_update = $record['report_time'] ?? $record['waktu'] ?? 'N/A';
    
    // Lakukan filtering berdasarkan Nama Gunung
    if (!empty($cari) && strpos(strtolower($nama_gunung_api), $cari_lower) === false) {
        continue;
    }
    
    // Pemetaan data ke format tabel Anda
    $filtered_data[] = [
        'nama_gunung'       => $nama_gunung_api,
        // Wilayah terdampak diinterpretasikan dari teks rekomendasi yang berisi zona bahaya
        'wilayah_terdampak' => "Status: ${level_status}. " . substr($rekomendasi, 0, 70) . (strlen($rekomendasi) > 70 ? '...' : ''), 
        'waktu_kejadian'    => $waktu_update, 
        'jumlah_korban'     => 'N/A', // Data korban tidak disediakan di API Status
        'informasi_terbaru' => "Rekomendasi terkini: ${rekomendasi}",
    ];
}

// Kembalikan data dalam format JSON
echo json_encode(['data' => $filtered_data]);
?>