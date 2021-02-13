<?php


namespace Dhernandez\Controller;


use Symfony\Component\HttpFoundation\Response;

class ResetController
{
    public function reset(): Response
    {
        return opcache_reset() ? new Response(null, 200) : new Response('', 500);
    }
}
