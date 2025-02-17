<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/sign/style.css" />
    <link rel="icon" href="/assets/ikon.ico" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <title>Portal Login Perpustakaan</title>
  </head>
  <body>
    <!-- Particles Background -->
    <div id="particles-js"></div>

    <!-- Main Content -->
    <div
      class="container d-flex justify-content-center align-items-center vh-100"
    >
      <div class="card" style="width: 28rem">
        <img
          src="/assets/logocaptBIGWHT.png"
          alt="logo"
          class="small-logo mt-3"
        />
        <div class="card-body text-center">
          <h3 class="card-title text-white">Portal Login Perpustakaan</h3>
          <p class="card-text text-white">
            Silakan pilih halaman login sesuai dengan status Anda
          </p>
        </div>
        <hr />
        <div class="card-body">
          <h4 class="card-title text-center text-white">Akses Login</h4>
          <div class="d-grid gap-3 p-2">
            <a
              class="btn text-white"
              style="background: linear-gradient(45deg, #000000, #514f4f)"
              href="admin/sign_in.php"
              >Admin</a
            >
            <a
              class="btn text-white"
              style="background: linear-gradient(45deg, #082c8f, #3b3bf2)"
              href="member/sign_in.php"
              >Student</a
            >
            <hr />
            <a
              class="btn text-white"
              style="background: linear-gradient(45deg, #088f1a, #5af23b)"
              href="../index.php"
              >Back</a
            >
          </div>
        </div>
      </div>
    </div>

    <script src="/sign/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
