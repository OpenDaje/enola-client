<?php declare(strict_types=1);

namespace Enola\Tests;

use Enola\EnolaClient;
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
}
