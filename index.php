<?php

use App\Kernel;
use App\Response;
use App\Routing\Router;
use DI\ContainerBuilder;

include_once 'vendor/autoload.php';

try {
    $builder = new ContainerBuilder();
    $builder->addDefinitions('config/di.php');
    $container = $builder->build();

    $router = new Router($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $container);
    $kernel = new Kernel($router);
    $kernel->run();
} catch (Throwable $e) {
    $response = new Response(
        'error',
        Response::HTTP_BAD_REQUEST,
        [
            'message' => $e->getMessage(),
            'code' => Response::HTTP_BAD_REQUEST,
            'data' => ['message' => $e->getMessage()],
        ]
    );
    $response->render();
}