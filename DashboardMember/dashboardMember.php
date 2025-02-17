<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../sign/member/sign_in.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/DashboardMember/style.css"> 
    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <title>Member Dashboard</title>
</head>

<body>
<nav class="navbar fixed-top bg-body-tertiary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../assets/logoyg.png" alt="logo" width="120px">
        </a>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                // Check if 'gender' is set in the session and display appropriate image
                if (isset($_SESSION['member']['gender']) && $_SESSION['member']['gender'] == 'Laki - Laki') {
                    echo '<img src="../assets/male.png" alt="memberLogo" width="40px">';
                } else {
                    echo '<img src="../assets/female.png" alt="memberLogo" width="40px">';
                }
                ?>
            </button>
            <ul class="dropdown-menu position-absolute mt-2 p-2" style="margin-left: -7rem;">
                <li>
                    <a class="dropdown-item text-center" href="#">
                        <?php
                        // Show appropriate logo based on gender
                        if (isset($_SESSION['member']['gender']) && $_SESSION['member']['gender'] == 'Laki - Laki') {
                            echo '<img src="../assets/male.png" alt="memberLogo" width="30px">';
                        } else {
                            echo '<img src="../assets/female.png" alt="memberLogo" width="30px">';
                        }
                        ?>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-center text-secondary" href="#"> 
                        <span class="text-capitalize"><?php echo $_SESSION['member']['nama']; ?></span>
                    </a>
                    <a class="dropdown-item text-center mb-2">Student</a>
                </li>
                <li>
                    <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="signOut.php">Sign Out <i class="fa-solid fa-right-to-bracket"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    
    <!-- Content -->
    <div class="content">
        <div class="p-4">
            <div class="dashboard-wrapper">
            <?php
            // Mendapatkan tanggal dan waktu saat ini
            $date = date('Y-m-d H:i:s');
            $day = date('l');
            $dayOfMonth = date('d');
            $month = date('F');
            $year = date('Y');
            ?>
            
            <h1 class="fw-bold">Dashboard - <span class="fs-4 text-secondary"><?php echo $day . " " . $dayOfMonth . " " . $month . " " . $year; ?></span></h1>
            <div>
            Welcome <span class="text-capitalize fw-bold"><?php echo $_SESSION['member']['nama']; ?></span>, to the YGGDRASIL Dashboard
            </div>
            </div>
            

            <!-- Library Services -->
            <div class="mt-3 p-2">
                <div class="mt-2 mb-4">
                </div>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <div class="cardImg m-2">
                        <a href="buku/daftarBuku.php">
                            <img src="../assets/dashboardCardMember/Books.gif" alt="daftar buku" class="img-fluid">
                        </a>
                    </div>
                    <div class="cardImg m-2">
                        <a href="formPeminjaman/TransaksiPeminjaman.php">
                            <img src="../assets/dashboardCardMember/Peminjaman.gif" alt="daftar buku" class="img-fluid">
                        </a>
                    </div>

                    <div class="cardImg m-2">
                        <a href="formPeminjaman/TransaksiPengembalian.php">
                            <img src="../assets/dashboardCardMember/Pengembalian.gif" alt="daftar buku" class="img-fluid">
                        </a>
                    </div>
                    <div class="cardImg m-2">
                        <a href="formPeminjaman/TransaksiDenda.php">
                            <img src="../assets/dashboardCardMember/Denda.gif" alt="daftar buku" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div> 
    </div> <!-- End of Content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
