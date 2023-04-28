<?php

declare(strict_types=1);

namespace App;

use App\Exception\RouteException;
use App\Routing\Router;

class Kernel
{
    public const CONFIG_KEY_VIEW_PATH = 'view_path';

    private static array $config = [];

    public function __construct(private Router $router)
    {
        self::$config = include 'config/general.php';
    }

    /**
     * @throws RouteException
     */
    public function run()
    {
        $response = $this->router->resolve();
        $response->render();
    }

    public static function getConfigKey(string $key): mixed
    {
        return self::$config[$key] ?? null;
    }
}
