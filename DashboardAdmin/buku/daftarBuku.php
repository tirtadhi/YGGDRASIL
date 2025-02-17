<?php
require "../../config/config.php";

// Fetch all books by default
$buku = queryReadData("SELECT * FROM buku");

// Search functionality
if (isset($_POST["search"])) {
    $buku = search($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Buku || Admin</title>

    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/DashboardAdmin/buku/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../assets/logoyg.png" alt="logo" width="120px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="../dashboardAdmin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="tambahBuku.php">Tambah Buku</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container p-4 mt-5">

        <!-- Search Form -->
        <form action="" method="post" class="mt-5">
            <div class="input-group d-flex justify-content-end mb-3">
                <input class="form-control border p-2 rounded-start-0" type="text" name="keyword" id="keyword" placeholder="Cari data buku...">
                <button class="btn btn-light rounded-end-0 border border-start-0" type="submit" name="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>

        <!-- Book Cards -->
        <div class="layout-card-custom">
            <?php foreach ($buku as $item) : ?>
                <div class="card" style="width: 15rem;">
                    <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="250px">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item["judul"]; ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Kategori: <?= $item["kategori"]; ?></li>
                        <li class="list-group-item">ISBN: <?= $item["id_buku"]; ?></li>
                    </ul>
                    <div class="card-body">
                        <a href="updateBuku.php?idReview=<?= $item["id_buku"]; ?>" class="btn btn-success">Edit</a>
                        <a href="deleteBuku.php?id=<?= $item["id_buku"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data buku?');">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
