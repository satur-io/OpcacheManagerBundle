# The OPcacheManagerBundle

Manage your OPcache using CLI through API endpoints only accessible from your localhost.

The OPcacheManagerBundle is the simplest and fastest way to manage your cache using CLI commands 
(or requesting API directly) and the useful package for your CI/CD scripts.

## Usage

:point_right: Note that you must have a server running your app. OPCache can't be usually managed from
CLI. OPCacheManager creates local API resources and make requests to these endpoints to manage the OPCache.

Use these simple commands:

```shell script
bin/console dhernandez:opcache:reset
bin/console dhernandez:opcache:status
bin/console dhernandez:opcache:configuration
```

or call the endpoints (from the same host), e.g. using curl:

```shell script
curl http://127.0.0.1/opcache/reset
curl http://127.0.0.1/opcache/status
curl http://127.0.0.1/opcache/configuration
```

## Testing
Clone de repo and run:
```shell script
composer install
bin/phpunit
```

Made with ❤️ and without :cop: in Soria.