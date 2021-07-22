<?php


namespace Blog\Route;


use Blog\Database;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class SignUpPage
{
    /**
     * @var Environment
     */
    private Environment $view;

    /**
     * @var Database
     */
    private Database $database;

    /**
     * AboutPage constructor.
     * @param Environment $view
     */
    public function __construct(Environment $view, Database $database)
    {
        $this->database = $database;
        $this->view = $view;
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $login = filter_var(trim($_POST['login']),  FILTER_SANITIZE_STRING);
        $name = filter_var(trim($_POST['name']),  FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']),  FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']),  FILTER_SANITIZE_STRING);


        $errors = [];
        $sqlLogin = "SELECT * FROM `users` WHERE `login` = '$login'";
        $sqlEmail = "SELECT * FROM `users` WHERE `email` = '$email'";

        if ($this->database->getConnection($sqlLogin))
            $errors[] = 'Такой логин уже занят другим пользователем!';
        if ($this->database->getConnection($sqlEmail))
            $errors[] = 'Этот email уже занят другим пользователем!';

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

        $password = md5($password."ggg123");


        if (empty($errors)) {
            $statement = $this->database->getConnection()->prepare(
                "INSERT INTO `users` (`login`, `name`, `email`, `password`) 
                            VALUES ('$login', '$name','$email', '$password')"
            );
            $statement->execute();

            setcookie('reg', true, time() + 10 , "/");
            header('location: /');
        }


        $body = $this->view->render('sign-up.twig');
        $response->getBody()->write($body);
        return $response;
    }
}