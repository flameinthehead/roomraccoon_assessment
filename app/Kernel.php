<?php

declare(strict_types=1);

namespace App;

use App\Exception\RouteException;
use App\Routing\Router;
use Exception;
use Predis\Client;

class Kernel
{
    public const CONFIG_KEY_VIEW_PATH = 'view_path';

    private static array $config = [];
    private static mixed $storage;

    public function __construct(private Router $router)
    {
        self::$config = include 'config/general.php';
    }

    /**
     * @throws RouteException
     */
    public function run()
    {
        $this->configureStorage();
        $response = $this->router->resolve();
        $response->render();
    }

    public static function getConfigKey(string $key): mixed
    {
        return self::$config[$key] ?? null;
    }

    public static function storage(): mixed
    {
        return self::$storage;
    }

    private function configureStorage(): void
    {
        $defaultStorage = self::getConfigKey('default_storage');
        if (!isset($defaultStorage)) {
            throw new Exception('Default storage is not specified');
        }

        if (!isset(self::$config['storage'][$defaultStorage])) {
            throw new Exception('There is no information about default storage');
        }

        $storageOptions = self::$config['storage'][$defaultStorage];

        switch ($defaultStorage) {
            case 'redis':
                self::$storage = new Client([
                    'scheme' => $storageOptions['scheme'],
                    'host'   => $storageOptions['host'],
                    'port'   => $storageOptions['port'],
                ]);
                break;
            default:
                throw new Exception('Undefined storage!');
        }
    }
}
