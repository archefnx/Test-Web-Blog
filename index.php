<?php

<<<<<<< HEAD
use Blog\Route\AboutPage;
use Blog\Route\BlogPage;
use Blog\Route\PostPage;
use Blog\Route\HomePage;
use Blog\Route\SignUpPage;
use Blog\Slim\TwigMiddleware;
=======
use Blog\Database;
use Blog\Route\HomePage;
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
use DevCoder\DotEnv;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
<<<<<<< HEAD

require __DIR__ . '/vendor/autoload.php';
=======
use \Twig\Environment;
use \Blog\postMapper;
use \Blog\Slim\TwigMiddleware;
use Blog\LatestPosts;

require __DIR__ . '/vendor/autoload.php';

>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57

$builder = new ContainerBuilder();
$builder->addDefinitions('config/di.php');
(new DotEnv(__DIR__ . '/.env'))->load();

<<<<<<< HEAD
$container = $builder->build();
=======
$builer = new ContainerBuilder();
$builer->addDefinitions('config/di.php');
(new DotEnv(__DIR__ . '/.env'))->load();
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57

AppFactory::setContainer($container);

<<<<<<< HEAD
// Create app
$app = AppFactory::create();
=======




$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$connection = $container->get(Database::class)->getConnection();
$view = $container->get(Environment::class);
$app->add(new TwigMiddleware($view));

$app->get('/', HomePage::class . ':execute');

$app->get('/about', function (Request $request, Response $response, $args) use ($view, $cookie) {

    $body = $view->render('about.twig', [
        'name' => 'Чел',
        'cookie' => $cookie
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/other', function (Request $request, Response $response, $args) use ($view, $cookie) {

    $body = $view->render('other.twig',[
        'cookie' => $cookie
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/test', function (Request $request, Response $response, $args) use ($view, $cookie) {

    $body = $view->render('test.twig',[
        'cookie' => $cookie
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/blog[/{page}]', function (Request $request, Response $response, $args) use ($view, $connection, $cookie) {
    $postMapper = new postMapper($connection);

    $page = isset($args['page']) ? (int) $args['page'] : 1;
    $limit = 2;

    $posts = $postMapper->getList($page, $limit, 'DESC');

    $totalCount = $postMapper->getTotalCount();
    $body = $view->render('blog.twig', [
        'posts' => $posts,
        'cookie' => $cookie,
        'pagination' => [
            'current' => $page,
            'paging' => ceil($totalCount / $limit),
        ]
    ]);
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57

$app->add($container->get(TwigMiddleware::class));

$app->get('/', HomePage::class . ':execute');
$app->get('/about', AboutPage::class);
$app->get('/blog[/{page}]', BlogPage::class);
$app->get('/{url_key}', PostPage::class);

$app->post('/signup', SignUpPage::class);

$app->run();
