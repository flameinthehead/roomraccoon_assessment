<?php

declare(strict_types=1);

namespace App\Routing;

use App\Exception\RouteException;
use App\Response;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;

class Router
{
    private const POSSIBLE_HTTP_METHODS = ['GET', 'POST', 'DELETE', 'PATCH'];

    private array $possibleRoutes;
    private array $matches = [];

    public function __construct(private string $method, private string $uri, private Container $container)
    {
        $this->possibleRoutes = include 'config/routes.php';
    }

    /**
     * @throws DependencyException
     * @throws RouteException
     * @throws NotFoundException
     */
    public function resolve(): Response
    {
        foreach ($this->possibleRoutes as $route){
            if (!$this->isValidRoute($route)){
                throw new RouteException('Invalid route '.serialize($route));
            }

            if ($this->assertRoute($route)){
                [$class, $method] = $route['route'];
                $controller = $this->container->get($class);
                $params = $this->getParams();
                return new Response($route['view'], Response::HTTP_OK, $controller->{$method}(...$params));
            }
        }

        return new Response(
            'error',
            Response::HTTP_NOT_FOUND,
            [
                'message' => 'Route not found',
                'code' => Response::HTTP_NOT_FOUND,
                'data' => new \stdClass(),
            ]
        );
    }

    private function isValidRoute(array $route): bool
    {
        if (!$this->hasAllRequiredFields($route)) {
            return false;
        }

        [$class, $method] = $route['route'];
        return (
            in_array($route['method'], self::POSSIBLE_HTTP_METHODS, true)
            && class_exists($class)
            && method_exists($class, $method)
        );
    }

    private function assertRoute($route): bool
    {
        return (
            $route['method'] === $this->method
            && preg_match($route['rule'], $this->uri, $this->matches)
        );
    }

    private function getParams(): array
    {
        $parameters = [];

        if (isset($this->matches[1])) {
            for ($i = 1, $iMax = count($this->matches); $i < $iMax; ++$i) {
                $parameters[] = $this->matches[$i];
            }
        }
        return $parameters;
    }

    private function hasAllRequiredFields(array $route): bool
    {
        return (
            !is_null($route['method'])
            && !is_null($route['rule'])
            && !is_null($route['route'])
            && !is_null($route['view'])
        );
    }
}