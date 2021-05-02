<?php


namespace Saturio\OpcacheManagerBundle\Controller;


use Symfony\Component\HttpFoundation\Response;

class ConfigurationController implements BaseController
{
    public function getConfiguration(): Response
    {
        $status = opcache_get_configuration();
        $response = $status ? [json_encode($status), 200] : [null, 500];
        return new Response(...$response);
    }
}
