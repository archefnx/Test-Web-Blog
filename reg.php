<?php
use Blog\registrator;

require __DIR__ . '/vendor/autoload.php';

$dsn      = 'mysql:host=127.0.0.1;dbname=topsite';
$username = 'mysql';
$pass = 'mysql';

$login = filter_var(trim($_POST['login']),  FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']),  FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']),  FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']),  FILTER_SANITIZE_STRING);


try {
    $connection = new PDO($dsn, $username, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception){
    echo 'Database exception: ' . $exception->getMessage();
    die();
}

$registr = new registrator($connection);
$errors = [];

$sqlLogin = "SELECT * FROM `users` WHERE `login` = '$login'";
$sqlEmail = "SELECT * FROM `users` WHERE `email` = '$email'";

if (mb_strlen($login) == '')
    $errors[] = 'Введите логин!';
if (mb_strlen($login) < 4)
    $errors[] = 'Логин должен состоять минимум из 4 символов!';
if (mb_strlen($login) > 20)
    $errors[] = 'Логин не должен превышать 20 символов!';

if (mb_strlen($name) == '')
    $errors[] = 'Введите имя!';
if (mb_strlen($name) < 3)
    $errors[] = 'Имя должно состоять минимум из 3 символов!';
if (mb_strlen($name) > 20)
    $errors[] = 'Имя не должно превышать 20 символов!';

if (mb_strlen($name) == '')
    $errors[] = 'Введите email!';

if (mb_strlen($password) == '')
    $errors[] = 'Введите пароль!';
if (mb_strlen($password) < 5)
    $errors[] = 'пароль должен состоять минимум из 5 символов!';
if (mb_strlen($password) > 20)
    $errors[] = 'Пароль не должен превышать 20 символов!';

if ($registr->query($sqlLogin))
    $errors[] = 'Такой логин уже занят другим пользователем!';
if ($registr->query($sqlEmail))
    $errors[] = 'Этот email уже занят другим пользователем!';


$password = md5($password."ggg123");

if (empty($errors)) {
    $registr->saveUser($login, $name, $email, $password);

    setcookie('reg', true, time() + 10 , "/");

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
    <title>Regestration</title>
</head>
<body>
<h1 class="text-center">Форма регистрации</h1>
<form action="reg.php" method="post" class="form-control">
    <?php if (isset($_POST['submit'])): ?>
    <p class="alert alert-danger"><?php echo array_shift($errors)?></p>
    <?php endif ?>
    <p><label for="login">Введите логин: </label><input type="text" name="login" id="login" class="form-control" placeholder="Логин" value="<?php if (isset($_REQUEST['login'])) echo $_REQUEST['login'] ?>"></p>
    <p><label for="name">Введите имя: </label><input type="text" name="name" id="name" class="form-control" placeholder="Имя" value="<?php if (isset($_REQUEST['name'])) echo $_REQUEST['name'] ?>"></p>
    <p><label for="email">Введите email: </label><input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php if (isset($_REQUEST['email'])) echo $_REQUEST['email'] ?>"></p>
    <p><label for="password">Введите пароль: </label><input type="password" name="password" id="password" class="form-control" placeholder="Пароль"></p>
    <button type="submit" name="submit" id="submit" class="btn btn-outline-dark">Зарегистрироватся</button>
    <button class="btn btn-outline-info a-control"><a href="/" class="text-decoration-none">На главную</a></button>
</form>
</body>
</html>