<?php
// Database Configuration
$host = "127.0.0.1";
$username = "root";
$password = "";
$database_name = "perpustakaan";
$connection = mysqli_connect($host, $username, $password, $database_name);

// Check the database connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the connection charset to utf8mb4 to avoid encoding conflicts
mysqli_set_charset($connection, 'utf8mb4');

// Utility Function for Input Validation
function validateInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

// === FUNCTION KHUSUS ADMIN START ===

// Menampilkan Data Kategori Buku
function queryReadData($query) {
    global $connection;
    $result = mysqli_query($connection, $query);
    if (!$result) {
        echo "Error: " . mysqli_error($connection);  // Menampilkan error jika query gagal
        return [];
    }

    $items = [];
    // Simpan hasil query dalam variabel sebelum diproses oleh mysqli_fetch_assoc
    while ($item = mysqli_fetch_assoc($result)) {
        $items[] = $item;
    }

    return $items;
}



// Menambahkan Data Buku
function tambahBuku($dataBuku) {
    global $connection;
    
    // Cek apakah id_buku sudah ada
    $queryCheck = "SELECT id_buku FROM buku WHERE id_buku = ?";
    $stmtCheck = $connection->prepare($queryCheck);
    $stmtCheck->bind_param("s", $dataBuku['id_buku']);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        echo "<script>alert('ID Buku sudah ada!');</script>";
        return 0;  // Jika ID sudah ada, hentikan proses
    }

    $cover = upload();
    if (!$cover) {
        return 0;
    }

    // Validasi input untuk parameter buku
    $judul = validateInput($dataBuku["judul"]);
    $pengarang = validateInput($dataBuku["pengarang"]);
    $penerbit = validateInput($dataBuku["penerbit"]);
    $bukuDeskripsi = validateInput($dataBuku["buku_deskripsi"]);
    
    $queryInsert = $connection->prepare("INSERT INTO buku (cover, id_buku, kategori, judul, pengarang, penerbit, tahun_terbit, jumlah_halaman, buku_deskripsi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $queryInsert->bind_param("sssssssis", $cover, $dataBuku["id_buku"], $dataBuku["kategori"], $judul, $pengarang, $penerbit, $dataBuku["tahun_terbit"], $dataBuku["jumlah_halaman"], $bukuDeskripsi);

    $queryInsert->execute();
    return $queryInsert->affected_rows;
}



// Fungsi Upload Gambar
function upload() {
    if (!is_dir('../../imgDB')) {
        mkdir('../../imgDB', 0777, true);
    }

    $namaFile = $_FILES["cover"]["name"];
    $ukuranFile = $_FILES["cover"]["size"];
    $error = $_FILES["cover"]["error"];
    $tmpName = $_FILES["cover"]["tmp_name"];

    // Cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>alert('Silahkan upload cover buku terlebih dahulu!');</script>";
        return 0;
    }

    // Cek kesesuaian format gambar
    $formatGambarValid = ['jpg', 'jpeg', 'png', 'svg', 'bmp', 'psd', 'tiff'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensiGambar, $formatGambarValid)) {
        echo "<script>alert('Format file tidak sesuai');</script>";
        return 0;
    }

    // Batas ukuran file
    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran file terlalu besar!');</script>";
        return 0;
    }

    // Generate nama file baru untuk menghindari duplikasi
    $namaFileBaru = uniqid() . "." . $ekstensiGambar;

    // Pastikan folder imgDB ada dan memiliki izin untuk diakses
    $targetPath = '../../imgDB/' . $namaFileBaru;
    if (!move_uploaded_file($tmpName, $targetPath)) {
        error_log("File upload failed for: $namaFile");
        echo "<script>alert('Gagal mengupload file!');</script>";
        return 0;
    }
    return $namaFileBaru;
}

