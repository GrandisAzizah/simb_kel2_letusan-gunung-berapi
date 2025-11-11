<?php
// Pastikan koneksi.php sudah tersedia
include 'koneksi.php';

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Variabel untuk menyimpan nilai pencarian, hanya untuk placeholder
$cari = isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sebaran Wilayah Terdampak Interaktif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="template.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="d-flex">
        <div class="container-fluid navbar-container">
            <div class="nav-left">
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

    <div class="container mt-4 mb-5">
        <h4 class="text-center fw-bold mb-4">Sebaran Wilayah Terdampak 🌋</h4>

        <div class="d-flex justify-content-center mb-3">
            <input type="text" id="live_search" placeholder="Cari Gunung / Wilayah"
                   value="<?= $cari ?>" class="form-control w-50">
            </div>

        <div class="text-end mb-3">
            <a href="input_sebaran.php" class="btn btn-danger">+ Tambah Laporan Baru</a>
        </div>
        
        <div id="loading_indicator" class="text-center d-none">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-danger">
                    <tr>
                        <th>Nama Gunung</th>
                        <th>Wilayah Terdampak</th>
                        <th>Waktu Kejadian</th>
                        <th>Jumlah Korban</th>
                        <th>Informasi Terbaru</th>
                        <th style="width: 150px;">Aksi</th> </tr>
                </thead>
                <tbody id="data_sebaran">
                    </tbody>
            </table>
        </div>
        
        <div id="no_result" class="alert alert-warning text-center d-none" role="alert">
            Tidak ada data yang ditemukan.
        </div>
    </div>
    
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="detailModalLabel">Detail Informasi</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><strong>Gunung:</strong> <span id="modal_gunung"></span></p>
            <p><strong>Wilayah:</strong> <span id="modal_wilayah"></span></p>
            <p><strong>Waktu:</strong> <span id="modal_waktu"></span></p>
            <hr>
            <h6>Informasi Terbaru:</h6>
            <p id="modal_info"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>


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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
    $(document).ready(function(){
        // Fungsi untuk mengambil data menggunakan AJAX
        function fetchData(search_query = '') {
            $('#loading_indicator').removeClass('d-none'); // Tampilkan loading
            $('#data_sebaran').html(''); // Kosongkan data lama

            $.ajax({
                url: 'fetch_data.php', // File PHP terpisah
                method: 'POST',
                data: { cari: search_query },
                dataType: 'json',
                success: function(response) {
                    $('#loading_indicator').addClass('d-none'); // Sembunyikan loading
                    $('#data_sebaran').empty(); // Kosongkan lagi sebelum mengisi

                    if (response.length > 0) {
                        $('#no_result').addClass('d-none'); // Sembunyikan notif 'tidak ada data'
                        $.each(response, function(i, row) {
                            // Cek panjang informasi terbaru, potong jika terlalu panjang
                            let infoPendek = row.informasi_terbaru.length > 50 ? 
                                row.informasi_terbaru.substring(0, 50) + '...' : 
                                row.informasi_terbaru;
                            
                            // Baris tabel dengan tombol aksi
                            let newRow = `
                                <tr>
                                    <td>${row.nama_gunung}</td>
                                    <td>${row.wilayah_terdampak}</td>
                                    <td>${row.waktu_kejadian}</td>
                                    <td>${row.jumlah_korban}</td>
                                    <td>${infoPendek}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white btn-detail" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailModal"
                                                data-gunung="${row.nama_gunung}"
                                                data-wilayah="${row.wilayah_terdampak}"
                                                data-waktu="${row.waktu_kejadian}"
                                                data-info="${row.informasi_terbaru}">
                                            Detail
                                        </button>
                                        <a href="edit_sebaran.php?id=${row.id}" class="btn btn-sm btn-warning">✏️</a>
                                        <button class="btn btn-sm btn-danger btn-hapus" data-id="${row.id}">🗑️</button>
                                    </td>
                                </tr>
                            `;
                            $('#data_sebaran').append(newRow);
                        });
                    } else {
                        // Tampilkan pesan 'Tidak ada data'
                        $('#no_result').removeClass('d-none');
                    }
                },
                error: function() {
                    $('#loading_indicator').addClass('d-none');
                    $('#data_sebaran').html('<tr><td colspan="6" class="text-danger">Terjadi kesalahan saat mengambil data.</td></tr>');
                    $('#no_result').addClass('d-none');
                }
            });
        }

        // Panggil fetchData saat halaman dimuat (untuk data awal)
        fetchData($('#live_search').val()); 

        // Live Search: Panggil fetchData saat nilai input berubah (ketika mengetik)
        $('#live_search').on('keyup', function(){
            let search_val = $(this).val();
            fetchData(search_val);
        });

        // Event Listener untuk tombol Detail (mengisi Modal)
        $('#data_sebaran').on('click', '.btn-detail', function() {
            let gunung = $(this).data('gunung');
            let wilayah = $(this).data('wilayah');
            let waktu = $(this).data('waktu');
            let info = $(this).data('info');

            $('#modal_gunung').text(gunung);
            $('#modal_wilayah').text(wilayah);
            $('#modal_waktu').text(waktu);
            $('#modal_info').text(info);
        });
        
        // Event Listener untuk tombol Hapus (menggunakan SweetAlert)
        $('#data_sebaran').on('click', '.btn-hapus', function() {
            let id = $(this).data('id');
            
            Swal.fire({
                title: 'Yakin menghapus data?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Di sini Anda akan menambahkan kode AJAX untuk menghapus data dari database
                    // Contoh: window.location.href = 'hapus_sebaran.php?id=' + id;
                    Swal.fire(
                        'Dihapus!',
                        'Data ID ' + id + ' telah dihapus. (Ini hanya simulasi)',
                        'success'
                    );
                    // Panggil fetchData() lagi setelah penghapusan berhasil
                    // fetchData($('#live_search').val());
                }
            });
        });

    });
    </script>
</body>
</html>