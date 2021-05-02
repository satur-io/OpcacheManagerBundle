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

Of course, you could use something like `php7.4-fpm reload` to refresh OPCache if the user you use
for deployment has permissions.

This is a headache when we use CI/CD tools for the deployment, since we can't reset the cache
launching a command.

### OpcacheManagerBundle solution
OpcacheManagerBundle provides some routes to manage your OPCache through symfony commands.
These commands make signed requests to the routes and show results in console. For security reasons,
the request must to be signed (the bundle manage this by itself), so it can't be use directly unless
the `APP_SECRET` is known.

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

Add the OpcacheManager routes:

```yaml
# config/routes/opcache_manager.yml

saturio_opcache:
    resource: "@SaturioOpcacheManagerBundle/Resources/config/routing.yaml"
```

And, finally, configure the OpcacheManager:
```yaml
# config/packages/saturio_opcache_manager.yaml
saturio_opcache_manager:
    server:
        default_uri: 'http://127.0.0.1:8000' # Your base URL
```


## Usage
:point_right: Note that you must have a server running your app to use OPCacheManagerBundle.

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
