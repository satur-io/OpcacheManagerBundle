<?php


namespace Saturio\OpcacheManagerBundle\Command;


use Saturio\OpcacheManagerBundle\Util\ResponsePrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ResetCommand extends Command
{
    use BaseCommand;

    public static $defaultName = 'saturio:opcache:reset';


    protected function configure()
    {
        $this
            ->setDescription('Reset OPcache')
            ->setHelp(sprintf('This command do a GET request to %s/opcache/reset, where opcache_reset() is called',
                $this->defaultUri));
    }


    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->routeValues(
            'opcache/reset',
            'Cache reset',
            'Cache could not be reset',
            );
    }
}
