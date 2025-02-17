<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/admin/sign_in.php");
    exit;
}

require "../../config/config.php";

// Fetch all members by default
$member = queryReadData("SELECT * FROM member");

// If search is performed, filter members based on keyword
if (isset($_POST["search"])) {
    $member = searchMember($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Terdaftar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/DashboardAdmin/member/style.css">
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
<div class="container container-main mt-5">

    <!-- Search Form -->
    <form action="" method="post" class="my-4">
        <div class="input-group mb-3 justify-content-end">
            <input class="form-control search-input" type="text" name="keyword" id="keyword" placeholder="Cari data member...">
            <button class="btn btn-light search-button" type="submit" name="search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </form>

    <!-- Table -->
    <h4>List of Members</h4>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="bg-primary text-light">NIM</th>
                    <th class="bg-primary text-light">Nama</th>
                    <th class="bg-primary text-light">Jenis Kelamin</th>
                    <th class="bg-primary text-light">Class</th>
                    <th class="bg-primary text-light">Major</th>
                    <th class="bg-primary text-light">No Telepon</th>
                    <th class="bg-primary text-light">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($member as $item) : ?>
                    <tr>
                        <td><?= $item["nim"]; ?></td>
                        <td><?= $item["nama"]; ?></td>
                        <td><?= $item["gender"]; ?></td>
                        <td><?= $item["class"]; ?></td>
                        <td><?= $item["major"]; ?></td>
                        <td><?= $item["no_tlp"]; ?></td>
                        <td>
                            <a href="deleteMember.php?id=<?= $item["nim"]; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Yakin ingin menghapus data member?');">
                               <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
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
