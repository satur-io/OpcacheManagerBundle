<?php


namespace Saturio\OpcacheManagerBundle\Tests\Helper;


use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class MockTestClient extends MockHttpClient
{
    public function __construct()
    {
        $responseFactory = function ($method, $url, $options) {
            return MockClientCallback::__invokeFromSymfony4($method, $url, $options);
        };
        parent::__construct($responseFactory, 'https://example.com');
    }

}
