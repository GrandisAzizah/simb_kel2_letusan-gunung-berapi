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
            font-family: 'Poppins', sans-serif;
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

        nav {
            background-color: #dc2626;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .nav-link {
            color: white !important;
            margin: 0 10px;
            text-decoration: none;
        }

        .nav-link:hover {
            color: #fee2e2 !important;
        }

        footer {
            background-color: #1f2937;
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="nav-left">
                <!-- navbar icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>

                <!-- offcanvas sidebar -->
                <div class=" offcanvas offcanvas-start" id="offcanvasSidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                     <div class="offcanvas-body">
                        <a href="mainpage.php" class="offcanvas-link">Beranda</a>
                        <a href="status.php" class="offcanvas-link">Cek Status Gunung</a>
                        <a href="sebaran.php" class="offcanvas-link">Wilayah Terdampak</a>
                        <a href="dataPosko.php" class="offcanvas-link">Posko & Logistik</a>
                        <a href="" class="offcanvas-link">Data Korban & Pengungsi</a>
                        <a href="laporan.php" class="offcanvas-link">Laporan Kejadian & Riwayat Letusan</a>
                    </div>
                </div>

                <!-- navbar brand and links -->
                <a class="navbar-brand" href="#">Volcanoes Monitor</a>
            </div>
            <!-- navbar menu -->
            <div class="nav-menu">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="mainpage.php">Beranda</a>
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
            <p class="lead">Informasi Posko Pengungsian dan Logistik Bencana Gunung Berapi</p>
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
            <strong>Informasi:</strong> Halaman ini menampilkan data posko pengungsian dan stok logistik untuk koordinasi bantuan bencana.
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-campground me-2"></i>Data Posko Pengungsian</h4>
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
                            </tr>
                        </thead>
                        <tbody id="tablePoskoBody">
                            <tr>
                                <td colspan="5" class="text-center text-muted">Memuat data posko...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-boxes me-2"></i>Data Logistik</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody id="tableLogistikBody">
                            <tr>
                                <td colspan="3" class="text-center text-muted">Memuat data logistik...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-warehouse me-2"></i>Stok Logistik per Posko</h4>
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
                            </tr>
                        </thead>
                        <tbody id="tableStokBody">
                            <tr>
                                <td colspan="5" class="text-center text-muted">Memuat data stok...</td>
                            </tr>
                        </tbody>
                    </table>
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
        const API_URL = 'api_posko.php';

        async function loadData() {
            try {
                const response = await fetch(`${API_URL}?action=load_all`);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();

                if (result.status === 'success') {
                    tampilkanPosko(result.dataPosko || []);
                    tampilkanLogistik(result.dataLogistik || []);
                    tampilkanStok(result.dataStok || []);
                    updateStatistik(result.dataPosko || [], result.dataLogistik || []);
                } else {
                    console.error('Gagal memuat data: ' + (result.message || 'Unknown error'));
                    showError('Gagal memuat data dari server');
                }
            } catch (error) {
                console.error('Terjadi error: ' + error.message);
                showError('Tidak dapat terhubung ke server. Pastikan API tersedia.');
            }
        }

        function showError(message) {
            const container = document.querySelector('.container');
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger alert-dismissible fade show';
            alertDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Error:</strong> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            container.insertBefore(alertDiv, container.firstChild);
        }

        function tampilkanPosko(data) {
            const tbody = document.getElementById('tablePoskoBody');
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Belum ada data posko.</td></tr>';
                return;
            }
            tbody.innerHTML = data.map((posko, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><strong>${posko.nama_posko}</strong></td>
                    <td>${posko.alamat_posko}</td>
                    <td><span class="badge bg-info">${posko.kapasitas_maksimal} orang</span></td>
                    <td>${posko.penanggung_jawab}</td>
                </tr>
            `).join('');
        }

        function tampilkanLogistik(data) {
            const tbody = document.getElementById('tableLogistikBody');
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="3" class="text-center text-muted">Belum ada data logistik.</td></tr>';
                return;
            }
            tbody.innerHTML = data.map((log, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><strong>${log.nama_barang}</strong></td>
                    <td><span class="badge bg-secondary">${log.satuan}</span></td>
                </tr>
            `).join('');
        }

        function tampilkanStok(data) {
            const tbody = document.getElementById('tableStokBody');
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Belum ada data stok.</td></tr>';
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
                    </tr>
                `;
            }).join('');
        }

        function updateStatistik(dataPosko, dataLogistik) {
            document.getElementById('totalPosko').textContent = dataPosko.length;
            document.getElementById('totalLogistik').textContent = dataLogistik.length;
            const totalKapasitas = dataPosko.reduce((sum, posko) => sum + parseInt(posko.kapasitas_maksimal || 0), 0);
            document.getElementById('kapasitasTotal').textContent = totalKapasitas;
        }

        document.addEventListener('DOMContentLoaded', loadData);
    </script>
</body>


</html>

