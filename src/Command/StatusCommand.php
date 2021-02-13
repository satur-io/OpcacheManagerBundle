<?php


namespace Dhernandez\Command;


use Dhernandez\Util\ResponsePrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StatusCommand extends Command
{
    public static $defaultName = 'dhernandez:opcache:status';

    protected HttpClientInterface $client;

    use ResponsePrinter;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Show OPcache status')
            ->setHelp('This command do a GET request to http://127.0.0.1/opcache/status, where opcache_get_status() is called');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->client->request('GET', 'http://127.0.0.1/opcache/status');

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $output->writeln('<error>Something goes wrong</error>');
            $this->printResponse($output, $response);
            $output->writeln('<error>Cache status could not be showed</error>');
            return Command::FAILURE;
        }

        $this->printResponse($output, $response);
        $output->writeln('<info>This is your OPcache status</info>');
        return Command::SUCCESS;
    }
}