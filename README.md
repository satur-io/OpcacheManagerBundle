# The OPcacheManagerBundle

Manage your OPcache using CLI through API endpoints.

The OpcacheManagerBundle a simple and fast way to manage your cache using CLI commands 
and the most useful package for your CI/CD scripts.

## How it works

### The issue
[OPcache](https://www.php.net/manual/es/book.opcache.php) doesn't provide any method to clean your
application cache using a CLI. So, if you want to clean your symfony app cache, you must run 
`opcache_reset()` function ***in your web server or your php-fpm process***. That is mean that
you need a URL in your app that call the reset function. 

This is a big problem when the we use CI/CD tools for the deployment since we can't reset the cache
launching a command. And although we could create an endpoint in our application for this task, we face the problem 
of security, since it should only be able to be executed from the tasks that we consider.

### OpcacheManagerBundle solution
OpcacheManagerBundle deals with this issue using routes build on execution time. We provide symfony commands
that create the routes for do the opcache tasks. Then, the command make a request to the created route and 
remove it when finish, so the routes only are available a few miliseconds.

***Please note that in this flow force the symfony cache dir will be removed.***

To improve performance, you could run the `cache:warmup` symfony command when OpcacheManager finish.

## Instalation

```shell script
composer require saturio/opcache-manager
```

## Configuration
First of all, active the bundle in your `config/bundles.php` file:

```php
// config/bundles.php
<?php

return [
// ...
    Saturio\OpcacheManagerBundle\SaturioOpcacheManagerBundle::class => ['all' => true],
];
```

Add the OpcacheManager route loader to your routes:

```yaml
# config/routes/opcache_manager.yml

opcache_routes:
    resource: .
    type: opcachemanager
```

And, finally, configure the OpcacheManager:
```yaml
# config/packages/saturio_opcache_manager.yaml
saturio_opcache_manager:
    server:
        default_uri: 'http://127.0.0.1:8000' # Your base URL
```


## Usage
:point_right: Note that you must have a server running your app. OPCache can't be usually managed from
CLI. OPCacheManager creates API resources and make requests to these endpoints to manage the OPCache.

Use these simple commands:

```shell script
bin/console saturio:opcache:reset
bin/console saturio:opcache:status
bin/console saturio:opcache:configuration
```

## Testing
Clone de repo and run:
```shell script
composer install
bin/phpunit
```

Made with ❤️ and without :cop: in Soria.
