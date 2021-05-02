<?php


namespace Saturio\OpcacheManagerBundle\Tests\Controller;


use Saturio\OpcacheManagerBundle\Tests\Helper\MockerPHPFunctions;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ConfigurationControllerTest extends TestCase
{
    use MockerPHPFunctions;

    private const URI_SCHEMA_TO_SIGN = 'http';
    private const URI_HOST_TO_SIGN = 'localhost';

    public function testOkConfigurationController()
    {
        $this->setConfigurationResult(true);
        $this->signedRequest('GET', '/opcache/configuration');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testKoConfigurationController()
    {
        $this->setConfigurationResult(false);
        $this->signedRequest('GET', '/opcache/configuration');
        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function testUnsignedConfiguration()
    {
        $this->client->catchExceptions(false);
        $this->expectException(AccessDeniedHttpException::class);
        $this->client->request('GET', '/opcache/configuration');
    }
}
