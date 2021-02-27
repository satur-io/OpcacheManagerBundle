<?php


namespace Saturio\OpcacheManagerBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StatusCommand extends Command
{
    use BaseCommand;

    public static $defaultName = 'saturio:opcache:status';


    protected function configure()
    {
        $this
            ->setDescription('Show OPcache status')
            ->setHelp(sprintf(
                'This command do a GET request to %s/opcache/status, where opcache_get_status() is called',
                $this->defaultUri));
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->addRoutes();

        $this->routeValues(
            'opcache/status',
            'This is your OPcache status',
            'Cache status could not be showed',
            );
    }
}
