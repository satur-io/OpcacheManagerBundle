<?php


namespace Dhernandez\Tests\Command;


use Dhernandez\Tests\Helper\MockerPHPFunctions;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ResetCommandTest extends KernelTestCase
{
    use MockerPHPFunctions;


    public function testOkExecute()
    {
        $this->setCacheResult(true);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('dhernandez:opcache:reset');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Cache reset', $output);
    }

    public function testKoExecute()
    {
        $this->setCacheResult(true);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('dhernandez:opcache:reset');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Cache could not be reset', $output);
    }
}
