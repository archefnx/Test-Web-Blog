<?php

namespace Blog\Twig;

use Psr\Http\Message\ServerRequestInterface;
use \Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtention extends AbstractExtension
{
    private $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    public function getFunctions()
    {
        return [
          new TwigFunction('asset_url', [$this, 'getAssetUrl'])
        ];
    }

    public function getAssetUrl($path): string
    {
        return $this->getBaeUrl() . $path;
    }


    public function getBaeUrl(): string
    {
        $params = $this->request->getServerParams();
        return $params['REQUEST_SCHEME'] . '://' . $params['HTTP_HOST'] . '/';
    }
}