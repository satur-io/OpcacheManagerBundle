<?php


namespace Dhernandez\Tests\Command;


use Dhernandez\Tests\Helper\MockerPHPFunctions;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class StatusCommandTest extends KernelTestCase
{
    use MockerPHPFunctions;


    public function testOkExecute()
    {
        $this->setCacheResult(true);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('dhernandez:opcache:status');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('This is your OPcache status', $output);
    }

    public function testKoExecute()
    {
        $this->setCacheResult(true);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('dhernandez:opcache:status');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Cache status could not be showed', $output);
    }
}
