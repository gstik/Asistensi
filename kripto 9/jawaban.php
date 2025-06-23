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
  <title>Jawaban Soal</title>
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
      color: red;
      text-align: center;
      margin-top: -10px;
    }
  </style>
</head>
<body>
  <h2>Jawaban Soal Kriptografi</h2>
  
  <?php if ($error): ?>
    <p class="error">jawabannya kurang bener</p>
  <?php endif; ?>

  <form action="hasil.php" method="post">
    <label>Jawaban:</label>
    <input type="text" name="jawaban" placeholder="Masukkan jawaban kalian di sini" required>
    <input type="submit" value="Submit Jawaban">
  </form>
</body>
</html>