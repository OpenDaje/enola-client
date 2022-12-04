<?php declare(strict_types=1);

namespace Enola\Tests\Api;

use Enola\Api\Imprese;

/**
 * @covers \Enola\Api\Imprese
 */
class ImpreseTest extends ApiTestCase
{
    public function testShouldGetCompanyInformation()
    {
        $pivaOrVatOrId = '000000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/base/$pivaOrVatOrId")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getCompanyByPartitaIva($pivaOrVatOrId));
    }

    public function testShouldGetAdvancedCompanyInformation()
    {
        $queryString = [
            'foo' => 'bar',
        ];
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/advance", $queryString)
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getAdvancedCompanyInformation($queryString));
    }

    public function testShouldGetFullCompanyInformation()
    {
        $pivaOrVatOrId = '000000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/advance/$pivaOrVatOrId")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getFullCompanyByPartitaIva($pivaOrVatOrId));
    }

    public function testShouldGetClosedCompanyInformation()
    {
        $pivaOrVat = '000000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/closed/$pivaOrVat")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getClosedCompanyByPartitaIva($pivaOrVat));
    }

    public function testShouldGetGruppoIva()
    {
        $pivaOrVat = '000000000';
        $queryString = [
            'cf' => 'AABBCCDDEE',
        ];
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/gruppoiva/$pivaOrVat")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getGruppoIva($pivaOrVat, $queryString));
    }

    public function testShouldGetCompanyPec()
    {
        $pivaOrVat = '000000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/pec/$pivaOrVat")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getCompanyPec($pivaOrVat));
    }

    public function testShouldGetAutocomplete()
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

        self::assertEquals($expectedArray, $api->getAutocomplete($term));
    }

    public function testShouldGetFormaGiuridica()
    {
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/forma_giuridica")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getFormaGiuridica());
    }

    public function testShouldGetFormaGiuridicaByCode()
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

        self::assertEquals($expectedArray, $api->getFormaGiuridicaByCode($formaGiuridicaCode));
    }

    public function testShouldGetUpdates()
    {
        $queryString = [
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
            ->with("/updates", $queryString)
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getUpdates($queryString));
    }

    public function testShouldGetUpdatesSince()
    {
        $since = new \DateTimeImmutable('now');
        $queryString = [
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
            ->with("/updates/" . $since->getTimestamp(), $queryString)
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getUpdateSince($since, $queryString));
    }

    protected function getApiClass(): string
    {
        return Imprese::class;
    }
}
