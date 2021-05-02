<?php


namespace Saturio\OpcacheManagerBundle\Command;


use Saturio\OpcacheManagerBundle\Util\ResponsePrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\UriSigner;
use Symfony\Contracts\HttpClient\HttpClientInterface;

trait BaseCommand
{
    protected HttpClientInterface $client;
    protected UriSigner $signer;
    protected string $defaultUri;

    protected string $route;
    protected string $okMessage;
    protected string $errorMessage;

    use ResponsePrinter;

    public function __construct(HttpClientInterface $client, UriSigner $signer, string $defaultUri)
    {
        $this->client = $client;
        $this->defaultUri = $defaultUri;
        $this->signer = $signer;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->client->request('GET',
            $this->signer->sign(sprintf('%s/%s', $this->defaultUri, $this->route)));

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
}
