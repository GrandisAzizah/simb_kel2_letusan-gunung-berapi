<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Laporan Sebaran Wilayah</title>
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

        /* Header Section */
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

        .header-section h3 {
            font-size: 2rem;
            font-weight: 800;
            color: #dc3545;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(220, 53, 69, 0.1);
            position: relative;
            display: inline-block;
        }

        .header-section h3::after {
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

        /* Form Container */
        .form-container {
            background: white;
            border-radius: 25px;
            padding: 3rem;
            box-shadow: 0 15px 50px rgba(220, 53, 69, 0.15);
            max-width: 700px;
            margin: 0 auto;
            animation: scaleIn 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #dc3545, #ff6b6b, #dc3545);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 0% 0%; }
            50% { background-position: 100% 0%; }
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

        /* Form Groups */
        .mb-3 {
            animation: slideUp 0.5s ease-out backwards;
        }

        .mb-3:nth-child(1) { animation-delay: 0.1s; }
        .mb-3:nth-child(2) { animation-delay: 0.2s; }
        .mb-3:nth-child(3) { animation-delay: 0.3s; }
        .mb-3:nth-child(4) { animation-delay: 0.4s; }
        .mb-3:nth-child(5) { animation-delay: 0.5s; }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Labels */
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            display: block;
            position: relative;
            padding-left: 0;
        }

        .form-label::before {
            content: '📝';
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        /* Form Controls */
        .form-control {
            border: 2px solid #ffe0e0;
            border-radius: 15px;
            padding: 0.9rem 1.2rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fff5f5;
        }

        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15);
            background: white;
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #ffb3b3;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Input Icons Effect */
        .form-control:focus + .input-icon {
            color: #dc3545;
            transform: scale(1.2);
        }

        /* Buttons */
        .btn {
            padding: 0.9rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
            box-shadow: 0 5px 20px rgba(220, 53, 69, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #ff6b6b 0%, #dc3545 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(220, 53, 69, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            box-shadow: 0 5px 20px rgba(108, 117, 125, 0.3);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #6c757d 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(108, 117, 125, 0.4);
        }

        /* Button Container */
        .button-container {
            margin-top: 2rem;
            animation: slideUp 0.5s ease-out 0.6s backwards;
        }

        /* Success/Error Alert */
        .alert {
            border-radius: 15px;
            border: none;
            padding: 1.2rem;
            font-weight: 500;
            animation: slideDown 0.5s ease-out;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
            color: white;
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

        /* Input validation styles */
        .form-control:invalid:not(:placeholder-shown) {
            border-color: #ffc107;
        }

        .form-control:valid:not(:placeholder-shown) {
            border-color: #28a745;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-section h3 {
                font-size: 1.5rem;
            }

            .form-container {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }

            .form-label {
                font-size: 0.95rem;
            }

            .form-control {
                padding: 0.8rem 1rem;
                font-size: 0.95rem;
            }

            .btn {
                padding: 0.8rem 2rem;
                font-size: 0.95rem;
            }

            .button-container .d-flex {
                flex-direction: column;
                gap: 1rem;
            }

            .button-container .btn {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .header-section {
                padding: 1.5rem 0.5rem;
            }

            .header-section h3 {
                font-size: 1.3rem;
            }

            .form-container {
                padding: 1.5rem 1rem;
                border-radius: 15px;
            }

            .form-label::before {
                font-size: 1rem;
            }
        }

        /* Loading state */
        .btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spinner 0.6s linear infinite;
        }

        @keyframes spinner {
            to { transform: rotate(360deg); }
        }

        /* Form required indicator */
        .form-label.required::after {
            content: ' *';
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
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
                        <a href="index.php">Beranda</a>
                        <a href="status.php">Cek Status Gunung</a>
                        <a href="sebaran.php">Wilayah Terdampak</a>
                        <a href="dataPosko.php">Posko & Logistik</a>
                        <a href="dataKorban.php">Data Korban & Pengungsi</a>
                        <a href="laporan.php">Laporan Kejadian & Riwayat Letusan</a>
                    </div>
                </div>

                <!-- Brand -->
                <a class="navbar-brand" href="#">Volcanoes Monitor</a>
            </div>

            <div class="nav-menu">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Form -->
    <div class="container mt-5 mb-5 content-wrapper">
        <div class="header-section">
            <h3>Tambah Laporan Sebaran Wilayah Terdampak</h3>
        </div>

        <div class="form-container">
            <form method="POST" action="" id="laporanForm">
                <div class="mb-3">
                    <label class="form-label required">Nama Gunung</label>
                    <input type="text" name="nama_gunung" class="form-control" placeholder="Contoh: Gunung Merapi" required>
                </div>

                <div class="mb-3">
                    <label class="form-label required">Wilayah Terdampak</label>
                    <input type="text" name="wilayah_terdampak" class="form-control" placeholder="Contoh: Sleman, Yogyakarta" required>
                </div>

                <div class="mb-3">
                    <label class="form-label required">Waktu Kejadian</label>
                    <input type="datetime-local" name="waktu_kejadian" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label required">Jumlah Korban</label>
                    <input type="number" name="jumlah_korban" class="form-control" placeholder="Masukkan jumlah korban" min="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label required">Informasi Terbaru</label>
                    <textarea name="informasi_terbaru" class="form-control" rows="4" placeholder="Tulis informasi detail tentang kejadian..." required></textarea>
                </div>

                <div class="button-container">
                    <div class="d-flex justify-content-between">
                        <a href="sebaran.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" name="submit" class="btn btn-danger" id="submitBtn">Simpan Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
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

        // Form submission loading state
        const form = document.getElementById('laporanForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(e) {
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'Menyimpan...';
        });

        // Enhanced form input effects
        const formInputs = document.querySelectorAll('.form-control');
        
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });

            // Add floating label effect
            input.addEventListener('input', function() {
                if (this.value) {
                    this.style.background = 'white';
                } else {
                    this.style.background = '#fff5f5';
                }
            });
        });

        // Button ripple effect
        const buttons = document.querySelectorAll('.btn');
        
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Auto-resize textarea
        const textarea = document.querySelector('textarea');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        }

        // Form validation feedback
        form.addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('input[required], textarea[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = '#dc3545';
                    input.style.animation = 'shake 0.5s';
                } else {
                    input.style.borderColor = '#28a745';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                submitBtn.classList.remove('loading');
                submitBtn.textContent = 'Simpan Laporan';
            }
        });

        // Shake animation for invalid inputs
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-10px); }
                75% { transform: translateX(10px); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>

<?php
// Proses simpan data ke database
if (isset($_POST['submit'])) {
    $nama_gunung = $_POST['nama_gunung'];
    $wilayah = $_POST['wilayah_terdampak'];
    $waktu = $_POST['waktu_kejadian'];
    $korban = $_POST['jumlah_korban'];
    $info = $_POST['informasi_terbaru'];

    $query = "INSERT INTO sebaran_wilayah (nama_gunung, wilayah_terdampak, waktu_kejadian, jumlah_korban, informasi_terbaru)
              VALUES ('$nama_gunung', '$wilayah', '$waktu', '$korban', '$info')";

    if ($koneksi->query($query)) {
        echo "<script>alert('Laporan berhasil disimpan!'); window.location='sebaran.php';</script>";
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Gagal menyimpan laporan: " . $koneksi->error . "</div>";
    }
}
?>