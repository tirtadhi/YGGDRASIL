<?php 
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}

require "../../config/config.php";

// Tangkap ISBN dari URL (GET)
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");

// Menampilkan data siswa yg sedang login
$nimSiswa = $_SESSION["member"]["nim"];
$dataSiswa = queryReadData("SELECT * FROM member WHERE nim = $nimSiswa");
$admin = queryReadData("SELECT * FROM admin");

// Peminjaman 
if (isset($_POST["pinjam"])) {
    if (pinjamBuku($_POST) > 0) {
        echo "<script>alert('Buku berhasil dipinjam');</script>";

    } else {
        echo "<script>alert('Buku gagal dipinjam!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pinjam Buku || Member</title>
    <!-- Bootstrap CSS -->
    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    
    <style>
        body {
            background-image: url('../../assets/bg-dashboard.png'); /* Ganti dengan path gambar Anda */
            background-size: cover; /* Menyesuaikan gambar agar menutupi seluruh area */
            background-position: center center; /* Posisi gambar di tengah layar */
            background-attachment: fixed; /* Efek paralaks */
            color: #fff; /* Agar teks kontras dengan background */
        }
        .container {
            margin-top: 80px;
        }
        .card-header {
            font-weight: bold;
            background-color: #0066cc;
            color: white;
        }
        .input-group-text {
            width: 150px;
        }
        .input-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary shadow-sm fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../../assets/logoyg.png" alt="logo" width="120px">
        </a>
        <a class="btn btn-outline-primary" href="../dashboardMember.php">Dashboard</a>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Form Peminjaman Buku</h2>

        <div class="row">
            <!-- Form Buku (Left) -->
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Data Lengkap Buku</h5>
                    <div class="card-body">
                        <?php foreach ($query as $item) : ?>
                        <p class="card-text">
                            <img src="../../imgDB/<?= $item["cover"]; ?>" width="180px" height="185px" style="border-radius: 5px;">
                        </p>
                        <form action="" method="post">
                            <div class="input-group">
                                <span class="input-group-text">ISBN</span>
                                <input type="text" class="form-control" value="<?= $item["id_buku"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Kategori</span>
                                <input type="text" class="form-control" value="<?= $item["kategori"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Judul</span>
                                <input type="text" class="form-control" value="<?= $item["judul"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Pengarang</span>
                                <input type="text" class="form-control" value="<?= $item["pengarang"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Penerbit</span>
                                <input type="text" class="form-control" value="<?= $item["penerbit"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Tahun Terbit</span>
                                <input type="date" class="form-control" value="<?= $item["tahun_terbit"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Jumlah Halaman</span>
                                <input type="number" class="form-control" value="<?= $item["jumlah_halaman"]; ?>" readonly required>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" style="height: 100px" readonly required><?= $item["buku_deskripsi"]; ?></textarea>
                                <label for="floatingTextarea2">Deskripsi Buku</label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Form Siswa (Right) -->
            <div class="col-md-6">
                <div class="card mt-4 mt-md-0">
                    <h5 class="card-header">Data Lengkap Siswa</h5>
                    <div class="card-body">
                        <p><img src="../../assets/memberLogo.png" width="150px"></p>
                        <form action="" method="post">
                            <?php foreach ($dataSiswa as $item) : ?>
                            <div class="input-group">
                                <span class="input-group-text">NIM</span>
                                <input type="number" class="form-control" value="<?= $item["nim"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Nama</span>
                                <input type="text" class="form-control" value="<?= $item["nama"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Jenis Kelamin</span>
                                <input type="text" class="form-control" value="<?= $item["gender"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Class</span>
                                <input type="text" class="form-control" value="<?= $item["class"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Major</span>
                                <input type="text" class="form-control" value="<?= $item["major"]; ?>" readonly required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">No Tlp</span>
                                <input type="tel" class="form-control" value="<?= $item["no_tlp"]; ?>" readonly required>
                            </div>
                            <?php endforeach; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-danger mt-4" role="alert">
            <span class="fw-bold">Catatan:</span> Setiap keterlambatan pada pengembalian buku akan dikenakan sanksi berupa denda.
        </div>

        <!-- Form Pinjam Buku -->
        <div class="card mt-4">
            <h5 class="card-header">Form Pinjam Buku</h5>
            <div class="card-body">
                <form action="" method="post" onsubmit="return validateForm()">
                    <?php foreach ($query as $item) : ?>
                    <div class="input-group">
                        <span class="input-group-text">ISBN</span>
                        <input type="text" name="id_buku" class="form-control" value="<?= $item["id_buku"]; ?>" readonly required>
                    </div>
                    <?php endforeach; ?>

                    <div class="input-group">
                        <span class="input-group-text">NIM</span>
                        <input type="number" name="nim" class="form-control" value="<?= htmlentities($_SESSION["member"]["nim"]); ?>" readonly required>
                    </div>

                    <select name="id" class="form-select" required>
                        <option selected>Pilih id admin</option>
                        <?php foreach ($admin as $item) : ?>
                        <option value="<?= $item["id"]; ?>"><?= $item["id"]; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="input-group mt-3">
                        <span class="input-group-text">Tanggal Pinjam</span>
                        <input type="date" name="tgl_peminjaman" class="form-control" id="tgl_peminjaman" onchange="setReturnDate()" required>
                    </div>

                    <div class="input-group mt-3">
                        <span class="input-group-text">Tenggat Pengembalian</span>
                        <input type="date" name="tgl_pengembalian" class="form-control" id="tgl_pengembalian" readonly required>
                    </div>

                    <a class="btn btn-danger" href="../buku/daftarBuku.php">Batal</a>
                    <button type="submit" class="btn btn-success" name="pinjam">Pinjam</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="../../style/js/script.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
