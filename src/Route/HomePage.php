<?php

declare(strict_types=1);

namespace Blog\Route;

use Blog\LatestPosts;
use Blog\OtherClasses\ApiClass;
use Blog\OtherClasses\CookiesClass;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class HomePage
{
    private LatestPosts $latestPosts;
    private Environment $view;
    private CookiesClass $cookie;
    private ApiClass $weatherData;

    public function __construct(LatestPosts $latestPosts, Environment $view,
                                CookiesClass $cookie, ApiClass $weatherData)
    {
        $this->latestPosts = $latestPosts;
        $this->view = $view;
        $this->cookie = $cookie;
        $this->weatherData = $weatherData;
    }

    public function execute(Request $request, Response $response): Response
    {
        $posts = $this->latestPosts->get(3);

        $body = $this->view->render('index.twig', [
            'posts' => $posts,
            'cookie' => $this->cookie->getUsernameCookie(),
            'regCookie' => $this->cookie->getRegCookie(),
            'weatherData' => $this->weatherData->getWeatherData('Kostanay')
        ]);
        $response->getBody()->write($body);
        return $response;
    }
}