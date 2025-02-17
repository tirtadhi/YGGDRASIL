<?php
session_start();

// Jika member belum login, arahkan ke halaman login
if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}

require "../../config/config.php";

// Query untuk mengambil semua buku
$buku = queryReadData("SELECT * FROM buku");

// Filter berdasarkan kategori buku
if (isset($_POST["search"])) {
    $buku = search($_POST["keyword"]);
}

if (isset($_POST["informatika"])) {
    $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'informatika'");
}
if (isset($_POST["bisnis"])) {
    $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'bisnis'");
}
if (isset($_POST["filsafat"])) {
    $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'filsafat'");
}
if (isset($_POST["novel"])) {
    $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'novel'");
}
if (isset($_POST["sains"])) {
    $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'sains'");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku || Member</title>

    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
      <!-- Filter Kategori Buku -->
      <div class="d-flex justify-content-center gap-2 mb-4">
        <form action="" method="post" class="filter-container">
          <div class="btn-group">
            <button class="btn btn-outline-primary" type="submit">Semua</button>
            <button type="submit" name="informatika" class="btn btn-outline-primary">Informatika</button>
            <button type="submit" name="bisnis" class="btn btn-outline-primary">Bisnis</button>
            <button type="submit" name="filsafat" class="btn btn-outline-primary">Filsafat</button>
            <button type="submit" name="novel" class="btn btn-outline-primary">Novel</button>
            <button type="submit" name="sains" class="btn btn-outline-primary">Sains</button>
          </div>
        </form>
      </div>

      <!-- Search Bar -->
      <form action="" method="post" class="d-flex justify-content-end mb-4">
        <input class="form-control me-2" type="text" name="keyword" placeholder="Cari judul atau kategori buku..." aria-label="Search">
        <button class="btn btn-primary" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>

      <!-- Card Buku -->
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($buku as $item) : ?>
        <div class="col">
          <div class="card shadow-sm h-100">
            <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="250px">
            <div class="card-body">
              <h5 class="card-title"><?= $item["judul"]; ?></h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Kategori: <?= $item["kategori"]; ?></li>
            </ul>
            <div class="card-body">
              <a class="btn btn-success w-100" href="detailBuku.php?id=<?= $item["id_buku"]; ?>">Detail</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
