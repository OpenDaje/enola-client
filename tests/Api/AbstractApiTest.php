<?php declare(strict_types=1);

namespace Enola\Tests\Api;

use Enola\Api\AbstractApi;
use Enola\EnolaClient;
use GuzzleHttp\Psr7\Response;
use Http\Client\Common\HttpMethodsClientInterface;

/**
 * @covers \Enola\Api\AbstractApi
 */
class AbstractApiTest extends ApiTestCase
{
    public function testShouldPassGETRequestToClient()
    {
        //self::markTestSkipped();
        $expectedArray = ['value'];

        $httpClient = self::getHttpMethodsMock(['get']);
        $httpClient
            ->expects(self::any())
            ->method('get')
            ->with('/path?param1=param1value', [
                'header1' => 'header1value',
            ])
            ->will(self::returnValue($this->getPSR7Response($expectedArray)));
        $client = self::getMockBuilder(EnolaClient::class)
            // added
            ->disableOriginalConstructor()
            ->onlyMethods(['getHttpClient'])
            ->getMock();
        $client->expects(self::any())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $api = $this->getAbstractApiObject($client);

        $actual = $this->getMethod($api, 'get')
            ->invokeArgs($api, [
                '/path', [
                    'param1' => 'param1value',
                ], [
                    'header1' => 'header1value',
                ], ]);

        self::assertEquals($expectedArray, $actual);
    }

    /**
     * Return a HttpMethods client mock.
     */
    protected function getHttpMethodsMock(array $methods = [])
    {
        $mock = self::createMock(HttpMethodsClientInterface::class);

        $mock
            ->expects(self::any())
            ->method('sendRequest');

        return $mock;
    }

    /**
     * @return Response
     */
    private function getPSR7Response(array $expectedArray)
    {
        return new Response(
            200,
            [
                'Content-Type' => 'application/json',
            ],
            \GuzzleHttp\Psr7\stream_for(json_encode($expectedArray, JSON_THROW_ON_ERROR))
        );
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getAbstractApiObject($client)
    {
        return self::getMockBuilder($this->getApiClass())
            //->onlyMethods(['get'])
            ->setConstructorArgs([$client])
            ->getMock();
    }

    protected function getApiClass(): string
    {
        return AbstractApi::class;
    }
}
