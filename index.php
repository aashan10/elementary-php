<?php

define('APP_DIR', __DIR__);


require_once 'vendor/autoload.php';

use Elementary\App;
use App\Controller\HomeController;
use Elementary\Events\API\EventInterface;
use Elementary\Request\API\RequestInterface;

$app = App::initialize();

/** @var EventInterface $event */
$event = $app->get(EventInterface::class);

$request = $app->get(RequestInterface::class);

$event->dispatch('controller_method_execute_before', [
    'request' => $request
]);

$controller = $app->get(HomeController::class);
$response = $controller->execute();

$event->dispatch('controller_method_execute_after', [
    'response' => $response
]);