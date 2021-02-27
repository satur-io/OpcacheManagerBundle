<?php


namespace Saturio\OpcacheManagerBundle\Route;


use Saturio\OpcacheManagerBundle\Controller\ConfigurationController;
use Saturio\OpcacheManagerBundle\Controller\ResetController;
use Saturio\OpcacheManagerBundle\Controller\StatusController;
use Saturio\OpcacheManagerBundle\Util\Router;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class RouteLoader extends Loader
{
    private $isLoaded = false;

    private const RESET_PARAMS = [
        'name' => 'opCacheResetRoute',
        'path' => '/opcache/reset',
        'controller' => ResetController::class.'::reset',
        ];

    private const STATUS_PARAMS = [
        'name' => 'opCacheStatusRoute',
        'path' => '/opcache/status',
        'controller' => StatusController::class.'::getStatus',
    ];

    private const CONFIGURATION_PARAMS = [
        'name' => 'opCacheConfigurationRoute',
        'path' => '/opcache/configuration',
        'controller' => ConfigurationController::class.'::getConfiguration',
    ];

    private const ROUTES = [self::RESET_PARAMS, self::STATUS_PARAMS, self::CONFIGURATION_PARAMS];


    public function load($resource, string $type = null)
    {
        if (getenv(Router::ENV_VAR_ACTIVATE_ROUTES_NAME) !== Router::ENV_VAR_ACTIVATE_ROUTES_ACTIVATE_VALUE) {
            return new RouteCollection();
        }

        if (true === $this->isLoaded) {
            throw new \RuntimeException('Do not add the OPCacheManager loader twice');
        }

        $routes = new RouteCollection();

        foreach (self::ROUTES as $routeParams) {
            $path = $routeParams['path'];
            $defaults = [
                '_controller' => $routeParams['controller'],
            ];

            $route = new Route($path, $defaults);

            $routeName = $routeParams['name'];
            $routes->add($routeName, $route);
        }

        $this->isLoaded = true;

        return $routes;
    }

    public function supports($resource, string $type = null)
    {
        return 'opcachemanager' === $type;
    }
}
