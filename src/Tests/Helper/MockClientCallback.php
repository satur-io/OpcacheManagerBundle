<?php


namespace Saturio\OpcacheManagerBundle\Tests\Helper;


use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MockClientCallback
{
    private static bool $error = true;

    public function __invoke(string $method, string $url, array $options = []): ResponseInterface
    {
        self::$error = !self::$error;
        return new MockResponse('{"cosa": "test"}', ['http_code' => self::$error ? 500 : 200]);
    }
}
