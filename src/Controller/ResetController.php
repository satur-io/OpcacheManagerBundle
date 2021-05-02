<?php


namespace Saturio\OpcacheManagerBundle\Controller;


use Symfony\Component\HttpFoundation\Response;

class ResetController implements BaseController
{
    public function reset(): Response
    {
        return opcache_reset() ? new Response(null, 200) : new Response('', 500);
    }
}
