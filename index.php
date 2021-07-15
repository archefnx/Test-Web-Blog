<?php

use Blog\Database;
use Blog\Route\HomePage;
use DevCoder\DotEnv;
use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use \Twig\Environment;
use \Blog\postMapper;
use \Blog\Slim\TwigMiddleware;
use Blog\LatestPosts;

require __DIR__ . '/vendor/autoload.php';


$app = AppFactory::create();
$app->addRoutingMiddleware();

$builer = new ContainerBuilder();
$builer->addDefinitions('config/di.php');
(new DotEnv(__DIR__ . '/.env'))->load();

$container = $builer->build();
AppFactory::setContainer($container);





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

    $response->getBody()->write($body);
    return $response;
});

$app->get('/{url_key}', function (Request $request, Response $response, $args) use ($view, $connection, $cookie) {
    $postMapper = new postMapper($connection);
    $post = $postMapper->getByUrlKey((string) $args['url_key']);

    if (empty($post)) {
        $body = $view->render('not-found.twig', [
            'cookie' => $cookie
        ]);
    } else {
        $body = $view->render('post.twig', [
            'post' => $post,
            'cookie' => $cookie
        ]);
    }
    $response->getBody()->write($body);
    return $response;
});

$app->run();

