<?php declare(strict_types=1);

namespace Enola\Tests\Api;

use Enola\Api\EuropeanVat;

/**
 * @covers \Enola\Api\EuropeanVat
 */
class EuropeanVatTest extends ApiTestCase
{
    public function testShouldGetCityAdvancedInformation()
    {
        $countryCode = 'IT';
        $vatNumber = 'IT';
        $expectedArray = [[
            'id' => '123',
            'name' => 'foo',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/companies/$countryCode/$vatNumber")
            ->will(self::returnValue($expectedArray));

        self::assertEquals($expectedArray, $api->getCompanyInformation($countryCode, $vatNumber));
    }

    protected function getApiClass(): string
    {
        return EuropeanVat::class;
    }
}
