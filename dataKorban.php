<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Korban & Pengungsi - Dashboard Bencana</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50; 
            --secondary-color: #3498db;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --success-color: #27ae60;
            --light-color: #ecf0f1;
            --dark-color: #34495e;
            --text-color: #333;
            --font-family: 'Roboto', sans-serif;
        }
        
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: var(--light-color);
            color: var(--text-color);
            line-height: 1.6;
            font-family: var(--font-family);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* === HEADER === */
        .header {
            background-color: #dc2626;
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; 
        }
        
        .header-content h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 0;
        }
        
        .date-display {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px; 
        }

        
        .section-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--primary-color);
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 10px;
        }
        
        .data-section {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid var(--light-color);
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        
        .stat-card h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: var(--dark-color);
            font-weight: 500;
        }
        
        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
        }
        
        .stat-card.casualties .stat-value { color: var(--danger-color); }
        .stat-card.injured .stat-value { color: var(--warning-color); }
        .stat-card.refugees .stat-value { color: var(--secondary-color); }
        .stat-card.villages .stat-value { color: var(--success-color); }

        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        
        .data-table th, .data-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .data-table th {
            background-color: var(--light-color);
            font-weight: 600;
            color: var(--dark-color);
            text-transform: uppercase;
            font-size: 14px;
        }
        
        .data-table tbody tr:hover {
            background-color: #f9f9f9;
        }

        
        .logistics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .logistics-card {
            background-color: var(--light-color);
            border-radius: 8px;
            padding: 20px;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
        }
        
        .logistics-card h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 8px;
            font-weight: 600;
        }
        
        .needs-list {
            list-style-type: none;
        }
        
        .needs-list li {
            padding: 10px 0;
            border-bottom: 1px dashed #ccc; /* Changed to dashed border */
            font-size: 16px;
        }
        
        .needs-list li:last-child {
            border-bottom: none;
        }
        
        /*map - lum*/
        .map-placeholder {
            background-color: var(--light-color);
            height: 400px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-color);
            font-weight: 500;
            margin-top: 10px;
            border: 2px dashed var(--secondary-color);
        }


        .footer {
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
            color: var(--dark-color);
            font-size: 14px;
            border-top: 1px solid #ccc;
            background-color: white;
        }
        

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            
            .header-content h1 {
                font-size: 24px;
            }

            .date-display {
                margin-top: 10px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .stat-value {
                font-size: 30px;
            }
            
            .data-section {
                padding: 20px;
            }

            .data-table th, .data-table td {
                padding: 10px;
                display: block;
                width: 100%;
                text-align: center;
            }

            .data-table th:first-child, .data-table td:first-child {
                text-align: left; 
            }

            .data-table thead {
                display: none;
            }
            
            .data-table tbody tr {
                margin-bottom: 15px;
                display: block;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
            }

            .data-table td::before {
                /* Display header label before the data */
                content: attr(data-label) ": ";
                font-weight: 600;
                float: left;
                text-transform: uppercase;
                color: var(--primary-color);
            }

            .logistics-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header" role="banner">
        <div class="container">
            <div class="header-content">
                <h1>Data Korban & Pengungsi <span aria-hidden="true"></span></h1>
                <div class="date-display" id="current-date" aria-live="polite"></div>
            </div>
        </div>
    </header>

        <!-- navbar -->
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="nav-left">
                <!-- navbar icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>

                <div class=" offcanvas offcanvas-start" id="offcanvasSidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body justify-content-start">
                      <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                            <!-- sudah login -->
                            <a href="mainpage.php">Beranda</a>
                            <a href="status.php">Cek Status Gunung</a>
                            <a href="info_gunung.php">Informasi Status Gunung Berapi</a>
                            <a href="sebaran.php">Sebaran Wilayah Terdampak</a>
                            <a href="dataPosko.php">Posko & Logistik</a>
                            <a href="dataKorban.php">Data Korban & Pengungsi</a>
                            <a href="laporan.php">Laporan Kejadian & Riwayat Letusan</a>
                            <a href="input_sebaran.php">Input Sebaran Wilayah Terdampak</a>
                            <a href="input_dataposko.php">Input Posko & Logistik</a>
                            <a href="input_laporan.php">Input Laporan Kejadian & Riwayat Letusan</a>
                            <a href="logout.php" class="btn btn-danger mt-1 text-white">Logout</a>
                        <?php else: ?>
                            <!-- belum login -->
                            <a href="mainpage.php">Beranda</a>
                            <a href="status.php">Cek Status Gunung</a>
                            <a href="info_gunung.php">Informasi Status Gunung Berapi</a>
                            <a href="sebaran.php">Sebaran Wilayah Terdampak</a>
                            <a href="dataPosko.php">Posko & Logistik</a>
                            <a href="">Data Korban & Pengungsi</a>
                            <a href="laporan.php">Laporan Kejadian & Riwayat Letusan</a>
                            <a href="login.php" class="btn btn-danger mt-3 text-white">Login</a>
                            <a href="registrasi.php" class="btn btn-danger mt-3 text-white">Registrasi</a>
                        <?php endif; ?>
                        </div>
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
    
    <main class="container" role="main">
        <section class="dashboard">
            
            <div class="data-section" aria-labelledby="section-stats">
                <h2 class="section-title" id="section-stats">Statistik Utama Dampak Bencana</h2>
                <div class="stats-grid">
                    <div class="stat-card casualties" role="status" aria-label="Jumlah Korban Jiwa">
                        <h3>Korban Jiwa</h3>
                        <div class="stat-value">27</div>
                    </div>
                    <div class="stat-card injured" role="status" aria-label="Jumlah Luka-Luka">
                        <h3>Luka-Luka</h3>
                        <div class="stat-value">93</div>
                    </div>
                    <div class="stat-card refugees" role="status" aria-label="Total Pengungsi">
                        <h3>Total Pengungsi</h3>
                        <div class="stat-value">597</div>
                    </div>
                    <div class="stat-card villages" role="status" aria-label="Total Desa Terdampak">
                        <h3>Desa Terdampak</h3>
                        <div class="stat-value">12</div>
                    </div>
                </div>
            </div>
            
            <div class="data-section" aria-labelledby="section-detail">
                <h2 class="section-title" id="section-detail">Rincian Korban Per Wilayah</h2>
                <div class="table-responsive">
                    <table class="data-table" aria-describedby="section-detail">
                        <thead>
                            <tr>
                                <th>Kabupaten</th>
                                <th>Korban Jiwa</th>
                                <th>Luka</th>
                                <th>Hilang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Kabupaten">Kab. Sleman</td>
                                <td data-label="Korban Jiwa">12</td>
                                <td data-label="Luka">55</td>
                                <td data-label="Hilang">2</td>
                            </tr>
                            <tr>
                                <td data-label="Kabupaten">Kab. Klaten</td>
                                <td data-label="Korban Jiwa">15</td>
                                <td data-label="Luka">39</td>
                                <td data-label="Hilang">13</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="data-section" aria-labelledby="section-logistic">
                <h2 class="section-title" id="section-logistic">Data Logistik & Kebutuhan Mendesak <span aria-hidden="true">📦</span></h2>
                <div class="logistics-grid">
                    <div class="logistics-card">
                        <h3>Kebutuhan Pangan</h3>
                        <ul class="needs-list" aria-label="Daftar Kebutuhan Pangan">
                            <li>Beras:  2.000 kg </li>
                            <li>Mie Instan:  500 dus </li>
                            <li>Air Mineral:  1.000 galon </li>
                            <li>Makanan Bayi:  150 kaleng </li>
                            <li>Susu:  200 kotak </li>
                        </ul>
                    </div>
                    <div class="logistics-card">
                        <h3>Kebutuhan Medis & Non-Pangan</h3>
                        <ul class="needs-list" aria-label="Daftar Kebutuhan Medis dan Non-Pangan">
                            <li>Obat P3K:  500 paket </li>
                            <li>Masker:  2.000 pcs </li>
                            <li>Hand Sanitizer:  300 botol </li>
                            <li>Selimut:  400 buah </li>
                            <li>Tenda Darurat:  50 unit  </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="data-section" aria-labelledby="section-map">
                <h2 class="section-title" id="section-map">Peta Lokasi Pengungsian <span aria-hidden="true">📍</span></h2>
                <div id="map" style="height:400px; border-radius:8px;"></div>
            </div>
        </section>
    </main>
    
    <footer class="footer" role="contentinfo">
        <div class="container">
            <p>Sistem Informasi Manajemen Bencana Gunung Berapi &copy; <span id="year-display">2025</span></p>
        </div>
    </footer>

    <script>
    const map = L.map('map').setView([-7.542, 110.445], 11); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    const pengungsian = [
        { nama: "Posko Glagaharjo", lat: -7.6002, lon: 110.4821, kapasitas: 250 },
        { nama: "Posko Umbulharjo", lat: -7.5659, lon: 110.4474, kapasitas: 180 },
        { nama: "Posko Tegal Mulyo", lat: -7.5734, lon: 110.4639, kapasitas: 120 }
    ];

    pengungsian.forEach(posko => {
        L.marker([posko.lat, posko.lon])
            .addTo(map)
            .bindPopup(
                `<b>${posko.nama}</b><br>Kapasitas: ${posko.kapasitas} orang`
            );
    });
</script>


    <script>
        function updateDateAndYear() {
            const now = new Date();
            const dateOptions = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            
            const dateElement = document.getElementById('current-date');
            if (dateElement) {
                dateElement.textContent = 'Data Diperbarui: ' + now.toLocaleDateString('id-ID', dateOptions);
            }
            
            const yearElement = document.getElementById('year-display');
            if (yearElement) {
                yearElement.textContent = now.getFullYear();
            }
        }
        
        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function() {
            updateDateAndYear();
        });
    </script>
</body>
</html>


