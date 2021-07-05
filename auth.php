<?php
require 'Conect_db.php';
$login = filter_var(trim($_POST['login']),  FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']),  FILTER_SANITIZE_STRING);
$errors = [];

$password = md5($password."ggg123");

    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    $user = $result->fetch_assoc();

    if (($user) == 0){
        $p = 'Такой пользователь не найден!';
    }else{
        setcookie('user', $user['name'], time() + 3600 * 24 * 30, "/");
        header('location: /');
    }

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/reg.css">
    <title>Auth</title>
</head>
<body class="">
<h1 class="text-center">Форма авторизации</h1>
<form action="" method="post" class="form-control">
    <p class="alert alert-danger"><?php if ($_REQUEST['login'] != '') echo $p ?></p>
    <p><label for="login">Введите логин: </label><input type="text" name="login" id="login" class="form-control" placeholder="Логин"></p>
    <p><label for="password">Введите пароль: </label><input type="password" name="password" id="password" class="form-control" placeholder="Пароль"></p>
    <button type="submit" class="btn btn-outline-info">Войти</button>
</form>
</body>
</html>

