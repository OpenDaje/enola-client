<?php declare(strict_types=1);

namespace Enola;

use BadMethodCallException;
use Enola\Api\AbstractApi;
use Enola\HttpClient\Builder;

use Enola\HttpClient\Plugin\Authentication;
use Http\Client\Common\HttpMethodsClientInterface;

use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
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
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'php-enola-api-client (https://github.com/OpenDaje/enola-client)',
            'Accept' => 'application/json',
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
     * Sets the api host URL.
     */
    private function setApiEndpoint(AbstractApi $api): void
    {
        $apiEndpoint = $this->isSandbox ? $api::SANDBOX : $api::ENDPOINT;
        $builder = $this->getHttpClientBuilder();
        $builder->removePlugin(AddHostPlugin::class);
        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri($apiEndpoint)));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function api(string $name): AbstractApi
    {
        switch ($name) {
            case 'cap':
                $api = new Api\Cap($this);
                $this->setApiEndpoint($api);
                break;

            case 'europeanvat':
                $api = new Api\EuropeanVat($this);
                $this->setApiEndpoint($api);
                break;

            case 'vehicle':
                $api = new Api\Vehicle($this);
                $this->setApiEndpoint($api);
                break;

            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }

        return $api;
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

    public function authenticate(string $token): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(new Authentication($token));
    }
}
