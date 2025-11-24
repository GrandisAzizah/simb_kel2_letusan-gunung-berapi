<?php
session_start();
include 'koneksi.php';

// Pencarian data
$cari = "";
if (isset($_GET['cari'])) {
    $cari = $koneksi->real_escape_string($_GET['cari']);
    $query = "SELECT * FROM sebaran_wilayah
              WHERE nama_gunung LIKE '%$cari%'
              OR wilayah_terdampak LIKE '%$cari%'
              ORDER BY waktu_kejadian DESC";
} else {
    $query = "SELECT * FROM sebaran_wilayah ORDER BY waktu_kejadian DESC";
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fff5f5 0%, #ffe0e0 50%, #ffd0d0 100%);
            position: relative;
            overflow-x: hidden;
        }

        /* Animated particles background */
        body::before {
            content: '';
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(220, 53, 69, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 107, 107, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(220, 53, 69, 0.08) 0%, transparent 40%);
            animation: drift 20s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes drift {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }

        /* Main content wrapper */
        .content-wrapper {
            position: relative;
            z-index: 1;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header Section Enhancement */
        .header-section {
            text-align: center;
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-section h4 {
            font-size: 2rem;
            font-weight: 800;
            color: #dc3545;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(220, 53, 69, 0.1);
            position: relative;
            display: inline-block;
        }

        .header-section h4::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 4px;
            background: linear-gradient(90deg, transparent, #dc3545, transparent);
            border-radius: 2px;
        }

        /* Search Box Enhancement */
        .search-container {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(220, 53, 69, 0.15);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .search-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(220, 53, 69, 0.2);
        }

        .search-container .form-control {
            border: 2px solid #ffe0e0;
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fff5f5;
        }

        .search-container .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
            background: white;
            transform: scale(1.02);
        }

        .search-container .btn {
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            border: 2px solid #6c757d;
        }

        .search-container .btn:hover {
            transform: scale(1.1) rotate(10deg);
            border-color: #dc3545;
            background: #dc3545;
            color: white;
        }

        /* Add Button Enhancement */
        .add-button-container {
            margin-bottom: 2rem;
            animation: slideRight 0.6s ease-out;
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .btn-danger {
            border-radius: 50px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(220, 53, 69, 0.3);
            border: none;
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(220, 53, 69, 0.4);
            background: linear-gradient(135deg, #ff6b6b 0%, #dc3545 100%);
        }

        /* Table Container Enhancement */
        .table-responsive {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Table Styling */
        .table {
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 1.2rem;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .table thead th:first-child {
            border-radius: 15px 0 0 0;
        }

        .table thead th:last-child {
            border-radius: 0 15px 0 0;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            animation: rowFadeIn 0.5s ease-out backwards;
        }

        .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
        .table tbody tr:nth-child(2) { animation-delay: 0.15s; }
        .table tbody tr:nth-child(3) { animation-delay: 0.2s; }
        .table tbody tr:nth-child(4) { animation-delay: 0.25s; }
        .table tbody tr:nth-child(5) { animation-delay: 0.3s; }

        @keyframes rowFadeIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, rgba(220, 53, 69, 0.08), rgba(255, 107, 107, 0.08));
            transform: scale(1.01);
            box-shadow: 0 5px 20px rgba(220, 53, 69, 0.15);
        }

        .table tbody td {
            padding: 1.2rem;
            vertical-align: middle;
            border-bottom: 1px solid #f5f5f5;
            transition: all 0.3s ease;
        }

        .table tbody tr:last-child td:first-child {
            border-radius: 0 0 0 15px;
        }

        .table tbody tr:last-child td:last-child {
            border-radius: 0 0 15px 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state::before {
            content: '📋';
            display: block;
            font-size: 5rem;
            margin-bottom: 1rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .empty-state p {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0.5rem 0;
        }

        /* Scroll to top button */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #dc3545, #ff6b6b);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 20px rgba(220, 53, 69, 0.4);
            transition: all 0.3s ease;
            z-index: 999;
            font-size: 1.2rem;
        }

        .scroll-top.show {
            display: flex;
            animation: popIn 0.3s ease-out;
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(0);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .scroll-top:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 30px rgba(220, 53, 69, 0.5);
        }

        /* Loading animation for search */
        .form-control.loading {
            background-image: linear-gradient(90deg, #f5f5f5 25%, #e0e0e0 50%, #f5f5f5 75%);
            background-size: 200% 100%;
            animation: loading 1.5s ease-in-out infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-section h4 {
                font-size: 1.5rem;
            }

            .search-container {
                padding: 1.5rem;
            }

            .search-container .form-control {
                font-size: 0.9rem;
                padding: 0.7rem 1.2rem;
            }

            .table-responsive {
                padding: 1rem;
            }

            .table {
                font-size: 0.85rem;
            }

            .table thead th,
            .table tbody td {
                padding: 0.8rem 0.5rem;
            }

            .btn-danger {
                padding: 0.7rem 1.5rem;
                font-size: 0.9rem;
            }

            .scroll-top {
                width: 45px;
                height: 45px;
                bottom: 1.5rem;
                right: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .header-section {
                padding: 1.5rem 0.5rem;
            }

            .header-section h4 {
                font-size: 1.3rem;
            }

            .search-container {
                padding: 1rem;
            }

            .table thead th {
                font-size: 0.75rem;
                padding: 0.8rem 0.3rem;
            }

            .table tbody td {
                font-size: 0.8rem;
                padding: 0.7rem 0.3rem;
            }

            .empty-state::before {
                font-size: 3rem;
            }

            .empty-state p {
                font-size: 1rem;
            }
        }

        /* Print styles */
        @media print {
            body::before,
            .scroll-top,
            .search-container,
            .add-button-container {
                display: none !important;
            }

            .table-responsive {
                box-shadow: none;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="nav-left">
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
                        <a href="dataKorban.php">Data Korban & Pengungsi</a>
                        <a href="laporan.php">Laporan Kejadian & Riwayat Letusan</a>
                        <div class="d-grid col-12">
                            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                                <!-- sudah login -->
                                <a href="input_dataposko.php">Input Data Posko</a>
                                <a href="input_laporan.php">Input Laporan</a>
                                <a href="input_sebaran.php">Input Sebaran</a>
                                <a href="logout.php" class="btn btn-danger mt-1 text-white">Logout</a>
                            <?php else: ?>
                                <!-- belum login -->
                                <a href="login.php" class="btn btn-danger mt-3 text-white">Login</a>
                                <a href="registrasi.php" class="btn btn-danger mt-3 text-white">Registrasi</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Brand -->
                <a class="navbar-brand" href="mainpage.php">Volcanoes Monitor</a>
            </div>

            <div class="nav-menu">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" href="mainpage.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-4 mb-5 content-wrapper">
        <div class="header-section">
            <h4>Sebaran Wilayah Terdampak</h4>
        </div>

        <!-- Form Pencarian -->
        <div class="search-container">
            <form method="GET" action="" class="d-flex justify-content-center flex-wrap gap-2">
                <input type="text" name="cari" placeholder="Cari Gunung / Wilayah"
                       value="<?= htmlspecialchars($cari) ?>" class="form-control w-auto flex-grow-1" style="min-width: 250px; max-width: 500px;">
                <button type="submit" class="btn btn-outline-secondary">🔍</button>
            </form>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Gunung</th>
                        <th>Wilayah Terdampak</th>
                        <th>Waktu Kejadian</th>
                        <th>Jumlah Korban</th>
                        <th>Informasi Terbaru</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($row['nama_gunung']) ?></strong></td>
                                <td><?= htmlspecialchars($row['wilayah_terdampak']) ?></td>
                                <td><?= htmlspecialchars($row['waktu_kejadian']) ?></td>
                                <td><span style="color: #dc3545; font-weight: 600;"><?= htmlspecialchars($row['jumlah_korban']) ?></span></td>
                                <td><?= htmlspecialchars($row['informasi_terbaru']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <p><strong>Belum ada laporan wilayah terdampak</strong></p>
                                    <p style="font-size: 0.9rem; color: #999;">Data akan muncul di sini setelah ditambahkan</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-auto">
        <p class="fw-bolder text-center mb-0 mt-3">Volcanoes Monitor</p>
        <p class="text-center mb-0">Kontak Darurat: <strong>BNPB 0812-1237575 / 021-29827444</strong></p>
        <p class="text-center mb-3">Telepon Darurat: <strong>112</strong></p>
        <div class="text-center small">
            <a href="#tentang-kami">Tentang Kami</a> |
            <a href="#privasi">Kebijakan Privasi</a> |
            <a href="#syarat">Syarat & Ketentuan</a>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-top" id="scrollTop">↑</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll to Top functionality
        const scrollTopBtn = document.getElementById('scrollTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
        
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Enhanced table row hover effects
        const tableRows = document.querySelectorAll('.table tbody tr');
        tableRows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
            
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Search input focus effect
        const searchInput = document.querySelector('input[name="cari"]');
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        }

        // Add button hover effect
        const addButton = document.querySelector('.btn-danger');
        if (addButton) {
            addButton.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.05)';
            });
            
            addButton.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        }
    </script>
</body>
</html>
