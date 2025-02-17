<?php 
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}

require "../../config/config.php";

if (isset($_POST["bayar"])) {
    if (bayarDenda($_POST) > 0) {
        echo "<script>
            alert('Denda berhasil dibayar');
            document.location.href = 'TransaksiDenda.php';
        </script>";
    } else {
        echo "<script>
            alert('Denda gagal dibayar');
        </script>";
    }
}

$dendaSiswa = $_GET["id"];
$query = queryReadData("SELECT pengembalian.id_pengembalian, buku.judul, member.nama, pengembalian.buku_kembali, pengembalian.keterlambatan, pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.nim = member.nim
WHERE pengembalian.id_pengembalian = $dendaSiswa");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/DashboardMember/formPeminjaman/style.css">
    <title>Form Bayar Denda || Member</title>
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
        <div class="mt-5 card p-3 mb-5">
            <form action="" method="post">
                <h3>Form Bayar Denda</h3>
                <?php foreach ($query as $item) : ?>
                    <input type="hidden" name="id_pengembalian" id="id_pengembalian" value="<?= $item["id_pengembalian"]; ?>">

                    <div class="mt-4 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama Siswa" name="nama" id="nama" value="<?= $item["nama"]; ?>" readonly>
                    </div>

                    <div class="d-flex flex-wrap gap-4">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Buku yang Dipinjam</label>
                            <input type="text" class="form-control" placeholder="Judul Buku" name="judul" id="judul" value="<?= $item["judul"]; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="buku_kembali" class="form-label">Tanggal Dikembalikan</label>
                            <input type="date" class="form-control" name="buku_kembali" id="buku_kembali" value="<?= $item["buku_kembali"]; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="denda" class="form-label">Besar Denda</label>
                            <input type="number" class="form-control" name="denda" id="denda" value="<?= $item["denda"]; ?>" readonly>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="mb-3">
                    <label for="bayarDenda" class="form-label">Jumlah Denda yang Dibayar</label>
                    <input type="number" class="form-control" name="bayarDenda" id="bayarDenda" required>
                </div>

                <div class="d-flex gap-3">
                    <button type="reset" class="btn btn-warning text-light">Reset</button>
                    <button type="submit" class="btn btn-success" name="bayar">Bayar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
