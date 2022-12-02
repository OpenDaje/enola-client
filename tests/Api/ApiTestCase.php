<?php declare(strict_types=1);

namespace Enola\Tests\Api;

use Enola\EnolaClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use ReflectionMethod;

abstract class ApiTestCase extends TestCase
{
    abstract protected function getApiClass(): string;

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getApiMock()
    {
        $httpClient = self::getMockBuilder(ClientInterface::class)
            ->onlyMethods(['sendRequest'])
            ->getMock();
        $httpClient
            ->expects(self::any())
            ->method('sendRequest');

        $client = EnolaClient::createWithHttpClient($httpClient);

        return self::getMockBuilder($this->getApiClass())
            ->setMethods(['get', 'post', 'postRaw', 'patch', 'delete', 'put', 'head'])
            ->setConstructorArgs([$client])
            ->getMock();
    }

    /**
     * @param object $object
     * @param string $methodName
     *
     * @return ReflectionMethod
     */
    protected function getMethod($object, $methodName)
    {
        $method = new ReflectionMethod($object, $methodName);
        $method->setAccessible(true);

        return $method;
    }
}
