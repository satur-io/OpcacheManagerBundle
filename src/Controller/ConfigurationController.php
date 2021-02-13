<?php


namespace Dhernandez\Controller;


use Symfony\Component\HttpFoundation\Response;

class ConfigurationController
{
    public function getConfiguration(): Response
    {
        $status = opcache_get_configuration();
        $response = $status ? [json_encode($status), 200] : [null, 500];
        return new Response(...$response);
    }
}
