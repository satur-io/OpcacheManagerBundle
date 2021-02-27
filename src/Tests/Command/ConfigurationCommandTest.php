<?php


namespace Saturio\OpcacheManagerBundle\Tests\Command;


use Saturio\OpcacheManagerBundle\Tests\Helper\MockerPHPFunctions;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ConfigurationCommandTest extends KernelTestCase
{
    use MockerPHPFunctions;


    public function testOkExecute()
    {
        $this->setCacheResult(true);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('saturio:opcache:configuration');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('This is your OPcache configuration', $output);
    }

    public function testKoExecute()
    {
        $this->setCacheResult(true);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('saturio:opcache:configuration');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Cache configuration could not be showed', $output);
    }
}