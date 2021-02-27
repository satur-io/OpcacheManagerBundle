<?php


namespace Saturio\OpcacheManagerBundle\Controller;


use Symfony\Component\HttpFoundation\Response;

class StatusController
{
    public function getStatus(): Response
    {
        $status = opcache_get_status();
        $response = $status ? [json_encode($status), 200] : [null, 500];
        return new Response(...$response);
    }
}
