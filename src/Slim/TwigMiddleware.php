<?php

namespace Blog\Slim;

use Blog\Twig\AssetExtention;
use League\CommonMark\Environment;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TwigMiddleware implements MiddlewareInterface
{
    private $environment;

    public function __construct( $environment)
    {
        $this->environment = $environment;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->environment->addExtension(new AssetExtention($request));
        return $handler->handle($request);
    }
}