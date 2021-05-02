<?php


namespace Saturio\OpcacheManagerBundle\Tests\Controller;


use Saturio\OpcacheManagerBundle\Tests\Helper\MockerPHPFunctions;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class StatusControllerTest extends TestCase
{
    use MockerPHPFunctions;

    public function testOkStatusController()
    {
        $this->setStatusResult(true);
        $this->signedRequest('GET', '/opcache/status');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testKoStatusController()
    {
        $this->setStatusResult(false);
        $this->signedRequest('GET', '/opcache/status');
        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function testUnsignedStatus()
    {
        $this->client->catchExceptions(false);
        $this->expectException(AccessDeniedHttpException::class);
        $this->client->request('GET', '/opcache/status');
    }
}
