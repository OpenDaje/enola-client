<?php declare(strict_types=1);

namespace Enola\Tests\Api;

use Enola\Api\Imprese;

/**
 * @covers \Enola\Api\Imprese
 */
class ImpreseTest extends ApiTestCase
{
    public function testShouldGetBaseCompanyInformation(): void
    {
        $VatOrCfOrId = '000000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/base/$VatOrCfOrId")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getBaseCompanyInformation($VatOrCfOrId));
    }

    public function testShouldGetCompaniesInformation(): void
    {
        $queryParams = [
            'foo' => 'bar',
        ];
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/advance", $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getCompaniesInformation($queryParams));
    }

    public function testShouldGetFullCompanyInformation(): void
    {
        $VatOrCfOrId = '000000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/advance/$VatOrCfOrId")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getFullCompanyInformation($VatOrCfOrId));
    }

    public function testShouldGetClosedCompanyInformation(): void
    {
        $vatOrCf = '000000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/closed/$vatOrCf")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getClosedCompany($vatOrCf));
    }

    public function testShouldGetGruppoIva(): void
    {
        $vatOrCf = '000000000';
        $queryParams = [
            'cf' => 'AABBCCDDEE',
        ];
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/gruppoiva/$vatOrCf")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getGruppoIva($vatOrCf, $queryParams));
    }

    public function testShouldGetCompanyPec(): void
    {
        $vatOrCf = '000000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/pec/$vatOrCf")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getCompanyPec($vatOrCf));
    }

    public function testShouldGetAutocomplete(): void
    {
        $term = 'mil';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/autocomplete/$term")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getAutocomplete($term));
    }

    public function testShouldGetFormaGiuridica(): void
    {
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/forma_giuridica")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getFormaGiuridica());
    }

    public function testShouldGetFormaGiuridicaByCode(): void
    {
        $formaGiuridicaCode = 'sp';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/forma_giuridica/$formaGiuridicaCode")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getFormaGiuridicaByCode($formaGiuridicaCode));
    }

    public function testShouldGetUpdates(): void
    {
        $queryParams = [
            'lat' => '13.5478',
            'lng' => '42.859',
            'radius' => '100',
        ];
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/updates", $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getUpdates($queryParams));
    }

    public function testShouldGetUpdatesSince(): void
    {
        $since = new \DateTimeImmutable('now');
        $queryParams = [
            'lat' => '13.5478',
            'lng' => '42.859',
            'radius' => '100',
        ];
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/updates/" . $since->getTimestamp(), $queryParams)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getUpdateSince($since, $queryParams));
    }

    protected function getApiClass(): string
    {
        return Imprese::class;
    }
}
