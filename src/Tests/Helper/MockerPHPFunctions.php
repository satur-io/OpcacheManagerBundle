<?php

namespace Dhernandez\Controller;

function opcache_reset(): bool
{
    global $opCacheResult;
    return $opCacheResult;
}

function opcache_get_status(): bool
{
    global $opCacheStatus;
    return $opCacheStatus;
}

function opcache_get_configuration(): bool
{
    global $opCacheConfiguration;
    return $opCacheConfiguration;
}


namespace Dhernandez\Tests\Helper;


trait MockerPHPFunctions
{
    private function setCacheResult(bool $result): void
    {
        global $opCacheResult;
        $opCacheResult = $result;
    }

    private function setStatusResult(bool $result): void
    {
        global $opCacheStatus;
        $opCacheStatus = $result;
    }

    private function setConfigurationResult(bool $result): void
    {
        global $opCacheConfiguration;
        $opCacheConfiguration = $result;
    }
}