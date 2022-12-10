<?php declare(strict_types=1);

namespace Enola\Tests\Api;

use Enola\Api\Vehicle;

/**
 * @covers \Enola\Api\Vehicle
 */
class VehicleTest extends ApiTestCase
{
    public function testShouldGetCityCarInformation()
    {
        $licensePlate = '000000';
        $expectedArray = [[
            'id' => '123',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/auto/$licensePlate")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getCarInformation($licensePlate));
    }

    public function testShouldGetMotorcycleInformation()
    {
        $licensePlate = '000000';
        $expectedArray = [[
            'id' => '123',
            'name' => 'foo',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/moto/$licensePlate")
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getMotorcycleInformation($licensePlate));
    }

    public function testShouldGetInsuranceInformation()
    {
        $licensePlate = '000000';
        $expectedArray = [[
            'id' => '123',
            'foo' => 'bar',
        ]];

        $api = $this->getApiMock();
        $api->expects(self::once())
            ->method('get')
            ->with("/assicurazione/" . $licensePlate)
            ->will(self::returnValue($expectedArray));

        self::assertSame($expectedArray, $api->getInsuranceInformation($licensePlate));
    }

    protected function getApiClass(): string
    {
        return Vehicle::class;
    }
}
