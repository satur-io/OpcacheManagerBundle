<?php

declare(strict_types=1);

namespace Saturio\OpcacheManagerBundle;


use Symfony\Component\HttpKernel\Bundle\Bundle;

class SaturioOpcacheManagerBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
