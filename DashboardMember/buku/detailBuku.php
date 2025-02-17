<?php 
require "../../config/config.php";
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Buku || Member</title>
    
    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/DashboardMember/buku/style.css">
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
      <h2 class="text-center mb-4">Detail Buku</h2>
      
      <div class="row justify-content-center">
        <!-- Kolom Kiri: Gambar Cover Buku -->
        <div class="col-md-4">
          <?php foreach ($query as $item) : ?>
            <img src="../../imgDB/<?= $item["cover"]; ?>" class="img-fluid rounded" alt="coverBuku">
        </div>

        <!-- Kolom Kanan: Detail Buku -->
        <div class="col-md-6">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><?= $item["judul"]; ?></h5>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>ISBN:</strong> <?= $item["id_buku"]; ?></li>
                <li class="list-group-item"><strong>Kategori:</strong> <?= $item["kategori"]; ?></li>
                <li class="list-group-item"><strong>Pengarang:</strong> <?= $item["pengarang"]; ?></li>
                <li class="list-group-item"><strong>Penerbit:</strong> <?= $item["penerbit"]; ?></li>
                <li class="list-group-item"><strong>Tahun Terbit:</strong> <?= $item["tahun_terbit"]; ?></li>
                <li class="list-group-item"><strong>Jumlah Halaman:</strong> <?= $item["jumlah_halaman"]; ?></li>
                <li class="list-group-item"><strong>Deskripsi Buku:</strong> <?= $item["buku_deskripsi"]; ?></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <!-- Tombol Batal dan Pinjam -->
                <a href="daftarBuku.php" class="btn btn-danger w-48">Batal</a>
                <a href="../formPeminjaman/pinjamBuku.php?id=<?= $item["id_buku"]; ?>" class="btn btn-success w-48">Pinjam</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
