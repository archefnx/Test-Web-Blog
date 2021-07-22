<?php

declare(strict_types=1);

namespace Blog\Route;

use Blog\OtherClasses\ApiClass;
use Blog\OtherClasses\CookiesClass;
use Blog\PostMapper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class BlogPage
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
     * @return ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $page = isset($args['page']) ? (int) $args['page'] : 1;
        $limit = 3;

        $posts = $this->postMapper->getList($page, $limit, 'DESC');

        $totalCount = $this->postMapper->getTotalCount();
        $body = $this->view->render('blog.twig', [
            'posts' => $posts,
            'pagination' => [
                'current' => $page,
                'paging' => ceil($totalCount / $limit),
                'cookie' => $this->cookie->getUsernameCookie(),
                'regCookie' => $this->cookie->getRegCookie(),
                'weatherData' => $this->weatherData->getWeatherData('Kostanay')
            ],
        ]);
        $response->getBody()->write($body);
        return $response;
    }
}
