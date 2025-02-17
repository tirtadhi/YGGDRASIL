<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>YGGDRASIL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/assets/ikon.ico" type="image/png">
</head>

<body>

    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="logo-container">
            <img src="assets//logocaptBIGWHT.png" alt="Logo" class="logo">
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="hero-content container text-center">
            <img src="assets/logocapt.png" alt="Logo" width="200px" class="mb-3">
            <p class="lead text-black">Temukan dunia pengetahuan di ujung jari Anda:</p>
            <p class="lead text-black">Perpustakaan online YGGDRASIL membawa Anda ke dunia buku digital.</p>
            <a href="sign/PortalLogin.php" class="btn btn-dark text-white">Get Started</a>
        </div>
    </section>

    <script>
      // Menyembunyikan loading screen dengan efek fade-out setelah 5 detik
      window.onload = function () {
        setTimeout(function () {
          document.getElementById("loading-screen").classList.add("fade-out"); // Menambahkan kelas untuk fade-out
        }, 3000); // Loading screen akan hilang setelah 3 detik
      };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
