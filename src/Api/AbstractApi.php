<?php declare(strict_types=1);

namespace Enola\Api;

use Enola\EnolaClient;

abstract class AbstractApi
{
    private EnolaClient $client;

    public function __construct(EnolaClient $client)
    {
        $this->client = $client;
    }
}
