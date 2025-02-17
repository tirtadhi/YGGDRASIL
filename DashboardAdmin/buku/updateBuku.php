<?php
require "../../config/config.php";

// Fetch book data based on the ID passed in the URL
$review = $_GET["idReview"];
$reviewData = queryReadData("SELECT * FROM buku WHERE id_buku = '$review'")[0];

// Fetch available categories
$kategori = queryReadData("SELECT * FROM kategori_buku");

if (isset($_POST["update"])) {
    // Update the book data
    if (updateBuku($_POST) > 0) {
        echo "<script>
        alert('Data buku berhasil diupdate!');
        document.location.href = 'daftarBuku.php';
        </script>";
    } else {
        echo "<script>
        alert('Data buku gagal diupdate!');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Buku || Admin</title>

    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/DashboardAdmin/buku/style.css">
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
    <div class="container p-3 mt-5">
        <div class="card p-2 mt-5">
            <h1 class="text-center fw-bold p-3">Form Edit Buku</h1>
            <form action="" method="post" enctype="multipart/form-data" class="mt-3 p-2">
                
                <!-- Book Cover -->
                <div class="custom-css-form mb-3">
                    <input type="hidden" name="coverLama" value="<?= $reviewData["cover"]; ?>">
                    <img src="../../imgDB/<?= $reviewData["cover"]; ?>" width="80px" height="80px" alt="Current Cover">
                    <label for="formFileMultiple" class="form-label">Cover Buku</label>
                    <input class="form-control" type="file" name="cover" id="formFileMultiple">
                </div>

                <!-- Book ID -->
                <div class="mb-3">
                    <label for="id_buku" class="form-label">ISBN</label>
                    <input type="text" class="form-control" name="id_buku" id="id_buku" placeholder="example inf01" value="<?= $reviewData["id_buku"]; ?>">
                </div>

                <!-- Book Category -->
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                    <select class="form-select" id="inputGroupSelect01" name="kategori">
                        <option selected><?= $reviewData["kategori"]; ?></option>
                        <?php foreach ($kategori as $item) : ?>
                            <option><?= $item["kategori"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Book Title -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book"></i></span>
                    <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Buku" value="<?= $reviewData["judul"]; ?>">
                </div>

                <!-- Author -->
                <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Nama Pengarang" value="<?= $reviewData["pengarang"]; ?>">
                </div>

                <!-- Publisher -->
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="Nama Penerbit" value="<?= $reviewData["penerbit"]; ?>">
                </div>

                <!-- Publication Year -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                    <input type="date" class="form-control" name="tahun_terbit" id="tahun_terbit" value="<?= $reviewData["tahun_terbit"]; ?>">
                </div>

                <!-- Number of Pages -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book-open"></i></span>
                    <input type="number" class="form-control" name="jumlah_halaman" id="jumlah_halaman" value="<?= $reviewData["jumlah_halaman"]; ?>">
                </div>

                <!-- Book Description -->
                <div class="form-floating mt-3 mb-3">
                    <textarea class="form-control" name="buku_deskripsi" id="buku_deskripsi" style="height: 100px" placeholder="Sinopsis tentang buku ini"><?= $reviewData["buku_deskripsi"]; ?></textarea>
                    <label for="buku_deskripsi">Sinopsis</label>
                </div>

                <!-- Submit and Cancel Buttons -->
                <button class="btn btn-success" type="submit" name="update">Edit</button>
                <a class="btn btn-danger" href="daftarBuku.php">Batal</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
