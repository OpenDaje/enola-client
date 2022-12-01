<?php declare(strict_types=1);

namespace Enola;

use BadMethodCallException;
use Enola\Api\AbstractApi;
use Enola\HttpClient\Builder;

use Enola\HttpClient\Plugin\Authentication;
use Http\Client\Common\HttpMethodsClientInterface;

use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use InvalidArgumentException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

/**
 * EnolaClient
 */
class EnolaClient
{
    private Builder $httpClientBuilder;


    private bool $isSandbox;

    public function __construct(string $token, bool $isSandbox = false, Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();
        $this->isSandbox = $isSandbox;
        /**
         * TODO
         * - Content-negotiation and accept?
         *      'Accept' => sprintf('application/vnd.github.%s+json', $this->apiVersion),
         */
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'php-enola-api-client (https://github.com/OpenDaje/enola-client)',
        ]));

        if ($token) {
            $builder->addPlugin(new Authentication($token));
        }
    }

    /**
     * Create a EnolaClient using an HTTP client.
     */
    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self('', false, $builder);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function api(string $name): AbstractApi
    {
    }

    /**
     * @param string $name
     * @param array  $args
     */
    public function __call($name, $args): AbstractApi
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    /**
     * Add a cache plugin to cache responses locally.
     */
    public function addCache(CacheItemPoolInterface $cachePool, array $config = []): void
    {
        $this->getHttpClientBuilder()->addCache($cachePool, $config);
    }

    /**
     * Remove the cache plugin.
     */
    public function removeCache(): void
    {
        $this->getHttpClientBuilder()->removeCache();
    }
}
