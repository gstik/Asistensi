<?php
session_start();

$admin_user = "kurapixel";
$admin_pass = "cryforme";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === $admin_user && $pass === $admin_pass) {
        $_SESSION['is_admin'] = true;
        header("Location: leaderboard.php");
        exit();
    } else {
        $error = "❌ Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>🔐 Login Admin Kriptografi</title>
  <style>
    body {
      font-family: 'Courier New', monospace;
      background: linear-gradient(to bottom, #311b1b, #5b2929);
      color: #fdf5d3;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-box {
      background-color: #fff;
      color: #000;
      padding: 30px 40px;
      border-radius: 10px;
      border: 3px solid #e6b800;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      text-align: center;
      width: 320px;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #5c1a1b;
      color: white;
      padding: 10px 20px;
      border: none;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
    }
    .error {
      color: #c0392b;
      font-size: 0.9em;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>🔐 Admin Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Masuk</button>
    </form>
  </div>

</body>
</html>
