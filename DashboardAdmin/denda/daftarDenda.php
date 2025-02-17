<?php 
// Halaman pengelolaan denda Buku Perpustakaan
require "../../config/config.php";

// Query to fetch denda data with related book, member, and admin info
$dataDenda = queryReadData("SELECT 
    pengembalian.id_pengembalian, 
    pengembalian.id_buku, 
    buku.judul, 
    pengembalian.nim, 
    member.nama, 
    member.major, 
    admin.nama_admin, 
    pengembalian.buku_kembali, 
    pengembalian.keterlambatan, 
    pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.nim = member.nim
INNER JOIN admin ON pengembalian.id_admin = admin.id
WHERE pengembalian.denda > 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Denda Buku || Admin</title>

    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/DashboardAdmin/denda/style.css">
</head>

<body>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary shadow-sm fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../../assets/logoyg.png" alt="logo" width="120px">
        </a>
        <a class="btn btn-outline-primary" href="../dashboardAdmin.php">Dashboard</a>
      </div>
</nav>

    <!-- Main Content -->
    <div class="container p-4 mt-5">
        <h2 class="text-center p-2 mt-5">Daftar Denda Buku</h2>
        
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Judul Buku</th>
                        <th>NIM</th>
                        <th>Nama Siswa</th>
                        <th>Major</th>
                        <th>Nama Admin</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Keterlambatan (Hari)</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataDenda as $item) : ?>
                        <tr>
                            <td><?= $item["id_buku"]; ?></td>
                            <td><?= $item["judul"]; ?></td>
                            <td><?= $item["nim"]; ?></td>
                            <td><?= $item["nama"]; ?></td>
                            <td><?= $item["major"]; ?></td>
                            <td><?= $item["nama_admin"]; ?></td>
                            <td><?= $item["buku_kembali"]; ?></td>
                            <td><?= $item["keterlambatan"]; ?> Hari</td>
                            <td>Rp <?= number_format($item["denda"], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
