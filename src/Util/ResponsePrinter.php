<?php


namespace Saturio\OpcacheManagerBundle\Util;


use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

trait ResponsePrinter
{
    private static int $JSON_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

    protected function printResponse(SymfonyStyle $io, ResponseInterface $response): void
    {
        $this->printCode($io, $response->getStatusCode());
        $this->printHeaders($io, $response->getHeaders(false));
        $this->printContent($io, $response->getContent(false));
    }

    private function printCode(SymfonyStyle $io, int $statusCode): void
    {
        $message = sprintf('Code response: %s', $statusCode);
        $statusCode === Response::HTTP_OK ? $io->success($message) : $io->error($message);
    }

    private function printHeaders(SymfonyStyle $io, ?array $headers): void
    {
        $io->section('Headers');
        $io->text(json_encode($headers, self::$JSON_OPTIONS));
    }

    private function printContent(SymfonyStyle $io, string $content): void
    {
        $message = json_encode(json_decode($content), self::$JSON_OPTIONS);

        $io->section('Body');
        $message === 'null' ? $io->info('Empty Body') : $io->text($message);;
    }
}
