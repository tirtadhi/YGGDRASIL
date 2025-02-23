<?php 
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}

require "../../config/config.php"; 
$nimSiswa = $_SESSION["member"]["nim"];

$dataDenda = queryReadData("SELECT pengembalian.id_pengembalian, pengembalian.id_peminjaman, pengembalian.id_buku, buku.judul, pengembalian.nim, member.nama, admin.nama_admin, pengembalian.buku_kembali, pengembalian.keterlambatan, pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.nim = member.nim
INNER JOIN admin ON pengembalian.id_admin = admin.id
WHERE pengembalian.nim = $nimSiswa AND pengembalian.denda > 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/DashboardMember/formPeminjaman/style.css">
    <title>Transaksi Denda Buku || Member</title>
    <link rel="icon" href="/assets/ikon.ico" type="image/png">
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

    <div class="p-4 mt-5">
        <div class="mt-5 alert alert-primary" role="alert">
            Riwayat transaksi Denda Anda - <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["member"]["nama"]); ?></span>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover">
                <thead class="text-center">
                    <tr>
                        <th class="bg-primary text-light">ISBN</th>
                        <th class="bg-primary text-light">Judul Buku</th>
                        <th class="bg-primary text-light">NIM</th>
                        <th class="bg-primary text-light">Nama Siswa</th>
                        <th class="bg-primary text-light">Nama Admin</th>
                        <th class="bg-primary text-light">Hari Pengembalian</th>
                        <th class="bg-primary text-light">Keterlambatan</th>
                        <th class="bg-primary text-light">Denda</th>
                        <th class="bg-primary text-light">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($dataDenda as $item) : ?>
                        <tr>
                            <td><?= $item["id_buku"]; ?></td>
                            <td><?= $item["judul"]; ?></td>
                            <td><?= $item["nim"]; ?></td>
                            <td><?= $item["nama"]; ?></td>
                            <td><?= $item["nama_admin"]; ?></td>
                            <td><?= $item["buku_kembali"]; ?></td>
                            <td><?= $item["keterlambatan"]; ?></td>
                            <td><?= $item["denda"]; ?></td>
                            <td>
                                <a class="btn btn-success" href="formBayarDenda.php?id=<?= $item["id_pengembalian"]; ?>">Bayar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
