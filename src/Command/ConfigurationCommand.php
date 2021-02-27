<?php


namespace Saturio\OpcacheManagerBundle\Command;


use Saturio\OpcacheManagerBundle\Util\ResponsePrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ConfigurationCommand extends Command
{
    use BaseCommand;

    public static $defaultName = 'saturio:opcache:configuration';


    protected function configure()
    {
        $this
            ->setDescription('Show OPcache configuration')
            ->setHelp(sprintf(
                'This command do a GET request to %s/opcache/configuration, where opcache_get_configuration() is called',
                $this->defaultUri));
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->addRoutes();

        $this->routeValues(
            'opcache/configuration',
            'This is your OPcache configuration',
            'Cache configuration could not be showed',
            );
    }
}