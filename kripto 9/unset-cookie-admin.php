<?php
setcookie('admin_key', '', time() - 3600); // hapus cookie
echo "🔓 Cookie admin dihapus. Kamu bukan admin lagi.";
?>
