<?php
include 'koneksi.php';
require 'function.php';

$data = query("SELECT nama_posko, alamat_posko, kapasitas_maksimal, penanggung_jawab FROM posko_pengungsian");

if (isset($_POST["cari"])) {
    $data = cariPosko($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status & Peringatan Dini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="poskoLaporanKejadian.css">
    <link rel="stylesheet" href="status.css">
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
                        <a href="">Beranda</a>
                        <a href="status.php">Cek Status Gunung</a>
                        <a href="">Wilayah Terdampak</a>
                        <a href="dataPosko.php">Posko & Logistik</a>
                        <a href="">Data Korban & Pengungsi</a>
                        <a href="laporan.php">Laporan Kejadian & Riwayat Letusan</a>
                    </div>
                </div>

                <!-- navbar brand and links -->
                <a class="navbar-brand" href="#">Volcanoes Monitor</a>
            </div>
            <!-- navbar menu -->
            <div class="nav-menu">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- judul -->
    <h2 class="judul-poppins text-center mt-4 mb-4">Status & Peringatan Dini</h2>

    <div class="volcano-container">
        <!-- Deskripsi di Kiri -->
        <div class="volcano-info">
            <h1 class="volcano-name">Gunung Merapi</h1>

            <div class="status-badge status-awas">Status: AWAS (Level IV)</div>

            <div class="info-section">
                <h2 class="section-title">Penjelasan Level Status</h2>
                <p><strong>AWAS (Level IV):</strong> Menandakan gunung berapi yang segera atau sedang meletus atau ada keadaan kritis yang menimbulkan bencana. Letusan pembukaan dimulai dengan abu dan asap.</p>
                <p><strong>SIAGA (Level III):</strong> Menandakan gunung berapi yang sedang bergerak ke arah letusan atau menimbulkan bencana.</p>
                <p><strong>WASPADA (Level II):</strong> Menandakan gunung berapi yang ada aktivitas apa pun bentuknya.</p>
                <p><strong>NORMAL (Level I):</strong> Menandakan gunung berapi tidak menunjukkan gejala aktivitas tekanan.</p>
            </div>

            <div class="info-section">
                <h2 class="section-title">Rekomendasi Resmi</h2>
                <ul class="recommendation-list">
                    <li>Masyarakat di zona radius 8 km dari puncak harus mengungsi segera</li>
                    <li>Waspada potensi lahar hujan di sepanjang sungai yang berhulu di Gunung Merapi</li>
                    <li>Gunakan masker untuk menghindari paparan abu vulkanik</li>
                    <li>Hindari area berisiko tinggi untuk aktivitas sehari-hari</li>
                    <li>Patuhi semua instruksi dari pihak berwenang dan posko terdekat</li>
                    <li>Siapkan tas darurat berisi dokumen penting dan kebutuhan 3 hari</li>
                </ul>
            </div>

            <hr class="divider">

            <div class="info-section">
                <h2 class="section-title">Kronologi Peringatan</h2>
                <ul class="timeline">
                    <li class="timeline-item">
                        <span class="timeline-date">31 Okt 2025:</span> Status dinaikkan ke AWAS (Level IV)
                    </li>
                    <li class="timeline-item">
                        <span class="timeline-date">25 Okt 2025:</span> Status SIAGA (Level III) - peningkatan aktivitas seismik
                    </li>
                    <li class="timeline-item">
                        <span class="timeline-date">15 Okt 2025:</span> Status WASPADA (Level II) - munculnya kubah lava baru
                    </li>
                    <li class="timeline-item">
                        <span class="timeline-date">1 Sep 2025:</span> Status NORMAL (Level I) - aktivitas dalam batas normal
                    </li>
                </ul>
            </div>
        </div>

        <!-- Gambar di Kanan -->
        <div class="volcano-image">
            <img src="https://via.placeholder.com/400x300/dc2626/white?text=Gunung+Merapi" alt="Gunung Merapi">
            <div class="image-caption">Tampilan Gunung Merapi dari sisi selatan - Sumber: PVMBG</div>

            <!-- Additional info box -->
            <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; width: 100%;">
                <h3 style="margin: 0 0 10px 0; color: #374151; font-size: 16px;">📊 Data Teknis</h3>
                <p style="margin: 5px 0; font-size: 14px;"><strong>Tinggi:</strong> 2.930 mdpl</p>
                <p style="margin: 5px 0; font-size: 14px;"><strong>Tipe:</strong> Stratovolcano</p>
                <p style="margin: 5px 0; font-size: 14px;"><strong>Letusan Terakhir:</strong> 2024</p>
                <p style="margin: 5px 0; font-size: 14px;"><strong>Lokasi:</strong> Jawa Tengah - Yogyakarta</p>
            </div>
        </div>
    </div>

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
</body>

</html>