// Menampilkan Data Buku Berdasarkan Pencarian
function search($keyword) {
    global $connection;
    $querySearch = $connection->prepare("SELECT * FROM buku WHERE judul LIKE ? OR kategori LIKE ?");
    $searchKeyword = '%' . $keyword . '%';
    $querySearch->bind_param("ss", $searchKeyword, $searchKeyword);
    $querySearch->execute();
    $result = $querySearch->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Delete Buku
// Delete Buku
function deleteBuku($bukuId) {
    global $connection;

    // Cek apakah ada data pengembalian atau peminjaman yang terkait dengan buku ini
    $queryCheckPengembalian = "SELECT * FROM pengembalian WHERE id_buku = '$bukuId'";
    $resultCheckPengembalian = mysqli_query($connection, $queryCheckPengembalian);

    // Jika ada data pengembalian, hapus data tersebut terlebih dahulu
    if (mysqli_num_rows($resultCheckPengembalian) > 0) {
        $queryDeletePengembalian = "DELETE FROM pengembalian WHERE id_buku = '$bukuId'";
        mysqli_query($connection, $queryDeletePengembalian);
    }

    // Cek apakah ada data peminjaman yang terkait dengan buku ini
    $queryCheckPeminjaman = "SELECT * FROM peminjaman WHERE id_buku = '$bukuId'";
    $resultCheckPeminjaman = mysqli_query($connection, $queryCheckPeminjaman);

    // Jika ada data peminjaman, hapus data tersebut terlebih dahulu
    if (mysqli_num_rows($resultCheckPeminjaman) > 0) {
        $queryDeletePeminjaman = "DELETE FROM peminjaman WHERE id_buku = '$bukuId'";
        mysqli_query($connection, $queryDeletePeminjaman);
    }

    // Sekarang, hapus buku dari tabel buku
    $queryDeleteBuku = "DELETE FROM buku WHERE id_buku = '$bukuId'";
    mysqli_query($connection, $queryDeleteBuku);

    // Mengembalikan jumlah baris yang terpengaruh oleh query
    return mysqli_affected_rows($connection);
}


// Update Data Buku
function updateBuku($dataBuku) {
    global $connection;
    $gambarLama = validateInput($dataBuku["coverLama"]);
    $idBuku = validateInput($dataBuku["id_buku"]);
    $kategoriBuku = $dataBuku["kategori"];
    $judulBuku = validateInput($dataBuku["judul"]);
    $pengarangBuku = validateInput($dataBuku["pengarang"]);
    $penerbitBuku = validateInput($dataBuku["penerbit"]);
    $tahunTerbit = $dataBuku["tahun_terbit"];
    $jumlahHalaman = $dataBuku["jumlah_halaman"];
    $deskripsiBuku = validateInput($dataBuku["buku_deskripsi"]);

    // Pengecekan mengganti gambar atau tidak
    if ($_FILES["cover"]["error"] === 4) {
        $cover = $gambarLama;
    } else {
        $cover = upload();
    }

    $queryUpdate = $connection->prepare("UPDATE buku SET 
        cover = ?,
        kategori = ?,
        judul = ?,
        pengarang = ?,
        penerbit = ?,
        tahun_terbit = ?,
        jumlah_halaman = ?,
        buku_deskripsi = ?
        WHERE id_buku = ?");
    $queryUpdate->bind_param(
        "ssssssiss",
        $cover,
        $kategoriBuku,
        $judulBuku,
        $pengarangBuku,
        $penerbitBuku,
        $tahunTerbit,
        $jumlahHalaman,
        $deskripsiBuku,
        $idBuku
    );
    $queryUpdate->execute();
    return $queryUpdate->affected_rows;
}


// Hapus Member yang Terdaftar
function deleteMember($nimMember) {
    global $connection;

    // Periksa apakah ada data pengembalian yang terkait
    $checkPengembalian = "SELECT * FROM pengembalian WHERE nim = '$nimMember'";
    $resultPengembalian = mysqli_query($connection, $checkPengembalian);

    if (mysqli_num_rows($resultPengembalian) > 0) {
        echo "<script>alert('Member masih memiliki pengembalian yang aktif!');</script>";
        return 0;  // Tidak melanjutkan penghapusan jika masih ada pengembalian
    }

    // Jika tidak ada pengembalian, lanjutkan penghapusan member
    $deleteMember = "DELETE FROM member WHERE nim = '$nimMember'";
    mysqli_query($connection, $deleteMember);

    return mysqli_affected_rows($connection);
}



// === FUNCTION KHUSUS ADMIN END ===


// === FUNCTION KHUSUS MEMBER START ===

// Peminjaman Buku
function pinjamBuku($dataBuku) {
    global $connection;
    $idBuku = $dataBuku["id_buku"];
    $nim = $dataBuku["nim"];
    $idAdmin = $dataBuku["id"];
    $tglPinjam = $dataBuku["tgl_peminjaman"];
    $tglKembali = $dataBuku["tgl_pengembalian"];

    // Cek apakah user memiliki denda
    $cekDenda = mysqli_query($connection, "SELECT denda FROM pengembalian WHERE nim = $nim AND denda > 0");
    if (mysqli_num_rows($cekDenda) > 0) {
        $item = mysqli_fetch_assoc($cekDenda);
        $jumlahDenda = $item["denda"];
        if ($jumlahDenda > 0) {
            echo "<script>alert('Anda belum melunasi denda, silahkan lakukan pembayaran terlebih dahulu!');</script>";
            return 0;
        }
    }

    // Cek apakah buku sudah dipinjam
    $cekPeminjaman = mysqli_query($connection, "SELECT * FROM peminjaman WHERE id_buku = '$idBuku' AND tgl_pengembalian IS NULL");
    if (mysqli_num_rows($cekPeminjaman) > 0) {
        echo "<script>alert('Buku ini sudah dipinjam oleh orang lain!');</script>";
        return 0;
    }

    $queryPinjam = "INSERT INTO peminjaman (id_buku, nim, id_admin, tgl_peminjaman, tgl_pengembalian) 
                    VALUES ('$idBuku', '$nim', '$idAdmin', '$tglPinjam', '$tglKembali')";
    if (!mysqli_query($connection, $queryPinjam)) {
        echo "Error: " . mysqli_error($connection);  // Error jika query gagal
        return 0;
    }

    return mysqli_affected_rows($connection);
}

function bayarDenda($data) {
    global $connection;
    $idPengembalian = $data["id_pengembalian"];
    $jmlDenda = $data["denda"];
    $jmlDibayar = $data["bayarDenda"];
    $calculate = $jmlDenda - $jmlDibayar;
    
    $bayarDenda = "UPDATE pengembalian SET denda = $calculate WHERE id_pengembalian = $idPengembalian";
    mysqli_query($connection, $bayarDenda);
    return mysqli_affected_rows($connection);
  }



// Fungsi untuk menghapus data pengembalian
function deleteDataPengembalian($idPengembalian) {
    global $connection;

    // Query untuk menghapus data pengembalian berdasarkan ID
    $queryDelete = "DELETE FROM pengembalian WHERE id_pengembalian = '$idPengembalian'";
    mysqli_query($connection, $queryDelete);

    // Mengembalikan hasil dari query
    return mysqli_affected_rows($connection);
}



// Pengembalian Buku
function pengembalian($dataBuku) {
    global $connection;
    
    $idPeminjaman = $dataBuku["id_peminjaman"];
    $idBuku = $dataBuku["id_buku"];
    $nim = $dataBuku["nim"];
    $idAdmin = $dataBuku["id_admin"];
    $tglKembali = $dataBuku["buku_kembali"]; // Tanggal pengembalian
    $tglTenggat = $dataBuku["tgl_pengembalian"]; // Tenggat pengembalian

    // Konversi tanggal ke timestamp untuk perhitungan
    $tglKembaliTimestamp = strtotime($tglKembali);
    $tglTenggatTimestamp = strtotime($tglTenggat);

    // Hitung selisih hari keterlambatan
    $selisih = ($tglKembaliTimestamp - $tglTenggatTimestamp) / (60 * 60 * 24); // Hasil dalam hari

    // Tentukan status keterlambatan
    $keterlambatan = ($selisih > 0) ? 'YA' : 'TIDAK';

    // Hitung denda (misalnya 1000 per hari keterlambatan)
    $denda = ($selisih > 0) ? $selisih * 1000 : 0;

    // Query untuk memasukkan data pengembalian
    $queryPengembalian = "INSERT INTO pengembalian (id_peminjaman, id_buku, nim, id_admin, buku_kembali, keterlambatan, denda) 
                          VALUES ('$idPeminjaman', '$idBuku', '$nim', '$idAdmin', '$tglKembali', '$keterlambatan', '$denda')";
    
    if (mysqli_query($connection, $queryPengembalian)) {
        // Menghapus data peminjaman setelah pengembalian berhasil
        $queryHapusPeminjaman = "DELETE FROM peminjaman WHERE id_peminjaman = '$idPeminjaman'";
        
        if (mysqli_query($connection, $queryHapusPeminjaman)) {
            // Jika penghapusan peminjaman berhasil, kembalikan affected_rows
            return mysqli_affected_rows($connection);
        } else {
            echo "Error: " . mysqli_error($connection);  // Jika query penghapusan gagal
            return 0;
        }
    } else {
        echo "Error: " . mysqli_error($connection);  // Jika query pengembalian gagal
        return 0;
    }
}





// === FUNCTION KHUSUS MEMBER END ===

function searchMember($keyword) {
    global $connection;
    $query = "SELECT * FROM member WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%'";
    $result = mysqli_query($connection, $query);
    $members = [];
    while ($member = mysqli_fetch_assoc($result)) {
        $members[] = $member;
    }
    return $members;
}


?>


