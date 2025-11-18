<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volcanoes Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        nav {
            background-color: #dc2626;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            color: white !important;
            padding: 10px;
            font-size: 18px;
        }

        svg.bi.bi-justify {
            margin-right: 10px;
            cursor: pointer;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
        }

        .navbar-left {
            width: 100%;
            justify-content: space-between;
        }

        .nav-menu {
            justify-content: end;
        }

        .nav-link {
            color: white !important;
            margin-bottom: 22px;
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

        footer {
            background-color: #1f2937;
            text-align: center;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            color: white;
            margin-top: 20px;
        }

        @media (max-width: 700px) {
            .navbar-container {
                flex-direction: column;
                gap: 5px;
            }
        }

        footer {
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.newscientist.com/wp-content/uploads/2020/12/21145328/volcanoes-f0r7pt_web.jpg?width=2006');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .btn-hero {
            background-color: #dc2626;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-hero:hover {
            background-color: #b91c1c;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .content-section {
            padding: 60px 0;
        }

        .section-title {
            color: #dc2626;
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: #dc2626;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .info-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .info-card h3 {
            color: #dc2626;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .info-card i {
            font-size: 2rem;
            color: #dc2626;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="navbar-container">
                <div class="d-flex align-items-center">
                    
                    <a class="navbar-brand text-white fw-bold" href="#">Volcanoes Monitor</a>
                </div>
                <div class="nav-menu">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <i class="fas fa-bars text-white"></i>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <a class="nav-link px-2" href="#">Beranda</a>
                            <a class="nav-link px-2" href="kontak.php">Kontak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Pemantauan Gunung Berapi Indonesia</h1>
                <p>Sistem informasi terintegrasi untuk memantau aktivitas gunung berapi di seluruh Indonesia</p>
                <a href="nanti ini kemana?" class="btn-hero">Learn More</a>
            </div>
        </div>
    </section>
    <section class="content-section" id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="section-title">Tentang Gunung Berapi</h2>
                    <p>Gunung berapi adalah sistem saluran fluida panas (batuan dalam wujud cair atau lava) yang memanjang dari kedalaman sekitar 10 km di bawah permukaan bumi sampai ke permukaan bumi, termasuk endapan hasil akumulasi material yang dikeluarkan pada saat meletus.</p>
                    
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/LQwZwKS9RPs" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    
                    <p>Indonesia merupakan negara dengan jumlah gunung berapi aktif terbanyak di dunia. Hal ini disebabkan oleh lokasi Indonesia yang berada di pertemuan tiga lempeng tektonik utama dunia, yaitu Lempeng Eurasia, Lempeng Indo-Australia, dan Lempeng Pasifik.</p>
                </div>
                
                <div class="col-lg-4">
                    <div class="info-card">
                        <i class="fas fa-mountain"></i>
                        <h3>Fakta Gunung Berapi Indonesia</h3>
                        <p>Indonesia memiliki 127 gunung berapi aktif yang tersebar di berbagai pulau, dengan konsentrasi tertinggi di Pulau Jawa, Sumatera, dan Sulawesi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    <p>Email: </p>
                    <p>Telepon: 0812345678</p>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <p>&copy; ada udang dibalik batu batunya hilang dosennya datang</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
