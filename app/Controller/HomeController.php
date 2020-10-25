<?php

namespace App\Controller;

use Elementary\App;
use Elementary\Controller\Controller;
use Elementary\Request\API\RequestInterface;
use Elementary\Response\API\ResponseInterface;

class HomeController extends Controller
{

    public function __construct(RequestInterface $request)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResponseInterface
    {
        /** @var ResponseInterface $response */
        $app = App::initialize();
        $response = $app->get(ResponseInterface::class);
        return $response;
    }
}