<?php

declare(strict_types=1);

namespace Blog\Route;

use Blog\OtherClasses\ApiClass;
use Blog\OtherClasses\CookiesClass;
use Blog\PostMapper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class PostPage
{
    /**
     * @var Environment
     */
    private Environment $view;

    /**
     * @var PostMapper
     */
    private PostMapper $postMapper;


    private CookiesClass $cookie;
    private ApiClass $weatherData;

    /**
     * BlogPage constructor.
     * @param Environment $view
     * @param PostMapper $postMapper
     */
    public function __construct(Environment $view, PostMapper $postMapper, CookiesClass $cookie, ApiClass $weatherData)
    {
        $this->view = $view;
        $this->postMapper = $postMapper;
        $this->cookie = $cookie;
        $this->weatherData = $weatherData;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $post = $this->postMapper->getByUrlKey((string) $args['url_key']);

        if (empty($post)) {
            $body = $this->view->render('not-found.twig', [
                'cookie' => $this->cookie->getUsernameCookie(),
                'regCookie' => $this->cookie->getRegCookie(),
                'weatherData' => $this->weatherData->getWeatherData('Kostanay')
            ]);
        } else {
            $body = $this->view->render('post.twig', [
                'post' => $post,
                'cookie' => $this->cookie->getUsernameCookie(),
                'regCookie' => $this->cookie->getRegCookie(),
                'weatherData' => $this->weatherData->getWeatherData('Kostanay')
            ]);
        }
        $response->getBody()->write($body);
        return $response;
    }
}
