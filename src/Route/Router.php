<?php


namespace Saturio\OpcacheManagerBundle\Route;


use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Filesystem\Filesystem;

class Router
{
    public Filesystem $filesystem;

    public const ENV_VAR_ACTIVATE_ROUTES_NAME = 'DHERNANDEZ_OPCACHE_BUNDLE_ROUTES';
    public const ENV_VAR_ACTIVATE_ROUTES_ACTIVATE_VALUE = 'activate';
    public const ENV_VAR_ACTIVATE_ROUTES_DEACTIVATE_VALUE = 'deactivate';

    public const COMMAND_CACHE_CLEAR = 'cache:clear';


    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function addOpCacheRoutes(Application $application): void
    {
        putenv(sprintf('%s=%s', self::ENV_VAR_ACTIVATE_ROUTES_NAME, self::ENV_VAR_ACTIVATE_ROUTES_ACTIVATE_VALUE));
        $this->reloadCache($application);
    }

    public function removeOpCacheRoutes($cacheDir): void
    {
        putenv(sprintf('%s=%s', self::ENV_VAR_ACTIVATE_ROUTES_NAME, self::ENV_VAR_ACTIVATE_ROUTES_DEACTIVATE_VALUE));
        $this->filesystem->remove($cacheDir);
    }

    private function reloadCache(Application $application): void
    {
        if ($application === null) {
            return;
        }
        $command = $application->find(self::COMMAND_CACHE_CLEAR);
        $command->run(new ArrayInput([]), new NullOutput());
    }
}
