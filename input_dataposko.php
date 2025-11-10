<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Posko & Logistik - Volcanoes Monitor</title>
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
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
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
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
        }

        .btn-success {
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 500;
        }

        .btn-warning {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
        }

        .btn-danger {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 0.2rem rgba(220, 38, 38, 0.25);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #dc2626;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        .modal-content {
            border-radius: 15px;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #dc2626;
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="nav-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>

                <div class="offcanvas offcanvas-start" id="offcanvasSidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <a href="mainpage.php">Beranda</a>
                        <a href="status.php">Cek Status Gunung</a>
                        <a href="">Wilayah Terdampak</a>
                        <a href="dataPosko.php" style="background-color: #fee2e2; font-weight: 600;">Posko & Logistik</a>
                        <a href="">Data Korban & Pengungsi</a>
                        <a href="laporan.php">Laporan Kejadian & Riwayat Letusan</a>
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
            <h1 class="display-5 fw-bold"><i class="fas fa-home-lg-alt me-3"></i>Data Posko & Logistik</h1>
            <p class="lead">Manajemen Posko Pengungsian dan Logistik Bencana Gunung Berapi</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="stats-card">
                    <i class="fas fa-campground stats-icon text-primary"></i>
                    <div class="stats-number" id="totalPosko">0</div>
                    <div class="stats-label">Total Posko</div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card">
                    <i class="fas fa-boxes stats-icon text-success"></i>
                    <div class="stats-number" id="totalLogistik">0</div>
                    <div class="stats-label">Jenis Logistik</div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card">
                    <i class="fas fa-users stats-icon text-warning"></i>
                    <div class="stats-number" id="kapasitasTotal">0</div>
                    <div class="stats-label">Total Kapasitas</div>
                </div>
            </div>
        </div>

        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Informasi:</strong> Kelola data posko pengungsian dan stok logistik untuk koordinasi bantuan bencana yang lebih efektif.
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-campground me-2"></i>Data Posko Pengungsian</h4>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalTambahPosko">
                    <i class="fas fa-plus me-2"></i>Tambah Posko
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Posko</th>
                                <th>Alamat</th>
                                <th>Kapasitas</th>
                                <th>Penanggung Jawab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tablePoskoBody">
                            <tr>
                                <td colspan="6" class="text-center text-muted">Memuat data posko...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-boxes me-2"></i>Data Logistik</h4>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalTambahLogistik">
                    <i class="fas fa-plus me-2"></i>Tambah Logistik
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableLogistikBody">
                            <tr>
                                <td colspan="4" class="text-center text-muted">Memuat data logistik...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-warehouse me-2"></i>Stok Logistik per Posko</h4>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
                    <i class="fas fa-plus me-2"></i>Tambah Stok
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Posko</th>
                                <th>Barang</th>
                                <th>Jumlah Stok</th>
                                <th>Update Terakhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableStokBody">
                            <tr>
                                <td colspan="6" class="text-center text-muted">Memuat data stok...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahPosko" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-campground me-2"></i>Tambah Posko Pengungsian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahPosko">
                        <div class="mb-3">
                            <label class="form-label">Nama Posko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_posko" required placeholder="Contoh: Posko GOR Utama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Posko <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat_posko" rows="3" required placeholder="Masukkan alamat lengkap posko"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kapasitas Maksimal <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="kapasitas_maksimal" required min="1" placeholder="Jumlah orang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="penanggung_jawab" required placeholder="Nama penanggung jawab">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanPosko()">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahLogistik" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-boxes me-2"></i>Tambah Jenis Logistik</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahLogistik">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_barang" required placeholder="Contoh: Beras, Air Mineral, Selimut">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Satuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="satuan" required placeholder="Contoh: Kg, Liter, Dus, Pcs">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanLogistik()">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahStok" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-warehouse me-2"></i>Tambah/Update Stok</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahStok">
                        <div class="mb-3">
                            <label class="form-label">Posko <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_posko" id="selectPosko" required>
                                <option value="">Pilih Posko</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Logistik <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_logistik" id="selectLogistik" required>
                                <option value="">Pilih Logistik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="jumlah_stok" required min="0" placeholder="Jumlah">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanStok()">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEditPosko" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Posko Pengungsian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditPosko">
                        <input type="hidden" name="id_posko_edit" id="id_posko_edit">
                        <div class="mb-3">
                            <label class="form-label">Nama Posko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_posko_edit" id="nama_posko_edit" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Posko <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat_posko_edit" id="alamat_posko_edit" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kapasitas Maksimal <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="kapasitas_maksimal_edit" id="kapasitas_maksimal_edit" required min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="penanggung_jawab_edit" id="penanggung_jawab_edit" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updatePosko()">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditLogistik" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Jenis Logistik</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditLogistik">
                        <input type="hidden" name="id_logistik_edit" id="id_logistik_edit">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_barang_edit" id="nama_barang_edit" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Satuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="satuan_edit" id="satuan_edit" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateLogistik()">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditStok" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Stok</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditStok">
                        <input type="hidden" name="id_stok_edit" id="id_stok_edit">
                        <div class="mb-3">
                            <label class="form-label">Posko <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_posko_edit" id="selectPoskoEdit" required>
                                <option value="">Pilih Posko</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Logistik <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_logistik_edit" id="selectLogistikEdit" required>
                                <option value="">Pilih Logistik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="jumlah_stok_edit" id="jumlah_stok_edit" required min="0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateStok()">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
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
        // URL API Backend kita
        const API_URL = 'api_posko.php';

        // Variabel global untuk menyimpan data dari DB (untuk dropdown)
        let globalDataPosko = [];
        let globalDataLogistik = [];
        let globalDataStok = [];

        // Fungsi untuk menampilkan notifikasi/alert
        function showAlert(message, type = 'success') {
            alert(message);
        }

        // Fungsi utama untuk mengambil semua data dari database
        async function loadData() {
            try {
                const response = await fetch(`${API_URL}?action=load_all`);
                const result = await response.json();

                if (result.status === 'success') {
                    globalDataPosko = result.dataPosko;
                    globalDataLogistik = result.dataLogistik;
                    globalDataStok = result.dataStok;
                    
                    tampilkanPosko(result.dataPosko);
                    tampilkanLogistik(result.dataLogistik);
                    tampilkanStok(result.dataStok);
                    updateStatistik(result.dataPosko, result.dataLogistik);
                    updateSelectOptions(result.dataPosko, result.dataLogistik);
                } else {
                    showAlert('Gagal memuat data: ' + result.message, 'danger');
                }
            } catch (error) {
                showAlert('Terjadi error: ' + error.message, 'danger');
            }
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
                    showAlert(result.message, 'success');
                    form.reset();
                    const modalElement = document.getElementById(modalId);
                    if (modalElement) {
                         const modalInstance = bootstrap.Modal.getInstance(modalElement);
                         if (modalInstance) {
                             modalInstance.hide();
                         }
                    }
                    loadData(); // Muat ulang semua data
                } else {
                    showAlert('Gagal: ' + result.message, 'danger');
                }
            } catch (error) {
                showAlert('Terjadi error: ' + error.message, 'danger');
            }
        }

        // Wrapper fungsi simpan (TAMBAH)
        function simpanPosko() {
            simpanData('tambah_posko', 'formTambahPosko', 'modalTambahPosko');
        }

        function simpanLogistik() {
            simpanData('tambah_logistik', 'formTambahLogistik', 'modalTambahLogistik');
        }

        function simpanStok() {
            simpanData('tambah_stok', 'formTambahStok', 'modalTambahStok');
        }

        // --- FUNGSI TAMPILKAN (Render HTML) ---

        function tampilkanPosko(data) {
            const tbody = document.getElementById('tablePoskoBody');
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">Belum ada data posko.</td></tr>';
                return;
            }
            tbody.innerHTML = data.map((posko, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><strong>${posko.nama_posko}</strong></td>
                    <td>${posko.alamat_posko}</td>
                    <td><span class="badge bg-info">${posko.kapasitas_maksimal} orang</span></td>
                    <td>${posko.penanggung_jawab}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editPosko(${posko.id_posko})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="hapusPosko(${posko.id_posko})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function tampilkanLogistik(data) {
            const tbody = document.getElementById('tableLogistikBody');
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">Belum ada data logistik.</td></tr>';
                return;
            }
            tbody.innerHTML = data.map((log, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><strong>${log.nama_barang}</strong></td>
                    <td><span class="badge bg-secondary">${log.satuan}</span></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editLogistik(${log.id_logistik})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="hapusLogistik(${log.id_logistik})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function tampilkanStok(data) {
            const tbody = document.getElementById('tableStokBody');
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">Belum ada data stok.</td></tr>';
                return;
            }
            tbody.innerHTML = data.map((stok, index) => {
                const updateTime = stok.update_terakhir ? new Date(stok.update_terakhir).toLocaleString('id-ID') : 'N/A';
                return `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${stok.nama_posko || 'Posko Dihapus'}</td>
                        <td>${stok.nama_barang || 'Logistik Dihapus'}</td>
                        <td><span class="badge bg-success">${stok.jumlah_stok} ${stok.satuan || ''}</span></td>
                        <td><small>${updateTime}</small></td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editStok(${stok.id_stok})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="hapusStok(${stok.id_stok})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // --- FUNGSI HAPUS (UMUM) ---
        async function hapusData(action, id) {
            if (!confirm('Yakin ingin menghapus data ini?')) {
                return;
            }
            const formData = new FormData();
            formData.append('id', id);
            try {
                const response = await fetch(`${API_URL}?action=${action}`, {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                if (result.status === 'success') {
                    showAlert(result.message, 'success');
                    loadData(); // Muat ulang data
                } else {
                    showAlert('Gagal: ' + result.message, 'danger');
                }
            } catch (error) {
                showAlert('Terjadi error: ' + error.message, 'danger');
            }
        }

        // Wrapper fungsi hapus
        function hapusPosko(id) { hapusData('hapus_posko', id); }
        function hapusLogistik(id) { hapusData('hapus_logistik', id); }
        function hapusStok(id) { hapusData('hapus_stok', id); }

        // --- FUNGSI EDIT & UPDATE ---

        // Edit/Update Posko
        async function editPosko(id) {
            try {
                const response = await fetch(`${API_URL}?action=get_posko&id=${id}`);
                const result = await response.json();
                if (result.status === 'success' && result.data) {
                    const posko = result.data;
                    document.getElementById('id_posko_edit').value = posko.id_posko;
                    document.getElementById('nama_posko_edit').value = posko.nama_posko;
                    document.getElementById('alamat_posko_edit').value = posko.alamat_posko;
                    document.getElementById('kapasitas_maksimal_edit').value = posko.kapasitas_maksimal;
                    document.getElementById('penanggung_jawab_edit').value = posko.penanggung_jawab;
                    new bootstrap.Modal(document.getElementById('modalEditPosko')).show();
                } else {
                    showAlert('Gagal mengambil data untuk diedit', 'danger');
                }
            } catch (error) {
                showAlert('Terjadi error: ' + error.message, 'danger');
            }
        }
        function updatePosko() {
            simpanData('update_posko', 'formEditPosko', 'modalEditPosko');
        }

        // Edit/Update Logistik (BARU)
        async function editLogistik(id) {
            try {
                const response = await fetch(`${API_URL}?action=get_logistik&id=${id}`);
                const result = await response.json();
                if (result.status === 'success' && result.data) {
                    const logistik = result.data;
                    document.getElementById('id_logistik_edit').value = logistik.id_logistik;
                    document.getElementById('nama_barang_edit').value = logistik.nama_barang;
                    document.getElementById('satuan_edit').value = logistik.satuan;
                    new bootstrap.Modal(document.getElementById('modalEditLogistik')).show();
                } else {
                    showAlert('Gagal mengambil data untuk diedit', 'danger');
                }
            } catch (error) {
                showAlert('Terjadi error: ' + error.message, 'danger');
            }
        }
        function updateLogistik() {
            simpanData('update_logistik', 'formEditLogistik', 'modalEditLogistik');
        }

        // Edit/Update Stok (BARU)
        async function editStok(id) {
             try {
                const response = await fetch(`${API_URL}?action=get_stok&id=${id}`);
                const result = await response.json();
                if (result.status === 'success' && result.data) {
                    const stok = result.data;
                    // Isi form modal edit stok
                    document.getElementById('id_stok_edit').value = stok.id_stok;
                    document.getElementById('selectPoskoEdit').value = stok.id_posko;
                    document.getElementById('selectLogistikEdit').value = stok.id_logistik;
                    document.getElementById('jumlah_stok_edit').value = stok.jumlah_stok;
                    new bootstrap.Modal(document.getElementById('modalEditStok')).show();
                } else {
                    showAlert('Gagal mengambil data untuk diedit', 'danger');
                }
            } catch (error) {
                showAlert('Terjadi error: ' + error.message, 'danger');
            }
        }
        function updateStok() {
            simpanData('update_stok', 'formEditStok', 'modalEditStok');
        }
        
        // --- FUNGSI UTILITAS LAINNYA ---

        function updateStatistik(dataPosko, dataLogistik) {
            document.getElementById('totalPosko').textContent = dataPosko.length;
            document.getElementById('totalLogistik').textContent = dataLogistik.length;
            const totalKapasitas = dataPosko.reduce((sum, posko) => sum + parseInt(posko.kapasitas_maksimal || 0), 0);
            document.getElementById('kapasitasTotal').textContent = totalKapasitas;
        }

        function updateSelectOptions(dataPosko, dataLogistik) {
            // Ambil SEMUA dropdown (untuk Tambah dan Edit)
            const selectPosko = document.getElementById('selectPosko');
            const selectLogistik = document.getElementById('selectLogistik');
            const selectPoskoEdit = document.getElementById('selectPoskoEdit'); // BARU
            const selectLogistikEdit = document.getElementById('selectLogistikEdit'); // BARU

            // Buat HTML untuk opsinya
            const poskoOptions = '<option value="">Pilih Posko</option>' + 
                dataPosko.map(p => `<option value="${p.id_posko}">${p.nama_posko}</option>`).join('');
            
            const logistikOptions = '<option value="">Pilih Logistik</option>' + 
                dataLogistik.map(l => `<option value="${l.id_logistik}">${l.nama_barang} (${l.satuan})</option>`).join('');

            // Terapkan ke semua dropdown
            selectPosko.innerHTML = poskoOptions;
            selectPoskoEdit.innerHTML = poskoOptions; // BARU
            selectLogistik.innerHTML = logistikOptions;
            selectLogistikEdit.innerHTML = logistikOptions; // BARU
        }

        // Load data saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>
</html>