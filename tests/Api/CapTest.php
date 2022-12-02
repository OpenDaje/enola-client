<?php declare(strict_types=1);

namespace Enola\Tests\Api;

use Enola\Api\Cap;

/**
 * @covers \Enola\Api\Cap
 */
class CapTest extends ApiTestCase
{
    //TODO
    public function ShouldSearchCity()
    {
    }

    public function testShouldGetCityInformation()
    {
        $istatCode = '000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/comuni_base/$istatCode")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getCityInformation($istatCode));
    }

    public function testShouldGetCityAdvancedInformation()
    {
        $istatCode = '000000';
        $expectedArray = [[
            'id' => '123',
            'name' => 'foo',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/comuni_advance/$istatCode")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getCityAdvancedInformation($istatCode));
    }

    public function testShouldGetSuppressedCities()
    {
        $expectedArray = [[
            'id' => '123',
            'foo' => 'bar',
        ]];
        $queryParams = [
            'sigla_provincia' => 'RM',
        ];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/comuni_soppressi", $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getSuppressedCities($queryParams));
    }

    public function testShouldGetMetropolitanCities()
    {
        $expectedArray = [[
            'id' => '123',
            'foo' => 'bar',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/citta_metropolitane")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getMetropolitanCities());
    }

    protected function getApiClass(): string
    {
        return Cap::class;
    }
}
