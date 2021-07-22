<?php

<<<<<<< HEAD
declare(strict_types=1);

use Blog\Database;
use Blog\OtherClasses\ApiClass;
use Blog\OtherClasses\CookiesClass;
=======
use Blog\Database;
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\get;

return [
    FilesystemLoader::class => autowire()
        ->constructorParameter('paths', 'templates'),

    Environment::class => autowire()
        ->constructorParameter('loader', get(FilesystemLoader::class)),

    Database::class => autowire()
        ->constructorParameter('connection', get(PDO::class)),

    PDO::class => autowire()
        ->constructorParameter('dsn', getenv('DATABASE_DSN'))
        ->constructorParameter('username', getenv('DATABASE_USERNAME'))
        ->constructorParameter('passwd', getenv('DATABASE_PASSWORD'))
        ->constructorParameter('options', []),

<<<<<<< HEAD
    CookiesClass::class => autowire(),
    ApiClass::class => autowire(),
];
=======
  Environment::class => autowire()
    ->constructorParameter('loader', get(FilesystemLoader::class)),

    Database::class => autowire()
    ->constructorParameter('dsn', getenv('DATABASE_DSN'))
    ->constructorParameter('username', getenv('DATABASE_USERNAME'))
    ->constructorParameter('password', getenv('DATABASE_PASSWORD'))

];
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
