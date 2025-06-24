<?php
require 'db.php';

// Ambil data dari database
$stmt = $pdo->query("SELECT kelompok, nim, waktu_submit FROM users");
$db_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data dari file .txt
$file_data = [];
if (file_exists("leaderboard.txt")) {
    $lines = file("leaderboard.txt", FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $parts = explode(" | ", $line);
        $file_data[] = [
            'kelompok' => $parts[0] ?? '-',
            'nim' => $parts[1] ?? '-',
            'waktu_submit' => $parts[2] ?? '-'
        ];
    }
}

// Gabungkan dan urutkan berdasarkan waktu
$merged = array_merge($db_data, $file_data);
usort($merged, function($a, $b) {
    return strtotime($a['waktu_submit']) <=> strtotime($b['waktu_submit']);
});
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>🏆 Leaderboard Kriptografi Hash 2025 🏆</title>
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
      max-width: 800px;
      margin: auto;
      padding: 25px;
      border-radius: 12px;
      border: 3px solid #e6b800;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #fdf5d3;
      color: #000;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>

  <h1>🏆 Leaderboard Kriptografi Hash 2025 🏆</h1>

  <div class="leaderboard">
    <?php if (count($merged) > 0): ?>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Kelompok</th>
          <th>NIM</th>
          <th>Waktu Submit</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($merged as $i => $entry): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($entry['kelompok'] ?? '-') ?></td>
          <td><?= htmlspecialchars($entry['nim'] ?? '-') ?></td>
          <td><?= htmlspecialchars($entry['waktu_submit'] ?? '-') ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p style="text-align: center; font-style: italic;">Belum ada tim yang berhasil 😿</p>
    <?php endif; ?>
  </div>

</body>
</html>
