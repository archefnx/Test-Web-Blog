<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use \Blog\postMapper;
use \Blog\LatestPosts;
use \Blog\Slim\TwigMiddleware;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$_COOKIE['user'] == '' ? $cookie = false : $cookie = true;

$loader = new FilesystemLoader('templates');
$view   = new Environment($loader);

$config   = include 'config/database.php';
$dsn      = $config['dsn'];
$username = $config['username'];
$password = $config['password'];

try {
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception){
    echo 'Database exception: ' . $exception->getMessage();
    die();
}


$apiKey ='e25f74c76d7bb4c2b57830ab9b129c16';
$city = "Nur-Sultan";
$url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=ru&units=metric&appid=" . $apiKey;
$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);

$weatherData = json_decode(curl_exec($ch));


$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$app->add(new TwigMiddleware($view));

$app->get('/', function (Request $request, Response $response) use ($view, $connection, $cookie, $weatherData) {
    $latestPosts = new LatestPosts($connection);
    $posts = $latestPosts->get(3);

    $regCookie = $_COOKIE['reg'];

    $body = $view->render('index.twig', [
        'posts' => $posts,
        'cookie' => $cookie,
        'regCookie' => $regCookie,
        'weatherData' => $weatherData
    ]);
    $response->getBody()->write($body);
    return $response;
});

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

