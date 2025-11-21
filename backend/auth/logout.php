<?php
session_start();

setcookie('user_id', '', time() - 3600, "/");
session_destroy();

echo "Sessió tancada.<br>";
echo "<a href='login.php'>Iniciar sessió</a>";
