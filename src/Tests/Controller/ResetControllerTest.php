<?php

namespace Saturio\OpcacheManagerBundle\Tests\Controller;


use Saturio\OpcacheManagerBundle\Tests\Helper\MockerPHPFunctions;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class ResetControllerTest extends TestCase
{
    use MockerPHPFunctions;

    public function testOkResetController()
    {
        $this->setCacheResult(true);
        $this->signedRequest('GET', '/opcache/reset');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testKoResetController()
    {
        $this->setCacheResult(false);
        $this->signedRequest('GET', '/opcache/reset');
        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function testUnsignedReset()
    {
        $this->client->catchExceptions(false);
        $this->expectException(AccessDeniedHttpException::class);
        $this->client->request('GET', '/opcache/reset');
    }
}
