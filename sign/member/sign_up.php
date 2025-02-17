<?php 
require "../../loginSystem/connect.php";

if (isset($_POST["signUp"])) {
    if (signUp($_POST) > 0) {
        echo "<script>
        alert('Sign Up berhasil!');
        window.location.href = '/sign/PortalLogin.php'; // Redirect to login page
        </script>";
    } else {
        echo "<script>
        alert('Sign Up gagal!');
        </script>";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
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
        <h3 class="text-center text-white mb-4">Sign Up</h3>
        <form method="post">

        <!-- username -->
          <div class="mb-3">
            <label for="validationCustom02" class="form-label text-white">Username</label>
            <input type="text" class="form-control" name="nama" placeholder="Enter your username" id="validationCustom02" required>
          </div>

          <div class="mb-3 d-flex justify-content-between">
            <!-- NIM -->
            <div class="me-3 w-48">
              <label for="validationCustom01" class="form-label text-white">NIM</label>
              <input type="text" class="form-control" name="nim" id="validationCustom01" placeholder="Enter your NIM" required>
            </div>

            <!-- No WhatsApp -->
            <div class="w-48">
              <label for="validationCustom01" class="form-label text-white">No WhatsApp</label>
              <input type="tel" class="form-control" name="no_tlp" placeholder="Enter your no telp" id="validationCustom01" required>
            </div>
          </div>

        <div class="mb-3 d-flex justify-content-between">
          <!-- Password -->
          <div class="me-3 w-48">
            <label for="validationCustom02" class="form-label text-white">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" id="validationCustom02" required>
          </div>

          <!-- Confirm Password -->
          <div class="w-48">
            <label for="validationCustom03" class="form-label text-white">Confirm Password</label>
            <input type="password" class="form-control" name="confirmPw" placeholder="Confirm your password" id="validationCustom03" required>
          </div>
        </div>

          
          <div class="mb-3 d-flex justify-content-between">
              <!-- Gender -->
              <div class="me-2 w-30">
                <label for="inputGroupSelect01" class="form-label text-white">Gender</label>
                <select name="gender" id="inputGroupSelect01" class="form-select" required>
                  <option value="" disabled selected>Choose your gender</option>
                  <option value="Laki - Laki">Laki Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>

              <!-- Class -->
              <div class="me-2 w-30">
                <label for="inputGroupSelect02" class="form-label text-white">Class</label>
                <input type="text" class="form-control" name="class" placeholder="05TPLP011" id="inputGroupSelect02" maxlength="10" required>
              </div>

              <!-- Major -->
              <div class="w-30">
                <label for="inputGroupSelect03" class="form-label text-white">Major</label>
                <select name="major" id="inputGroupSelect03" class="form-select" required>
                  <option value="" disabled selected>Major</option>
                  <option value="Akuntansi">Akuntansi</option>
                  <option value="Akuntansi Perpajakan">Akuntansi Perpajakan</option>
                  <option value="Administrasi Negara">Administrasi Negara</option>
                  <option value="Ekonomi Syariah">Ekonomi Syariah</option>
                  <option value="Hukum">Hukum</option>
                  <option value="Manajemen">Manajemen</option>
                  <option value="Matematika">Matematika</option>
                  <option value="Pendidikan Ekonomi">Pendidikan Ekonomi</option>
                  <option value="Pendidikan Guru Sekolah Dasar">Pendidikan Guru Sekolah Dasar</option>
                  <option value="Pendidikan Pancasila dan Kewarganegaraan">Pendidikan Pancasila dan Kewarganegaraan</option>
                  <option value="Sastra Indonesia">Sastra Indonesia</option>
                  <option value="Sastra Inggris">Sastra Inggris</option>
                  <option value="Sistem Informasi">Sistem Informasi</option>
                  <option value="Teknik Elektro">Teknik Elektro</option>
                  <option value="Teknik Industri">Teknik Industri</option>
                  <option value="Teknik Informatika">Teknik Informatika</option>
                  <option value="Teknik Kimia">Teknik Kimia</option>
                  <option value="Teknik Mesin">Teknik Mesin</option>
                </select>
              </div>
            </div>


          <div class="d-flex justify-content-between mb-3">
            <button type="submit" name="signUp" class="btn w-50 text-white" style="background: linear-gradient(45deg, #082c8f, #3b3bf2)">Register</button>
            <a href="/sign/PortalLogin.php" class="btn text-white" style="background: linear-gradient(45deg, #848484, #a9a9a9)">Cancel</a>
          </div>
          <div class="d-flex justify-content-center mb-1">
            <p class="text-white">Already have an account? <a href="/sign/PortalLogin.php" class="text-primary">Sign In</a></p>
          </div>
        </form>
      </div>
    </div>

    <!-- Particles.js Initialization -->
    <script src="/sign/admin/script.js"></script>

    <script>
  const form = document.querySelector("form");
  form.addEventListener("submit", function(event) {
      const password = document.querySelector("input[name='password']").value;
      const confirmPassword = document.querySelector("input[name='confirmPw']").value;

      if (password !== confirmPassword) {
          alert("Password dan Confirm Password tidak cocok!");
          event.preventDefault(); // Mencegah form disubmit
      }
  });
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
