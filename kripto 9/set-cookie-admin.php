<?php
define('ADMIN_COOKIE', 'cryforme'); // harus sama dengan di leaderboard.php

setcookie('admin_key', ADMIN_COOKIE, time() + 3600); // aktif 1 jam
echo "✅ Cookie admin disetel. Silakan buka kembali leaderboard.php";
?>
