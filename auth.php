<?php
use DevCoder\DotEnv;

require __DIR__ . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/.env'))->load();

$dsn = getenv('DATABASE_DSN');
$username = getenv('DATABASE_USERNAME');
$pass = getenv('DATABASE_PASSWORD');

try {
    $connection = new PDO($dsn, $username, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception){
    throw new \InvalidArgumentException($exception->getMessage());
}

$login = filter_var(trim($_POST['login']),  FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']),  FILTER_SANITIZE_STRING);
$errors = [];

if (mb_strlen($login) == '')
    $errors[] = 'Введите логин!';
if (mb_strlen($password) == '')
    $errors[] = 'Введите пароль!';

$password = md5($password."ggg123");

if (empty($errors)) {
    $statement = $connection->prepare(
        "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'"
    );

    $statement->execute();
    $user = $statement->fetchAll();

    if ($user != false) {
        setcookie('user', 'true', time() + 3600 * 24 * 30, "/");
        $login = '';
        $password = '';
        header('location: /');
    } else {
        $errors[] = 'Неверный логин или пароль!';
    }
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
<body>

<h1 class="text-center">Форма авторизации</h1>
<form action="" method="post" class="form-control">
    <?php if (isset($_POST['submit']) and $errors != []):?>
        <p class="alert alert-danger"><?php echo array_shift($errors) ?></p>
    <?php endif ?>
    <p><label for="login">Введите логин: </label><input type="text" name="login" id="login" class="form-control" placeholder="Логин" value="<?php if (isset($_REQUEST['login'])) echo $_REQUEST['login'] ?>"></p>
    <p><label for="password">Введите пароль: </label><input type="password" name="password" id="password" class="form-control" placeholder="Пароль"></p>
    <button type="submit" name="submit" id="submit" class="btn btn-outline-info">Войти</button>
    <button class="btn btn-outline-info a-control"><a href="/" class="text-decoration-none">На главную</a></button>
</form>

</body>
</html>

