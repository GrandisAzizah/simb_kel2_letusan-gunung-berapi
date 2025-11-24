<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="kontak.css">
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
                                <a href="input_dataposko.php">Input Data Posko</a>
                                <a href="input_laporan.php">Input Laporan</a>
                                <a href="input_sebaran.php">Input Sebaran</a>
                                <button href="logout.php" class="btn btn-danger mt-1">Logout</button>
                            <?php else: ?>
                                <!-- belum login -->
                                <button href="login.php" class="btn btn-danger mt-3">Login</button>
                                <button href="registrasi.php" class="btn btn-danger mt-3">Registrasi</button>
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

    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h1 style="color: #dc2626; text-align: center;">Kontak BPBD Seluruh Indonesia</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;">💡 Klik informasi kontak untuk menyalin</p>

        <!-- Aceh -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Aceh</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-value">(0651) 34783</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">bpbaceh@gmail.com</span>
                </li>
            </ul>
        </div>

        <!-- Bali -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Bali</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-value">(0651) 34783</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">bpbd@baliprov.go.id</span>
                </li>
            </ul>
        </div>

        <!-- Banten -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Banten</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-value">(0254) 7921283</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">bpbd_banten@yahoo.com, bpbd.banten2014@gmail.com</span>
                </li>
            </ul>
        </div>

        <!-- Bengkulu -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Bengkulu</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-value">(0361) 245397</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">bpbd@bengkuluprov.go.id</span>
                </li>
            </ul>
        </div>

        <!-- DI Yogyakarta -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">DI Yogyakarta</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-value">(0274) 555584, 555585</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">pusdalopsdiy@gmail.com</span>
                </li>
            </ul>
        </div>

        <!-- DKI Jakarta -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">DKI Jakarta</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-value">(021) 29827444, 29827666, 0812 1237 575</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">pusdalops@bnpb.go.id</span>
                </li>
            </ul>
        </div>

        <!-- Jambi -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Jambi</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-value">(0741) 5913258</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">pusdalops.jambi@yahoo.co.id</span>
                </li>
            </ul>
        </div>

        <!-- Jawa Barat -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Jawa Barat</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-value">(0741) 5913258</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">pusdalops.jambi@yahoo.co.id</span>
                </li>
            </ul>
        </div>

        <!-- Jawa Tengah -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Jawa Tengah</h2>
            </div>
            <ul class="contact-list">
                <span class="contact-type">Telepon</span>
                <li class="contact-item">
                    <span class="contact-type">WhatsApp</span>
                    <span class="contact-value">08813809409</span>
                </li>
                <li class="contact-item">
                    <span class="contact-value">(024) 519927, 3519904</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">bpbd@jatengprov.go.id</span>
                </li>
            </ul>
        </div>

        <!-- Jawa Timur -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Jawa Timur</h2>
            </div>
            <ul class="contact-list">
                <li class="contact-item">
                    <span class="contact-value">+62 (031) 8550222</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">mail@bpbd.jatimprov.go.id</span>
                </li>
            </ul>
        </div>

        <!-- Kalimantan Timur -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Kalimantan Timur</h2>
            </div>
            <ul class="contact-list">
                <li class="contact-item">
                    <span class="contact-value">(0541) 741040</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">bpbd@kaltimprov.go.id</span>
                </li>
            </ul>
        </div>

        <!-- Kalimantan Utara -->
        <div class="province-card">
            <div class="card-header">
                <h2 class="province-name">Kalimantan Utara</h2>
            </div>
            <ul class="contact-list">
                <li class="contact-item">
                    <span class="contact-value">(0552) 21727</span>
                </li>
                <li class="contact-item">
                    <span class="contact-type">Email</span>
                    <span class="contact-value">bpbdkaltara@gmail.com</span>
                </li>
            </ul>
        </div>

        <!-- Tambahkan provinsi lainnya di sini -->

    </div>

    <div class="copy-hint">
        🚨 Info Darurat: Dalam keadaan darurat, hubungi 112 (Call Center Nasional)
    </div>
    </div>

    <script>
        function copyToClipboard(text) {
            // Hapus spasi dari nomor telepon
            const cleanText = text.replace(/\s/g, '');

            navigator.clipboard.writeText(cleanText).then(() => {
                showNotification();
            }).catch(err => {
                // Fallback untuk browser lama
                const textArea = document.createElement('textarea');
                textArea.value = cleanText;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showNotification();
            });
        }

        function showNotification() {
            const notification = document.getElementById('copyNotification');
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 2000);
        }
    </script>
</body>


</html>




