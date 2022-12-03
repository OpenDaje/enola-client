<?php declare(strict_types=1);

namespace Enola\Tests;

use BadMethodCallException;
use Enola\Api;
use Enola\EnolaClient;
use Enola\HttpClient\Builder;
use Enola\HttpClient\Plugin\Authentication;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

/**
 * @covers \Enola\EnolaClient
 */
class EnolaClientTest extends TestCase
{
    public function testShouldNotHaveToPassHttpClientToConstructor()
    {
        $enolaClient = new EnolaClient('token');

        self::assertInstanceOf(ClientInterface::class, $enolaClient->getHttpClient());
    }

    public function testShouldPassHttpClientInterfaceToNamedConstructor()
    {
        $httpClientMock = self::getMockBuilder(ClientInterface::class)
            ->getMock();

        $enolaClient = EnolaClient::createWithHttpClient($httpClientMock);

        self::assertInstanceOf(ClientInterface::class, $enolaClient->getHttpClient());
    }

    public function testShouldAuthenticateUsingGivenToken()
    {
        $builder = self::getMockBuilder(Builder::class)
            ->onlyMethods(['addPlugin', 'removePlugin'])
            ->getMock();
        $builder->expects(self::once())
            ->method('addPlugin')
            ->with(self::equalTo(new Authentication('token')));

        $builder->expects(self::once())
            ->method('removePlugin')
            ->with(Authentication::class);

        $client = self::getMockBuilder(EnolaClient::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getHttpClientBuilder'])
            ->getMock();
        $client->expects(self::any())
            ->method('getHttpClientBuilder')
            ->willReturn($builder);

        $client->authenticate('token');
    }

    /**
     * @dataProvider getApiClassesProvider
     */
    public function testShouldGetApiInstance($apiName, $class)
    {
        $client = new EnolaClient('token');

        self::assertInstanceOf($class, $client->api($apiName));
    }

    /**
     * @dataProvider getApiClassesProvider
     */
    public function testShouldGetMagicApiInstance($apiName, $class)
    {
        $client = new EnolaClient('token');

        self::assertInstanceOf($class, $client->$apiName());
    }

    public function testShouldNotGetApiInstance()
    {
        self::expectException(InvalidArgumentException::class);
        $client = new EnolaClient('token');
        $client->api('do_not_exist');
    }

    public function testShouldNotGetMagicApiInstance()
    {
        self::expectException(BadMethodCallException::class);
        $client = new EnolaClient('token');
        $client->doNotExist();
    }

    public function getApiClassesProvider(): array
    {
        return [
            ['cap', Api\Cap::class],
            ['vehicle', Api\Vehicle::class],
            ['europeanvat', Api\EuropeanVat::class],
        ];
    }
}
