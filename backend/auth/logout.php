<?php
session_start();
setcookie('user_id', '', time()-3600, "/");
$_SESSION = [];
session_destroy();
header("Location: login.php");
exit;
