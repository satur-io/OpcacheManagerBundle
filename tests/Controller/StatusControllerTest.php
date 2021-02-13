<?php


namespace Dhernandez\Tests\Controller;


use Dhernandez\Tests\Helper\MockerPHPFunctions;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatusControllerTest extends WebTestCase
{
    use MockerPHPFunctions;

    public function testOkStatusController()
    {
        $this->setStatusResult(true);
        $client = static::createClient();
        $client->request('GET', '/opcache/status');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testKoStatusController()
    {
        $this->setStatusResult(false);
        $client = static::createClient();
        $client->request('GET', '/opcache/status');

        $this->assertResponseStatusCodeSame(500);
    }
}
