<?php

declare(strict_types=1);

namespace Blog\Route;

use Blog\OtherClasses\ApiClass;
use Blog\OtherClasses\CookiesClass;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class AboutPage
{
    /**
     * @var Environment
     */
    private Environment $view;

    private CookiesClass $cookie;
    private ApiClass $weatherData;

    /**
     * AboutPage constructor.
     * @param Environment $view
     */
    public function __construct(Environment $view, CookiesClass $cookie, ApiClass $weatherData)
    {
        $this->view = $view;
        $this->cookie = $cookie;
        $this->weatherData = $weatherData;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $body = $this->view->render('about.twig', [
            'name' => 'Max',
            'cookie' => $this->cookie->getUsernameCookie(),
            'regCookie' => $this->cookie->getRegCookie(),
            'weatherData' => $this->weatherData->getWeatherData('Kostanay')
        ]);
        $response->getBody()->write($body);
        return $response;
    }
}
