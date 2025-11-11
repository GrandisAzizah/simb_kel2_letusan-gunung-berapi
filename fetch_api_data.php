<?php
// fetch_api_data.php - Bertindak sebagai proxy antara frontend dan API eksternal

// URL API publik yang menyediakan data sebaran wilayah
// Ganti dengan URL API yang sebenarnya!
$api_url = "URL_API_PUBLIK_ANDA"; 

// Mendapatkan nilai pencarian dari AJAX
$cari = isset($_POST['cari']) ? $_POST['cari'] : '';

// --- 1. Ambil Data dari API menggunakan cURL ---
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

header('Content-Type: application/json');

if ($http_code !== 200 || $response === false) {
    http_response_code(500); 
    echo json_encode(['error' => 'Gagal mengambil data dari sumber API.', 'code' => $http_code]);
    exit;
}

// Dekode JSON
$data_api = json_decode($response, true);

if ($data_api === null) {
    http_response_code(500); 
    echo json_encode(['error' => 'Gagal mengurai respons JSON dari API.']);
    exit;
}

// --- 2. Proses dan Filter Data (Jika diperlukan) ---

// Asumsi: API mengembalikan array data langsung. 
// Jika API mengembalikan object dengan key 'reports' atau sejenisnya, sesuaikan: $data_list = $data_api['reports'];
$data_list = $data_api;

$filtered_data = [];

// Lakukan filtering di sisi server PHP jika ada query pencarian
if (!empty($cari)) {
    $cari_lower = strtolower($cari);
    foreach ($data_list as $record) {
        // *** PENTING: SESUAIKAN NAMA PROPERTI JSON di sini (contoh: 'mountain', 'region')
        // Ini adalah contoh field yang disesuaikan dengan kebutuhan tabel sebaran.php
        $nama_gunung        = $record['mountain_name'] ?? ''; 
        $wilayah_terdampak  = $record['affected_regions'] ?? '';
        
        if (strpos(strtolower($nama_gunung), $cari_lower) !== false || 
            strpos(strtolower($wilayah_terdampak), $cari_lower) !== false) {
            
            // Tambahkan record yang cocok
            $filtered_data[] = [
                'nama_gunung'       => $nama_gunung,
                'wilayah_terdampak' => $wilayah_terdampak,
                'waktu_kejadian'    => $record['event_timestamp'] ?? 'N/A',
                'jumlah_korban'     => $record['casualties'] ?? 0,
                'informasi_terbaru' => $record['latest_info'] ?? 'Belum ada informasi terbaru.',
            ];
        }
    }
} else {
    // Jika tidak ada pencarian, kirim semua data
    foreach ($data_list as $record) {
         $filtered_data[] = [
            'nama_gunung'       => $record['mountain_name'] ?? '',
            'wilayah_terdampak' => $record['affected_regions'] ?? '',
            'waktu_kejadian'    => $record['event_timestamp'] ?? 'N/A',
            'jumlah_korban'     => $record['casualties'] ?? 0,
            'informasi_terbaru' => $record['latest_info'] ?? 'Belum ada informasi terbaru.',
        ];
    }
}

// Kembalikan data dalam format yang diharapkan oleh frontend
echo json_encode(['data' => $filtered_data]);
?>