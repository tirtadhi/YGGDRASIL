<?php
// FILE LOGIN SYSTEM 
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "perpustakaan";
$connect = mysqli_connect($host, $username, $password, $database);


/* SIGN UP Member */
function signUp($data) {
  global $connect;

  $nim = htmlspecialchars($data["nim"]);
  $nama = htmlspecialchars(strtolower($data["nama"]));
  $password = mysqli_real_escape_string($connect, $data["password"]);
  $confirmPw = mysqli_real_escape_string($connect, $data["confirmPw"]);
  $jk = htmlspecialchars($data["gender"]);
  $class = htmlspecialchars($data["class"]);
  $major = htmlspecialchars($data["major"]);
  $noTlp = htmlspecialchars($data["no_tlp"]);

  // Validasi panjang NIM (12 digit) dan hanya angka
  if (!preg_match("/^\d{12}$/", $nim)) {
      echo "<script>alert('NIM harus terdiri dari 12 angka!');</script>";
      return 0;  // Menghentikan proses jika NIM tidak sesuai format
  }

  // cek nim sudah ada / belum
  $nimResult = mysqli_query($connect, "SELECT nim FROM member WHERE nim = '$nim'");
  if (mysqli_fetch_assoc($nimResult)) {
      echo "<script>
      alert('NIM sudah terdaftar, silahkan gunakan NIM lain!');
      </script>";
      return 0;
  }

  // Pengecekan kesamaan confirm password dan password
  if ($password !== $confirmPw) {
      echo "<script>
      alert('Password / confirm password tidak sesuai');
      </script>";
      return 0;
  }

  $class = htmlspecialchars($data["class"]);
  if (strlen($class) > 10) {
    echo "<script>alert('Class tidak boleh lebih dari 9=10 karakter');</script>";
    return 0;
  }


  // Enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Menyusun query untuk menyimpan data ke dalam database
  $querySignUp = "INSERT INTO member (nim, nama, password, gender, class, major, no_tlp) VALUES ($nim, '$nama', '$password', '$jk', '$class', '$major', '$noTlp')";

  mysqli_query($connect, $querySignUp);

  return mysqli_affected_rows($connect);
}


?>
