<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Gunung Berapi Indonesia - Volcanoes Monitor</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            min-height: 100vh;
        }

        /* Header Styles */
        nav {
            background-color: #dc2626;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            color: white !important;
            padding: 10px;
            font-size: 18px;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-link {
            color: white !important;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #fee2e2 !important;
        }

        .offcanvas {
            width: 300px !important;
        }

        .offcanvas-header .btn-close {
            transition: all 0.3s ease;
        }

        .offcanvas-header .btn-close:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.5);
            outline: none;
            transform: scale(1.1);
        }

        .offcanvas-body a {
            color: #b91c1c;
            font-size: 16px;
            display: block;
            padding: 12px 0;
            margin-bottom: 8px;
            text-decoration: none;
        }

        .offcanvas-body a:hover {
            border: #dc2626 1px solid;
            color: #dc2626;
            border-radius: 4px;
            padding-left: 10px;
        }

        /* Main Content */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .main-title {
            text-align: center;
            margin: 30px 0;
            color: #333;
            font-weight: 700;
            font-size: 2.2rem;
        }

        .content-section {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-section {
            flex: 1;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            display: flex;
            flex-direction: column;
            /* Perubahan utama: tinggi maksimum dan overflow */
            max-height: 600px;
            overflow: hidden;
        }

        .map-section {
            flex: 2;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
            border-bottom: 2px solid #dc2626;
            padding-bottom: 10px;
        }

        .info-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #dc2626;
            font-weight: 600;
        }

        .volcano-list {
            margin-top: 20px;
            flex: 1;
            overflow-y: auto;
            /* Perubahan: tinggi maksimum dan scroll */
            max-height: 500px;
            padding-right: 10px;
        }

        /* Scrollbar styling */
        .volcano-list::-webkit-scrollbar {
            width: 6px;
        }

        .volcano-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .volcano-list::-webkit-scrollbar-thumb {
            background: #dc2626;
            border-radius: 10px;
        }

        .volcano-list::-webkit-scrollbar-thumb:hover {
            background: #b91c1c;
        }

        .volcano-item {
            background: rgba(248, 249, 250, 0.8);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #dc2626;
            transition: all 0.3s;
        }

        .volcano-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .volcano-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 5px;
        }

        .volcano-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .status-awas {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
        }

        .status-siaga {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
        }

        .status-waspada {
            background: linear-gradient(135deg, #f1c40f, #f39c12);
            color: #2c3e50;
        }

        .status-normal {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
        }

        .detail-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .detail-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .map-container {
            height: 500px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        #volcanoMap {
            height: 100%;
            width: 100%;
            background: #f8f9fa;
        }

        .controls {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.1);
        }

        .filter-group label {
            color: #555;
            font-weight: 500;
        }

        .filter-group select {
            padding: 8px 12px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
            background: rgba(255,255,255,0.9);
            color: #333;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }

        .refresh-btn {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .refresh-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        /* Legend Styles */
        .legend {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
        }

        .legend-title {
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
            font-size: 1.1em;
        }

        .legend-items {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border-radius: 8px;
            background: rgba(248, 249, 250, 0.8);
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.8);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .legend-text {
            font-size: 0.9em;
            font-weight: 500;
        }

        /* Volcano Marker Styles */
        .volcano-marker {
            background: none !important;
            border: none !important;
        }

        .mountain-icon {
            position: relative;
            width: 40px;
            height: 40px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }

        .mountain-base {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60%;
            background: linear-gradient(45deg, #8B4513, #A0522D, #8B4513);
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            border-radius: 0 0 5px 5px;
        }

        .mountain-peak {
            position: absolute;
            top: 15%;
            left: 35%;
            width: 30%;
            height: 40%;
            background: linear-gradient(45deg, #696969, #808080, #696969);
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }

        .status-glow {
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border-radius: 50%;
            animation: glow 2s infinite;
        }

        .status-glow.awas { background: rgba(220, 38, 38, 0.3); }
        .status-glow.siaga { background: rgba(243, 156, 18, 0.3); }
        .status-glow.waspada { background: rgba(241, 196, 15, 0.3); }
        .status-glow.normal { background: rgba(46, 204, 113, 0.3); }

        @keyframes glow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.1); }
        }

        /* Footer styles */
        footer {
            background-color: #1f2937;
            text-align: center;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            color: white;
            margin-top: 40px;
        }

        footer h5 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        footer p {
            margin-bottom: 10px;
            font-size: 14px;
        }

        footer hr {
            background-color: rgba(255,255,255,0.2);
        }

        @media (max-width: 992px) {
            .content-section {
                flex-direction: column;
            }
            
            .info-section, .map-section {
                flex: none;
            }

            .legend-items {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 10px;
            }
            
            .controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="navbar-left">
                <!-- Sidebar icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-justify" viewBox="0 0 16 16" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar">
                    <path fill-rule="evenodd"
                        d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>

                <div class="offcanvas offcanvas-start" id="offcanvasSidebar" data-bs-scroll="true"
                    data-bs-backdrop="false" tabindex="-1">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body justify-content-start">
                        <a href="mainpage.php">Beranda</a>
                        <a href="status.php">Cek Status Gunung</a>
                        <a href="info_gunung.php">Informasi Status Gunung Berapi</a>
                        <a href="sebaran.php">Sebaran Wilayah Terdampak</a>
                        <a href="dataPosko.php">Posko & Logistik</a>
                        <a href="">Data Korban & Pengungsi</a>
                        <a href="laporan.php">Laporan Kejadian & Riwayat Letusan</a>
                        <div class="d-grid col-12">
                            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                                <!-- sudah login -->
                                <button href="logout.php" class="btn btn-danger mt-1">Logout</button>
                            <?php else: ?>
                                <!-- belum login -->
                                <button href="login.php" class="btn btn-danger mt-3">Login</button>
                                <button href="registrasi.php" class="btn btn-danger mt-3">Registrasi</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <a class="navbar-brand" href="#" style="color: white !important; font-weight: 600; font-size: 1.5rem; text-decoration: none;">Volcanoes Monitor</a>
            </div>

            <div class="nav-menu">
                <a class="nav-link active" href="mainpage.php">Beranda</a>
                <a class="nav-link" href="kontak.php">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="main-title">Informasi Status Gunung Berapi di Indonesia</h1>
        
        <div class="content-section">
            <!-- Map Section -->
            <div class="map-section">
                <h2 class="section-title">Peta Sebaran Gunung Berapi Indonesia</h2>
                
                <div class="controls">
                    <div class="filter-group">
                        <label>Filter Status:</label>
                        <select id="filterStatus" onchange="filterData()">
                            <option value="all">Semua Status</option>
                            <option value="Awas">Level IV - Awas</option>
                            <option value="Siaga">Level III - Siaga</option>
                            <option value="Waspada">Level II - Waspada</option>
                            <option value="Normal">Level I - Normal</option>
                        </select>
                    </div>
                    <button class="refresh-btn" onclick="loadVolcanoData()">
                        <i class="fas fa-sync-alt"></i> Refresh Data
                    </button>
                </div>

                <div class="map-container">
                    <div id="volcanoMap"></div>
                </div>

                <!-- Legend -->
                <div class="legend">
                    <div class="legend-title">🎯 Keterangan Status Gunung Berapi:</div>
                    <div class="legend-items">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #dc2626;"></div>
                            <span class="legend-text">Level IV - Awas (Letusan)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #f39c12;"></div>
                            <span class="legend-text">Level III - Siaga (Waspada Tinggi)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #f1c40f;"></div>
                            <span class="legend-text">Level II - Waspada (Aktivitas Meningkat)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #2ecc71;"></div>
                            <span class="legend-text">Level I - Normal (Aman)</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Information Section -->
            <div class="info-section">
                <h2 class="info-title">Informasi Terkini</h2>
                <div class="volcano-list" id="volcanoList">
                    <!-- Volcano items will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Volcanoes Monitor</h5>
                    <p>Sistem informasi terintegrasi untuk memantau aktivitas gunung berapi di Indonesia.</p>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <h5>Kontak</h5>
                    <p>Email: kel2@volcanoesmonitor.id</p>
                    <p>Telepon: 0812345678</p>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <p>&copy; 2025 Volcanoes Monitor - Sistem Pemantauan Gunung Berapi Indonesia</p>
        </div>
    </footer>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let allVolcanoes = [];
        let map;
        let markers = [];

        // Data gunung berapi lengkap
        const volcanoData = [
            {
                id_gunung: 1,
                nama_gunung: "Merapi",
                lokasi: "Jawa Tengah & DIY",
                status_aktif: "Siaga",
                ketinggian: "2,930",
                koordinat: "-7.541, 110.446",
                aktivitas_terakhir: "2024-11-08",
                aktivitas: "Teramati kubah lava aktif, awan panas guguran tercatat 15 kali dalam 24 jam terakhir. Radius bahaya 5 km dari puncak."
            },
            {
                id_gunung: 2,
                nama_gunung: "Semeru",
                lokasi: "Jawa Timur",
                status_aktif: "Siaga",
                ketinggian: "3,676",
                koordinat: "-8.108, 112.922",
                aktivitas_terakhir: "2024-11-10",
                aktivitas: "Erupsi efusif dengan luncuran awan panas ke arah Besuk Kobokan. Kolom abu mencapai 800-1000 m. Zona bahaya radius 5 km."
            },
            {
                id_gunung: 3,
                nama_gunung: "Lewotobi Laki-laki",
                lokasi: "Nusa Tenggara Timur",
                status_aktif: "Waspada",
                ketinggian: "1,584",
                koordinat: "-8.372, 122.775",
                aktivitas_terakhir: "2024-11-09",
                aktivitas: "Peningkatan aktivitas seismik vulkanik. Teramati asap putih tipis setinggi 50-100 m. Masyarakat diimbau waspada."
            },
            {
                id_gunung: 4,
                nama_gunung: "Marapi",
                lokasi: "Sumatera Barat",
                status_aktif: "Waspada",
                ketinggian: "2,891",
                koordinat: "-0.381, 100.473",
                aktivitas_terakhir: "2024-11-07",
                aktivitas: "Aktivitas vulkanik meningkat dengan tremor menerus. Asap kawah teramati putih tebal 100-300 m. Radius aman 4 km."
            },
            {
                id_gunung: 5,
                nama_gunung: "Anak Krakatau",
                lokasi: "Lampung",
                status_aktif: "Siaga",
                ketinggian: "338",
                koordinat: "-6.102, 105.423",
                aktivitas_terakhir: "2024-11-11",
                aktivitas: "Erupsi strombolian dengan lontaran material pijar 300-500 m. Abu vulkanik teramati ke arah timur laut. Zona larangan 5 km dari kawah."
            },
            {
                id_gunung: 6,
                nama_gunung: "Ruang",
                lokasi: "Sulawesi Utara",
                status_aktif: "Waspada",
                ketinggian: "725",
                koordinat: "2.297, 125.369",
                aktivitas_terakhir: "2024-11-06",
                aktivitas: "Pasca erupsi April 2024, kondisi mulai stabil namun masih waspada. Teramati asap putih tipis 25-50 m. Zona bahaya 3 km."
            },
            {
                id_gunung: 7,
                nama_gunung: "Ibu",
                lokasi: "Maluku Utara",
                status_aktif: "Siaga",
                ketinggian: "1,325",
                koordinat: "1.488, 127.630",
                aktivitas_terakhir: "2024-11-11",
                aktivitas: "Erupsi berulang dengan kolom abu 500-2000 m. Lontaran material pijar radius 1 km. Zona bahaya 5 km, evakuasi telah dilakukan."
            },
            {
                id_gunung: 8,
                nama_gunung: "Dukono",
                lokasi: "Maluku Utara",
                status_aktif: "Waspada",
                ketinggian: "1,229",
                koordinat: "1.693, 127.894",
                aktivitas_terakhir: "2024-11-10",
                aktivitas: "Erupsi efusif menerus dengan asap abu tipis-sedang 200-600 m. Zona larangan 2 km dari kawah aktif."
            },
            {
                id_gunung: 9,
                nama_gunung: "Sinabung",
                lokasi: "Sumatera Utara",
                status_aktif: "Waspada",
                ketinggian: "2,460",
                koordinat: "3.170, 98.392",
                aktivitas_terakhir: "2024-11-05",
                aktivitas: "Kubah lava masih aktif dengan awan panas guguran sporadis. Asap putih tebal 50-200 m. Radius bahaya 3-5 km sektor tertentu."
            },
            {
                id_gunung: 10,
                nama_gunung: "Kerinci",
                lokasi: "Jambi",
                status_aktif: "Normal",
                ketinggian: "3,805",
                koordinat: "-1.697, 101.264",
                aktivitas_terakhir: "2024-10-15",
                aktivitas: "Aktivitas normal dengan asap kawah tipis. Tidak ada peningkatan aktivitas vulkanik signifikan."
            },
            {
                id_gunung: 11,
                nama_gunung: "Kelud",
                lokasi: "Jawa Timur",
                status_aktif: "Normal",
                ketinggian: "1,731",
                koordinat: "-7.930, 112.308",
                aktivitas_terakhir: "2024-09-20",
                aktivitas: "Kondisi normal pasca erupsi 2014. Danau kawah dalam kondisi stabil. Aktivitas pariwisata dibuka kembali."
            },
            {
                id_gunung: 12,
                nama_gunung: "Bromo",
                lokasi: "Jawa Timur",
                status_aktif: "Normal",
                ketinggian: "2,329",
                koordinat: "-7.942, 112.953",
                aktivitas_terakhir: "2024-10-28",
                aktivitas: "Aktivitas normal dengan asap kawah putih tipis 25-100 m. Wisatawan diperbolehkan dengan tetap waspada."
            }
        ];

        // Initialize map with bright theme
        function initMap() {
            map = L.map('volcanoMap', {
                zoomControl: true,
                attributionControl: true
            }).setView([-2.5489, 118.0149], 5);
            
            // Bright theme map tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 20
            }).addTo(map);
        }

        // Create realistic mountain marker
        function createMountainMarker(status) {
            const statusClass = getStatusClass(status);
            
            let markerHtml = `
                <div class="mountain-icon">
                    <div class="status-glow ${statusClass}"></div>
                    <div class="mountain-base"></div>
                    <div class="mountain-peak"></div>
                </div>
            `;
            
            return L.divIcon({
                className: 'volcano-marker',
                html: markerHtml,
                iconSize: [40, 40],
                iconAnchor: [20, 40]
            });
        }

        // Get marker color based on status
        function getMarkerColor(status) {
            const colors = {
                'Awas': '#dc2626',
                'Siaga': '#f39c12',
                'Waspada': '#f1c40f',
                'Normal': '#2ecc71'
            };
            return colors[status] || '#2ecc71';
        }

        // Sort volcanoes by status priority (Awas -> Siaga -> Waspada -> Normal)
        function sortVolcanoesByStatus(volcanoes) {
            const statusPriority = {
                'Awas': 1,
                'Siaga': 2,
                'Waspada': 3,
                'Normal': 4
            };
            
            return volcanoes.sort((a, b) => {
                return statusPriority[a.status_aktif] - statusPriority[b.status_aktif];
            });
        }

        // Load volcano data
        async function loadVolcanoData() {
            const volcanoList = document.getElementById('volcanoList');
            volcanoList.innerHTML = `
                <div style="text-align: center; padding: 20px; color: #666;">
                    <p>Memuat data gunung berapi...</p>
                </div>
            `;

            try {
                // Simulasi loading data
                await new Promise(resolve => setTimeout(resolve, 1000));
                
                // Gunakan data dari variabel volcanoData
                allVolcanoes = sortVolcanoesByStatus(volcanoData);
                displayVolcanoList(allVolcanoes);
                updateMapMarkers(allVolcanoes);

            } catch (error) {
                volcanoList.innerHTML = `
                    <div style="text-align: center; padding: 20px; color: #dc2626;">
                        <p>Gagal memuat data</p>
                    </div>
                `;
            }
        }

        // Display volcanoes in list
        function displayVolcanoList(volcanoes) {
            if (volcanoes.length === 0) {
                document.getElementById('volcanoList').innerHTML = `
                    <div style="text-align: center; padding: 20px;">
                        <p>Tidak ada data yang sesuai dengan filter</p>
                    </div>
                `;
                return;
            }

            const html = volcanoes.map(volcano => {
                const statusClass = `status-${getStatusClass(volcano.status_aktif)}`;
                
                return `
                    <div class="volcano-item">
                        <div class="volcano-name">${volcano.nama_gunung}</div>
                        <div class="volcano-status ${statusClass}">Status: ${volcano.status_aktif}</div>
                        <button class="detail-btn" onclick="showVolcanoDetail(${volcano.id_gunung})">Lihat Detail</button>
                    </div>
                `;
            }).join('');

            document.getElementById('volcanoList').innerHTML = html;
        }

        // Show volcano detail
        function showVolcanoDetail(id) {
            const volcano = allVolcanoes.find(v => v.id_gunung === id);
            if (volcano) {
                alert(`Detail Gunung ${volcano.nama_gunung}:\n\nLokasi: ${volcano.lokasi}\nKetinggian: ${volcano.ketinggian} mdpl\nStatus: ${volcano.status_aktif}\nAktivitas Terakhir: ${new Date(volcano.aktivitas_terakhir).toLocaleDateString('id-ID')}\n\nAktivitas: ${volcano.aktivitas}`);
            }
        }

        // Update map markers with realistic mountain icons
        function updateMapMarkers(volcanoes) {
            // Clear existing markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Volcano coordinates database
            const volcanoCoordinates = {
                'Merapi': [-7.541, 110.446],
                'Sinabung': [3.170, 98.392],
                'Semeru': [-8.108, 112.922],
                'Agung': [-8.343, 115.508],
                'Bromo': [-7.942, 112.953],
                'Anak Krakatau': [-6.102, 105.423],
                'Rinjani': [-8.411, 116.457],
                'Kerinci': [-1.697, 101.264],
                'Soputan': [1.112, 124.737],
                'Ijen': [-8.058, 114.242],
                'Lewotobi Laki-laki': [-8.372, 122.775],
                'Marapi': [-0.381, 100.473],
                'Ruang': [2.297, 125.369],
                'Ibu': [1.488, 127.630],
                'Dukono': [1.693, 127.894],
                'Kelud': [-7.930, 112.308],
                'Tambora': [-8.247, 118.006],
                'Karangetang': [2.781, 125.407]
            };

            volcanoes.forEach(volcano => {
                const coords = volcanoCoordinates[volcano.nama_gunung] || getRandomCoordinates();
                const markerIcon = createMountainMarker(volcano.status_aktif);
                
                const marker = L.marker(coords, { icon: markerIcon }).addTo(map);
                
                marker.bindPopup(`
                    <div style="min-width: 250px; color: #2c3e50;">
                        <h3 style="margin: 0 0 10px; color: #dc2626; border-bottom: 2px solid #dc2626; padding-bottom: 5px;">
                            ${volcano.nama_gunung}
                        </h3>
                        <p style="margin: 8px 0;"><strong>Lokasi:</strong> ${volcano.lokasi}</p>
                        <p style="margin: 8px 0;"><strong>Status:</strong> 
                            <span style="color: ${getMarkerColor(volcano.status_aktif)}; font-weight: bold;">
                                ${volcano.status_aktif}
                            </span>
                        </p>
                        <p style="margin: 8px 0;"><strong>Ketinggian:</strong> ${volcano.ketinggian} mdpl</p>
                        <p style="margin: 8px 0;"><strong>Aktivitas Terakhir:</strong> ${new Date(volcano.aktivitas_terakhir).toLocaleDateString('id-ID')}</p>
                    </div>
                `);
                
                markers.push(marker);
            });

            // Adjust map view to show all markers
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            }
        }

        // Filter data
        function filterData() {
            const statusFilter = document.getElementById('filterStatus').value;
            
            let filtered = allVolcanoes;
            if (statusFilter !== 'all') {
                filtered = allVolcanoes.filter(v => v.status_aktif === statusFilter);
            }
            
            displayVolcanoList(filtered);
            updateMapMarkers(filtered);
        }

        // Helper functions
        function getStatusClass(status) {
            const classes = {
                'Awas': 'awas',
                'Siaga': 'siaga', 
                'Waspada': 'waspada',
                'Normal': 'normal'
            };
            return classes[status] || 'normal';
        }

        function getRandomCoordinates() {
            // Random coordinates within Indonesia
            const lat = -6 + (Math.random() * 10 - 5);
            const lng = 110 + (Math.random() * 20 - 10);
            return [lat, lng];
        }

        // Initialize everything when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            loadVolcanoData();
        });
    </script>
</body>

</html>
