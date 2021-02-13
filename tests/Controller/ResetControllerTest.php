<?php

namespace Dhernandez\Tests\Controller;


use Dhernandez\Tests\Helper\MockerPHPFunctions;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ResetControllerTest extends WebTestCase
{
    use MockerPHPFunctions;

    public function testOkResetController()
    {
        $this->setCacheResult(true);
        $client = static::createClient();
        $client->request('GET', '/opcache/reset');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testKoResetController()
    {
        $this->setCacheResult(false);
        $client = static::createClient();
        $client->request('GET', '/opcache/reset');

        $this->assertResponseStatusCodeSame(500);
    }
}
