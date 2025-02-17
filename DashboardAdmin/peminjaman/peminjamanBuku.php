<?php
// Halaman pengelolaan peminjaman buku perpustakaan
require "../../config/config.php";

// Query to fetch peminjaman data with related book and member info
$dataPeminjam = queryReadData("SELECT 
    peminjaman.id_peminjaman, 
    peminjaman.id_buku, 
    buku.judul, 
    peminjaman.nim, 
    member.nama, 
    member.class, 
    member.major, 
    peminjaman.id_admin, 
    peminjaman.tgl_peminjaman, 
    peminjaman.tgl_pengembalian 
FROM peminjaman 
INNER JOIN member ON peminjaman.nim = member.nim
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Peminjaman Buku || Admin</title>

    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/DashboardAdmin/peminjaman/style.css">
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
        <h2 class="text-center p-2 mt-5">Daftar Peminjaman Buku</h2>
        
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id Peminjaman</th>
                        <th>ISBN</th>
                        <th>Judul Buku</th>
                        <th>NIM Siswa</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Major</th>
                        <th>Id Admin</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataPeminjam as $item) : ?>
                        <tr>
                            <td><?= $item["id_peminjaman"]; ?></td>
                            <td><?= $item["id_buku"]; ?></td>
                            <td><?= $item["judul"]; ?></td>
                            <td><?= $item["nim"]; ?></td>
                            <td><?= $item["nama"]; ?></td>
                            <td><?= $item["class"]; ?></td>
                            <td><?= $item["major"]; ?></td>
                            <td><?= $item["id_admin"]; ?></td>
                            <td><?= $item["tgl_peminjaman"]; ?></td>
                            <td><?= $item["tgl_pengembalian"]; ?></td>
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
