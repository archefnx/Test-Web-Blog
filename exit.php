<?php
setcookie('user', $user['name'], time() - 3600 * 24 * 30, "/");
setcookie('login', $user['login'], time() - 3600 * 24 * 30, "/");

header('location: /');
?>