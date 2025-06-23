<?php
session_start();

$jawaban_benar = "kriptografi123"; // Ganti sesuai soal
$jawaban_user = strtolower(trim($_POST['jawaban']));

if ($jawaban_user === $jawaban_benar) {
  $timestamp = date("Y-m-d H:i:s");
  $data = $_SESSION['nama'] . " | " . $_SESSION['nim'] . " | " . $timestamp . "\n";
  file_put_contents("leaderboard.txt", $data, FILE_APPEND);
  $status = "benar";
} else {
  header("Location: jawaban.php?error=1");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Hasil Submit</title>
  <style>
    body {
      font-family: Consolas, monospace;
      background: linear-gradient(to right, #5c1a1b, #7b2d26);
      color: white;
      text-align: center;
      padding-top: 100px;
    }
    h2 {
      font-size: 1.8em;
    }
    a {
      color: #ffd;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h2>yeay benerr, 100 poin buat kelompok kalian 😼</h2>
  <a href="leaderboard.php">Lihat Leaderboard</a>
</body>
</html>
