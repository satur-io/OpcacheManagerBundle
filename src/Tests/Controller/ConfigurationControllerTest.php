<?php


namespace Saturio\OpcacheManagerBundle\Tests\Controller;


use Saturio\OpcacheManagerBundle\Tests\Helper\MockerPHPFunctions;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConfigurationControllerTest extends WebTestCase
{
    use MockerPHPFunctions;

    public function testOkConfigurationController()
    {
        $this->setConfigurationResult(true);
        $client = static::createClient();
        $client->request('GET', '/opcache/configuration');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testKoConfigurationController()
    {
        $this->setConfigurationResult(false);
        $client = static::createClient();
        $client->request('GET', '/opcache/configuration');

        $this->assertResponseStatusCodeSame(500);
    }
}
