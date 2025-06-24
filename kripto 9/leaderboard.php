<?php
session_start();
require 'db.php';

// Daftar IP yang diizinkan sebagai admin
$allowed_ips = ["192.168.1.100", "192.168.1.101"]; // ganti sesuai jaringanmu

// Cookie admin yang harus dimiliki
define('ADMIN_COOKIE', 'cryforme');

// Hanya aktifkan admin jika IP dan cookie cocok
if (
    in_array($_SERVER['REMOTE_ADDR'], $allowed_ips) &&
    (isset($_COOKIE['admin_key']) && $_COOKIE['admin_key'] === ADMIN_COOKIE)
) {
    $_SESSION['is_admin'] = true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['reset'])) {
    file_put_contents("leaderboard.txt", "");
    $pdo->exec("DELETE FROM users");

    $log_time = date("Y-m-d H:i:s");
    $log_msg = "[RESET] oleh Admin | $log_time\n";
    file_put_contents("reset_log.txt", $log_msg, FILE_APPEND);

    header("Location: " . $_SERVER['PHP_SELF'] . "?reset=success");
    exit();
}

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

$merged = array_merge($db_data, $file_data);
usort($merged, function ($a, $b) {
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
      margin-bottom: 10px;
    }
    .admin-label {
      text-align: center;
      font-size: 0.95em;
      font-style: italic;
      color: #fdf5d3;
      margin-bottom: 20px;
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
    footer {
      text-align: center;
      color: #fff;
      margin-top: 40px;
    }
  </style>
</head>
<body>

  <h1>🏆 Leaderboard Kriptografi Hash 2025 🏆</h1>

  <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
    <p class="admin-label">👩‍💼 Login sebagai: Admin TiKA</p>
  <?php endif; ?>

  <div class="leaderboard">

    <?php if (isset($_GET['reset']) && $_GET['reset'] === 'success'): ?>
      <p style="background-color: #dff0d8; color: #3c763d; text-align: center;
                 padding: 10px; border-radius: 6px; margin-bottom: 20px;">
        🧹 Leaderboard berhasil dikosongkan!
      </p>
    <?php endif; ?>

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
          <td><?= htmlspecialchars($entry['kelompok']) ?></td>
          <td><?= htmlspecialchars($entry['nim']) ?></td>
          <td><?= htmlspecialchars($entry['waktu_submit']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p style="text-align: center; font-style: italic;">Belum ada tim yang berhasil 😿</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
      <form method="post" style="text-align: center; margin-top: 30px;">
        <input type="submit" name="reset" value="🧹 Reset Leaderboard"
               onclick="return confirm('Yakin mau kosongkan leaderboard?')"
               style="background-color: #e6b800; border: none; padding: 10px 20px;
                      font-weight: bold; border-radius: 6px; cursor: pointer;">
      </form>

      <p style="text-align: center; margin-top: 20px;">
        <a href="logout.php" style="color:#444; font-size:0.9em;">🚪 Logout Admin</a>
      </p>
    <?php endif; ?>

    <p style="text-align:center; font-size:0.9em; color:#7b2d26; margin-top:-10px;">
      <br><br>
      Halaman ini bisa dilihat publik. Hanya Admin yang bisa mengatur ☝️😾.
    </p>

  </div>

  <footer>
    <p style="font-size:0.9em;">⏳ <span id="clock">--:--:--</span> WIB</p>
  </footer>

  <script>
    function updateClock() {
      const now = new Date();
      const jam = now.getHours().toString().padStart(2, '0');
      const menit = now.getMinutes().toString().padStart(2, '0');
      const detik = now.getSeconds().toString().padStart(2, '0');
      document.getElementById("clock").textContent = `${jam}:${menit}:${detik}`;
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>

</body>
</html>
