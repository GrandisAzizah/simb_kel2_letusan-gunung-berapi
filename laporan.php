<?php
session_start();
include 'koneksi.php';
require 'function.php';

$data = query("SELECT waktu_laporan, judul_laporan, detail_laporan FROM laporan WHERE status_verifikasi = 'diverifikasi' ORDER BY waktu_laporan DESC");

if (isset($_POST["submit"])) {
    $data = cariLaporan($_POST["keywordLaporan"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kejadian & Riwayat Letusan</title>
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

        .judul-poppins {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            text-align: center;
            margin: 60px 60px !important;
            color: #333;
        }

        .btn-outline {
            color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .btn-outline:hover {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .btn-outline:focus {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        .btn-outline:active {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .form-control {
            width: 300px;
            border-color: #dc3545 !important;
        }

        .form-control:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        .time-cell,
        .title-cell,
        .detail-cell {
            padding: 16px 12px;
            vertical-align: middle;
        }

        .time-wrapper,
        .title-wrapper,
        .detail-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .time-icon,
        .title-icon,
        .detail-icon {
            color: #dc2626;
            width: 20px;
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
                <a class="navbar-brand" href="mainpage.php">Volcanoes Monitor</a>
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

    <!-- akhir navbar -->

    <h2 class="judul-poppins text-center mt-4 mb-4">Laporan Kejadian & Riwayat Letusan</h2>

    <div class="container-fluid mb-4 mt-3 justify-content-center d-flex">
        <form action="" method="POST" class="d-flex search-form" role="search" style="max-width: 500px; width: 100%;">
            <input class="form-control me-2 search-input" type="search" name="keywordLaporan" placeholder="Cari laporan kejadian..." aria-label="Search" autofocus autocomplete="off" />
            <button class="btn btn-outline search-btn" type="submit" name="submit">
                <i class="fas fa-search"></i> Search
            </button>
        </form>
    </div>

    <div class="container-lg">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-file-alt me-2"></i>Data Laporan Kejadian</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Waktu Laporan</th>
                                <th>Judul Laporan</th>
                                <th>Detail Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data)): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-3"></i><br>
                                        Belum ada data laporan
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($data as $row) : ?>
                                    <tr class="table-row">
                                        <td class="time-cell">
                                            <div class="time-wrapper">
                                                <i class="fas fa-clock time-icon"></i>
                                                <span class="time-text"><?= $row["waktu_laporan"]; ?></span>
                                            </div>
                                        </td>
                                        <td class="title-cell">
                                            <div class="title-wrapper">
                                                <i class="fas fa-file-alt title-icon"></i>
                                                <strong class="title-text"><?= $row["judul_laporan"]; ?></strong>
                                            </div>
                                        </td>
                                        <td class="detail-cell">
                                            <div class="detail-wrapper">
                                                <i class="fas fa-info-circle detail-icon"></i>
                                                <span class="detail-text"><?= $row["detail_laporan"]; ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <p class="fw-bolder">Volcanoes Monitor</p>
        <p class="fw-bolder">Kontak Darurat</p>
        <p class="fw-bolder">BNPB:</p>
        <div style="user-select: all; padding: 12px; cursor: pointer;">
            0812-1237575
        </div>

        <div style="user-select: all; padding: 12px; cursor: pointer;">
            021-29827444
        </div>
        <p class="fw-bolder">Telepon Darurat:</p>
        <p>112</p>

        <div class="popup-menu">
            <p><a href="#tentang-kami">Tentang Kami</a></p>
            <p><a href="#privasi">Kebijakan Privasi</a></p>
            <p><a href="#syarat">Syarat & Ketentuan</a></p>
        </div>

        <div id="tentang-kami" class="popup">
            <h3>Tentang Kami</h3>
            <p>
            <div class="popup-content">
                <p><strong>Volcanoes Monitor</strong> adalah platform monitoring gunung berapi terintegrasi yang didedikasi untuk melindungi masyarakat dan mendukung para peneliti vulkanologi.</p>

                <h4>Fitur Utama Kami:</h4>
                <ul style="padding-left: 20px; margin-left: 0; text-align: left;">
                    <li><strong>Beranda</strong> - Dashboard real-time aktivitas vulkanik terkini</li>
                    <li><strong>Wilayah Terdampak</strong> - Pemetaan area risiko dan zona bahaya</li>
                    <li><strong>Posko & Logistik</strong> - Informasi posko darurat dan distribusi bantuan</li>
                    <li><strong>Data Korban & Pengungsi</strong> - Monitoring korban dan pengungsian</li>
                    <li><strong>Laporan Kejadian & Riwayat Letusan</strong> - Dokumentasi historis dan laporan</li>
                </ul>

                <p>Platform kami menggabungkan data sensor, laporan lapangan, dan analisis ahli untuk memberikan informasi akurat dan tepat waktu.</p>

                <p><em>Dibangun untuk keselamatan, didedikasikan untuk kehidupan.</em></p>
            </div>
            </p>
            <a href="#">✕ Tutup</a>
        </div>
        <div class="overlay"></div>

        <div id="privasi" class="popup">
            <h3>Kebijakan Privasi</h3>
            <p><strong>Volcanoes Monitor</strong> berkomitmen melindungi privasi pengguna kami. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.</p>

            <h4>Informasi yang Kami Kumpulkan:</h4>
            <ul style="padding-left: 20px; text-align: left;">
                <li><strong>Data Lokasi</strong> - Untuk menampilkan informasi gunung berapi dan posko di wilayah Anda</li>
                <li><strong>Data Laporan</strong> - Laporan aktivitas vulkanik</li>
                <li><strong>Data Penggunaan</strong> - Statistik untuk improve layanan</li>
                <li><strong>Data Darurat</strong> - Informasi kontak untuk notifikasi darurat</li>
            </ul>

            <h4>Penggunaan Data:</h4>
            <ul style="padding-left: 20px; text-align: left;">
                <li>Memberikan informasi aktivitas vulkanik</li>
                <li>Mengirim notifikasi peringatan dini</li>
                <li>Meningkatkan akurasi prediksi dan monitoring</li>
                <li>Koordinasi tanggap darurat dengan pihak berwenang</li>
            </ul>

            <p><strong>Keamanan:</strong> Data Anda dilindungi dengan enkripsi dan hanya diakses oleh tim yang berwenang.</p>

            <p><em>Terakhir diperbarui: 1 November 2025</em></p>

            <a href="#">✕ Tutup</a>
        </div>
        <div class="overlay"></div>

        <div id="syarat" class="popup">
            <h3>Syarat & Ketentuan</h3>
            <p>Dengan menggunakan <strong>Volcanoes Monitor</strong>, Anda menyetujui syarat dan ketentuan berikut:</p>

            <h4>Penggunaan Layanan:</h4>
            <ul style="padding-left: 20px; text-align: left;">
                <li>Layanan ini ditujukan untuk informasi dan keselamatan publik</li>
                <li>Data yang ditampilkan dapat berubah setelah adanya penyesuaian</li>
                <li>Pengguna bertanggung jawab atas laporan yang disampaikan</li>
                <li>Dilarang menyebarkan informasi palsu atau menyesatkan</li>
            </ul>

            <h4>Kewajiban Pengguna:</h4>
            <ul style="padding-left: 20px; text-align: left;">
                <li>Menyampaikan laporan yang akurat dan bertanggung jawab</li>
                <li>Mengikuti instruksi evakuasi dari pihak berwenang</li>
                <li>Tidak menyalahgunakan sistem untuk kepentingan pribadi</li>
                <li>Menghormati privasi pengguna lain</li>
            </ul>

            <h4>Pembatasan Tanggung Jawab:</h4>
            <ul style="padding-left: 20px; text-align: left;">
                <li>Kami berusaha menyajikan informasi terakurat, namun tidak menjamin kelengkapan data</li>
                <li>Pengguna disarankan selalu merujuk pada sumber resmi Badan Nasional Penanggulangan Bencana <a href="https://www.bnpb.go.id/">(BNPB)</a> dan Pusat Vulkanologi dan Mitigasi Bencana Geologi <a href="https://geologi.esdm.go.id/pvmbg"> (PVMBG)</a></li>
                <li>Tidak bertanggung jawab atas kerugian akibat keterlambatan informasi</li>
            </ul>

            <p><strong>Perubahan Ketentuan:</strong> Kami dapat memperbarui syarat ini sewaktu-waktu.</p>

            <p><em>Terakhir diperbarui: 1 November 2025</em></p>
            <a href="#">✕ Tutup</a>
        </div>
        <div class="overlay"></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>





