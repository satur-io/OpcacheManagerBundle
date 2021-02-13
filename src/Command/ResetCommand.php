<?php


namespace Dhernandez\Command;


use Dhernandez\Util\ResponsePrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ResetCommand extends Command
{
    public static $defaultName = 'dhernandez:opcache:reset';

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
            ->setDescription('Reset OPcache')
            ->setHelp('This command do a GET request to http://127.0.0.1/opcache/reset, where opcache_reset() is called');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->client->request('GET', 'http://127.0.0.1/opcache/reset');

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $output->writeln('<error>Something goes wrong</error>');
            $this->printResponse($output, $response);
            $output->writeln('<error>Cache could not be reset</error>');
            return Command::FAILURE;
        }

        $this->printResponse($output, $response);
        $output->writeln('<info>Cache reset</info>');
        return Command::SUCCESS;
    }
}
