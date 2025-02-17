<?php 
session_start();

// Jika member sudah login, tidak boleh kembali ke halaman login, kecuali logout
if (isset($_SESSION["signIn"])) {
    header("Location: ../../DashboardMember/dashboardMember.php");
    exit;
}

require "../../loginSystem/connect.php";

if (isset($_POST["signIn"])) {
    $nama = strtolower($_POST["nama"]);
    $nim = $_POST["nim"];
    $password = $_POST["password"];

    $result = mysqli_query($connect, "SELECT * FROM member WHERE nama = '$nama' AND nim = $nim");

    if (mysqli_num_rows($result) === 1) {
        // Cek password 
        $pw = mysqli_fetch_assoc($result);
        if (password_verify($password, $pw["password"])) {
            // SET SESSION 
            $_SESSION["signIn"] = true;
            $_SESSION["member"]["nama"] = $nama;
            $_SESSION["member"]["nim"] = $nim;
            $_SESSION["member"]["gender"] = $pw["gender"];  // Menyimpan gender ke dalam session
            header("Location: ../../DashboardMember/dashboardMember.php");
            exit;
        }
    }
    $error = true;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/sign/admin/style.css">
    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
  </head>
  <body>
    <!-- Particles.js Background -->
    <div id="particles-js"></div>

    <!-- Main Content -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="card" style="width: 28rem;">
        <img
            src="/assets/logocaptBIGWHT.png"
            alt="logo"
            class="small-logo mt-3 mb-3"
        />
        <h3 class="text-center text-white mb-4">Login Student</h3>
        <form method="post">
          <div class="mb-3">
            <label for="validationCustom01" class="form-label text-white">Username</label>
            <input type="text" class="form-control" name="nama" placeholder="Enter your username" id="validationCustom01" required>
          </div>
          <div class="mb-3">
            <label for="validationCustom01" class="form-label text-white">NIM</label>
            <input type="number" class="form-control" name="nim" placeholder="Enter your NIM" id="validationCustom01" required>
          </div>
          <div class="mb-3">
            <label for="validationCustom02" class="form-label text-white">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" id="validationCustom02" required>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <button type="submit" name="signIn" class="btn w-50 text-white" style="background: linear-gradient(45deg, #082c8f, #3b3bf2)">Login</button>
            <a href="/sign/PortalLogin.php" class="btn text-white" style="background: linear-gradient(45deg, #848484, #a9a9a9)">Cancel</a>
          </div>
          <div class="text-center">
            <p class="text-white">Don't have an account yet? <a href="sign_up.php" class="text-warning text-decoration-none">Sign Up</a></p>
          </div>
          <?php if (isset($error)): ?>
            <p class="text-danger text-center mt-3">Invalid username, NIM, or password!</p>
          <?php endif; ?>
        </form>
      </div>
    </div>

    <!-- Particles.js Initialization -->
    <script src="/sign/admin/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
