<?php
$leaderboard = file_exists("leaderboard.txt") ? file("leaderboard.txt", FILE_IGNORE_NEW_LINES) : [];
$total = count($leaderboard);
$last_submit = $total > 0 ? end($leaderboard) : null;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard Asisten</title>
  <style>
    body {
      font-family: Consolas, monospace;
      background: linear-gradient(to right, #5c1a1b, #7b2d26);
      color: #fff;
      margin: 0;
      padding: 30px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    .menu {
      text-align: center;
      margin-bottom: 30px;
    }
    .menu a {
      display: inline-block;
      margin: 8px;
      padding: 10px 16px;
      background: #fff;
      color: #5c1a1b;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .menu a:hover {
      background: #ffd;
    }
    .stats, .leaderboard {
      background: #fff;
      color: #000;
      max-width: 500px;
      margin: 20px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    ol {
      padding-left: 20px;
    }
  </style>
</head>
<body>

  <h1>Dashboard Asisten – KDJK 2025</h1>

  <div class="menu">
    <a href="index.php">🔁 Halaman Identitas</a>
    <a href="jawaban.php">🧠 Halaman Jawaban</a>
    <a href="hasil.php">🎉 Halaman Hasil</a>
    <a href="dashboard.php">🔄 Refresh</a>
    <a href="reset.php" onclick="return confirm('Yakin mau hapus leaderboard?')">🗑️ Reset Leaderboard</a>
  </div>

  <div class="stats">
    <h2>📊 Statistik</h2>
    <p>Total kelompok berhasil: <strong><?= $total ?></strong></p>
    <?php if ($last_submit): ?>
      <p>Submit terakhir: <em><?= htmlspecialchars($last_submit) ?></em></p>
    <?php endif; ?>
  </div>

  <div class="leaderboard">
    <h2>🏆 Leaderboard</h2>
    <?php if ($total > 0): ?>
      <ol>
        <?php foreach ($leaderboard as $entry): ?>
          <li><?= htmlspecialchars($entry) ?></li>
        <?php endforeach; ?>
      </ol>
    <?php else: ?>
      <p>Belum ada yang berhasil 😅</p>
    <?php endif; ?>
  </div>

</body>
</html>
