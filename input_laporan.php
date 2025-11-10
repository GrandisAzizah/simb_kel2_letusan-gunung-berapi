<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kejadian - Volcanoes Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="template.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-header {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card-header {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #dc2626;
            border: none;
        }
        .btn-primary:hover {
            background-color: #b91c1c;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 0.2rem rgba(220, 38, 38, 0.25);
        }

        .table thead {
            background-color: #dc2626;
            color: white;
        }

        .modal-header {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        
        .stats-card {
            background: white; border-radius: 10px; padding: 20px;
            text-align: center; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .stats-icon { font-size: 2.5rem; margin-bottom: 10px; }
        .stats-number { font-size: 2rem; font-weight: 700; color: #dc2626; }
        .stats-label { color: #6c757d; font-size: 0.9rem; }

        .laporan-card {
            border-left: 4px solid #dc2626; margin-bottom: 15px; padding: 15px;
            background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .status-badge { position: absolute; top: 15px; right: 15px; }
        .filter-section {
            background: white; padding: 20px; border-radius: 10px;
            margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="nav-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-justify" viewBox="0 0 16 16" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar">
                    <path fill-rule="evenodd"
                        d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>

                <div class="offcanvas offcanvas-start" id="offcanvasSidebar" data-bs-scroll="true"
                    data-bs-backdrop="false" tabindex="-1">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <a href="mainpage.php">Beranda</a>
                        <a href="status.php">Cek Status Gunung</a>
                        <a href="">Wilayah Terdampak</a>
                        <a href="dataPosko.php">Posko & Logistik</a>
                        <a href="">Data Korban & Pengungsi</a>
                        <a href="laporan.php" style="background-color: #fee2e2; font-weight: 600;">Laporan Kejadian & Riwayat Letusan</a>
                    </div>
                </div>

                <a class="navbar-brand" href="mainpage.php">Volcanoes Monitor</a>
            </div>
            <div class="nav-menu">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="mainpage.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1 class="display-5 fw-bold"><i class="fas fa-file-alt me-3"></i>Laporan Kejadian & Riwayat Letusan</h1>
            <p class="lead">Dokumentasi dan Pelaporan Aktivitas Gunung Berapi</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <i class="fas fa-file-alt stats-icon text-primary"></i>
                    <div class="stats-number" id="totalLaporan">0</div>
                    <div class="stats-label">Total Laporan</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <i class="fas fa-clock stats-icon text-warning"></i>
                    <div class="stats-number" id="menungguVerifikasi">0</div>
                    <div class="stats-label">Menunggu Verifikasi</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <i class="fas fa-check-circle stats-icon text-success"></i>
                    <div class="stats-number" id="terverifikasi">0</div>
                    <div class="stats-label">Terverifikasi</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <i class="fas fa-volcano stats-icon text-danger"></i>
                    <div class="stats-number" id="totalLetusan">0</div>
                    <div class="stats-label">Riwayat Letusan</div>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Filter Status</label>
                    <select class="form-select" id="filterStatus" onchange="tampilkanLaporan()">
                        <option value="">Semua Status</option>
                        <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                        <option value="Terverifikasi">Terverifikasi</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Cari Laporan</label>
                    <input type="text" class="form-control" id="searchLaporan" placeholder="Cari judul..." onkeyup="tampilkanLaporan()">
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahLaporan">
                        <i class="fas fa-plus me-2"></i>Tambah Laporan
                    </button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahLetusan">
                        <i class="fas fa-volcano me-2"></i>Catat Letusan
                    </button>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="laporan-tab" data-bs-toggle="tab" data-bs-target="#laporan" type="button" role="tab">
                    <i class="fas fa-file-alt me-2"></i>Laporan Kejadian
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="letusan-tab" data-bs-toggle="tab" data-bs-target="#letusan" type="button" role="tab">
                    <i class="fas fa-volcano me-2"></i>Riwayat Letusan
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="laporan" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div id="laporanList">
                            <div class="text-center text-muted py-5">
                                <i class="fas fa-spinner fa-spin fa-3x mb-3"></i>
                                <p>Memuat laporan...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="letusan" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gunung</th>
                                        <th>Tanggal Letusan</th>
                                        <th>Tingkat</th>
                                        <th>Durasi</th>
                                        <th>Korban</th>
                                        <th>Dampak Ekonomi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableLetusanBody">
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Memuat data letusan...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahLaporan" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Tambah Laporan Kejadian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahLaporan">
                        <div class="mb-3">
                            <label class="form-label">ID Petugas <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="id_petugas" required placeholder="Masukkan ID Petugas (angka, cth: 1)">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Waktu Laporan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="waktu_laporan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul Laporan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul_laporan" required placeholder="Contoh: Aktivitas Gunung Merapi Meningkat">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Detail Laporan <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="detail_laporan" rows="5" required placeholder="Deskripsikan kejadian secara detail..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanLaporan()">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahLetusan" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-volcano me-2"></i>Catat Riwayat Letusan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahLetusan">
                        <div class="mb-3">
                             <label class="form-label">ID Gunung <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="id_gunung" required placeholder="Masukkan ID Gunung (angka, cth: 1)">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Letusan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_letusan" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tingkat Letusan <span class="text-danger">*</span></label>
                                <select class="form-select" name="tingkat_letusan" required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="VEI 1 - Ringan">VEI 1 - Ringan</option>
                                    <option value="VEI 2 - Sedang">VEI 2 - Sedang</option>
                                    <option value="VEI 3 - Besar">VEI 3 - Besar</option>
                                    <option value="VEI 4 - Sangat Besar">VEI 4 - Sangat Besar</option>
                                    <option value="VEI 5 - Ekstrem">VEI 5 - Ekstrem</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Durasi Letusan</label>
                                <input type="text" class="form-control" name="durasi_letusan" placeholder="Contoh: 2 jam, 30 menit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jumlah Korban</label>
                                <input type="number" class="form-control" name="jumlah_korban" min="0" value="0" placeholder="Jumlah korban">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dampak Ekonomi</label>
                            <input type="text" class="form-control" name="dampak_ekonomi" placeholder="Contoh: Rp 500 juta, Kerusakan infrastruktur">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="simpanLetusan()">
                        <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetailLaporan" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>Detail Laporan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailLaporanContent">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p class="fw-bolder">Volcanoes Monitor</p>
        <p class="fw-bolder">Kontak Darurat</p>
        <p class="fw-bolder">BNPB:</p>
        <div style="user-select: all; padding: 12px; cursor: pointer;">0812-1237575</div>
        <div style="user-select: all; padding: 12px; cursor: pointer;">021-29827444</div>
        <p class="fw-bolder">Telepon Darurat:</p>
        <p>112</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // API URL
        const API_URL = 'api_laporan.php';

        // Global data cache
        let globalDataLaporan = [];
        let globalDataLetusan = [];

        // Fungsi notifikasi
        function showAlert(message, type = 'success') {
            alert(message);
        }

        // Fungsi utama load data
        async function loadData() {
            try {
                const response = await fetch(`${API_URL}?action=load_all`);
                const result = await response.json();

                if (result.status === 'success') {
                    globalDataLaporan = result.dataLaporan;
                    globalDataLetusan = result.dataLetusan;
                } else {
                    showAlert(result.message, 'danger');
                    globalDataLaporan = [];
                    globalDataLetusan = [];
                }
            } catch (error) {
                showAlert(error.message, 'danger');
                globalDataLaporan = [];
                globalDataLetusan = [];
            }
            
            // Panggil fungsi tampilkan setelah data di-fetch
            tampilkanLaporan();
            tampilkanLetusan();
            updateStatistik();
        }

        // --- FUNGSI TAMPILKAN (Render HTML) ---

        function tampilkanLaporan() {
            const container = document.getElementById('laporanList');
            const filterStatus = document.getElementById('filterStatus').value;
            const searchTerm = document.getElementById('searchLaporan').value.toLowerCase();

            // Filter data
            const filteredData = globalDataLaporan.filter(laporan => {
                const statusMatch = filterStatus === "" || laporan.status_verifikasi === filterStatus;
                const searchMatch = laporan.judul_laporan.toLowerCase().includes(searchTerm);
                return statusMatch && searchMatch;
            });

            if (filteredData.length === 0) {
                container.innerHTML = `
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>Tidak ada laporan yang sesuai filter.</p>
                    </div>`;
                return;
            }

            container.innerHTML = filteredData.map(laporan => {
                const statusColor = laporan.status_verifikasi === 'Terverifikasi' ? 'success' : 
                                  laporan.status_verifikasi === 'Ditolak' ? 'danger' : 'warning';
                
                // Tampilkan nama petugas jika ada (dari JOIN), jika tidak (cth: petugas dihapus) tampilkan ID
                const namaPelapor = laporan.nama_petugas || `ID: ${laporan.id_petugas}`;
                
                return `
                    <div class="laporan-card position-relative">
                        <span class="badge bg-${statusColor} status-badge">${laporan.status_verifikasi}</span>
                        <h5 class="mb-2">${laporan.judul_laporan}</h5>
                        <div class="mb-2">
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i>${namaPelapor} | 
                                <i class="fas fa-calendar me-1"></i>${new Date(laporan.waktu_laporan).toLocaleDateString('id-ID')}
                            </small>
                        </div>
                        <p class="mb-3">${laporan.detail_laporan.substring(0, 150)}${laporan.detail_laporan.length > 150 ? '...' : ''}</p>
                        <div class="d-flex gap-2 flex-wrap">
                            <button class="btn btn-sm btn-info" onclick="lihatDetail(${laporan.id_laporan})">
                                <i class="fas fa-eye me-1"></i>Lihat Detail
                            </button>
                            ${laporan.status_verifikasi === 'Menunggu Verifikasi' ? `
                                <button class="btn btn-sm btn-success" onclick="verifikasiLaporan(${laporan.id_laporan}, 'Terverifikasi')">
                                    <i class="fas fa-check me-1"></i>Verifikasi
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="verifikasiLaporan(${laporan.id_laporan}, 'Ditolak')">
                                    <i class="fas fa-times me-1"></i>Tolak
                                </button>
                            ` : ''}
                            <button class="btn btn-sm btn-danger" onclick="hapusLaporan(${laporan.id_laporan})">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function tampilkanLetusan() {
            const tbody = document.getElementById('tableLetusanBody');
            
            if (globalDataLetusan.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" class="text-center text-muted">Belum ada data letusan.</td></tr>';
                return;
            }

            tbody.innerHTML = globalDataLetusan.map((letusan, index) => {
                // Tampilkan nama gunung jika ada (dari JOIN)
                const namaGunung = letusan.nama_gunung || `ID: ${letusan.id_gunung}`;
                
                return `
                    <tr>
                        <td>${index + 1}</td>
                        <td><strong>${namaGunung}</strong></td>
                        <td>${new Date(letusan.tanggal_letusan).toLocaleDateString('id-ID')}</td>
                        <td>${letusan.tingkat_letusan}</td>
                        <td>${letusan.durasi_letusan || '-'}</td>
                        <td>${letusan.jumlah_korban}</td>
                        <td>${letusan.dampak_ekonomi || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="hapusLetusan(${letusan.id_letusan})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // --- FUNGSI SIMPAN (UMUM) ---
        async function simpanData(action, formId, modalId) {
            const form = document.getElementById(formId);
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            const formData = new FormData(form);

            try {
                const response = await fetch(`${API_URL}?action=${action}`, {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.status === 'success') {
                    showAlert(result.message);
                    form.reset();
                    bootstrap.Modal.getInstance(document.getElementById(modalId)).hide();
                    loadData(); // Muat ulang semua data
                } else {
                    // INI ADALAH PERBAIKAN TYPO PERTAMA
                    showAlert('Gagal: ' + result.message, 'danger');
                }
            } catch (error) {
                showAlert('Error: ' + error.message, 'danger');
            }
        }

        // Wrapper simpan
        function simpanLaporan() {
            simpanData('tambah_laporan', 'formTambahLaporan', 'modalTambahLaporan');
        }
        function simpanLetusan() {
            simpanData('tambah_letusan', 'formTambahLetusan', 'modalTambahLetusan');
        }

        // --- FUNGSI AKSI (Hapus, Verifikasi, Detail) ---
        async function hapusData(action, id) {
            if (!confirm('Yakin ingin menghapus data ini?')) return;
            
            const formData = new FormData();
            formData.append('id', id);

            try {
                const response = await fetch(`${API_URL}?action=${action}`, {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                if (result.status === 'success') {
                    showAlert(result.message);
                    loadData(); // Muat ulang data
                } else {
                    showAlert(result.message, 'danger');
                }
            } catch (error) {
                showAlert(error.message, 'danger');
            }
        }

        // Wrapper hapus
        function hapusLaporan(id) { hapusData('hapus_laporan', id); }
        function hapusLetusan(id) { hapusData('hapus_letusan', id); }

        // Verifikasi
        async function verifikasiLaporan(id, status) {
            const formData = new FormData();
            formData.append('id_laporan', id);
            formData.append('status', status);

            try {
                const response = await fetch(`${API_URL}?action=verifikasi_laporan`, {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                if (result.status === 'success') {
                    showAlert(result.message);
                    loadData(); // Muat ulang data
                } else {
                    showAlert(result.message, 'danger');
                }
            } catch (error) {
                showAlert(error.message, 'danger');
            }
        }

        // Detail
        function lihatDetail(id) {
            const laporan = globalDataLaporan.find(l => l.id_laporan == id); // Pakai '==' untuk perbandingan longgar
            if (!laporan) {
                showAlert('Data laporan tidak ditemukan', 'danger');
                return;
            }

            const content = `
                <h5>${laporan.judul_laporan}</h5>
                <p>
                    <small class="text-muted">
                        Oleh: ${laporan.nama_petugas || 'N/A'} | 
                        Tanggal: ${new Date(laporan.waktu_laporan).toLocaleDateString('id-ID')} | 
                        Status: ${laporan.status_verifikasi}
                    </small>
                </p>
                <hr>
                <p>${laporan.detail_laporan.replace(/\n/g, '<br>')}</p>
            `;
            document.getElementById('detailLaporanContent').innerHTML = content;
            new bootstrap.Modal(document.getElementById('modalDetailLaporan')).show();
        }

        // --- STATISTIK ---
        function updateStatistik() {
            document.getElementById('totalLaporan').textContent = globalDataLaporan.length;
            document.getElementById('totalLetusan').textContent = globalDataLetusan.length;
            
            // INI ADALAH PERBAIKAN TYPO KEDUA
            document.getElementById('menungguVerifikasi').textContent = globalDataLaporan.filter(l => l.status_verifikasi === 'Menunggu Verifikasi').length;
            document.getElementById('terverifikasi').textContent = globalDataLaporan.filter(l => l.status_verifikasi === 'Terverifikasi').length;
        }

        // Load data saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>
</html>
