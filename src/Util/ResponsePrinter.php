<?php


namespace Dhernandez\Util;


use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;

trait ResponsePrinter
{
    protected function printResponse(OutputInterface $output, \Symfony\Contracts\HttpClient\ResponseInterface $response): void
    {
        $this->printCode($output, $response->getStatusCode());
        $output->writeln('');
        $this->printHeaders($output, $response->getHeaders(false));
        $output->writeln('');
        $this->printContent($output, $response->getContent(false));
    }

    protected function printCode(OutputInterface $output, int $statusCode): void
    {
        $output->writeln(sprintf('Code response: <fg=white;bg=%s;options=bold>%s</>',
            $statusCode === Response::HTTP_OK ? 'green' : 'red',
            $statusCode));
    }

    protected function printHeaders(OutputInterface $output, ?array $headers): void
    {
        $output->writeln('<fg=white;options=bold>Headers</>');
        $output->writeln('<fg=white;options=bold>=======s</>');
        $output->writeln(sprintf('<fg=cyan;options=conceal>%s</>',
            json_encode($headers, JSON_PRETTY_PRINT)));
    }

    protected function printContent(OutputInterface $output, string $content): void
    {
        $output->writeln('<fg=white;options=bold>Body</>');
        $output->writeln('<fg=white;options=bold>====</>');
        $output->writeln(sprintf('<fg=white;bg=cyan>%s</>',
            json_encode(json_decode($content), JSON_PRETTY_PRINT)));
    }
}
