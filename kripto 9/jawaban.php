<?php
session_start();

// Simpan nama dan NIM jika dikirim dari form identitas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['nama'] = $_POST['nama'];
  $_SESSION['nim'] = $_POST['nim'];
}

// Cek error jika jawaban salah
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jawaban</title>
  <style>
    body {
      font-family: Consolas, monospace;
      background: linear-gradient(to right, #5c1a1b, #7b2d26);
      margin: 0;
      padding: 0;
    }
    h2 {
      color: #fff;
      text-align: center;
      margin-top: 40px;
    }
    form {
      background: #fff;
      max-width: 400px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 10px;
      border: 3px solid #e6b800; /* Tambahkan ini */
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    input[type="text"], input[type="submit"] {
      display: block;
      width: 90%;
      padding: 10px;
      margin: 15px auto;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background: #7b2d26;
      color: white;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #5c1a1b;
    }
    
    .error {
      color: #b20000;
      background-color: #ffeaea;
      border: 1px solid #ffb3b3;
      padding: 10px;
      border-radius: 6px;
      margin: 10px auto;
      width: 80%;
      text-align: center;
      font-weight: bold;
      font-size: 0.6em; /* ukuran dikecilin sedikit */
    }
  </style>
</head>
<body>

  <h2>Hasil Crack Hash</h2>

  <form action="hasil.php" method="post">
    <label>Jawaban:</label>
    <input type="text" name="jawaban" placeholder="Setor jawaban di sini!" required>

    <?php if ($error): ?>
      <div class="error">Jawabannya kurang bener, coba lagi ya! 😿</div>
    <?php endif; ?>

    <input type="submit" value="Bismillah, Submit. ">
  </form>

</body>
</html>

