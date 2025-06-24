<?php
session_start();

// Ganti dengan username dan password admin kamu sendiri
$admin_user = "admin";
$admin_pass = "kriptografi";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === $admin_user && $pass === $admin_pass) {
        $_SESSION['is_admin'] = true;
        header("Location: leaderboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Admin</title>
</head>
<body>
  <h2>Login Admin</h2>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
  </form>
</body>
</html>
