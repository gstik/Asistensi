<?php
$leaderboard = file_exists("leaderboard.txt") ? file("leaderboard.txt", FILE_IGNORE_NEW_LINES) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Leaderboard KDJK 2025</title>
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
      margin-bottom: 30px;
    }
    .leaderboard {
      background: #fff;
      color: #000;
      max-width: 600px;
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    .empty {
      text-align: center;
      font-style: italic;
      color: #555;
    }
  </style>
</head>
<body>

  <h1>🏆 Leaderboard Kriptografi Hashing 2025 🏆</h1>

  <div class="leaderboard">
    <?php if (count($leaderboard) > 0): ?>
      <table>
        <tr>
          <th>#</th>
          <th>Kelompok</th>
          <th>NIM</th>
          <th>Waktu</th>
        </tr>
        <?php foreach ($leaderboard as $i => $entry): 
          $parts = explode(" | ", $entry);
          ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($parts[0] ?? '-') ?></td>
            <td><?= htmlspecialchars($parts[1] ?? '-') ?></td>
            <td><?= htmlspecialchars($parts[2] ?? '-') ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p class="empty">Belum ada tim yang berhasil 😿</p>
    <?php endif; ?>
  </div>

</body>
</html>
