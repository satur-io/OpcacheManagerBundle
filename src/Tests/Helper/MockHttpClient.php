<?php


namespace Saturio\OpcacheManagerBundle\Tests\Helper;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class MockHttpClient extends \Symfony\Component\HttpClient\MockHttpClient implements HttpClientInterface
{
    public function __construct()
    {
        parent::__construct(array(MockClientCallback::class, '__invokeFromSymfony4'), 'http://127.0.0.1');
    }

    public static function create()
    {
        return new self();
    }

}