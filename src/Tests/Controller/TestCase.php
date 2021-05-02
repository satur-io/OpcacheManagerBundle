<?php


namespace Saturio\OpcacheManagerBundle\Tests\Controller;


use Saturio\OpcacheManagerBundle\Tests\Helper\MockerPHPFunctions;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpKernel\HttpKernelBrowser;
use Symfony\Component\HttpKernel\UriSigner;


class TestCase extends WebTestCase
{
    use MockerPHPFunctions;

    private const URI_SCHEMA_TO_SIGN = 'http';
    private const URI_HOST_TO_SIGN = 'localhost';


    protected UriSigner $signer;
    protected HttpKernelBrowser $client;


    protected function setUp(): void
    {
        $this->client = static::createClient();
        self::bootKernel();
        $this->signer = self::$container->get('uri_signer');
    }

    protected function signedRequest(string $method, string $uri): Crawler
    {
        $fullUrl = $this->signer->sign(self::URI_SCHEMA_TO_SIGN.'://'.self::URI_HOST_TO_SIGN.$uri);
        $uriParts = parse_url($fullUrl);
        $path = isset($uriParts['path']) ? $uriParts['path'] : '';
        $query = isset($uriParts['query']) && $uriParts['query'] ? '?'.$uriParts['query'] : '';
        $fragment = isset($uriParts['fragment']) ? '#'.$uriParts['fragment'] : '';
        return $this->client->request('GET', $path.$query.$fragment);
    }
}