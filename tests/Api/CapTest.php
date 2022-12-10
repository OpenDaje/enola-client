<?php declare(strict_types=1);

namespace Enola\Tests\Api;

use Enola\Api\Cap;

/**
 * @covers \Enola\Api\Cap
 */
class CapTest extends ApiTestCase
{
    public function testShouldSearchCity(): void
    {
        $queryParams = [
            'cap' => '00100',
            'regione' => 'lazio',
        ];
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/cerca_comuni', $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->searchCity($queryParams));
    }

    public function testShouldGetBaseCityInformation(): void
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

        self::assertSame($expectedArray, $api->getBaseCityInformation($istatCode));
    }

    public function testShouldGetFullCityInformation(): void
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

        self::assertSame($expectedArray, $api->getFullCityInformation($istatCode));
    }

    public function testShouldGetSuppressedCities(): void
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

        self::assertSame($expectedArray, $api->getSuppressedCities($queryParams));
    }

    public function testShouldGetMetropolitanCities(): void
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

        self::assertSame($expectedArray, $api->getMetropolitanCities());
    }

    public function testShouldGetCitiesByCap(): void
    {
        $cap = '00100';
        $expectedArray = [[
            'id' => '123',
            'foo' => 'bar',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/cap/' . $cap)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getCitiesByCap($cap));
    }

    public function testShouldGetRegioni(): void
    {
        $expectedArray = [[
            'id' => '123',
            'foo' => 'bar',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/regioni')
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getRegioni());
    }

    public function testShouldGetProvince(): void
    {
        $expectedArray = [[
            'id' => '123',
            'foo' => 'bar',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with('/province')
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getProvince());
    }

    public function testShouldGetProvinceByCode(): void
    {
        $code = '000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/province/$code")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getProvinceByCode($code));
    }

    protected function getApiClass(): string
    {
        return Cap::class;
    }
}
