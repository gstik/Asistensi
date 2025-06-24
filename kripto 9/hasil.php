<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

$jawaban_benar = "kriptografi123"; // Ganti sesuai soal kamu
$jawaban_user = strtolower(trim($_POST['jawaban']));

// Jika jawaban cocok
if ($jawaban_user === $jawaban_benar) {
  $timestamp = date("Y-m-d H:i:s"); // Jam sesuai WIB
  $data = $_SESSION['nama'] . " | " . $_SESSION['nim'] . " | " . $timestamp . "\n";
  file_put_contents("leaderboard.txt", $data, FILE_APPEND);
  $status = "benar";
} else {
  header("Location: jawaban.php?error=1");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Submit</title>
  <style>
    body {
      font-family: "Fira Code", Consolas, monospace;
      background: linear-gradient(to right, #2e0f10, #601717);
      color: #f5f5f5;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .card {
      background: #1c1c1c;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.5);
      max-width: 500px;
      text-align: center;
    }

    .card h2 {
      margin-bottom: 20px;
      font-size: 1.9em;
      color: #ffe66d;
    }

    .btn {
      background-color: #ffcc00;
      color: #000;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #e6b800;
    }
  </style>
</head>
<body>

  <div class="card">
    <h2>😼🎉 Jawaban kalian benar! 100 poin 😼🎉</h2>
    <p style="font-size:0.9em; color:#ccc;">
      Tercatat pada: <?= $timestamp ?> WIB
    </p>
    <br>
    <a class="btn" href="leaderboard.php">📊 Lihat Leaderboard 📊</a>
  </div>

</body>
</html>
