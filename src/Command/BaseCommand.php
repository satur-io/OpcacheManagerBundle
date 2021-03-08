<?php


namespace Saturio\OpcacheManagerBundle\Command;


use Saturio\OpcacheManagerBundle\Util\ResponsePrinter;
use Saturio\OpcacheManagerBundle\Route\Router;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

trait BaseCommand
{
    protected HttpClientInterface $client;
    protected Router $routerManager;
    protected string $defaultUri;

    protected string $route;
    protected string $okMessage;
    protected string $errorMessage;

    use ResponsePrinter;

    public function __construct(HttpClientInterface $client, Router $routerManager, string $defaultUri)
    {
        $this->client = $client;
        $this->defaultUri = $defaultUri;
        $this->routerManager = $routerManager;

        parent::__construct();
    }

    protected function addRoutes()
    {
        $this->routerManager->addOpCacheRoutes($this->getApplication());
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->client->request('GET', sprintf('%s/%s', $this->defaultUri, $this->route));

        $io = new SymfonyStyle($input, $output);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $io->error('Something goes wrong');
            $this->printResponse($io, $response);
            $io->error($this->errorMessage);
            return defined('Command::FAILURE') ? Command::FAILURE : 1;
        }

        $this->printResponse($io, $response);
        $io->success($this->okMessage);
        return defined('Command::SUCCESS') ? Command::SUCCESS : 0;
    }

    protected function routeValues(string $route, string $okMessage, string $errorMessage)
    {
        $this->route = $route;
        $this->okMessage = $okMessage;
        $this->errorMessage = $errorMessage;
    }

    public function __destruct()
    {
        $this->routerManager->removeOpCacheRoutes($this->getApplication()->getKernel()->getCacheDir());
    }
}
