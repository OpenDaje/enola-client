<?php declare(strict_types=1);

namespace Enola\Api;

/**
 * Web service that allows you to receive information about a vehicle starting from its license plate.
 *
 * @link https://developers.openapi.it/categories/car/targa
 */
class Vehicle extends AbstractApi
{
    public const ENDPOINT = 'https://targa.openapi.it';

    public const SANDBOX = 'https://test.targa.openapi.it';

    /**
     * This method shows information about a car starting from its Italian license plate
     *
     * @link https://developers.openapi.it/categories/car/targa#/Vehicles/get_auto__targa_
     *
     * @return array|string
     */
    public function getCarInformation(string $licensePlate, array $params = [])
    {
        return $this->get('/auto/' . $licensePlate, $params);
    }

    /**
     * This method shows information about a motorcycle starting from its Italian license plate
     *
     * @link https://developers.openapi.it/categories/car/targa#/Vehicles/get_moto__targa_
     *
     * @return array|string
     */
    public function getMotorcycleInformation(string $licensePlate, array $params = [])
    {
        return $this->get('/moto/' . $licensePlate, $params);
    }

    /**
     * This method shows information about car insurance starting from its Italian license plate
     *
     * @link https://developers.openapi.it/categories/car/targa#/Vehicles/get_assicurazione__targa_
     *
     * @return array|string
     */
    public function getInsuranceInformation(string $licensePlate, array $params = [])
    {
        return $this->get('/assicurazione/' . $licensePlate, $params);
    }
}
