<?php declare(strict_types=1);

namespace Enola\Api;

use Enola\EnolaClient;
use Enola\HttpClient\Message\ResponseMediator;

abstract class AbstractApi
{
    private EnolaClient $client;

    public function __construct(EnolaClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get the client instance.
     */
    protected function getClient(): EnolaClient
    {
        return $this->client;
    }

    /**
     * @return $this
     */
    public function configure()
    {
        return $this;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     GET parameters.
     * @param array  $requestHeaders Request Headers.
     *
     * @return array|string
     */
    protected function get(string $path, array $parameters = [], array $requestHeaders = [])
    {
        if (\count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);
        }

        $response = $this->client->getHttpClient()->get($path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }
}
