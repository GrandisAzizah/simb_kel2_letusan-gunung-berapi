<?php

// FUNCTION QUERY
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// FUNCTION CARI POSKO
function cariPosko($keyword)
{
    global $koneksi;

    $query = "SELECT * FROM posko_pengungsian
                WHERE
              nama_posko LIKE '%$keyword%' OR
              kapasitas_maksimal LIKE '%$keyword%' OR
              alamat_posko LIKE '%$keyword%' OR
              penanggung_jawab LIKE '%$keyword%' 
            ";
    return query($query);
}

// FUNCTION CARI LAPORAN
function cariLaporan($keywordLaporan)
{
    global $koneksi;

    $query = "SELECT * FROM laporan
                WHERE
              waktu_laporan LIKE '%$keywordLaporan%' OR
              judul_laporan LIKE '%$keywordLaporan%' OR
              detail_laporan LIKE '%$keywordLaporan%' OR
              status_verifikasi LIKE '%$keywordLaporan%' 
            ";
    return query($query);
}
